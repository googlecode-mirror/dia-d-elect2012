<?php

$objeto = null;
$zona = aplicacao::getParam('zona');
$secao = aplicacao::getParam('secao');
if (!is_null($zona) and !is_null($secao) ){
	$sql = "SELECT * FROM secao WHERE zona = ? and secao= ? ";
	$result = banco::listar($sql,array($zona,$secao));
	if ($result){
		$objeto = $result[0];
	}
}


if(aplicacao::isRequestPost()){	
	if (is_null($objeto)) $objeto = new stdClass();
	$objeto->zona = aplicacao::getParam('zona_cad');		
	$objeto->secao = aplicacao::getParam('secao_cad');		
	$objeto->cod_municipio = aplicacao::getParam('cod_municipio');		
	$objeto->municipio = aplicacao::getParam('municipio');		
	$objeto->cod_local = aplicacao::getParam('cod_local');		
	$objeto->local = aplicacao::getParam('local');		
	$objeto->endereco = aplicacao::getParam('endereco');		
	$objeto->bairro = aplicacao::getParam('bairro');		
	$objeto->cep = aplicacao::getParam('cep');		
	$objeto->aptos_secao = aplicacao::getParam('aptos_secao');		
	$objeto->secao_agregadas = aplicacao::getParam('secao_agregadas');		
	$objeto->aptos_agregadas = aplicacao::getParam('aptos_agregadas');		
	$objeto->aptos_total = aplicacao::getParam('aptos_total');	
	$objeto->latitude = aplicacao::getParam('latitude');	
	$objeto->longitude = aplicacao::getParam('longitude');	

	$enderecoCompleto = $objeto->endereco . " " . $objeto->bairro ." " . $objeto->municipio;
	$result = gmaps::getLatLong($enderecoCompleto);
	if($result){
		$objeto->latitude = $result[0];
		$objeto->longitude = $result[1];
	}
	
	$acao = aplicacao::getParam('acao');
	$erro=false;
	
	if ($acao == 'novo'){		
		$sql = 'SELECT * FROM secao WHERE secao =? and zona=?';
		$result = banco::listar($sql,array($objeto->secao,$objeto->zona));
		if (count($result)>0){
			mensagem::erro('Não foi possivel cadastrar seção. A zona e seção informados já existem no banco de dados.');
			$erro=true;
		}		
		try{			
			$sql = 'INSERT INTO secao (zona, secao, cod_municipio, municipio, cod_local, local, endereco, bairro, cep, aptos_secao, secao_agregadas, aptos_agregadas, aptos_total, latitude, longitude) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
			banco::executar($sql,array($objeto->zona, $objeto->secao, $objeto->cod_municipio, $objeto->municipio, $objeto->cod_local, $objeto->local, $objeto->endereco, $objeto->bairro, $objeto->cep, $objeto->aptos_secao, $objeto->secao_agregadas, $objeto->aptos_agregadas, $objeto->aptos_total, $objeto->latitude, $objeto->longitude));
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('secoes.php');
		}catch(Exception $e){
			mensagem::erro('Não foi possivel cadastrar usuário. Erro no banco de dados.');
			aplicacao::redirect('secao-cadastro.php');
		}
		
	}
	
	if ($acao == 'editar'){
		
		if ($objeto->zona != $zona or $objeto->secao != $secao){
			$sql = 'SELECT * FROM secao WHERE secao =? and zona=? ';
			$result = banco::listar($sql,array($objeto->secao,$objeto->zona));
			if (count($result)>0){
				mensagem::erro('Não foi possivel cadastrar seção. A zona e seção informados já existem no banco de dados.');
				$erro=true;
			}
		}
		
		try{
			$sql = 'UPDATE secao SET zona = ?, secao = ?, cod_municipio = ?, municipio = ?, cod_local = ?, local = ?, endereco = ?, bairro = ?, cep = ?, aptos_secao = ?, secao_agregadas = ?, aptos_agregadas = ?, aptos_total = ?, latitude = ?, longitude = ? WHERE zona = ? and secao = ?';
			banco::executar($sql,array($objeto->zona, $objeto->secao, $objeto->cod_municipio, $objeto->municipio, $objeto->cod_local, $objeto->local, $objeto->endereco, $objeto->bairro, $objeto->cep, $objeto->aptos_secao, $objeto->secao_agregadas, $objeto->aptos_agregadas, $objeto->aptos_total, $objeto->latitude, $objeto->longitude,$zona,$secao));
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('secoes.php');
		}catch(Exception $e){
			mensagem::erro('Não foi possivel alterar usuário. Erro no banco de dados.');
			aplicacao::redirect('secao-cadastro.php?zona='.$zona.'&secao='.$secao);
		}
		
	}
}



