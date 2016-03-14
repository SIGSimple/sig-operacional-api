<?php

class ConvenioLicitacaoContratoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(ConvenioLicitacaoContratoTO $tObj) {
		$sql = "INSERT INTO tb_convenio_licitacao_contrato ( cod_convenio, cod_licitacao, cod_contrato, vlr_destinado_contrato ) 
				VALUES ( :cod_convenio, :cod_licitacao, :cod_contrato, :vlr_destinado_contrato );";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_convenio', $tObj->cod_convenio, PDO::PARAM_INT);
		$insert->bindValue(':cod_licitacao', $tObj->cod_licitacao, PDO::PARAM_INT);
		$insert->bindValue(':cod_contrato', $tObj->cod_contrato, PDO::PARAM_INT);
		$insert->bindValue(':vlr_destinado_contrato', $tObj->vlr_destinado_contrato, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(ConvenioLicitacaoContratoTO $tObj) {
		$sql = "UPDATE tb_convenio_licitacao_contrato
				SET cod_convenio = :cod_convenio,
					cod_licitacao = :cod_licitacao,
					cod_contrato = :cod_contrato,
					vlr_destinado_contrato = :vlr_destinado_contrato
				WHERE id = :id";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':cod_convenio', $tObj->cod_convenio, PDO::PARAM_INT);
		$update->bindValue(':cod_licitacao', $tObj->cod_licitacao, PDO::PARAM_INT);
		$update->bindValue(':cod_contrato', $tObj->cod_contrato, PDO::PARAM_INT);
		$update->bindValue(':vlr_destinado_contrato', $tObj->vlr_destinado_contrato, PDO::PARAM_STR);
		$update->bindValue(':id', $tObj->id, PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM tb_convenio_licitacao_contrato WHERE id = ". $id;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT 
					clc.id,
					clc.cod_convenio,
					cvn.num_autos AS num_autos_convenio,
					cvn.num_convenio,
					clc.cod_licitacao,
					lct.num_autos AS num_autos_licitacao,
					lct.num_edital,
					clc.cod_contrato,
					ctc.num_autos AS num_autos_contrato,
					ctc.num_contrato,
					clc.vlr_destinado_contrato
				FROM tb_convenio_licitacao_contrato AS clc
				LEFT JOIN tb_convenio 				AS cvn ON cvn.id = clc.cod_convenio
				LEFT JOIN tb_licitacao 				AS lct ON lct.id = clc.cod_licitacao
				LEFT JOIN tb_contrato 				AS ctc ON ctc.id = clc.cod_contrato";
		
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
				$sql .= " WHERE num_autos_convenio LIKE '%$search%' OR num_convenio LIKE '%$search%' OR num_autos_licitacao LIKE '%$search%' OR num_edital LIKE '%$search%' OR num_autos_contrato LIKE '%$search%' OR num_contrato LIKE '%$search%'";

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