<?php
	$sql = "SELECT md5(local) as cod_local, local, endereco, bairro 
			FROM secao GROUP BY local, endereco,bairro 
			ORDER BY local ASC";
	$lista_locais = banco::listar($sql);
	
	
	$sql = "SELECT cod_advogado,UCASE(nome) as nome
			FROM advogado
			ORDER BY nome ASC";
	$lista_advogados = banco::listar($sql);
	
	
?>
