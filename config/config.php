<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('display_errors', 1);

$local = "/xampp/htdocs/teste/";

$diretorio = $local.'/config/';
set_include_path(get_include_path() . PATH_SEPARATOR . $diretorio);

$diretorio = $local.'/action/';
set_include_path(get_include_path() . PATH_SEPARATOR . $diretorio);

$diretorio = $local.'/class/';
set_include_path(get_include_path() . PATH_SEPARATOR . $diretorio);

/* Configurações do banco de dodos */
define("HOST",'localhost');
define("USER",'root');
define("PASS",'');
define("DB",'teste');

/*autoload*/
function autoLoad ($classe) {
	include('class.'.$classe . ".php");
}

spl_autoload_register("autoLoad");

?>