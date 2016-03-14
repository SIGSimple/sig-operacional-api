<?php

class ContratoController{

	public static function save() {
		$tObj = new ContratoTO();

		// Preenche os campos do objeto com os dados do POST
		foreach ($_POST as $key => $value) {
			if(property_exists($tObj, $key))
				$tObj->$key = $value;
		}

		$tObj->cod_empresa_contratada 						= isset($_POST['empresa_contratada']) 						? $_POST['empresa_contratada']['data']['cod_construtora'] : "";
		$tObj->cod_engenheiro_empresa_contratada 			= isset($_POST['engenheiro_empresa_contratada']) 			? $_POST['engenheiro_empresa_contratada']['data']['cod_fiscal'] : "";
		$tObj->cod_engenheiro_obras_consorcio 				= isset($_POST['engenheiro_obras_consorcio']) 				? $_POST['engenheiro_obras_consorcio']['data']['cod_fiscal'] : "";
		$tObj->cod_engenheiro_daee 							= isset($_POST['engenheiro_daee']) 							? $_POST['engenheiro_daee']['data']['cod_fiscal'] : "";
		$tObj->cod_engenheiro_planejamento_obras_consorcio	= isset($_POST['engenheiro_planejamento_obras_consorcio']) 	? $_POST['engenheiro_planejamento_obras_consorcio']['data']['cod_fiscal'] : "";
		$tObj->cod_fiscal_consorcio 						= isset($_POST['fiscal_consorcio']) 						? $_POST['fiscal_consorcio']['data']['cod_fiscal'] : "";
		$tObj->cod_engenheiro_responsavel_medicao 			= isset($_POST['engenheiro_responsavel_medicao']) 			? $_POST['engenheiro_responsavel_medicao']['data']['cod_fiscal'] : "";
		$tObj->cod_engenheiro_obras_construtora 			= isset($_POST['engenheiro_obras_construtora']) 			? $_POST['engenheiro_obras_construtora']['data']['cod_fiscal'] : "";

		// Tratamento de campos que precisam ser nulos ou com aspas simples
		foreach ($tObj as $key => $value) {
			if(empty($value))
				$tObj->$key = 'NULL';
			else {
				switch ($key) {
					case 'num_autos':
					case 'num_contrato':
					case 'dta_assinatura':
					case 'dta_publicacao_doe':
					case 'dta_pedido_empenho':
					case 'dta_os':
					case 'dta_vigencia':
					case 'dta_base':
					case 'dta_inauguracao':
					case 'dta_termo_recebimento_provisorio':
					case 'dta_termo_recebimento_definitivo':
					case 'dta_encerramento_contrato':
					case 'dta_recisao_contratual':
					case 'dta_inicio_obras':
					case 'num_percentual_executado':
					case 'dta_previsao_termino':
					case 'dta_conclusao_inauguracao':
					case 'dta_previsao_inauguracao':
					case 'dsc_observacoes_relatorio_mensal':
					case 'dsc_observacoes_bacia':
					case 'dsc_parceria_realizacao':
					case 'dsc_observacoes_gerais':
					case 'dsc_observacoes_apoio_gerencial':
						$tObj->$key = "'". $value ."'";
						break;
				}
			}
		}

		$cod_empreendimento = isset($_POST['empreendimento']) ? $_POST['empreendimento']['data']['cod_empreendimento'] : "" ;

		$validator = new DataValidator();

		$validator->set_msg('O campo [Empreendimento] é obrigatório')
				  ->set('cod_empreendimento', $cod_empreendimento)
				  ->is_required();

		$validator->set_msg('O campo [Nº Autos do Processo] é obrigatório')
				  ->set('num_autos', $tObj->num_autos)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new ContratoDao();
			
			if(!isset($_POST['id'])) {
				$status_code = 201;
				$tObj->id = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->id) {
				$empContDao = new EmpreendimentoContratoDao();

				if($empContDao->deleteByIdContrato($tObj->id)) {
					$empContTO = new EmpreendimentoContratoTO();
					$empContTO->cod_empreendimento 	= $cod_empreendimento;
					$empContTO->cod_contrato 		= $tObj->id;

					if($empContDao->save($empContTO))
						Flight::halt($status_code, 'Operação realizada com sucesso!');
					else
						Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
				}
				else
					Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
			}
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new ContratoDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new ContratoDao();
		$items = $dao->get(array('ctc->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new ContratoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>