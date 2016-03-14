<?php

class HttpUtil {

	public static function doGetRequest($url, $params) {
		if($params != "")
			 $url = $url . "?" . http_build_query($params);

		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

		return curl_exec($curl);
	}

	public static function doPostRequest($url, $params, $useAuth=false, $user=null, $pass=null) {
		$curl = curl_init($url);

		if($useAuth)
			curl_setopt($curl, CURL_USERPWD, $user . ":" . $pass);

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

		$response = curl_exec($curl);

		return $response;
	}
}

?>
