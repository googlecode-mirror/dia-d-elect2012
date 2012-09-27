<?php 
$objeto = null;
$codigo = aplicacao::getParam('codigo');
if (!is_null($codigo)){
	$sql = "SELECT * FROM advogado WHERE cod_advogado = ?";
	$result = banco::listar($sql,array($codigo));
	if ($result){
		$objeto = $result[0];
	}
}


if(aplicacao::isRequestPost()){	
	if(is_null($objeto)) $objeto = new stdClass();
	$objeto->nome = trim(aplicacao::getParam('nome'));
	$objeto->oab = str_replace(" ", "", trim(aplicacao::getParam('oab')));
	$objeto->cpf =  utils::unMaskCPF(aplicacao::getParam('cpf'));	
	$objeto->celular1 = (float) utils::unMaskPhone(aplicacao::getParam('celular1'));
	$objeto->celular2 = (float) utils::unMaskPhone(aplicacao::getParam('celular2'));
	$objeto->tel_residencial = (float) utils::unMaskPhone(aplicacao::getParam('tel_residencial'));
	$objeto->tel_comercial =(float) utils::unMaskPhone(aplicacao::getParam('tel_comercial'));
	$objeto->email1 = trim(aplicacao::getParam('email1'));
	$objeto->email2 = trim(aplicacao::getParam('email2'));	
	$objeto->endereco = aplicacao::getParam('endereco');
	$objeto->numero = (int) aplicacao::getParam('numero');
	$objeto->complemento = trim(aplicacao::getParam('complemento'));
	$objeto->bairro = aplicacao::getParam('bairro');
	$objeto->cidade = aplicacao::getParam('cidade');
	$objeto->uf = aplicacao::getParam('uf');
	$objeto->eleicoesAnt = aplicacao::getParam('eleicoesAnt');
	$objeto->cep = (int) utils::unMaskCEP(aplicacao::getParam('cep'));		
	$objeto->indicacao1 = trim(aplicacao::getParam('indicacao1'));
	$objeto->indicacao2 = trim(aplicacao::getParam('indicacao2'));		
	$objeto->zona = (int) aplicacao::getParam('zona');
	$objeto->secao = (int) aplicacao::getParam('secao');
	$objeto->titulo = str_replace(" ", "", trim(aplicacao::getParam('titulo')));
	
	//Flag erros de validação
	$erro = false;
	
	//VALIDACOES -----------------------------
	if (!$erro){
		if (empty($objeto->nome)) {
			mensagem::erro('Campo "Nome" não pode ser vazio.');
			$erro = true;
		}
		elseif (empty($objeto->oab)) {
			mensagem::erro('Campo "OAB" não pode ser vazio.');
			$erro = true;
		}
		elseif ($objeto->celular1 == 0) {
			mensagem::erro('Campo "Celular 1" não pode ser vazio.');
			$erro = true;
		}
		elseif (empty($objeto->endereco)) {
			mensagem::erro('Campo "Endereço" não pode ser vazio.');
			$erro = true;
		}
		elseif (empty($objeto->email1)) {
			mensagem::erro('Campo "Email1" não pode ser vazio.');
			$erro = true;
		}
		elseif ($objeto->numero == 0) {
			mensagem::erro('Campo "Número" não pode ser vazio.');
			$erro = true;
		}
		elseif (empty($objeto->bairro)) {
			mensagem::erro('Campo "Bairro" não pode ser vazio.');
			$erro = true;
		}
		elseif ($objeto->cep  == 0 ) {
			mensagem::erro('Campo "CEP" não pode ser vazio.');
			$erro = true;
		}
		elseif (empty($objeto->indicacao1)) {
			mensagem::erro('Campo "Indicação 1" não pode ser vazio.');
			$erro = true;
		}
		elseif ($objeto->zona  == 0) {
			mensagem::erro('Campo "Zona" não pode ser vazio.');
			$erro = true;
		}
		elseif ($objeto->secao == 0) {
			mensagem::erro('Campo "Seção" não pode ser vazio.');
			$erro = true;
		}
	}
	
	if (!$erro){
		//Validação cpf
		if(!utils::validarCPF($objeto->cpf)){
			mensagem::erro('CPF inválido! Verifique e corrija o campo CPF.');
			$erro = true;
		}
	}
	
	if (!$erro){
		//Validação secao zona
		$sql = 'SELECT * from secao WHERE secao = ? AND zona = ?';
		$result = banco::listar($sql,array($objeto->secao,$objeto->zona));
		if (count($result) ==  0 ){
			mensagem::erro('A Zona e Seção não existe!. Verifique e corrija os campos.');
			$erro = true;
		}
	}
	
	$acao = aplicacao::getParam('acao');
	if ($acao == 'novo'){
		if (!$erro){
			//Validação advogado
			$sql = 'SELECT * from advogado WHERE cpf =? OR oab = ?';
			$result = banco::listar($sql,array($objeto->cpf,$objeto->oab));
			if (count($result) > 0 ){
				mensagem::erro('Já existe um advogado com o cpf ou oab informados. Verifique e corrija os campos.');
				$erro = true;
			}
		}	
		if (!$erro){
			try{
				$sql = 'INSERT INTO advogado (nome, oab, cpf, celular1, celular2, tel_residencial, tel_comercial, email1, email2, endereco, numero, complemento, bairro, cidade, uf, eleicoesAnt, cep, indicacao1, indicacao2, zona, secao, titulo) VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
				$values = array($objeto->nome, $objeto->oab, $objeto->cpf, $objeto->celular1, $objeto->celular2, $objeto->tel_residencial, $objeto->tel_comercial, $objeto->email1, $objeto->email2, $objeto->endereco, $objeto->numero, $objeto->complemento, $objeto->bairro, $objeto->cidade, $objeto->uf, $objeto->eleicoesAnt, $objeto->cep, $objeto->indicacao1, $objeto->indicacao2, $objeto->zona, $objeto->secao, $objeto->titulo);
					
				banco::executar($sql,$values);
				mensagem::sucesso('Dados cadastrados com sucesso!');
				aplicacao::redirect('advogados.php');
			}catch (Exception $e){
				mensagem::erro('Erro no banco de dados. Tente novamente!');
				aplicacao::redirect('advogado-cadastro.php');
			}				
		}
	}
	
	if ($acao == 'editar'){
		if (!$erro){
			//Validação advogado
			$sql = 'SELECT * from advogado WHERE (cpf = ? OR oab = ?) and cod_advogado <> ? ';
			$result = banco::listar($sql,array($objeto->cpf, $objeto->oab, $codigo));
			if (count($result) > 0 ){
				mensagem::erro('Já existe um advogado com o cpf ou oab informados. Verifique e corrija os campos.');
				$erro = true;
			}
		}
		if (!$erro){
			try{
				$sql = 'UPDATE advogado SET nome = ?, oab = ?, cpf = ?, celular1 = ?, celular2 = ?, tel_residencial = ?, tel_comercial = ?, email1 = ?, email2 = ?, endereco = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, uf = ?, eleicoesAnt = ?, cep = ?, indicacao1 = ?, indicacao2 = ?, zona = ?, secao = ?, titulo = ? WHERE cod_advogado = ?';
				$values = array($objeto->nome, $objeto->oab, $objeto->cpf, $objeto->celular1, $objeto->celular2, $objeto->tel_residencial, $objeto->tel_comercial, $objeto->email1, $objeto->email2, $objeto->endereco, $objeto->numero, $objeto->complemento, $objeto->bairro, $objeto->cidade, $objeto->uf, $objeto->eleicoesAnt, $objeto->cep, $objeto->indicacao1, $objeto->indicacao2, $objeto->zona, $objeto->secao, $objeto->titulo, $codigo);
				banco::executar($sql,$values);
				mensagem::sucesso('Dados cadastrados com sucesso!');
				aplicacao::redirect('advogados.php');
			}catch (Exception $e){
				mensagem::erro('Erro no banco de dados. Tente novamente!');
				aplicacao::redirect('advogado-cadastro.php?codigo = '.$codigo);
			}
		}
	}
	
	if ($objeto->numero == 0 ) $objeto->numero = null;
	if ($objeto->cep == 0 ) $objeto->cep = null;
	if ($objeto->celular1 == 0 ) $objeto->celular1 = null;
	if ($objeto->celular2 == 0 ) $objeto->celular2 = null;
	if ($objeto->tel_residencial == 0 ) $objeto->tel_residencial = null;
	if ($objeto->tel_comercial == 0 ) $objeto->tel_comercial = null;
	if ($objeto->secao == 0 ) $objeto->secao = null;
	if ($objeto->zona == 0 ) $objeto->zona = null;
	
}

