<?php

class ItemCronogramaContratoController{

	public static function save() {
		$tObj = new ItemCronogramaContratoTO();

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
			$dao = new ItemCronogramaContratoDao();
			
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
		$dao = new ItemCronogramaContratoDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new ItemCronogramaContratoDao();
		$items = $dao->get(array('cci->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function getByIdCronograma($idContrato, $idCronograma) {
		$dao  = new ItemCronogramaContratoDao();

		$_GET['tcc->cod_contrato'] = $idContrato;
		$_GET['tcc->id'] = $idCronograma;

		$items = $dao->get($_GET);
		if($items)
			Flight::json($items['rows']);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new ItemCronogramaContratoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>