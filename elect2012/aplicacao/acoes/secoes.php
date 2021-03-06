<?php

if (aplicacao::isRequestPost()){
	$acao= aplicacao::getParam('acao');

	if ($acao == "deletar"){
		$zona= aplicacao::getParam('zona') ;
		$secao= aplicacao::getParam('secao') ;

		try{
			$sql = "DELETE FROM secao WHERE zona = ? and secao = ?";
			$result = banco::executar($sql,array($zona,$secao));
			mensagem::sucesso('Operação realizada com sucesso!');
		}catch(Exception $e){
			mensagem::erro('Erro ao deletar a seção. Tente novamente!');
		}		
		
	}
}


//$sql = "SELECT * FROM secao ORDER BY zona,secao,local";
$sql = "SELECT * FROM secao ORDER BY zona,secao,local";
$lista = banco::listar($sql);