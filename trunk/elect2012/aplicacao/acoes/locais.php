<?php

if (aplicacao::isRequestPost()){
	$acao= aplicacao::getParam('acao');

	if ($acao == "deletar"){
		$id= aplicacao::getParam('deletar_id') ;

		try{
			$sql = "DELETE FROM localidades WHERE cod_localidade = ?";
			$result = banco::executar($sql,array($id));
			mensagem::sucesso('Operação realizada com sucesso!');
		}catch(Exception $e){
			mensagem::erro('Erro ao deletar o usuário. Tente novamente!');
		}		
		
	}
}


$sql = "SELECT * FROM localidades";
$lista = banco::listar($sql);