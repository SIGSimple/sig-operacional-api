<?php

class ProgramaController{

	public static function save() {
		$tObj = new ProgramaTO();
		$tObj->cod_depto 		= isset($_POST['cod_depto']) ? $_POST['cod_depto'] : "" ;
		$tObj->desc_depto 		= isset($_POST['desc_depto']) ? $_POST['desc_depto'] : "" ;
		$tObj->sigla 			= isset($_POST['sigla']) ? $_POST['sigla'] : "" ;

		$validator = new DataValidator();

		$validator->set_msg('O campo [Descrição] é obrigatório')
				  ->set('desc_depto', $tObj->desc_depto)
				  ->is_required();

		$validator->set_msg('O campo [Sigla] é obrigatório')
				  ->set('sigla', $tObj->sigla)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new ProgramaDao();
			
			if(!isset($_POST['cod_depto'])) {
				$status_code = 201;
				$tObj->cod_depto = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->cod_depto)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new ProgramaDao();
		if($dao->delete($_GET['cod_depto']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new ProgramaDao();
		$items = $dao->get(array('cod_depto' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new ProgramaDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>