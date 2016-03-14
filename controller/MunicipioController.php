<?php
class MunicipioController{
	public static function save() {
		$tObj = new MunicipioTO();
		$tObj->id_predio 					= isset($_POST['id_predio']) ? $_POST['id_predio'] : "" ;
		$tObj->cod_municipio 				= isset($_POST['cod_municipio']) ? $_POST['cod_municipio'] : "" ;
		$tObj->cod_bacia_daee 				= isset($_POST['cod_bacia_daee']) ? $_POST['cod_bacia_daee'] : "";
		$tObj->nme_bacia_daee 				= isset($_POST['nme_bacia_daee']) ? $_POST['nme_bacia_daee'] : "";
		$tObj->cod_bacia_secretaria 		= isset($_POST['cod_bacia_secretaria']) ? $_POST['cod_bacia_secretaria'] : "";
		$tObj->nme_municipio 				= isset($_POST['nme_municipio']) ? $_POST['nme_municipio'] : "";
		$tObj->nme_endereco 				= isset($_POST['nme_endereco']) ? $_POST['nme_endereco'] : "";
		$tObj->Complemento 					= isset($_POST['Complemento']) ? $_POST['Complemento'] : "";
		$tObj->CEP 							= isset($_POST['CEP']) ? $_POST['CEP'] : "";
		$tObj->dsc_observacoes 				= isset($_POST['dsc_observacoes']) ? $_POST['dsc_observacoes'] : "";
		$tObj->cod_prefeitura 				= isset($_POST['prefeitura']) ? $_POST['prefeitura']['data']['cod_construtora'] : "";
		$tObj->cod_prefeito 				= isset($_POST['prefeito']) ? $_POST['prefeito']['data']['cod_fiscal'] : "";
		$tObj->ano_inicio_adm 				= isset($_POST['ano_inicio_adm']) ? $_POST['ano_inicio_adm'] : "";
		$tObj->ano_fim_adm 					= isset($_POST['ano_fim_adm']) ? $_POST['ano_fim_adm'] : "";
		$tObj->cod_partido 					= isset($_POST['cod_partido']) ? $_POST['cod_partido'] : "";
		$tObj->qtd_populacao_urbana_2010 	= isset($_POST['qtd_populacao_urbana_2010']) ? $_POST['qtd_populacao_urbana_2010'] : "";
		$tObj->qtd_populacao_urbana_2030 	= isset($_POST['qtd_populacao_urbana_2030']) ? $_POST['qtd_populacao_urbana_2030'] : "";
		$tObj->latitude_longitude 			= isset($_POST['latitude_longitude']) ? $_POST['latitude_longitude'] : "";
		$tObj->flg_atendido_sabesp 			= isset($_POST['flg_atendido_sabesp']) ? $_POST['flg_atendido_sabesp'] : "";
		$tObj->cod_concessao 				= isset($_POST['cod_concessao']) ? $_POST['cod_concessao'] : "";

		$validator = new DataValidator();

		$validator->set_msg('O campo [Cidade] é obrigatório')
				  ->set('cod_municipio', $tObj->cod_municipio)
				  ->is_required();

		$validator->set_msg('O campo [Divisão de Bacia (DAEE)] é obrigatório')
				  ->set('cod_bacia_daee', $tObj->cod_bacia_daee)
				  ->is_required();

		$validator->set_msg('O campo [Divisão de Bacia (SSRH)] é obrigatório')
				  ->set('cod_bacia_secretaria', $tObj->cod_bacia_secretaria)
				  ->is_required();

		$validator->set_msg('O campo [Prefeitura] é obrigatório')
				  ->set('cod_prefeitura', $tObj->cod_prefeitura)
				  ->is_required();

		$validator->set_msg('O campo [Prefeito] é obrigatório')
				  ->set('cod_prefeito', $tObj->cod_prefeito)
				  ->is_required();

		$validator->set_msg('O campo [Partido] é obrigatório')
				  ->set('cod_partido', $tObj->cod_partido)
				  ->is_required();

		$validator->set_msg('O campo [Concessao] é obrigatório')
				  ->set('cod_concessao', $tObj->cod_concessao)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new MunicipioDao();
			
			if(!isset($_POST['id_predio'])) {
				$status_code = 201;
				$tObj->id_predio = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->id_predio)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new MunicipioDao();
		if($dao->delete($_GET['id_predio']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new MunicipioDao();
		$items = $dao->get(array('id_predio' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new MunicipioDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum registro encontrado.');
	}
}
?>