<?php

class PartidoController {
	public static function get() {
		$dao = new PartidoDao;
		$itens = $dao->get($_GET);
		if($itens)
			Flight::json($itens);
		else
			Flight::halt(500, 'Nenhum registro encontrado');
	}
}

?>