<?php
class ModalidadeLicitacaoController{
	public static function get() {
		$dao  = new ModalidadeLicitacaoDao();
		$itens = $dao->get($_GET);
		if($itens)
			Flight::json($itens);
		else
			Flight::halt(404, 'Nenhum registro encontrado.');
	}
}
?>