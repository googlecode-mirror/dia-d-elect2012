<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

include "aplicacao/boot.php"; 

$acao= aplicacao::getParam("acao");
$json = null;

if ($acao == "carregar-mapa"){
	$sql = "SELECT s1.local, s1.latitude, s1.longitude, 1 as tipo, 
				COALESCE(( select count(*) 
				  from secao s2
				  inner join advogado_secao a  ON s2.secao = a.secao AND s2.zona = a.zona
				  where md5(s2.local) = md5(s1.local)
				  group by s2.local
				),0) as total_adv
			FROM secao s1 GROUP BY s1.local, s1.latitude, s1.longitude
			
			UNION
			
			SELECT nome as local, latitude, longitude, tipo, 0 as total_adv FROM localidades";	
	$value = banco::listar($sql);
	$json = json_encode($value);
}

print $json;