<?php

class MunicipioDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(MunicipioTO $tObj) {
		if(!$tObj->ano_inicio_adm)
			$tObj->ano_inicio_adm = 'NULL';

		if(!$tObj->ano_fim_adm)
			$tObj->ano_fim_adm = 'NULL';

		if(!$tObj->qtd_populacao_urbana_2010)
			$tObj->qtd_populacao_urbana_2010 = 'NULL';

		if(!$tObj->qtd_populacao_urbana_2030)
			$tObj->qtd_populacao_urbana_2030 = 'NULL';

		if(!$tObj->flg_atendido_sabesp)
			$tObj->flg_atendido_sabesp = '0';

		$sql = "INSERT INTO tb_predio (
					cod_municipio,
					cod_bacia_daee,
					nme_bacia_daee,
					cod_bacia_secretaria,
					nme_municipio,
					nme_endereco,
					Complemento,
					CEP,
					dsc_observacoes,
					cod_prefeitura,
					cod_prefeito,
					ano_inicio_adm,
					ano_fim_adm,
					cod_partido,
					qtd_populacao_urbana_2010,
					qtd_populacao_urbana_2030,
					latitude_longitude,
					flg_atendido_sabesp,
					cod_concessao
				) VALUES (
					". $tObj->cod_municipio . ",
					". $tObj->cod_bacia_daee . ",
					'". $tObj->nme_bacia_daee . "',
					". $tObj->cod_bacia_secretaria . ",
					'". $tObj->nme_municipio . "',
					'". $tObj->nme_endereco . "',
					'". $tObj->Complemento . "',
					'". $tObj->CEP . "',
					'". $tObj->dsc_observacoes . "',
					". $tObj->cod_prefeitura . ",
					". $tObj->cod_prefeito . ",
					". $tObj->ano_inicio_adm . ",
					". $tObj->ano_fim_adm . ",
					". $tObj->cod_partido . ",
					". $tObj->qtd_populacao_urbana_2010 . ",
					". $tObj->qtd_populacao_urbana_2030 . ",
					'". $tObj->latitude_longitude . "',
					". $tObj->flg_atendido_sabesp . ",
					". $tObj->cod_concessao . "
				);";

		$insert = $this->conn->prepare($sql);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(MunicipioTO $tObj) {
		if(!$tObj->ano_inicio_adm)
			$tObj->ano_inicio_adm = 'NULL';

		if(!$tObj->ano_fim_adm)
			$tObj->ano_fim_adm = 'NULL';

		if(!$tObj->qtd_populacao_urbana_2010)
			$tObj->qtd_populacao_urbana_2010 = 'NULL';

		if(!$tObj->qtd_populacao_urbana_2030)
			$tObj->qtd_populacao_urbana_2030 = 'NULL';

		if(!$tObj->flg_atendido_sabesp)
			$tObj->flg_atendido_sabesp = '0';

		$sql = "UPDATE tb_predio
				SET cod_municipio = ". $tObj->cod_municipio .",
					cod_bacia_daee = ". $tObj->cod_bacia_daee .",
					nme_bacia_daee = '". $tObj->nme_bacia_daee ."',
					cod_bacia_secretaria = ". $tObj->cod_bacia_secretaria .",
					nme_municipio = '". $tObj->nme_municipio ."',
					nme_endereco = '". $tObj->nme_endereco ."',
					Complemento = '". $tObj->Complemento ."',
					CEP = '". $tObj->CEP ."',
					dsc_observacoes = '". $tObj->dsc_observacoes ."',
					cod_prefeitura = ". $tObj->cod_prefeitura .",
					cod_prefeito = ". $tObj->cod_prefeito .",
					ano_inicio_adm = ". $tObj->ano_inicio_adm .",
					ano_fim_adm = ". $tObj->ano_fim_adm .",
					cod_partido = ". $tObj->cod_partido .",
					qtd_populacao_urbana_2010 = ". $tObj->qtd_populacao_urbana_2010 .",
					qtd_populacao_urbana_2030 = ". $tObj->qtd_populacao_urbana_2030 .",
					latitude_longitude = '". $tObj->latitude_longitude ."',
					flg_atendido_sabesp = ". $tObj->flg_atendido_sabesp .",
					cod_concessao = ". $tObj->cod_concessao ."
				WHERE id_predio = ". $tObj->id_predio;

		$update = $this->conn->prepare($sql);

		return $update->execute();
	}

	public function delete($id_predio) {
		$sql = "DELETE FROM tb_predio WHERE id_predio = ". $id_predio;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					mun.id_predio,
					mun.cod_bacia_daee,
					bsd.desc_diretoria AS nme_bacia_daee,
					mun.cod_bacia_secretaria,
					bsc.desc_diretoria AS nme_bacia_secretaria,
					mun.cod_municipio,
					cid.Municipios as nme_municipio,
					mun.nme_endereco,
					mun.Complemento,
					mun.CEP,
					mun.dsc_observacoes,
					mun.cod_prefeitura,
				    pfa.Construtora AS nme_prefeitura,
					mun.cod_prefeito,
				    pfo.nme_responsavel AS nme_prefeito,
					mun.ano_inicio_adm,
					mun.ano_fim_adm,
					mun.cod_partido,
				    ptd.nme_partido,
					mun.qtd_populacao_urbana_2010,
					mun.qtd_populacao_urbana_2030,
					mun.latitude_longitude,
					mun.flg_atendido_sabesp,
					mun.cod_concessao,
				    cnc.dsc_concessao
				FROM tb_predio 				AS mun
				LEFT JOIN tb_Municipios		AS cid ON cid.cod_mun = mun.cod_municipio
				LEFT JOIN tb_diretoria 		AS bsd ON bsd.id = mun.cod_bacia_daee
				LEFT JOIN tb_diretoria 		AS bsc ON bsc.id = mun.cod_bacia_secretaria
				LEFT JOIN tb_Construtora 	AS pfa ON pfa.cod_construtora = mun.cod_prefeitura
				LEFT JOIN tb_responsavel 	AS pfo ON pfo.cod_fiscal = mun.cod_prefeito
				LEFT JOIN tb_partido 		AS ptd ON ptd.id = mun.cod_partido
				LEFT JOIN tb_concessao 		AS cnc ON cnc.id = mun.cod_concessao";
		
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
				$sql .= " WHERE nme_municipio LIKE '%$search%'";

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