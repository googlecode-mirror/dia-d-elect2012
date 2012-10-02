<?php
include "aplicacao/boot.php"; 

$acao= aplicacao::getParam("acao");
$json = null;

if ($acao == "carregar-mapa"){	
	$value = array("teste","teste","teste","teste","teste","teste");
	$json = json_encode($value);
}

print $json;