<?php

class ItemCronogramaContratoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(ItemCronogramaContratoTO $tObj) {
		$sql = "INSERT INTO tb_contrato_cronograma_item (desc_depto, sigla) 
				VALUES (:desc_depto, :sigla);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':desc_depto', $tObj->desc_depto, PDO::PARAM_STR);
		$insert->bindValue(':sigla', $tObj->sigla, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(ItemCronogramaContratoTO $tObj) {
		$sql = "UPDATE tb_contrato_cronograma_item
				SET desc_depto = :desc_depto,
					sigla = :sigla
				WHERE cod_depto = :cod_depto";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':desc_depto', $tObj->desc_depto, PDO::PARAM_STR);
		$update->bindValue(':sigla', $tObj->sigla, PDO::PARAM_STR);
		$update->bindValue(':cod_depto', 				$tObj->cod_depto, 					PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_depto) {
		$sql = "DELETE FROM tb_contrato_cronograma_item WHERE cod_depto = ". $cod_depto;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT 
					cci.id,
				    cci.cod_cronograma,
				    cci.cod_item_planejamento,
				    cci.dta_planejamento,
				    cci.vlr_planejamento,
				    tci.dsc_item,
				    tci.flg_reajuste
				FROM tb_contrato_cronograma_item 	AS cci
				INNER JOIN tb_contrato_cronograma 	AS tcc ON tcc.id = cci.cod_cronograma
				INNER JOIN tb_contrato_item 		AS tci ON tci.cod_contrato = tcc.cod_contrato and tci.id = cci.cod_item_planejamento";
		
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
				$sql .= " WHERE dsc_item LIKE '%$search%'";

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

		$sql .= " ORDER BY cci.dta_planejamento";

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