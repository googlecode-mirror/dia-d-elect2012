<?php

$objeto = null;
$codigo = aplicacao::getParam('codigo');
if (!is_null($codigo)){
	$sql = "SELECT * FROM usuario WHERE cod_usuario = ?";
	$result = banco::listar($sql,array($codigo));
	if ($result){
		$objeto = $result[0];
	}
}

if(aplicacao::isRequestPost()){
	$acao = aplicacao::getParam('acao');	
	$nome = aplicacao::getParam('nome');
	$login = aplicacao::getParam('login');
	$perfil = aplicacao::getParam('perfil');
	$senha = md5(aplicacao::getParam('senha') . 'elect2012');
	
	if ($acao == 'novo'){
		
		$sql = 'SELECT * FROM usuario WHERE login =?';
		$result = banco::listar($sql,array($login));
		if (count($result)>0){
			mensagem::erro('Não foi possivel cadastrar usuário. O login informado já existe no banco de dados.');
			aplicacao::redirect('usuario-cadastro.php');
		}
		
		try{			
			$sql = 'INSERT INTO usuario (nome, login, senha,perfil) VALUES (?,?,?,?)';
			banco::executar($sql,array($nome,$login,$senha,$perfil));
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('usuarios.php');
		}catch(Exception $e){
			mensagem::erro('Não foi possivel cadastrar usuário. Erro no banco de dados.');
			aplicacao::redirect('usuario-cadastro.php');
		}
		
	}
	
	if ($acao == 'editar'){
		
		$sql = 'SELECT * FROM usuario WHERE login =? AND cod_usuario <> ?';
		$result = banco::listar($sql,array($login,$codigo));
		if (count($result)>0){
			mensagem::erro('Não foi possivel cadastrar usuário. O login informado já existe no banco de dados.');
			aplicacao::redirect('usuario-cadastro.php?codigo='.$codigo);
		}
				
		try{
			$sql = 'UPDATE usuario SET perfil=?, nome = ?, login = ? , senha = ? WHERE cod_usuario = ?';
			banco::executar($sql,array($perfil,$nome,$login,$senha,$codigo));
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('usuarios.php');
		}catch(Exception $e){
			mensagem::erro('Não foi possivel alterar usuário. Erro no banco de dados.');
			aplicacao::redirect('usuario-cadastro.php?codigo='.$codigo);
		}
		
	}
}



