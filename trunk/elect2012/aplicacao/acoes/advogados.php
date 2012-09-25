<?php

if (aplicacao::isRequestPost()){
	$acao= aplicacao::getParam('acao');

	if ($acao == "deletar"){
		$id= aplicacao::getParam('deletar_id') ;

		try{
			$sql = "DELETE FROM advogado WHERE cod_advogado = ?";
			$result = banco::executar($sql,array($id));
			mensagem::sucesso('Operação realizada com sucesso!');
		}catch(Exception $e){
			mensagem::erro('Erro ao deletar o advogado. Tente novamente!');
		}		
		
	}
}

$sql = "SELECT ad.cod_advogado, ad.oab as oab, ad.nome as nome, ad.zona as zona, ad.secao as secao, se.local as local FROM advogado as ad, secao as se where ad.zona = se.zona and ad.secao = se.secao ORDER BY nome";
$lista = banco::listar($sql);