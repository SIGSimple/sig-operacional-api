<?php

class EmpresaController{

	public static function save() {
		$tObj = new EmpresaTO();
		$tObj->cod_construtora 				= isset($_POST['cod_construtora']) ? $_POST['cod_construtora'] : "";
		$tObj->Construtora 					= isset($_POST['Construtora']) ? $_POST['Construtora'] : "";
		$tObj->end_construtora 				= isset($_POST['end_construtora']) ? $_POST['end_construtora'] : "";
		$tObj->cep_empresa 					= isset($_POST['cep_empresa']) ? $_POST['cep_empresa'] : "";
		$tObj->cod_municipio_empresa 		= isset($_POST['cod_municipio_empresa']) ? $_POST['cod_municipio_empresa'] : "";
		$tObj->email_empresa 				= isset($_POST['email_empresa']) ? $_POST['email_empresa'] : "";
		$tObj->site_empresa 				= isset($_POST['site_empresa']) ? $_POST['site_empresa'] : "";
		$tObj->num_telefone 				= isset($_POST['num_telefone']) ? $_POST['num_telefone'] : "";
		$tObj->cnpj_empresa 				= isset($_POST['cnpj_empresa']) ? $_POST['cnpj_empresa'] : "";
		$tObj->nme_engenheiro_responsavel 	= isset($_POST['nme_engenheiro_responsavel']) ? $_POST['nme_engenheiro_responsavel'] : "";
		$tObj->num_crea 					= isset($_POST['num_crea']) ? $_POST['num_crea'] : "";
		$tObj->telefone_responsavel 		= isset($_POST['telefone_responsavel']) ? $_POST['telefone_responsavel'] : "";
		$tObj->email_responsavel 			= isset($_POST['email_responsavel']) ? $_POST['email_responsavel'] : "";

		$validator = new DataValidator();

		$validator->set_msg('O campo [Nome] é obrigatório')
				  ->set('Construtora', $tObj->Construtora)
				  ->is_required();

		$validator->set_msg('O CNPJ informado é inválido')
				  ->set('cnpj_empresa', $tObj->cnpj_empresa)
				  ->is_cnpj();

		$validator->set('email_empresa', $tObj->email_empresa)
				  ->is_email();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new EmpresaDao();
			
			if(!isset($_POST['cod_construtora'])) {
				$status_code = 201;
				$tObj->cod_construtora = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->cod_construtora)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new EmpresaDao();
		if($dao->delete($_GET['cod_construtora']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new EmpresaDao();
		$items = $dao->get(array('cod_construtora' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new EmpresaDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>