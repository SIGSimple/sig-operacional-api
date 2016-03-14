<?php

class HistogramaDiarioObraDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(HistogramaDiarioObraTO $tObj) {
		$sql = "INSERT INTO tb_histograma (cod_acompanhamento, cod_recurso, qtd_recurso, dsc_observacoes) 
				VALUES (:cod_acompanhamento, :cod_recurso, :qtd_recurso, :dsc_observacoes);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_acompanhamento', $tObj->cod_acompanhamento, PDO::PARAM_INT);
		$insert->bindValue(':cod_recurso', $tObj->cod_recurso, PDO::PARAM_INT);
		$insert->bindValue(':qtd_recurso', $tObj->qtd_recurso, PDO::PARAM_INT);
		$insert->bindValue(':dsc_observacoes', $tObj->dsc_observacoes, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(HistogramaDiarioObraTO $tObj) {
		$sql = "UPDATE tb_histograma
				SET cod_recurso = :cod_recurso,
					qtd_recurso = :qtd_recurso,
					dsc_observacoes = :dsc_observacoes,
				WHERE id = :id";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':cod_recurso', $tObj->cod_recurso, PDO::PARAM_INT);
		$update->bindValue(':qtd_recurso', $tObj->qtd_recurso, PDO::PARAM_INT);
		$update->bindValue(':dsc_observacoes', $tObj->dsc_observacoes, PDO::PARAM_STR);
		$update->bindValue(':id', $tObj->id, PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM tb_histograma WHERE id = ". $id;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					hsg.id,
					hsg.cod_acompanhamento,
					hsg.cod_recurso,
					rec.nme_recurso,
					ttr.nme_tipo_recurso,
					hsg.qtd_recurso,
					hsg.dsc_observacoes
				FROM tb_histograma 			AS hsg
				INNER JOIN tb_recurso 		AS rec ON rec.id = hsg.cod_recurso
				INNER JOIN tb_tipo_recurso 	AS ttr ON ttr.id = rec.cod_tipo_recurso";
		
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
				$sql .= " WHERE nme_recurso LIKE '%$search%' OR nme_tipo_recurso LIKE '%$search%' OR dsc_observacoes LIKE '%$search%'";

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