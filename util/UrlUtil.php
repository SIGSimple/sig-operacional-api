<?php

class UrlUtil {
	public static function getParamValue($urlParams, $param) {
		foreach ($urlParams as $key => $value) {
			if($key == $param)
				return $value;
			else {
				$key = explode("->", $key);

				foreach ($key as $i => $v) {
					if($v == $param)
						return $value;
				}
			}
		}
	}
}

?>
