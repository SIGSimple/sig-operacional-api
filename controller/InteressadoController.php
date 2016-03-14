<?php
class InteressadoController {
	public static function save() {
		$tObj = new InteressadoTO();
		$tObj->cod_fiscal 	= isset($_POST['cod_fiscal']) ? $_POST['cod_fiscal'] : "";
		$tObj->nme_responsavel 	= isset($_POST['nme_responsavel']) ? $_POST['nme_responsavel'] : "";
		$tObj->cargo 			= isset($_POST['cargo']) ? $_POST['cargo'] : "";
		$tObj->email 			= isset($_POST['email']) ? $_POST['email'] : "";
		$tObj->telefone 		= isset($_POST['telefone']) ? $_POST['telefone'] : "";
		$tObj->numero_crea		= isset($_POST['numero_crea']) ? $_POST['numero_crea'] : "";
		$tObj->cod_empresa		= isset($_POST['empresa']) ? $_POST['empresa']['data']['cod_construtora'] : "";
		$tObj->cod_usuario 		= isset($_POST['usuario']) ? $_POST['usuario']['data']['cod_usuario'] : "";

		$validator = new DataValidator();

		$validator->set_msg('O campo [Nome] é obrigatório')
				  ->set('nme_responsavel', $tObj->nme_responsavel)
				  ->is_required();

		$validator->set('email', $tObj->email)
				  ->is_email();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new InteressadoDao();
			
			if(!isset($_POST['cod_fiscal'])) {
				$status_code = 201;
				$tObj->cod_fiscal = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->cod_fiscal)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new InteressadoDao();
		if($dao->delete($_GET['cod_fiscal']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new InteressadoDao();
		$items = $dao->get(array('cod_fiscal' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new InteressadoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum registro encontrado.');
	}
}
?>