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


$sql = "SELECT * FROM advogado ORDER BY nome";
$lista = banco::listar($sql);