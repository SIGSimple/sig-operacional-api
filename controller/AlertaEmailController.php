<?php

class AlertaEmailController {
	public static function saveAlertaEmail(){
		$tObj = new AlertaEmailTO();
		$tObj->nme_alerta 			= isset($_POST['nme_alerta']) ? $_POST['nme_alerta'] : "" ;
		$tObj->sql_query 			= isset($_POST['sql_query']) ? addslashes($_POST['sql_query']) : "" ;
		$tObj->txt_html_email 		= isset($_POST['txt_html_email']) ? htmlentities($_POST['txt_html_email'], ENT_QUOTES) : "" ;
		$tObj->dta_inicio 			= isset($_POST['dta_inicio']) ? $_POST['dta_inicio'] : "" ;
		$tObj->dta_fim 				= isset($_POST['dta_fim']) ? $_POST['dta_fim'] : "" ;
		$tObj->flg_periodicidade 	= isset($_POST['flg_periodicidade']) ? $_POST['flg_periodicidade'] : "" ;
		$tObj->flg_ativo 			= isset($_POST['flg_ativo']) ? $_POST['flg_ativo'] : "" ;

		$destinatarios = isset($_POST['destinatarios']) ? $_POST['destinatarios'] : "";

		$validator = new DataValidator();

		$validator->set_msg('O Nome/Descrição da alerta é obrigatório')
				  ->set('nme_alerta' ,$tObj->nme_alerta)
				  ->is_required();

		$validator->set_msg('A Consulta (SQL) é obrigatória')
				  ->set('sql_query' ,$tObj->sql_query)
				  ->is_required();

		$validator->set_msg('O Modelo de E-mail (HTML) é obrigatório')
				  ->set('txt_html_email' ,$tObj->txt_html_email)
				  ->is_required();

		$validator->set_msg('A Data de Início é obrigatória')
				  ->set('dta_inicio' ,$tObj->dta_inicio)
				  ->is_required();

		$validator->set_msg('A Periodicidade é obrigatória')
				  ->set('flg_periodicidade' ,$tObj->dta_inicio)
				  ->is_required();

		$validator->set_msg('A Data de Fim é obrigatória')
				  ->set('dta_fim' ,$tObj->dta_fim)
				  ->is_required();

		$validator->set_msg('Informe ao menos um destinatário!')
				  ->set('destinatarios' ,$destinatarios)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$alertaEmailDao = new AlertaEmailDao();

			$tObj->cod_alerta_email = $alertaEmailDao->saveAlertaEmail($tObj);

			if($tObj->cod_alerta_email > 0) {
				$alertaEmailDestinatarioDao = new AlertaEmailDestinatarioDao();

				foreach ($destinatarios as $key => $destinatario) {
					$alEmDestTO = new AlertaEmailDestinatarioTO();
					$alEmDestTO->cod_alerta_email = $tObj->cod_alerta_email;
					$alEmDestTO->cod_destinatario = $destinatario['cod_fiscal'];
					
					if(!$alertaEmailDestinatarioDao->saveAlertaEmailDestinatario($alEmDestTO))
						Flight::halt(500, 'Ocorreu um erro ao tentar salvar!<br/>Contate o administrador.');
				}

				Flight::halt(200, 'Alerta de E-mail salva com sucesso!');
			}
			else
				Flight::halt(500, 'Ocorreu um erro ao tentar salvar!<br/>Contate o administrador.');
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function getAlertasEmail() {
		$alertaEmailDao  = new AlertaEmailDao();
		$items = $alertaEmailDao->getAlertasEmail($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma alerta de e-mail encontrada.');
	}

	public static function enviarEmail($alertaEmail) {
		// Instantiate DAO's containers
		$alertaEmailDao = new AlertaEmailDao();
		$sqlHelperDao = new SQLHelperDao();
		$alertaEmailDestinatarioDao = new AlertaEmailDestinatarioDao();

		// Create temporary file of HTML e-mail template
		$pth_email_template = "util/email_templates/";
		$tmp_filename = "tmp_". rand() . ".php";
		$tmp_file = fopen($pth_email_template . $tmp_filename, "w+");
		fwrite($tmp_file, $alertaEmail['txt_html_email']);
		fclose($tmp_file);

		//  Get dataset of current alert
		$dataset = $sqlHelperDao->executeQuery($alertaEmail['sql_query']);

		// Get destination users list of current alert
		$params['aed->cod_alerta_email'] = $alertaEmail['cod_alerta_email'];
		$fromList = $alertaEmailDestinatarioDao->getDestinatariosAlertEmail($params);

		foreach ($fromList as $key => $fromUser) {
			// Prepare e-mail options
			$from = array(array("nome" => $fromUser['nme_responsavel'], "email" => $fromUser['email']));
			$data = array("nme_destinatario" => $fromUser['nme_responsavel'], "dataset" => $dataset);
			
			// Process e-mail send
			if(sendMail($alertaEmail['nme_alerta'], $tmp_filename, $from, $data))
				continue;
			else
				Flight::halt(500, "Erro ao enviar e-mail para [". $fromUser['nme_responsavel'] ."]:[". $fromUser['email'] ."]");
		}

		// Destroy temporary file
		unlink($pth_email_template . $tmp_filename);

		// Update last send alert e-mail date
		if(!$alertaEmailDao->setDataEnvio($alertaEmail['cod_alerta_email']))
			Flight::halt(500, "Erro ao atualizar data de envio [". $alertaEmail['cod_alerta_email'] ."]");
	}

	public static function processarAlertas() {
		$alertaEmailDao = new AlertaEmailDao();
		// Get alerts elegible to send
		$items = $alertaEmailDao->getAlertasEmail(null);
		if($items) {
			$returnMessage = "";
			
			foreach ($items['rows'] as $key => $alertaEmail) {
				// Get the periodicity flag value
				$flg_periodicidade = $alertaEmail['flg_periodicidade'];

				if($alertaEmail['dta_ultimo_envio']) {
					// Get the last send date
					$dta_ultimo_envio = DateTime::createFromFormat('Y-m-d', DateTime::createFromFormat('Y-m-d H:i:s', $alertaEmail['dta_ultimo_envio'])->format('Y-m-d'));

					// Get today's date
					$hoje = DateTime::createFromFormat('Y-m-d', (new DateTime())->format('Y-m-d'));

					// Compare differences between last send date and today's date 
					$interval = $hoje->diff($dta_ultimo_envio);

					// Analyzes if it is within sending periodicity
					switch ($flg_periodicidade) {
						case 'D': // Daily
							if((int)$interval->format('%R%a') == -1) { // last sended yesterday?
								AlertaEmailController::enviarEmail($alertaEmail);
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] enviada com sucesso!<br/>";
							}
							else
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] não enviada pois está fora da periodicidade de envio!<br/>";
							break;
						case 'S': // Weekly
							if((int)$interval->format('%R%a') == -7) { // last sended seven days ago?
								AlertaEmailController::enviarEmail($alertaEmail);
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] enviada com sucesso!<br/>";
							}
							else
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] não enviada pois está fora da periodicidade de envio!<br/>";
							break;
						case 'Q': // Fortnightly
							if((int)$interval->format('%R%a') == -15) { // last sended fifteen days ago?
								AlertaEmailController::enviarEmail($alertaEmail);
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] enviada com sucesso!<br/>";
							}
							else
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] não enviada pois está fora da periodicidade de envio!<br/>";
							break;
						case 'M': // Monthly
							if((int)$interval->format('%R%m') == -1) { // last sended one month ago?
								AlertaEmailController::enviarEmail($alertaEmail);
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] enviada com sucesso!<br/>";
							}
							else
								$returnMessage .= "Alerta [". $alertaEmail['nme_alerta'] ."] não enviada pois está fora da periodicidade de envio!<br/>";
							break;
					}
				}
				else
					AlertaEmailController::enviarEmail($alertaEmail);
			}

			Flight::halt(200, $returnMessage);
		}
		else
			Flight::halt(404, 'Nada a processar!');
	}
}

?>