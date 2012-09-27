<?php

$nome = null;
$oab =  null;
$cpf =   null;
$celular1 = null;
$celular2 =  null;
$tel_residencial =  null;
$tel_comercial =  null;
$email1 = null;
$email2 = null;
$endereco =  null;
$numero = null;
$complemento =  null;
$bairro =  null;
$cidade =  null;
$uf =  null;
$cep = null;
$eleicoesAnt = null;
$eleicoesAntAnos = array();
$bairroPreferido1 = null;
$indicacao1 =  null;
$indicacao2 =  null;
$zona =  null;
$secao =  null;
$titulo =  null;

if(aplicacao::isRequestPost()){	
	$acao = aplicacao::getParam('acao');
	if ($acao == 'novo-adv'){
		//Flag erros de validação
		$erro = false;
		
		$nome = trim(aplicacao::getParam('nome'));
		$oab = str_replace(" ", "", trim(aplicacao::getParam('oab')));
		$cpf =  utils::unMaskCPF(aplicacao::getParam('cpf'));
		
		$celular1 = (int) utils::unMaskPhone(aplicacao::getParam('celular1'));
		$celular2 = (int) utils::unMaskPhone(aplicacao::getParam('celular2'));
		$tel_residencial = (int) utils::unMaskPhone(aplicacao::getParam('tel_residencial'));
		$tel_comercial =(int) utils::unMaskPhone(aplicacao::getParam('tel_comercial'));
		
		$email1 = trim(aplicacao::getParam('email1'));
		$email2 = trim(aplicacao::getParam('email2'));

		$endereco = aplicacao::getParam('endereco');
		$numero = (int) aplicacao::getParam('numero');
		$complemento = trim(aplicacao::getParam('complemento'));
		$bairro = aplicacao::getParam('bairro');
		$cidade = aplicacao::getParam('cidade');
		$uf = aplicacao::getParam('uf');
		$cep = (int) utils::unMaskCEP(aplicacao::getParam('cep'));
		
		$eleicoesAnt = aplicacao::getParam('eleicoesAnt');
		$eleicoesAntAnos = aplicacao::getParam('eleicoesAntAnos');
		$bairroPreferido1 = aplicacao::getParam('bairroPreferido1');
			
		$indicacao1 = trim(aplicacao::getParam('indicacao1'));
		$indicacao2 = trim(aplicacao::getParam('indicacao2'));
			
		$zona = (int) aplicacao::getParam('zona');
		$secao = (int) aplicacao::getParam('secao');
		$titulo = str_replace(" ", "", trim(aplicacao::getParam('titulo')));
		
		$captcha = trim(aplicacao::getParam('captcha'));
		
		
		// if ($captcha == $_SESSION["palavra"]){
			// mensagem::erro('Código de verificação inválido! Verifique e corrija o campo "Código de verificação".');
			// $erro = true;
		// }
		
		if (!$erro){
			if (empty($nome)) {
				mensagem::erro('Campo "Nome" não pode ser vazio.');
				$erro = true;
			}
			elseif (empty($oab)) {
				mensagem::erro('Campo "OAB" não pode ser vazio.');
				$erro = true;
			}
			elseif ($celular1 == 0) {
				mensagem::erro('Campo "Celular 1" não pode ser vazio.');
				$erro = true;
			}
			elseif (empty($endereco)) {
				mensagem::erro('Campo "Endereço" não pode ser vazio.');
				$erro = true;
			}
			elseif (empty($email1)) {
				mensagem::erro('Campo "Email1" não pode ser vazio.');
				$erro = true;
			}
			elseif ($numero == 0) {
				mensagem::erro('Campo "Número" não pode ser vazio.');
				$erro = true;
			}
			elseif (empty($bairro)) {
				mensagem::erro('Campo "Bairro" não pode ser vazio.');
				$erro = true;
			}
			elseif ($cep  == 0 ) {
				mensagem::erro('Campo "CEP" não pode ser vazio.');
				$erro = true;
			}
			elseif (empty($indicacao1)) {
				mensagem::erro('Campo "Indicação 1" não pode ser vazio.');
				$erro = true;
			}
			elseif ($zona  == 0) {
				mensagem::erro('Campo "Zona" não pode ser vazio.');
				$erro = true;
			}
			elseif ($secao == 0) {
				mensagem::erro('Campo "Seção" não pode ser vazio.');
				$erro = true;
			}			
		}
		
		if (!$erro){			
			if(!utils::validarCPF($cpf)){
				mensagem::erro('CPF inválido! Verifique e corrija o campo CPF.');
				$erro = true;
			}
		}
		
		if (!$erro){
			//Validação advogado
			$sql = 'SELECT * from advogado WHERE cpf =? OR oab = ?';
			$result = banco::listar($sql,array($cpf,$oab));
			if (count($result) > 0 ){
				mensagem::erro('Já existe um advogado com o cpf ou oab informados. Verifique e corrija os campos.');
				$erro = true;
			}
		}		
		
		if (!$erro){
			//Validação secao zona
			$sql = 'SELECT * from secao WHERE secao = ? AND zona = ?';
			$result = banco::listar($sql,array($secao,$zona));
			if (count($result) ==  0 ){
				mensagem::erro('A Zona e Seção não existe!. Verifique e corrija os campos.');
				$erro = true;
			}
		}
		
		if (!$erro){
			try{
				//falta incluir eleicoesAntAnos
				$sql = 'INSERT INTO advogado (nome, oab, cpf, celular1, celular2, tel_residencial, tel_comercial, email1, email2, endereco, numero, complemento, bairro, cidade, uf, eleicoesAnt, eleicoesAntAnos, bairroPreferido1, cep, indicacao1, indicacao2, zona, secao, titulo) VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
				$values = array($nome, $oab, $cpf, $celular1, $celular2, $tel_residencial, $tel_comercial, $email1, $email2, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $eleicoesAnt, $eleicoesAntAnos, $bairroPreferido1, $cep,  $indicacao1, $indicacao2, $zona, $secao, $titulo);
				// echo ("<pre>");
				// var_dump($values);
				// echo ("</pre>");
				// die();					
				banco::executar($sql,$values);
				mensagem::sucesso('Dados cadastrados com sucesso!');
				aplicacao::redirect('cadastro-advogado.php');
			}catch (Exception $e){
				mensagem::erro('Erro no banco de dados. Tente novamente!');
				aplicacao::redirect('cadastro-advogado.php');
			}
			
		}
		
	}
}

if ($numero == 0 ) $numero = null;
if ($cep == 0 ) $cep = null;
if ($celular1 == 0 ) $celular1 = null;
if ($celular2 == 0 ) $celular2 = null;
if ($tel_residencial == 0 ) $tel_residencial = null;
if ($tel_comercial == 0 ) $tel_comercial = null;
if ($secao == 0 ) $secao = null;
if ($zona == 0 ) $zona = null;
