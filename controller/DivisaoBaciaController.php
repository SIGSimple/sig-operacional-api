<?php

class DivisaoBaciaController{

	public static function save() {
		$tObj = new DivisaoBaciaTO();
		$tObj->id 				= isset($_POST['id']) ? $_POST['id'] : "" ;
		$tObj->desc_diretoria 	= isset($_POST['desc_diretoria']) ? $_POST['desc_diretoria'] : "" ;
		$tObj->nome_diretor 	= isset($_POST['nome_diretor']) ? $_POST['nome_diretor'] : "" ;

		$validator = new DataValidator();

		$validator->set_msg('O campo [Descrição] é obrigatório')
				  ->set('desc_diretoria', $tObj->desc_diretoria)
				  ->is_required();

		$validator->set_msg('O campo [Nome do Diretor] é obrigatório')
				  ->set('nome_diretor', $tObj->nome_diretor)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new DivisaoBaciaDao();
			
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
		$dao = new DivisaoBaciaDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new DivisaoBaciaDao();
		$items = $dao->get(array('id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new DivisaoBaciaDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>