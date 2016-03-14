<?php

class HistogramaDiarioObraController{

	public static function save($idDiarioObra) {
		$tObj = new HistogramaDiarioObraTO();
		$tObj->cod_acompanhamento = $idDiarioObra;
		
		// Preenche os campos do objeto com os dados do POST
		foreach ($_POST as $key => $value) {
			if(property_exists($tObj, $key)) {
				$tObj->$key = $value;
			}
		}

		$validator = new DataValidator();

		$validator->set_msg('O campo [Recurso] é obrigatório')
				  ->set('cod_recurso', $tObj->cod_recurso)
				  ->is_required();

		$validator->set_msg('O campo [Quantidade] é obrigatório')
				  ->set('qtd_recurso', $tObj->qtd_recurso)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new HistogramaDiarioObraDao();
			
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
		$dao = new HistogramaDiarioObraDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new HistogramaDiarioObraDao();
		$items = $dao->get(array('hsg->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function getByIdDiarioObra($idDiarioObra) {
		$dao  = new HistogramaDiarioObraDao();
		$items = $dao->get(array('cod_acompanhamento' => $idDiarioObra));
		if($items)
			Flight::json($items['rows']);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new HistogramaDiarioObraDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>