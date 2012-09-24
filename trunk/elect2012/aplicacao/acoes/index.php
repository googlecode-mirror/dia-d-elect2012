<?php
if(aplicacao::isRequestPost()){
	$acao = aplicacao::getParam('acao');
	if ($acao = 'login'){
		$login = aplicacao::getParam('login');
		$senha = md5(aplicacao::getParam('senha').'elect2012');
		$result = banco::listar('SELECT * FROM usuario WHERE login = ? and senha = ?',array($login,$senha));
		if(count($result)>0){
			$usuario = $result[0];
			aplicacao::setUsuarioLogado($usuario);
			aplicacao::redirect('index.php');
		}else{
			mensagem::erro('Login ou senha incorretos! Tente novamente!');
			aplicacao::redirect('index.php');
		}
	}
}