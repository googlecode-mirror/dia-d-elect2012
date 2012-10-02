<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

include "aplicacao/boot.php"; 

$acao= aplicacao::getParam("acao");
$json = null;

if ($acao == "carregar-mapa"){
	$sql = "SELECT 1 as sucesso, local, latitude, longitude, 1 as tipo, 1 as cor FROM secao GROUP BY local, latitude, longitude
			UNION
			SELECT 1 as sucesso, nome as local, latitude, longitude, tipo, 1 as cor FROM localidades";	
	$value = banco::listar($sql);
	$json = json_encode($value);
}

print $json;