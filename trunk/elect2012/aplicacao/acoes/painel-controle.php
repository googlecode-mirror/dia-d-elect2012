<?php
	$sql = "SELECT md5(local) as cod_local, local, endereco, bairro 
			FROM secao GROUP BY local, endereco,bairro 
			ORDER BY local ASC";
	$lista_locais = banco::listar($sql);
?>
