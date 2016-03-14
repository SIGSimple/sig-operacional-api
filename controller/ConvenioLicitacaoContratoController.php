<?php

class ConvenioLicitacaoContratoController{

	public static function save() {
		$tObj = new ConvenioLicitacaoContratoTO();

		$tObj->id 						= isset($_POST['id']) 						? $_POST['id'] : "";
		$tObj->cod_convenio 			= isset($_POST['convenio']) 				? $_POST['convenio']['data']['id'] : "";
		$tObj->cod_licitacao 			= isset($_POST['licitacao']) 				? $_POST['licitacao']['data']['id'] : "";
		$tObj->cod_contrato 			= isset($_POST['contrato']) 				? $_POST['contrato']['data']['id'] : "";
		$tObj->vlr_destinado_contrato 	= isset($_POST['vlr_destinado_contrato']) 	? $_POST['vlr_destinado_contrato'] : "";

		try {
			$dao = new ConvenioLicitacaoContratoDao();
			
			if(!isset($_POST['id'])) {
				$status_code = 201;
				$tObj->id = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

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
		$dao = new ConvenioLicitacaoContratoDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new ConvenioLicitacaoContratoDao();
		$items = $dao->get(array('clc->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new ConvenioLicitacaoContratoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>