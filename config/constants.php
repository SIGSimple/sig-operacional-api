<?php

define('URL_BASE', baseUrl().'/sig-operacional-web');
define('CHARSET', 'utf8');

// Constantes de configuração do banco de dados
if(serverName() == 'localhost')
{
	// DESENVOLVIMENTO - LOCALHOST
	define('HOST', 		'localhost');
	define('DBNAME', 	'programaaguali');
	define('USER', 		'root');
	define('PASSWORD', 	'150679');
	define('PATH_UPLOAD_FILES', '/home/consorciointermultip/public_html/files/');
}
else
{
	// DESENVOLVIMENTO - LOCALHOST
	/*define('HOST', 		'localhost');
	define('DBNAME', 	'programaaguali');
	define('USER', 		'root');
	define('PASSWORD', 	'150679');
	define('PATH_UPLOAD_FILES', '/home/consorciointermultip/public_html/files/');*/
	
	// PRODUÇÃO - AMAZON
	define('HOST', 		'mysql01.sigsimple.hospedagemdesites.ws');
	define('DBNAME', 	'sigsimple');
	define('USER', 		'sigsimple');
	define('PASSWORD', 	'f150679@Fil');
	define('PATH_UPLOAD_FILES', '/home/consorciointermultip/public_html/files/');
}

?>