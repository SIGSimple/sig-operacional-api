<?php

class DivisaoBaciaDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(DivisaoBaciaTO $tObj) {
		$sql = "INSERT INTO tb_diretoria (desc_diretoria, nome_diretor) 
				VALUES (:desc_diretoria, :nome_diretor);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':desc_diretoria', 	$tObj->desc_diretoria,	PDO::PARAM_STR);
		$insert->bindValue(':nome_diretor', 	$tObj->nome_diretor, 	PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(DivisaoBaciaTO $tObj) {
		$sql = "UPDATE tb_diretoria
				SET desc_diretoria = :desc_diretoria,
					nome_diretor = :nome_diretor
				WHERE id = :id";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':desc_diretoria', 	$tObj->desc_diretoria,	PDO::PARAM_STR);
		$update->bindValue(':nome_diretor', 	$tObj->nome_diretor, 		PDO::PARAM_STR);
		$update->bindValue(':id', 				$tObj->id, 					PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_agencia_cetesb) {
		$sql = "DELETE FROM tb_diretoria WHERE id = ". $cod_agencia_cetesb;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT *
				FROM tb_diretoria";
		
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
				$sql .= " WHERE desc_diretoria LIKE '%$search%' OR nome_diretor LIKE '%$search%'";

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