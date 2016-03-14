<?php
class TipoContratacaoController{
	public static function get() {
		$dao  = new TipoContratacaoDao();
		$itens = $dao->get($_GET);
		if($itens)
			Flight::json($itens);
		else
			Flight::halt(404, 'Nenhum registro encontrado.');
	}
}
?>