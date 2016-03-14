<?php

class DiarioObraDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(DiarioObraTO $tObj) {
		$sql = "INSERT INTO tb_Acompanhamento (
					cod_empreendimento,
					PI,
					`Data do Registro`,
					Registro,
					cod_fiscal,
					vistoria,
					dt_vistoria,
					flg_pendencia,
					cod_tipo_pendencia,
					dta_limite_pendencia,
					dsc_pendencia,
					flg_pendencia_concluida,
					dta_resolucao_pendencia,
					dsc_acao_resolucao_pendencia,
					flg_pendencia_valida,
					cod_situacao_sso,
					dsc_nota_sso,
					cod_situacao_clima_manha,
					dsc_nota_clima_manha,
					cod_situacao_clima_tarde,
					dsc_nota_clima_tarde,
					cod_situacao_clima_noite,
					dsc_nota_clima_noite,
					cod_situacao_limpeza_obra,
					dsc_nota_limpeza_obra,
					cod_situacao_organizacao_obra,
					dsc_nota_organizacao_obra,
					cod_tipo_registro,
					dta_log,
					cod_usuario_lancamento,
					flg_relatorio_mensal
				) 
				VALUES (
					:cod_empreendimento,
					:PI,
					:dta_registro,
					:dsc_registro,
					:cod_fiscal,
					:flg_vistoria_realizada,
					:dta_vistoria,
					:flg_pendencia,
					:cod_tipo_pendencia,
					:dta_limite_pendencia,
					:dsc_pendencia,
					:flg_pendencia_concluida,
					:dta_resolucao_pendencia,
					:dsc_acao_resolucao_pendencia,
					:flg_pendencia_valida,
					:cod_situacao_sso,
					:dsc_nota_sso,
					:cod_situacao_clima_manha,
					:dsc_nota_clima_manha,
					:cod_situacao_clima_tarde,
					:dsc_nota_clima_tarde,
					:cod_situacao_clima_noite,
					:dsc_nota_clima_noite,
					:cod_situacao_limpeza_obra,
					:dsc_nota_limpeza_obra,
					:cod_situacao_organizacao_obra,
					:dsc_nota_organizacao_obra,
					:cod_tipo_registro,
					:dta_log,
					:cod_usuario_lancamento,
					:flg_relatorio_mensal
				);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_empreendimento', $tObj->cod_empreendimento, PDO::PARAM_INT);
		$insert->bindValue(':PI', $tObj->PI, PDO::PARAM_STR);
		$insert->bindValue(':dta_registro', $tObj->dta_registro, PDO::PARAM_STR);
		$insert->bindValue(':dsc_registro', $tObj->dsc_registro, PDO::PARAM_STR);
		$insert->bindValue(':cod_fiscal', $tObj->cod_fiscal, PDO::PARAM_INT);
		$insert->bindValue(':flg_vistoria_realizada', $tObj->flg_vistoria_realizada, PDO::PARAM_STR);
		$insert->bindValue(':dta_vistoria', $tObj->dta_vistoria, PDO::PARAM_STR);
		$insert->bindValue(':flg_pendencia', $tObj->flg_pendencia, PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_pendencia', $tObj->cod_tipo_pendencia, PDO::PARAM_INT);
		$insert->bindValue(':dta_limite_pendencia', $tObj->dta_limite_pendencia, PDO::PARAM_STR);
		$insert->bindValue(':dsc_pendencia', $tObj->dsc_pendencia, PDO::PARAM_STR);
		$insert->bindValue(':flg_pendencia_concluida', $tObj->flg_pendencia_concluida, PDO::PARAM_STR);
		$insert->bindValue(':dta_resolucao_pendencia', $tObj->dta_resolucao_pendencia, PDO::PARAM_STR);
		$insert->bindValue(':dsc_acao_resolucao_pendencia', $tObj->dsc_acao_resolucao_pendencia, PDO::PARAM_STR);
		$insert->bindValue(':flg_pendencia_valida', $tObj->flg_pendencia_valida, PDO::PARAM_STR);
		$insert->bindValue(':cod_situacao_sso', $tObj->cod_situacao_sso, PDO::PARAM_INT);
		$insert->bindValue(':dsc_nota_sso', $tObj->dsc_nota_sso, PDO::PARAM_STR);
		$insert->bindValue(':cod_situacao_clima_manha', $tObj->cod_situacao_clima_manha, PDO::PARAM_INT);
		$insert->bindValue(':dsc_nota_clima_manha', $tObj->dsc_nota_clima_manha, PDO::PARAM_STR);
		$insert->bindValue(':cod_situacao_clima_tarde', $tObj->cod_situacao_clima_tarde, PDO::PARAM_INT);
		$insert->bindValue(':dsc_nota_clima_tarde', $tObj->dsc_nota_clima_tarde, PDO::PARAM_STR);
		$insert->bindValue(':cod_situacao_clima_noite', $tObj->cod_situacao_clima_noite, PDO::PARAM_INT);
		$insert->bindValue(':dsc_nota_clima_noite', $tObj->dsc_nota_clima_noite, PDO::PARAM_STR);
		$insert->bindValue(':cod_situacao_limpeza_obra', $tObj->cod_situacao_limpeza_obra, PDO::PARAM_INT);
		$insert->bindValue(':dsc_nota_limpeza_obra', $tObj->dsc_nota_limpeza_obra, PDO::PARAM_STR);
		$insert->bindValue(':cod_situacao_organizacao_obra', $tObj->cod_situacao_organizacao_obra, PDO::PARAM_INT);
		$insert->bindValue(':dsc_nota_organizacao_obra', $tObj->dsc_nota_organizacao_obra, PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_registro', $tObj->cod_tipo_registro, PDO::PARAM_INT);
		$insert->bindValue(':dta_log', $tObj->dta_log, PDO::PARAM_STR);
		$insert->bindValue(':cod_usuario_lancamento', $tObj->cod_usuario_lancamento, PDO::PARAM_INT);
		$insert->bindValue(':flg_relatorio_mensal', $tObj->flg_relatorio_mensal, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(DiarioObraTO $tObj) {
		$sql = "UPDATE tb_Acompanhamento
				SET cod_empreendimento = :cod_empreendimento,
					PI = :PI,
					`Data do Registro` = :dta_registro,
					Registro = :dsc_registro,
					cod_fiscal = :cod_fiscal,
					vistoria = :flg_vistoria_realizada,
					dt_vistoria = :dta_vistoria,
					flg_pendencia = :flg_pendencia,
					cod_tipo_pendencia = :cod_tipo_pendencia,
					dta_limite_pendencia = :dta_limite_pendencia,
					dsc_pendencia = :dsc_pendencia,
					flg_pendencia_concluida = :flg_pendencia_concluida,
					dta_resolucao_pendencia = :dta_resolucao_pendencia,
					dsc_acao_resolucao_pendencia = :dsc_acao_resolucao_pendencia,
					flg_pendencia_valida = :flg_pendencia_valida,
					cod_situacao_sso = :cod_situacao_sso,
					dsc_nota_sso = :dsc_nota_sso,
					cod_situacao_clima_manha = :cod_situacao_clima_manha,
					dsc_nota_clima_manha = :dsc_nota_clima_manha,
					cod_situacao_clima_tarde = :cod_situacao_clima_tarde,
					dsc_nota_clima_tarde = :dsc_nota_clima_tarde,
					cod_situacao_clima_noite = :cod_situacao_clima_noite,
					dsc_nota_clima_noite = :dsc_nota_clima_noite,
					cod_situacao_limpeza_obra = :cod_situacao_limpeza_obra,
					dsc_nota_limpeza_obra = :dsc_nota_limpeza_obra,
					cod_situacao_organizacao_obra = :cod_situacao_organizacao_obra,
					dsc_nota_organizacao_obra = :dsc_nota_organizacao_obra,
					cod_tipo_registro = :cod_tipo_registro,
					dta_log = :dta_log,
					cod_usuario_lancamento = :cod_usuario_lancamento,
					flg_relatorio_mensal = :flg_relatorio_mensal
				WHERE cod_acompanhamento = :cod_acompanhamento";
		$update = $this->conn->prepare($sql);
		$update->bindValue(':cod_empreendimento', $tObj->cod_empreendimento, PDO::PARAM_INT);
		$update->bindValue(':PI', $tObj->PI, PDO::PARAM_STR);
		$update->bindValue(':dta_registro', $tObj->dta_registro, PDO::PARAM_STR);
		$update->bindValue(':dsc_registro', $tObj->dsc_registro, PDO::PARAM_STR);
		$update->bindValue(':cod_fiscal', $tObj->cod_fiscal, PDO::PARAM_INT);
		$update->bindValue(':flg_vistoria_realizada', $tObj->flg_vistoria_realizada, PDO::PARAM_STR);
		$update->bindValue(':dta_vistoria', $tObj->dta_vistoria, PDO::PARAM_STR);
		$update->bindValue(':flg_pendencia', $tObj->flg_pendencia, PDO::PARAM_STR);
		$update->bindValue(':cod_tipo_pendencia', $tObj->cod_tipo_pendencia, PDO::PARAM_INT);
		$update->bindValue(':dta_limite_pendencia', $tObj->dta_limite_pendencia, PDO::PARAM_STR);
		$update->bindValue(':dsc_pendencia', $tObj->dsc_pendencia, PDO::PARAM_STR);
		$update->bindValue(':flg_pendencia_concluida', $tObj->flg_pendencia_concluida, PDO::PARAM_STR);
		$update->bindValue(':dta_resolucao_pendencia', $tObj->dta_resolucao_pendencia, PDO::PARAM_STR);
		$update->bindValue(':dsc_acao_resolucao_pendencia', $tObj->dsc_acao_resolucao_pendencia, PDO::PARAM_STR);
		$update->bindValue(':flg_pendencia_valida', $tObj->flg_pendencia_valida, PDO::PARAM_STR);
		$update->bindValue(':cod_situacao_sso', $tObj->cod_situacao_sso, PDO::PARAM_INT);
		$update->bindValue(':dsc_nota_sso', $tObj->dsc_nota_sso, PDO::PARAM_STR);
		$update->bindValue(':cod_situacao_clima_manha', $tObj->cod_situacao_clima_manha, PDO::PARAM_INT);
		$update->bindValue(':dsc_nota_clima_manha', $tObj->dsc_nota_clima_manha, PDO::PARAM_STR);
		$update->bindValue(':cod_situacao_clima_tarde', $tObj->cod_situacao_clima_tarde, PDO::PARAM_INT);
		$update->bindValue(':dsc_nota_clima_tarde', $tObj->dsc_nota_clima_tarde, PDO::PARAM_STR);
		$update->bindValue(':cod_situacao_clima_noite', $tObj->cod_situacao_clima_noite, PDO::PARAM_INT);
		$update->bindValue(':dsc_nota_clima_noite', $tObj->dsc_nota_clima_noite, PDO::PARAM_STR);
		$update->bindValue(':cod_situacao_limpeza_obra', $tObj->cod_situacao_limpeza_obra, PDO::PARAM_INT);
		$update->bindValue(':dsc_nota_limpeza_obra', $tObj->dsc_nota_limpeza_obra, PDO::PARAM_STR);
		$update->bindValue(':cod_situacao_organizacao_obra', $tObj->cod_situacao_organizacao_obra, PDO::PARAM_INT);
		$update->bindValue(':dsc_nota_organizacao_obra', $tObj->dsc_nota_organizacao_obra, PDO::PARAM_STR);
		$update->bindValue(':cod_tipo_registro', $tObj->cod_tipo_registro, PDO::PARAM_INT);
		$update->bindValue(':dta_log', $tObj->dta_log, PDO::PARAM_STR);
		$update->bindValue(':cod_usuario_lancamento', $tObj->cod_usuario_lancamento, PDO::PARAM_INT);
		$update->bindValue(':flg_relatorio_mensal', $tObj->flg_relatorio_mensal, PDO::PARAM_STR);
		$update->bindValue(':cod_acompanhamento', $tObj->cod_acompanhamento, PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_agencia_cetesb) {
		$sql = "DELETE FROM tb_Acompanhamento WHERE id = ". $cod_agencia_cetesb;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					acp.cod_acompanhamento,
					acp.cod_empreendimento,
					acp.PI,
					acp.`Data do Registro` as dta_registro,
					acp.Registro as dsc_registro,
					acp.cod_fiscal,
					rsp.nme_responsavel,
					acp.vistoria as flg_vistoria_realizada,
					acp.dt_vistoria as dta_vistoria,
					acp.flg_pendencia,
					acp.cod_tipo_pendencia,
					pdn.dsc_tipo_pendencia,
					acp.dta_limite_pendencia,
					acp.dsc_pendencia,
					acp.flg_pendencia_concluida,
					acp.dta_resolucao_pendencia,
					acp.dsc_acao_resolucao_pendencia,
					acp.flg_pendencia_valida,
					acp.cod_situacao_sso,
					sso.dsc_situacao_sso,
					acp.dsc_nota_sso,
					acp.cod_situacao_clima_manha,
					scm.dsc_situacao_clima as dsc_situacao_clima_manha,
					acp.dsc_nota_clima_manha,
					acp.cod_situacao_clima_tarde,
					sct.dsc_situacao_clima as dsc_situacao_clima_tarde,
					acp.dsc_nota_clima_tarde,
					acp.cod_situacao_clima_noite,
					scn.dsc_situacao_clima as dsc_situacao_clima_noite,
					acp.dsc_nota_clima_noite,
					acp.cod_situacao_limpeza_obra,
					slo.dsc_situacao_obra as dsc_situacao_limpeza_obra,
					acp.dsc_nota_limpeza_obra,
					acp.cod_situacao_organizacao_obra,
					soo.dsc_situacao_obra as dsc_situacao_organizacao_obra,
					acp.dsc_nota_organizacao_obra,
					acp.cod_tipo_registro,
					ttr.dsc_tipo_registro,
					acp.dta_log,
					tsp.desc_situacao,
					acp.cod_usuario_lancamento,
					usu.nme_usuario,
					acp.flg_relatorio_mensal
				FROM tb_Acompanhamento 				as acp
				LEFT JOIN tb_responsavel 			as rsp on rsp.cod_fiscal 	= acp.cod_fiscal
				LEFT JOIN tb_tipo_pendencia 		as pdn on pdn.id 			= acp.cod_tipo_pendencia
				LEFT JOIN tb_situacao_sso 			as sso on sso.id 			= acp.cod_situacao_sso
				LEFT JOIN tb_situacao_clima			as scm on scm.id 			= acp.cod_situacao_clima_manha
				LEFT JOIN tb_situacao_clima 		as sct on sct.id 			= acp.cod_situacao_clima_tarde
				LEFT JOIN tb_situacao_clima 		as scn on scn.id 			= acp.cod_situacao_clima_noite
				LEFT JOIN tb_situacao_obra 			as slo on slo.id 			= acp.cod_situacao_limpeza_obra
				LEFT JOIN tb_situacao_obra 			as soo on soo.id 			= acp.cod_situacao_organizacao_obra
				LEFT JOIN tb_tipo_registro 			as ttr on ttr.id 			= acp.cod_tipo_registro
				LEFT JOIN tb_situacao_pi 			as tsp on tsp.cod_situacao 	= acp.cod_situacao_atual_obra
				LEFT JOIN tb_usuario 				as usu on usu.cod_usuario 	= acp.cod_usuario_lancamento ";
		
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
				$sql .= " WHERE Registro LIKE '%$search%'";

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