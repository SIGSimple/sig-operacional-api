<?php

class ConvenioDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(ConvenioTO $tObj) {
		$sql = "INSERT INTO tb_convenio (
					num_autos,
					num_convenio,
					cod_projetista_convenio,
					cod_enquadramento,
					cod_programa,
					dta_assinatura,
					dta_publicacao_doe,
					prz_meses,
					dta_vigencia,
					vlr_original,
					vlr_contra_partida_prefeitura,
					nme_fonte_recurso,
					cod_coordenador_daee,
					dsc_observacoes
				) 
				VALUES (
					:num_autos,
					:num_convenio,
					:cod_projetista_convenio,
					:cod_enquadramento,
					:cod_programa,
					:dta_assinatura,
					:dta_publicacao_doe,
					:prz_meses,
					:dta_vigencia,
					:vlr_original,
					:vlr_contra_partida_prefeitura,
					:nme_fonte_recurso,
					:cod_coordenador_daee,
					:dsc_observacoes
				);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':num_autos', $tObj->num_autos, PDO::PARAM_STR);
		$insert->bindValue(':num_convenio', $tObj->num_convenio, PDO::PARAM_STR);
		$insert->bindValue(':cod_projetista_convenio', $tObj->cod_projetista_convenio, PDO::PARAM_INT);
		$insert->bindValue(':cod_enquadramento', $tObj->cod_enquadramento, PDO::PARAM_INT);
		$insert->bindValue(':cod_programa', $tObj->cod_programa, PDO::PARAM_INT);
		$insert->bindValue(':dta_assinatura', $tObj->dta_assinatura, PDO::PARAM_STR);
		$insert->bindValue(':dta_publicacao_doe', $tObj->dta_publicacao_doe, PDO::PARAM_STR);
		$insert->bindValue(':prz_meses', $tObj->prz_meses, PDO::PARAM_STR);
		$insert->bindValue(':dta_vigencia', $tObj->dta_vigencia, PDO::PARAM_STR);
		$insert->bindValue(':vlr_original', $tObj->vlr_original, PDO::PARAM_STR);
		$insert->bindValue(':vlr_contra_partida_prefeitura', $tObj->vlr_contra_partida_prefeitura, PDO::PARAM_STR);
		$insert->bindValue(':nme_fonte_recurso', $tObj->nme_fonte_recurso, PDO::PARAM_STR);
		$insert->bindValue(':cod_coordenador_daee', $tObj->cod_coordenador_daee, PDO::PARAM_INT);
		$insert->bindValue(':dsc_observacoes', $tObj->dsc_observacoes, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(ConvenioTO $tObj) {
		$sql = "UPDATE tb_convenio
				SET num_autos = :num_autos,
					num_convenio = :num_convenio,
					cod_projetista_convenio = :cod_projetista_convenio,
					cod_enquadramento = :cod_enquadramento,
					cod_programa = :cod_programa,
					dta_assinatura = :dta_assinatura,
					dta_publicacao_doe = :dta_publicacao_doe,
					prz_meses = :prz_meses,
					dta_vigencia = :dta_vigencia,
					vlr_original = :vlr_original,
					vlr_contra_partida_prefeitura = :vlr_contra_partida_prefeitura,
					nme_fonte_recurso = :nme_fonte_recurso,
					cod_coordenador_daee = :cod_coordenador_daee,
					dsc_observacoes = :dsc_observacoes
				WHERE id = :id";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':num_autos', $tObj->num_autos, PDO::PARAM_STR);
		$update->bindValue(':num_convenio', $tObj->num_convenio, PDO::PARAM_STR);
		$update->bindValue(':cod_projetista_convenio', $tObj->cod_projetista_convenio, PDO::PARAM_INT);
		$update->bindValue(':cod_enquadramento', $tObj->cod_enquadramento, PDO::PARAM_INT);
		$update->bindValue(':cod_programa', $tObj->cod_programa, PDO::PARAM_INT);
		$update->bindValue(':dta_assinatura', $tObj->dta_assinatura, PDO::PARAM_STR);
		$update->bindValue(':dta_publicacao_doe', $tObj->dta_publicacao_doe, PDO::PARAM_STR);
		$update->bindValue(':prz_meses', $tObj->prz_meses, PDO::PARAM_STR);
		$update->bindValue(':dta_vigencia', $tObj->dta_vigencia, PDO::PARAM_STR);
		$update->bindValue(':vlr_original', $tObj->vlr_original, PDO::PARAM_STR);
		$update->bindValue(':vlr_contra_partida_prefeitura', $tObj->vlr_contra_partida_prefeitura, PDO::PARAM_STR);
		$update->bindValue(':nme_fonte_recurso', $tObj->nme_fonte_recurso, PDO::PARAM_STR);
		$update->bindValue(':cod_coordenador_daee', $tObj->cod_coordenador_daee, PDO::PARAM_INT);
		$update->bindValue(':dsc_observacoes', $tObj->dsc_observacoes, PDO::PARAM_STR);
		$update->bindValue(':id', $tObj->id, PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM tb_convenio WHERE id = ". $id;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					cvn.id,
					cvn.num_autos,
					cvn.num_convenio,
					cvn.cod_projetista_convenio,
					emp.Construtora AS nme_projetista_convenio,
					cvn.cod_enquadramento,
					tce.dsc_enquadramento,
					cvn.cod_programa,
					pgr.desc_depto AS nme_programa,
					CAST(cvn.dta_assinatura AS DATE) AS dta_assinatura,
					CAST(cvn.dta_publicacao_doe AS DATE) AS dta_publicacao_doe,
					cvn.prz_meses,
					CAST(cvn.dta_vigencia AS DATE) AS dta_vigencia,
					cvn.vlr_original,
					cvn.vlr_contra_partida_prefeitura,
					cvn.nme_fonte_recurso,
					cvn.cod_coordenador_daee,
					rsp.nme_responsavel AS nme_coordenador_daee,
					cvn.dsc_observacoes
				FROM tb_convenio 					AS cvn
				LEFT JOIN tb_Construtora 			AS emp ON emp.cod_construtora = cvn.cod_projetista_convenio
				LEFT JOIN tb_convenio_enquadramento AS tce ON tce.id = cvn.cod_enquadramento
				LEFT JOIN tb_depto 					AS pgr ON pgr.cod_depto = cvn.cod_programa
				LEFT JOIN tb_responsavel			AS rsp ON rsp.cod_fiscal = cvn.cod_coordenador_daee ";
		
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
				$sql .= " WHERE num_autos LIKE '%$search%' OR num_convenio LIKE '%$search%' OR nme_empresa_projetista_convenio LIKE '%$search%' OR nme_programa LIKE '%$search%' OR nme_coordenador_daee LIKE '%$search%'";

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