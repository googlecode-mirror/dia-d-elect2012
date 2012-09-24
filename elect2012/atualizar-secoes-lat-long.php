<?php
include "aplicacao/boot.php";

$sql = "SELECT local, CONCAT(endereco,' ',bairro,' ',municipio) as logradouro FROM secao GROUP BY local ORDER BY local ASC";
$lista = banco::listar($sql);

foreach ($lista as $item){
	$result = gmaps::getLatLong($item->logradouro);
	if ($result){
		$lat = $result[0];
		$long = $result[1];
		banco::executar('UPDATE secao SET latitude = ?, longitude = ? WHERE local = ?',array($lat,$long,$item->local));
	}
}