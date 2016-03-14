<?php

class ContratoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(ContratoTO $tObj) {
		$sql = "INSERT INTO tb_contrato (
					cod_empresa_contratada,
					cod_engenheiro_empresa_contratada,
					num_autos,
					num_contrato,
					dta_assinatura,
					dta_publicacao_doe,
					dta_pedido_empenho,
					dta_os,
					prz_original_contrato_meses,
					prz_aditivos_contrato_meses,
					prz_original_execucao_meses,
					dta_vigencia,
					dta_base,
					dta_inauguracao,
					dta_termo_recebimento_provisorio,
					dta_termo_recebimento_definitivo,
					dta_encerramento_contrato,
					dta_recisao_contratual,
					vlr_original_contrato,
					vlr_aditivos_contrato,
					qtd_populacao_urbana_2010,
					vlr_investimento_governo,
					dta_inicio_obras,
					num_percentual_executado,
					dta_previsao_termino,
					dta_conclusao_inauguracao,
					dta_previsao_inauguracao,
					cod_engenheiro_obras_consorcio,
					cod_engenheiro_daee,
					cod_engenheiro_planejamento_obras_consorcio,
					cod_fiscal_consorcio,
					cod_engenheiro_responsavel_medicao,
					cod_engenheiro_obras_construtora,
					cod_situacao_obra,
					cod_situacao_contrato,
					dsc_observacoes_relatorio_mensal,
					dsc_observacoes_bacia,
					cod_parceiro,
					dsc_parceria_realizacao,
					dsc_observacoes_gerais,
					dsc_observacoes_apoio_gerencial
				) 
				VALUES (
					". $tObj->cod_empresa_contratada .",
					". $tObj->cod_engenheiro_empresa_contratada .",
					". $tObj->num_autos .",
					". $tObj->num_contrato .",
					". $tObj->dta_assinatura .",
					". $tObj->dta_publicacao_doe .",
					". $tObj->dta_pedido_empenho .",
					". $tObj->dta_os .",
					". $tObj->prz_original_contrato_meses .",
					". $tObj->prz_aditivos_contrato_meses .",
					". $tObj->prz_original_execucao_meses .",
					". $tObj->dta_vigencia .",
					". $tObj->dta_base .",
					". $tObj->dta_inauguracao .",
					". $tObj->dta_termo_recebimento_provisorio .",
					". $tObj->dta_termo_recebimento_definitivo .",
					". $tObj->dta_encerramento_contrato .",
					". $tObj->dta_recisao_contratual .",
					". $tObj->vlr_original_contrato .",
					". $tObj->vlr_aditivos_contrato .",
					". $tObj->qtd_populacao_urbana_2010 .",
					". $tObj->vlr_investimento_governo .",
					". $tObj->dta_inicio_obras .",
					". $tObj->num_percentual_executado .",
					". $tObj->dta_previsao_termino .",
					". $tObj->dta_conclusao_inauguracao .",
					". $tObj->dta_previsao_inauguracao .",
					". $tObj->cod_engenheiro_obras_consorcio .",
					". $tObj->cod_engenheiro_daee .",
					". $tObj->cod_engenheiro_planejamento_obras_consorcio .",
					". $tObj->cod_fiscal_consorcio .",
					". $tObj->cod_engenheiro_responsavel_medicao .",
					". $tObj->cod_engenheiro_obras_construtora .",
					". $tObj->cod_situacao_obra .",
					". $tObj->cod_situacao_contrato .",
					". $tObj->dsc_observacoes_relatorio_mensal .",
					". $tObj->dsc_observacoes_bacia .",
					". $tObj->cod_parceiro .",
					". $tObj->dsc_parceria_realizacao .",
					". $tObj->dsc_observacoes_gerais .",
					". $tObj->dsc_observacoes_apoio_gerencial ."
				);";

		$insert = $this->conn->prepare($sql);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(ContratoTO $tObj) {
		$sql = "UPDATE tb_contrato
				SET cod_empresa_contratada = ". $tObj->cod_empresa_contratada .",
					cod_engenheiro_empresa_contratada = ". $tObj->cod_engenheiro_empresa_contratada .",
					num_autos = ". $tObj->num_autos .",
					num_contrato = ". $tObj->num_contrato .",
					dta_assinatura = ". $tObj->dta_assinatura .",
					dta_publicacao_doe = ". $tObj->dta_publicacao_doe .",
					dta_pedido_empenho = ". $tObj->dta_pedido_empenho .",
					dta_os = ". $tObj->dta_os .",
					prz_original_contrato_meses = ". $tObj->prz_original_contrato_meses .",
					prz_aditivos_contrato_meses = ". $tObj->prz_aditivos_contrato_meses .",
					prz_original_execucao_meses = ". $tObj->prz_original_execucao_meses .",
					dta_vigencia = ". $tObj->dta_vigencia .",
					dta_base = ". $tObj->dta_base .",
					dta_inauguracao = ". $tObj->dta_inauguracao .",
					dta_termo_recebimento_provisorio = ". $tObj->dta_termo_recebimento_provisorio .",
					dta_termo_recebimento_definitivo = ". $tObj->dta_termo_recebimento_definitivo .",
					dta_encerramento_contrato = ". $tObj->dta_encerramento_contrato .",
					dta_recisao_contratual = ". $tObj->dta_recisao_contratual .",
					vlr_original_contrato = ". $tObj->vlr_original_contrato .",
					vlr_aditivos_contrato = ". $tObj->vlr_aditivos_contrato .",
					qtd_populacao_urbana_2010 = ". $tObj->qtd_populacao_urbana_2010 .",
					vlr_investimento_governo = ". $tObj->vlr_investimento_governo .",
					dta_inicio_obras = ". $tObj->dta_inicio_obras .",
					num_percentual_executado = ". $tObj->num_percentual_executado .",
					dta_previsao_termino = ". $tObj->dta_previsao_termino .",
					dta_conclusao_inauguracao = ". $tObj->dta_conclusao_inauguracao .",
					dta_previsao_inauguracao = ". $tObj->dta_previsao_inauguracao .",
					cod_engenheiro_obras_consorcio = ". $tObj->cod_engenheiro_obras_consorcio .",
					cod_engenheiro_daee = ". $tObj->cod_engenheiro_daee .",
					cod_engenheiro_planejamento_obras_consorcio = ". $tObj->cod_engenheiro_planejamento_obras_consorcio .",
					cod_fiscal_consorcio = ". $tObj->cod_fiscal_consorcio .",
					cod_engenheiro_responsavel_medicao = ". $tObj->cod_engenheiro_responsavel_medicao .",
					cod_engenheiro_obras_construtora = ". $tObj->cod_engenheiro_obras_construtora .",
					cod_situacao_obra = ". $tObj->cod_situacao_obra .",
					cod_situacao_contrato = ". $tObj->cod_situacao_contrato .",
					dsc_observacoes_relatorio_mensal = ". $tObj->dsc_observacoes_relatorio_mensal .",
					dsc_observacoes_bacia = ". $tObj->dsc_observacoes_bacia .",
					cod_parceiro = ". $tObj->cod_parceiro .",
					dsc_parceria_realizacao = ". $tObj->dsc_parceria_realizacao .",
					dsc_observacoes_gerais = ". $tObj->dsc_observacoes_gerais .",
					dsc_observacoes_apoio_gerencial = ". $tObj->dsc_observacoes_apoio_gerencial ."
				WHERE id = ". $tObj->id;

		$update = $this->conn->prepare($sql);
		return $update->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM tb_contrato WHERE id = ". $id;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					mun.Municipios as nme_municipio,
					pct.cod_empreendimento,
					tpi.nome_empreendimento AS nme_empreendimento,
					tpi.PI as num_autos_empreendimento,
					ctc.id,
					ctc.cod_empresa_contratada,
					emp.Construtora AS nme_empresa_contratada,
					ctc.cod_engenheiro_empresa_contratada,
					rsp_ec.nme_responsavel AS nme_engenheiro_empresa_contratada,
					ctc.num_autos,
					ctc.num_contrato,
					CAST(ctc.dta_assinatura AS DATE) AS dta_assinatura,
					CAST(ctc.dta_publicacao_doe AS DATE) AS dta_publicacao_doe,
					CAST(ctc.dta_pedido_empenho AS DATE) AS dta_pedido_empenho,
					CAST(ctc.dta_os AS DATE) AS dta_os,
					ctc.prz_original_contrato_meses,
					ctc.prz_aditivos_contrato_meses,
					ctc.prz_original_execucao_meses,
					CAST(ctc.dta_vigencia AS DATE) AS dta_vigencia,
					CAST(ctc.dta_base AS DATE) AS dta_base,
					CAST(ctc.dta_inauguracao AS DATE) AS dta_inauguracao,
					CAST(ctc.dta_termo_recebimento_provisorio AS DATE) AS dta_termo_recebimento_provisorio,
					CAST(ctc.dta_termo_recebimento_definitivo AS DATE) AS dta_termo_recebimento_definitivo,
					CAST(ctc.dta_encerramento_contrato AS DATE) AS dta_encerramento_contrato,
					CAST(ctc.dta_recisao_contratual AS DATE) AS dta_recisao_contratual,
					ctc.vlr_original_contrato,
					ctc.vlr_aditivos_contrato,
					ctc.qtd_populacao_urbana_2010,
					ctc.vlr_investimento_governo,
					CAST(ctc.dta_inicio_obras AS DATE) AS dta_inicio_obras,
					ctc.num_percentual_executado,
					CAST(ctc.dta_previsao_termino AS DATE) AS dta_previsao_termino,
					CAST(ctc.dta_conclusao_inauguracao AS DATE) AS dta_conclusao_inauguracao,
					CAST(ctc.dta_previsao_inauguracao AS DATE) AS dta_previsao_inauguracao,
					ctc.cod_engenheiro_obras_consorcio,
					rsp_oc.nme_responsavel AS nme_engenheiro_obras_consorcio,
					ctc.cod_engenheiro_daee,
					rsp_ed.nme_responsavel AS nme_engenheiro_daee,
					ctc.cod_engenheiro_planejamento_obras_consorcio,
					rsp_po.nme_responsavel AS nme_engenheiro_planejamento_obras_consorcio,
					ctc.cod_fiscal_consorcio,
					rsp_fc.nme_responsavel AS nme_fiscal_consorcio,
					ctc.cod_engenheiro_responsavel_medicao,
					rsp_rm.nme_responsavel AS nme_engenheiro_responsavel_medicao,
					ctc.cod_engenheiro_obras_construtora,
					rsp_eo.nme_responsavel AS nme_engenheiro_obras_construtora,
					ctc.cod_situacao_obra,
					spo.desc_situacao AS dsc_situacao_obra,
					ctc.cod_situacao_contrato,
					spc.desc_situacao AS dsc_sitaucao_contrato,
					ctc.dsc_observacoes_relatorio_mensal,
					ctc.dsc_observacoes_bacia,
					ctc.cod_parceiro,
					ctc.dsc_parceria_realizacao,
					ctc.dsc_observacoes_gerais,
					ctc.dsc_observacoes_apoio_gerencial,
					tpc.nme_parceiro
				FROM tb_contrato 			AS ctc
				LEFT JOIN tb_pi_contrato	AS pct 		ON pct.cod_contrato 	= ctc.id
				LEFT JOIN tb_pi 			AS tpi 		ON tpi.`Código` 		= pct.cod_empreendimento
				LEFT JOIN tb_predio			AS tpr 		ON tpr.id_predio 		= tpi.id_predio
				LEFT JOIN tb_Municipios 	AS mun 		ON mun.cod_mun 			= tpr.cod_municipio
				LEFT JOIN tb_Construtora 	AS emp 		ON emp.cod_construtora 	= ctc.cod_empresa_contratada
				LEFT JOIN tb_responsavel 	AS rsp_ec 	ON rsp_ec.cod_fiscal 	= ctc.cod_engenheiro_empresa_contratada
				LEFT JOIN tb_responsavel 	AS rsp_oc 	ON rsp_oc.cod_fiscal 	= ctc.cod_engenheiro_obras_consorcio
				LEFT JOIN tb_responsavel 	AS rsp_ed 	ON rsp_ed.cod_fiscal 	= ctc.cod_engenheiro_daee
				LEFT JOIN tb_responsavel 	AS rsp_po 	ON rsp_po.cod_fiscal 	= ctc.cod_engenheiro_planejamento_obras_consorcio
				LEFT JOIN tb_responsavel 	AS rsp_fc 	ON rsp_fc.cod_fiscal 	= ctc.cod_fiscal_consorcio
				LEFT JOIN tb_responsavel 	AS rsp_rm 	ON rsp_rm.cod_fiscal 	= ctc.cod_engenheiro_responsavel_medicao
				LEFT JOIN tb_responsavel 	AS rsp_eo 	ON rsp_eo.cod_fiscal 	= ctc.cod_engenheiro_obras_construtora
				LEFT JOIN tb_situacao_pi 	AS spo 		ON spo.cod_situacao 	= ctc.cod_situacao_obra
				LEFT JOIN tb_situacao_pi 	AS spc 		ON spc.cod_situacao 	= ctc.cod_situacao_contrato
				LEFT JOIN tb_parceiro 		AS tpc 		ON tpc.id 				= ctc.cod_parceiro ";
		
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
				$sql .= " WHERE mun.Municipios LIKE '%$search%' OR tpi.nome_empreendimento LIKE '%$search%' OR ctc.num_autos LIKE '%$search%' OR ctc.num_contrato LIKE '%$search%'";

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

		$sql .= " ORDER BY nme_municipio, nme_empreendimento, num_autos";
		
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