<?php

class TipoETEController {
	public static function get() {
		$dao = new TipoETEDao;
		$itens = $dao->get($_GET);
		if($itens)
			Flight::json($itens);
		else
			Flight::halt(500, 'Nenhum registro encontrado');
	}
}

?>