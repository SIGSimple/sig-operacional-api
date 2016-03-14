<?php

class SituacaoObraController {
	public static function get() {
		$dao = new SituacaoObraDao;
		$itens = $dao->get($_GET);
		if($itens)
			Flight::json($itens);
		else
			Flight::halt(500, 'Nenhum registro encontrado');
	}
}

?>