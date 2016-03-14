<?php

class LicitacaoController{

	public static function save() {
		$tObj = new LicitacaoTO();

		// Preenche os campos do objeto com os dados do POST
		foreach ($_POST as $key => $value) {
			if(property_exists($tObj, $key))
				$tObj->$key = $value;
		}

		$validator = new DataValidator();

		$validator->set_msg('O campo [Nº Autos do Processo] é obrigatório')
				  ->set('num_autos', $tObj->num_autos)
				  ->is_required();

		$validator->set_msg('O campo [Nº do Edital] é obrigatório')
				  ->set('num_edital', $tObj->num_edital)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new LicitacaoDao();
			
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
		$dao = new LicitacaoDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new LicitacaoDao();
		$items = $dao->get(array('lct->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new LicitacaoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>