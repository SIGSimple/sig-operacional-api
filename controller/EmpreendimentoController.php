<?php

class EmpreendimentoController{

	public static function save() {
		$tObj = new EmpreendimentoTO();

		// Preenche os campos do objeto com os dados do POST
		foreach ($_POST as $key => $value) {
			if(property_exists($tObj, $key))
				$tObj->$key = $value;
		}

		// Tratamento de campos que precisam ser nulos ou com aspas simples
		foreach ($tObj as $key => $value) {
			if(empty($value)) {
				switch ($key) {
					case 'cod_empreendimento':
					case 'cod_predio':
					case 'cod_tipo_empreendimento':
					case 'cod_programa':
					case 'cod_bacia_hidrografica':
					case 'cod_manancial_lancamento':
					case 'cod_tipo_ete':
					case 'qtd_metragem_coletor_tronco':
					case 'qtd_metragem_interceptor':
					case 'qtd_metragem_linha_recalque':
					case 'qtd_metragem_emissario_fluente_bruto':
					case 'qtd_eee':
					case 'qtd_metragem_emissario_efluente_tratado':
						$tObj->$key = 'NULL';
						break;
				}
			}
		}

		$validator = new DataValidator();

		$validator->set_msg('O campo [Cidade] é obrigatório')
				  ->set('cod_predio', $tObj->cod_predio)
				  ->is_required();

		$validator->set_msg('O campo [Localidade] é obrigatório')
				  ->set('nome_empreendimento', $tObj->nome_empreendimento)
				  ->is_required();

		$validator->set_msg('O campo [Nº Autos do Processo] é obrigatório')
				  ->set('PI', $tObj->PI)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$dao = new EmpreendimentoDao();
			
			if(!isset($_POST['cod_empreendimento'])) {
				$status_code = 201;
				$tObj->cod_empreendimento = $dao->save($tObj);
			}
			else {
				$status_code = 200;
				$dao->update($tObj);
			}

			if($tObj->cod_empreendimento)
				Flight::halt($status_code, 'Operação realizada com sucesso!');
			else
				Flight::halt(500, "Ocorreu um erro ao realizar a operação!");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}

	public static function delete() {
		$dao = new EmpreendimentoDao();
		if($dao->delete($_GET['cod_empreendimento']))
			Flight::halt(200, 'Registro excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir o registro! Contate o administrador do sistema.');
	}

	public static function getById($id) {
		$dao  = new EmpreendimentoDao();
		$items = $dao->get(array('tpi->`Código`' => $id));
		if($items)
			Flight::json($items['rows'][0]);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}

	public static function get() {
		$dao  = new EmpreendimentoDao();
		$items = $dao->get($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma registro encontrado.');
	}
}

?>