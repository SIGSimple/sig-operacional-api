<?php

class ConvenioController{

	public static function save() {
		$tObj = new ConvenioTO();

		// Preenche os campos do objeto com os dados do POST
		foreach ($_POST as $key => $value) {
			if(property_exists($tObj, $key))
				$tObj->$key = $value;
		}

		$tObj->cod_projetista_convenio 	= isset($_POST['projetista_convenio']) 	? $_POST['projetista_convenio']['data']['cod_construtora'] : "";
		$tObj->cod_coordenador_daee 	= isset($_POST['coordenador_daee']) 	? $_POST['coordenador_daee']['data']['cod_fiscal'] : "";

		$validator = new DataValidator();

		$validator->set_msg('O campo [Nº Autos do Processo] é obrigatório')
				  ->set('num_autos', $tObj->num_autos)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		// Tratamento de campos que precisam ser nulos ou com aspas simples
		foreach ($tObj as $key => $value) {
			if(empty($value))
				$tObj->$key = 'NULL';
			/*else {
				switch ($key) {
					case 'num_autos':
					case 'num_convenio':
					case 'dta_assinatura':
					case 'dta_publicacao_doe':
					case 'dta_vigencia':
					case 'nme_fonte_recurso':
					case 'dsc_observacoes':
						$tObj->$key = "'". $value ."'";
						break;
				}
			}*/
		}

		try {
			$dao = new ConvenioDao();
			
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
		$dao = new ConvenioDao();
		if($dao->delete($_GET['id']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new ConvenioDao();
		$items = $dao->get(array('cvn->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new ConvenioDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>