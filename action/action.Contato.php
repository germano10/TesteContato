<?php

require_once('../config/config.php');
require_once('../config/funcoes.php');

$objContato = new Contato();

if(isset($_POST['btnSalvarContato'])){
	$objContato->set("con_id", $_REQUEST['con_id']);
	$objContato->gravarContato($_REQUEST);
	header("Location: ../index.php");
}

if($_REQUEST['acao'] == "apagarNumero"){
	$objContato->apagarNumero($_REQUEST);
}

if($_REQUEST['acao'] == "apagarContato"){
	$objContato->apagarContato($_REQUEST);
}

?>