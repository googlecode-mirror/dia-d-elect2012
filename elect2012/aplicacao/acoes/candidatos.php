<?php

if (aplicacao::isRequestPost()){
	$acao= aplicacao::getParam('acao');

	if ($acao == "deletar"){
		$id= aplicacao::getParam('deletar_id') ;

		try{
			$sql = "DELETE FROM candidato WHERE numero = ?";
			$result = banco::executar($sql,array($id));
			mensagem::sucesso('Operação realizada com sucesso!');
		}catch(Exception $e){
			mensagem::erro('Erro ao deletar o candidato. Tente novamente!');
		}		
		
	}
}


$sql = "SELECT * FROM candidato ORDER BY numero";
$lista = banco::listar($sql);