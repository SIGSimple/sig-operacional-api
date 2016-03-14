<?php

class ModuloPerfilController {
	public static function getModulosPerfis($cod_perfil) {
		$moduloPerfilDao = new ModuloPerfilDao();
		$items = $moduloPerfilDao->getModulosPerfis($cod_perfil);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum modulo x perfil encontrado.');
	}
}

?>