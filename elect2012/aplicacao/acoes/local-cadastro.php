<?php

$objeto = null;
$cod_localidade = aplicacao::getParam('codigo');
if (!is_null($cod_localidade)){
	$sql = "SELECT * FROM localidades WHERE cod_localidade = ?";
	$result = banco::listar($sql,array($cod_localidade));
	if ($result){
		$objeto = $result[0];
	}
}

if(aplicacao::isRequestPost()){
	$acao = aplicacao::getParam('acao');	
	
	$nome = trim(aplicacao::getParam('nome'));
	$cep = trim(aplicacao::getParam('cep'));
	$endereco = trim(aplicacao::getParam('endereco'));
	$numero =(int) trim(aplicacao::getParam('numero'));
	$complemento = trim(aplicacao::getParam('complemento'));
	$bairro = trim(aplicacao::getParam('bairro'));
	$cidade = trim(aplicacao::getParam('cidade'));
	$uf = trim(aplicacao::getParam('uf'));
	$obs = trim(aplicacao::getParam('obs'));
	$lat = 1;
	$long= 1;
	//var_dump($_POST);
	if ($acao == 'novo'){
		try{
			$sql = "INSERT INTO localidades ( nome, cep, endereco, numero, complemento, bairro, cidade, uf, lat, long, obs) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";			
			$values = array($nome, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $lat, $long, $obs);
			echo("<pre>");
			var_dump( $values );
			var_dump( $sql );
			echo("</pre>");
			banco::executar($sql, $values);			
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('localidades.php');
		}catch(Exception $e){
			var_dump(banco::errorInfo());
			mensagem::erro('Não foi possivel cadastrar localidade. Erro no banco de dados.');
			//aplicacao::redirect('local-cadastro.php');
		}
		
	}
	
	if ($acao == 'editar'){
		try{
			$sql = 'UPDATE localidades SET nome=? , obs=? , cep=? , endereco=? , complemento=? ,numero=? , bairro=? , cidade=? , uf=? , lat=? , long=?  WHERE cod_localidade = ?';
			banco::executar($sql,array($nome,$obs,$cep,$endereco,$numero,$bairro,$cidade,$uf,$lat,$long,$cod_localidade));
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('localidades.php');
		}catch(Exception $e){
			mensagem::erro('Não foi possivel alterar usuário. Erro no banco de dados.');
			aplicacao::redirect('local-cadastro.php?codigo='.$codigo);
		}
		
	}
}



