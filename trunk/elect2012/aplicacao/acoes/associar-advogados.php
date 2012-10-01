<?php

$advogado = aplicacao::getParam('cod_adv');
$cod_local =  aplicacao::getParam('cod_local');
$acao =  aplicacao::getParam('acao');

if($acao == 'atualizar'){
	
	banco::abrirTransacao();
	try{
		$sql = 'DELETE FROM advogado_secao WHERE cod_advogado = ?';
		banco::executar($sql,array($advogado));
		
		foreach($cod_local as $item){
			$sql = 'SELECT * FROM secao WHERE md5(local) = ?';
			$secoes_local = banco::listar($sql,array($item));
			foreach($secoes_local as $subitem){
				$sql = 'INSERT INTO advogado_secao (zona,secao,cod_advogado) VALUES (?,?,?)';
				banco::executar($sql,array($subitem->zona, $subitem->secao, $advogado));
			}
		}
		
		banco::fecharTransacao();
	}catch (Exception $e){
		banco::cancelarTransacao();
	}
}

$sql = "SELECT cod_advogado,UCASE(nome) as nome
			FROM advogado
			ORDER BY nome ASC";
$lista_advogados = banco::listar($sql);
$lista_locais = array();

if ($advogado){
	$sql = "SELECT md5(local) as cod_local, local, endereco, bairro, a.cod_advogado
			FROM secao s
			LEFT JOIN advogado_secao a ON a.secao = s.secao AND a.zona = s.zona
			GROUP BY local, endereco,bairro			
			ORDER BY local ASC";
	$lista_locais = banco::listar($sql);	
}
