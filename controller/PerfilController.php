<?php

class PerfilController {
	public static function getPerfis() {
		$perfilDao = new PerfilDao();
		$items = $perfilDao->getPerfis($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum perfil encontrado.');
	}

	public static function save() {
		$perfilTO = new PerfilTO();
		$perfilTO->cod_perfil 	= isset($_POST['cod_perfil']) 	? $_POST['cod_perfil'] 	: "";
		$perfilTO->nme_perfil 	= isset($_POST['nme_perfil']) 	? $_POST['nme_perfil'] 	: "";
		$perfilTO->flg_ativo 	= isset($_POST['flg_ativo']) 	? $_POST['flg_ativo'] 	: array();
		$perfilTO->modulos 		= isset($_POST['modulos']) 		? $_POST['modulos'] 	: array();

		$validator = new DataValidator();

		$validator->set_msg('A Descrição é obrigatória')
				  ->set('nme_perfil', $perfilTO->nme_perfil)
				  ->is_required();

		if(count($modulos) == 0) {
			$validator->set_msg('Selecione ao menos um módulo')
					  ->set('modulos', $perfilTO->modulos)
					  ->set_custom_error();
		}

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$perfilDao = new PerfilDao();
			if($cod_perfil === "")
				$perfilTO->cod_perfil = $perfilDao->savePerfil($perfilTO);
			else if(!$perfilDao->updatePerfil($perfilTO))
				Flight::halt(500, "Falha ao atualizar o perfil [". $perfilTO->nme_perfil ."]");

			if($perfilTO->cod_perfil) {
				$moduloPerfilDao = new ModuloPerfilDao();
				if($moduloPerfilDao->deleteAllModulosPerfil($perfilTO->cod_perfil)) {
					foreach ($modus as $key => $modulo) {
						$moduloPerfilTO = new ModuloPerfilTO();
						$moduloPerfilTO->cod_modulo = $modulo['cod_modulo'];
						$moduloPerfilTO->cod_perfil = $perfilTO->cod_perfil;

						if(!$moduloPerfilDao->saveModuloPerfil($moduloPerfilTO))
							Flight::halt(500, "Falha ao gravar os módulos ao perfil [". $perfilTO->nme_perfil ."]");
					}
				}
			}
			else
				Flight::halt(500, "Falha ao salvar o perfil [". $perfilTO->nme_perfil ."]");
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}
}

?>