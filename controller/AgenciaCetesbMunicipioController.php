<?php

class AgenciaCetesbMunicipioController {
	public static function getMunicipiosByIdAgenciaCetesb($cod_agencia_cetesb) {
		$dao  = new AgenciaCetesbMunicipioDao();
		$items = $dao->getMunicipiosByIdAgenciaCetesb($cod_agencia_cetesb);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum registro encontrado.');
	}
}

?>