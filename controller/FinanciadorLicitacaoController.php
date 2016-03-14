<?php
class FinanciadorLicitacaoController{
	public static function get() {
		$dao = new FinanciadorLicitacaoDao();
		$itens = $dao->get($_GET);
		if($itens)
			Flight::json($itens);
		else
			Flight::halt(404, 'Nenhum registro encontrado.');
	}
}
?>