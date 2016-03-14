<?php

class AnexoDiarioObraController{

	public static function save($idDiarioObra) {
		$tObj = new AnexoDiarioObraTO();
		$tObj->cod_referencia = $idDiarioObra;
		
		// Preenche os campos do objeto com os dados do POST
		foreach ($_POST as $key => $value) {
			if(property_exists($tObj, $key)) {
				$tObj->$key = $value;
			}
		}

		$validator = new DataValidator();

		$validator->set_msg('O campo [Arquivo] é obrigatório')
				  ->set('nme_arquivo', $tObj->nme_arquivo)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new AnexoDiarioObraDao();
			
			if(!isset($_POST['id_arquivo'])) {
				$status_code = 201;
				$tObj->id_arquivo = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->id_arquivo)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new AnexoDiarioObraDao();
		if($dao->delete($_GET['id_arquivo']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new AnexoDiarioObraDao();
		$items = $dao->get(array('id_arquivo' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function getByIdDiarioObra($idDiarioObra) {
		$dao  = new AnexoDiarioObraDao();
		$items = $dao->get(array('cod_referencia' => $idDiarioObra));
		if($items)
			Flight::json($items['rows']);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new AnexoDiarioObraDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>