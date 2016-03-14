<?php

class AgenciaCetesbController{

	public static function save() {
		$tObj = new AgenciaCetesbTO();
		$tObj->id 				= isset($_POST['id']) ? $_POST['id'] : "" ;
		$tObj->nme_agencia 		= isset($_POST['nme_agencia']) ? $_POST['nme_agencia'] : "" ;
		$tObj->cod_municipio 	= isset($_POST['cod_municipio']) ? $_POST['cod_municipio'] : "" ;
		$tObj->num_telefone 	= isset($_POST['num_telefone']) ? $_POST['num_telefone'] : "" ;
		$tObj->end_email 		= isset($_POST['end_email']) ? $_POST['end_email'] : "" ;

		$municipios_atendidos 	= isset($_POST['municipios_atendidos']) ? $_POST['municipios_atendidos'] : "";

		$validator = new DataValidator();

		$validator->set_msg('O campo [Agência Ambiental de(o)] é obrigatório')
				  ->set('nme_agencia', $tObj->nme_agencia)
				  ->is_required();

		$validator->set_msg('O campo [Cidade/Municipio] é obrigatório')
				  ->set('cod_municipio', $tObj->cod_municipio)
				  ->is_required();

		$validator->set_msg('O campo [Telefone] é obrigatório')
				  ->set('num_telefone', $tObj->num_telefone)
				  ->is_required();

		$validator->set_msg('O campo [E-mail] é obrigatório')
				  ->set('end_email', $tObj->end_email)
				  ->is_required();

		$validator->set_msg('Informe ao menos um Municipio Atendido!')
				  ->set('municipios_atendidos', $municipios_atendidos)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$agenciaCetesbDao = new AgenciaCetesbDao();
			
			if(!isset($_POST['id'])) {
				$status_code = 201;
				$tObj->id = $agenciaCetesbDao->save($tObj);
			}
			else {
				$status_code = 200;
				$agenciaCetesbDao->update($tObj);
			}

			if(!$tObj->id)
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
			else {
				$agenciaCetesbMunicipioDao = new AgenciaCetesbMunicipioDao();
				$agenciaCetesbMunicipioDao->deleteMunicipiosByIdAgenciaCetesb($tObj->id);

				foreach ($municipios_atendidos as $key => $cod_municipio) {
					$tObj2 = new AgenciaCetesbMunicipioTO();
					$tObj2->cod_agencia_cetesb 	= $tObj->id;
					$tObj2->cod_municipio 		= $cod_municipio;

					if(!$agenciaCetesbMunicipioDao->save($tObj2))
						Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
				}

				Flight::halt($status_code, 'Operação realizada com sucesso!');
			}
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$agenciaCetesbDao = new AgenciaCetesbDao();
		if($agenciaCetesbDao->delete($_GET['id'])) {
			$agenciaCetesbMunicipioDao = new AgenciaCetesbMunicipioDao();
			if($agenciaCetesbMunicipioDao->deleteMunicipiosByIdAgenciaCetesb($_GET['id']))
				Flight::halt(200, 'Registro excluído com sucesso!');
			else
				Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
		}
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new AgenciaCetesbDao();
		$items = $dao->get(array('tac->id' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new AgenciaCetesbDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>