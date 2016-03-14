<?php

class LicitacaoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(LicitacaoTO $tObj) {
		$sql = "INSERT INTO tb_licitacao (
					num_autos,
					cod_tipo_contratacao,
					cod_financiador,
					cod_modalidade,
					num_edital,
					dta_publicacao_doe,
					dta_licitacao,
					cod_situacao_licitacao,
					vlr_licitacao
				) VALUES (
					:num_autos,
					:cod_tipo_contratacao,
					:cod_financiador,
					:cod_modalidade,
					:num_edital,
					:dta_publicacao_doe,
					:dta_licitacao,
					:cod_situacao_licitacao,
					:vlr_licitacao
				);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':num_autos', $tObj->num_autos, PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_contratacao', $tObj->cod_tipo_contratacao, PDO::PARAM_INT);
		$insert->bindValue(':cod_financiador', $tObj->cod_financiador, PDO::PARAM_INT);
		$insert->bindValue(':cod_modalidade', $tObj->cod_modalidade, PDO::PARAM_INT);
		$insert->bindValue(':num_edital', $tObj->num_edital, PDO::PARAM_STR);
		$insert->bindValue(':dta_publicacao_doe', $tObj->dta_publicacao_doe, PDO::PARAM_STR);
		$insert->bindValue(':dta_licitacao', $tObj->dta_licitacao, PDO::PARAM_STR);
		$insert->bindValue(':cod_situacao_licitacao', $tObj->cod_situacao_licitacao, PDO::PARAM_INT);
		$insert->bindValue(':vlr_licitacao', $tObj->vlr_licitacao, PDO::PARAM_INT);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(LicitacaoTO $tObj) {
		$sql = "UPDATE tb_licitacao
				SET num_autos = :num_autos,
					cod_tipo_contratacao = :cod_tipo_contratacao,
					cod_financiador = :cod_financiador,
					cod_modalidade = :cod_modalidade,
					num_edital = :num_edital,
					dta_publicacao_doe = :dta_publicacao_doe,
					dta_licitacao = :dta_licitacao,
					cod_situacao_licitacao = :cod_situacao_licitacao,
					vlr_licitacao = :vlr_licitacao
				WHERE id = :id";
				
		$update = $this->conn->prepare($sql);
		$update->bindValue(':num_autos', $tObj->num_autos, PDO::PARAM_STR);
		$update->bindValue(':cod_tipo_contratacao', $tObj->cod_tipo_contratacao, PDO::PARAM_INT);
		$update->bindValue(':cod_financiador', $tObj->cod_financiador, PDO::PARAM_INT);
		$update->bindValue(':cod_modalidade', $tObj->cod_modalidade, PDO::PARAM_INT);
		$update->bindValue(':num_edital', $tObj->num_edital, PDO::PARAM_STR);
		$update->bindValue(':dta_publicacao_doe', $tObj->dta_publicacao_doe, PDO::PARAM_STR);
		$update->bindValue(':dta_licitacao', $tObj->dta_licitacao, PDO::PARAM_STR);
		$update->bindValue(':cod_situacao_licitacao', $tObj->cod_situacao_licitacao, PDO::PARAM_INT);
		$update->bindValue(':vlr_licitacao', $tObj->vlr_licitacao, PDO::PARAM_INT);
		$update->bindValue(':id', $tObj->id, PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM tb_licitacao WHERE id = ". $id;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					lct.id,
					lct.num_autos,
					lct.cod_tipo_contratacao,
					ttc.dsc_tipo_contratacao,
					lct.cod_financiador,
					tfl.dsc_financiador,
					lct.cod_modalidade,
					tml.dsc_modalidade,
					lct.num_edital,
					lct.dta_publicacao_doe,
					lct.dta_licitacao,
					lct.cod_situacao_licitacao,
					tsl.dsc_situacao,
					lct.vlr_licitacao
				FROM tb_licitacao 					AS lct
				LEFT JOIN tb_tipo_contratacao 		AS ttc ON ttc.id = lct.cod_tipo_contratacao
				LEFT JOIN tb_financiador_licitacao 	AS tfl ON tfl.id = lct.cod_financiador
				LEFT JOIN tb_modalidade_licitacao 	AS tml ON tml.id = lct.cod_modalidade
				LEFT JOIN tb_situacao_licitacao 	AS tsl ON tsl.id = lct.cod_situacao_licitacao";
		
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
				$sql .= " WHERE num_autos LIKE '%$search%' OR num_edital LIKE '%$search%' OR dsc_tipo_contratacao LIKE '%$search%' OR dsc_financiador LIKE '%$search%' OR dsc_modalidade LIKE '%$search%' OR dsc_situacao LIKE '%$search%'";

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