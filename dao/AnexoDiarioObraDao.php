<?php

class AnexoDiarioObraDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(AnexoDiarioObraTO $tObj) {
		$sql = "INSERT INTO tb_acompanhamento_arquivo ( cod_referencia, nme_arquivo, pth_arquivo, dsc_observacoes ) 
				VALUES ( :cod_referencia, :nme_arquivo, :pth_arquivo, :dsc_observacoes );";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_referencia', $tObj->cod_referencia, PDO::PARAM_INT);
		$insert->bindValue(':nme_arquivo', $tObj->nme_arquivo, PDO::PARAM_STR);
		$insert->bindValue(':pth_arquivo', $tObj->pth_arquivo, PDO::PARAM_STR);
		$insert->bindValue(':dsc_observacoes', $tObj->dsc_observacoes, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function delete($id_arquivo) {
		$sql = "DELETE FROM tb_acompanhamento_arquivo WHERE id_arquivo = ". $id_arquivo;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT * FROM tb_acompanhamento_arquivo";
		
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
				$sql .= " WHERE nme_arquivo LIKE '%$search%' OR dsc_observacoes LIKE '%$search%'";

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