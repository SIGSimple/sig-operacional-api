<?php

class RecursoController{

	public static function save() {
		$tObj = new RecursoTO();
		$tObj->id 				= isset($_POST['id']) ? $_POST['id'] : "" ;
		$tObj->cod_tipo_recurso = isset($_POST['cod_tipo_recurso']) ? $_POST['cod_tipo_recurso'] : "" ;
		$tObj->nme_recurso 		= isset($_POST['nme_recurso']) ? $_POST['nme_recurso'] : "" ;

		$validator = new DataValidator();

		$validator->set_msg('O campo [Descrição] é obrigatório')
				  ->set('nme_recurso', $tObj->nme_recurso)
				  ->is_required();

		$validator->set_msg('O campo [Tipo de Recurso] é obrigatório')
				  ->set('cod_tipo_recurso', $tObj->cod_tipo_recurso)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new RecursoDao();
			
			if(!isset($_POST['id'])) {
				$status_code = 201;
				$tObj->id = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->id)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new RecursoDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new RecursoDao();
		$items = $dao->get(array('rec->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new RecursoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>