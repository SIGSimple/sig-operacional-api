<?php

class RecursoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(RecursoTO $tObj) {
		$sql = "INSERT INTO tb_recurso (cod_tipo_recurso, nme_recurso) 
				VALUES (:cod_tipo_recurso, :nme_recurso);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_tipo_recurso', $tObj->cod_tipo_recurso, PDO::PARAM_STR);
		$insert->bindValue(':nme_recurso', $tObj->nme_recurso, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(RecursoTO $tObj) {
		$sql = "UPDATE tb_recurso
				SET nme_recurso = :nme_recurso,
					cod_tipo_recurso = :cod_tipo_recurso
				WHERE id = :id";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':cod_tipo_recurso', $tObj->cod_tipo_recurso, PDO::PARAM_STR);
		$update->bindValue(':nme_recurso', $tObj->nme_recurso, PDO::PARAM_STR);
		$update->bindValue(':id', 		$tObj->id, 					PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM tb_recurso WHERE id = ". $id;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT rec.id, rec.cod_tipo_recurso, ttr.nme_tipo_recurso, rec.nme_recurso
				FROM tb_recurso AS rec
				INNER JOIN tb_tipo_recurso AS ttr ON ttr.id = rec.cod_tipo_recurso";
		
		$nolimit = false;
		$limit = 5;
		$offset = 0;
		$sort = "";
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

			if(isset($busca['sort'])) {
				$sort = $busca['sort'];
				unset($busca['sort']);
			}	

			if(isset($busca['order'])) {
				$order = $busca['order'];
				unset($busca['order']);

				if($order == "asc")
					$order = SORT_ASC;
				else if($order == "desc")
					$order = SORT_DESC;
			}

			if(isset($busca['search'])) {
				$search = $busca['search'];
				unset($busca['search']);
			}

			if($search != "") {
				$sql .= " WHERE rec.nme_recurso LIKE '%$search%' OR ttr.nme_tipo_recurso LIKE '%$search%'";

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
				if($sort != "")
					$result = parse_arr_values(array_orderby($select->fetchALL(PDO::FETCH_ASSOC), $sort, $order),"all");
				else
					$result = parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC),"all");

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