<?php
ini_set('default_charset','UTF-8');
date_default_timezone_set('America/Sao_Paulo');

require_once 'func.php';
require_once 'constants.php';
require_once 'util/flight/Flight.php';
require_once 'util/Conexao/Conexao.php';
require 'vendor/autoload.php';

function loader( $nomeDaClasse ){
	if(file_exists( 'controller/'.$nomeDaClasse.'.php'  )){
		include('controller/'.$nomeDaClasse.'.php');
	}
	else if(file_exists( 'dao/'.$nomeDaClasse.'.php'  )){
		include('dao/'.$nomeDaClasse.'.php');
	}
	else if(file_exists( 'model/'.$nomeDaClasse.'.php'  )){
		include('model/'.$nomeDaClasse.'.php');
	}
	else if(file_exists( 'util/'.$nomeDaClasse.'/'.$nomeDaClasse.'.php'  )){
		include('util/'.$nomeDaClasse.'/'.$nomeDaClasse.'.php');
	}
}
spl_autoload_register("loader");
?>