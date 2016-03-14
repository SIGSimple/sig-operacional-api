<?php

class SituacaoContratoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(SituacaoContratoTO $tObj) {
		$sql = "INSERT INTO tb_situacao_pi (desc_situacao, cod_atendimento) 
				VALUES (:desc_situacao, :cod_atendimento);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':desc_situacao', $tObj->desc_situacao, PDO::PARAM_STR);
		$insert->bindValue(':cod_atendimento', $tObj->cod_atendimento, PDO::PARAM_INT);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(SituacaoContratoTO $tObj) {
		$sql = "UPDATE tb_situacao_pi
				SET desc_situacao = :desc_situacao,
					cod_atendimento = :cod_atendimento
				WHERE cod_situacao = :cod_situacao";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':desc_situacao', $tObj->desc_situacao, PDO::PARAM_STR);
		$update->bindValue(':cod_atendimento', $tObj->cod_atendimento, PDO::PARAM_INT);
		$update->bindValue(':cod_situacao', 				$tObj->cod_situacao, 					PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_situacao) {
		$sql = "DELETE FROM tb_situacao_pi WHERE cod_situacao = ". $cod_situacao;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT *
				FROM tb_situacao_pi";
		
		$nolimit = false;
		$limit = 5;
		$offset = 0;
		$order = "asc";
		$search = "";

		if(is_array($busca) && count($busca) > 0) {
			if(isset($busca['nolimit'])) {
				$nolimit = true;
				unset($busca['nolimit']);
			}

			if(isset($busca['limit'])) {
				$limit = $busca['limit'];
				unset($busca['limit']);
			}

			if(isset($busca['offset'])) {
				$offset = $busca['offset'];
				unset($busca['offset']);
			}	

			if(isset($busca['order'])) {
				$order = $busca['order'];
				unset($busca['order']);
			}	

			if(isset($busca['search'])) {
				$search = $busca['search'];
				unset($busca['search']);
			}

			if($search != "") {
				$sql .= " WHERE desc_situacao LIKE '%$search%'";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}
			}
			else if(count($busca) > 0) {
				$where = prepareWhere($busca);
				$sql .= " WHERE " . $where;
			}
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$result = parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), 'all');

				if($order != "asc")
					$result = array_reverse($result);


				$sizeOfResult = count($result);
				
				if(!$nolimit)
					$result = array_slice($result, $offset, $limit);

				$data = array();
				$data['total'] 	= $sizeOfResult;
				$data['rows'] 	= $result;

				return $data;
			}
			else
				return false;
		}
		else
			return false;

	}
}

?>