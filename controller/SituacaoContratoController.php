<?php

class SituacaoContratoController{

	public static function save() {
		$tObj = new SituacaoContratoTO();
		$tObj->cod_situacao			= isset($_POST['cod_situacao']) ? $_POST['cod_situacao'] : "" ;
		$tObj->desc_situacao 		= isset($_POST['desc_situacao']) ? $_POST['desc_situacao'] : "" ;
		$tObj->cod_atendimento		= isset($_POST['cod_atendimento']) ? $_POST['cod_atendimento'] : "" ;

		$validator = new DataValidator();

		$validator->set_msg('O campo [Descrição] é obrigatório')
				  ->set('desc_situacao', $tObj->desc_situacao)
				  ->is_required();

		$validator->set_msg('O campo [cod_atendimento] é obrigatório')
				  ->set('cod_atendimento', $tObj->cod_atendimento)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new SituacaoContratoDao();
			
			if(!isset($_POST['cod_situacao'])) {
				$status_code = 201;
				$tObj->cod_situacao = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->cod_situacao)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new SituacaoContratoDao();
		if($dao->delete($_GET['cod_situacao']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new SituacaoContratoDao();
		$items = $dao->get(array('cod_situacao' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new SituacaoContratoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>