<?php

class ManancialLancamentoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(ManancialLancamentoTO $tObj) {
		$sql = "INSERT INTO tb_manancial_lancamento (nme_manancial) 
				VALUES (:nme_manancial);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':nme_manancial', $tObj->nme_manancial, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(ManancialLancamentoTO $tObj) {
		$sql = "UPDATE tb_manancial_lancamento
				SET nme_manancial = :nme_manancial
				WHERE id = :id";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':nme_manancial', $tObj->nme_manancial, PDO::PARAM_STR);
		$update->bindValue(':id', 				$tObj->id, 					PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_agencia_cetesb) {
		$sql = "DELETE FROM tb_manancial_lancamento WHERE id = ". $cod_agencia_cetesb;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT *
				FROM tb_manancial_lancamento";
		
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
				$sql .= " WHERE nme_manancial LIKE '%$search%'";

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