<?php

class ConfiguracaoController {
	public static function saveConfiguracao(){
		$confTO = new ConfiguracaoTO();
		$confTO->chv_configuracao 	= isset($_POST['chv_configuracao']) ? $_POST['chv_configuracao'] : "" ;
		$confTO->vlr_configuracao 	= isset($_POST['vlr_configuracao']) ? $_POST['vlr_configuracao'] : "" ;
		$confTO->flg_ativo 			= isset($_POST['flg_ativo']) ? $_POST['flg_ativo'] : "" ;

		$validator = new DataValidator();

		$validator->set_msg('A chave de configuração é obrigatória')
				  ->set('chv_configuracao' ,$confTO->chv_configuracao)
				  ->is_required();

		$validator->set_msg('O valor da chave de configuração é obrigatório')
				  ->set('vlr_configuracao' ,$confTO->vlr_configuracao)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$confDao = new ConfiguracaoDao();
			if($confDao->saveConfiguracao($confTO))
				Flight::halt(200, 'Chave de configuração salva com sucesso!');
			else
				Flight::halt(500, 'Ocorreu um erro ao tentar salvar!<br/>Contate o administrador.');
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function getConfiguracoes() {
		$confDao  = new ConfiguracaoDao();
		$items = $confDao->getConfiguracoes($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma configuração encontrada.');
	}
}

?>