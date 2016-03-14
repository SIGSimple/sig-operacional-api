<?php

class DiarioObraController{

	public static function save() {
		$tObj = new DiarioObraTO();
		
		// Preenche os campos do objeto com os dados do POST
		foreach ($_POST as $key => $value) {
			if(property_exists($tObj, $key)) {
				switch ($key) {
					case 'flg_vistoria_realizada':
					case 'flg_pendencia':
					case 'flg_pendencia_concluida':
					case 'flg_pendencia_valida':
					case 'flg_relatorio_mensal':
						if(!empty($value))
							$tObj->$key = ($value == 'true' || $value == '1') ? 1 : 0;
						break;
					default:
						$tObj->$key = $value;
						break;
				}
			}
		}

		foreach ($tObj as $key => $value) {
			if(empty($value)) {
				switch ($key) {
					case 'cod_tipo_pendencia':
					case 'cod_situacao_sso':
					case 'cod_situacao_clima_manha':
					case 'cod_situacao_clima_tarde':
					case 'cod_situacao_clima_noite':
					case 'cod_situacao_limpeza_obra':
					case 'cod_situacao_organizacao_obra':
						$tObj->$key = 'NULL';
						break;
				}
			}
		}

		$validator = new DataValidator();

		$validator->set_msg('O campo [Referente a] é obrigatório')
				  ->set('dta_registro', $tObj->dta_registro)
				  ->is_required();

		$validator->set_msg('O campo [Responsável] é obrigatório')
				  ->set('cod_fiscal', $tObj->cod_fiscal)
				  ->is_required();

		$validator->set_msg('O campo [Registro] é obrigatório')
				  ->set('dsc_registro', $tObj->dsc_registro)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new DiarioObraDao();
			
			if(!isset($_POST['cod_acompanhamento'])) {
				$status_code = 201;
				$tObj->cod_acompanhamento = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->cod_acompanhamento)
				Flight::response()->status($status_code)
								  ->header('Content-Type', 'application/json')
								  ->write(json_encode(array('message'=>'Operação realizada com sucesso!', 'id'=>$tObj->cod_acompanhamento)))
								  ->send();
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new DiarioObraDao();
		if($dao->delete($_GET['cod_acompanhamento']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new DiarioObraDao();
		$items = $dao->get(array('cod_acompanhamento' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new DiarioObraDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>