<?php

class ModuloController {
	public static function getModulos() {
		$dao = new ModuloDao;
	
		$data = $dao->getModulos($_GET);

		$itemsByReference = array();
		
		// Build array of item references:
		foreach($data as $key => &$item) {
			$itemsByReference[$item['cod_modulo']] = &$item;
			// Children array:
			$itemsByReference[$item['cod_modulo']]['nodes'] = array();
			// Empty data class (so that json_encode adds "data: {}" )
			// $itemsByReference[$item['cod_modulo']]['data'] = new StdClass();
		}

		// Set items as children of the relevant parent item.
		foreach($data as $key => &$item)
			if($item['cod_modulo_pai'] && isset($itemsByReference[$item['cod_modulo_pai']]))
				$itemsByReference [$item['cod_modulo_pai']]['nodes'][] = &$item;
		
		// Remove items that were added to parents elsewhere:
		foreach($data as $key => &$item) {
			if($item['cod_modulo_pai'] && isset($itemsByReference[$item['cod_modulo_pai']]))
				unset($data[$key]);
		}

		Flight::json($data);
	}
}

?>