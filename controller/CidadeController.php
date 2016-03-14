<?php

class CidadeController {
	public static function get() {
		$dao = new CidadeDao;
		$itens = $dao->get($_GET);
		if($itens)
			Flight::json($itens);
		else
			Flight::halt(404, 'nenhum registro encontrado!');		
	}
}

?>