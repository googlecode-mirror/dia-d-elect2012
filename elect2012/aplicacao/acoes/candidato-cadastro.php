<?php
$objeto = null;
$codigo = aplicacao::getParam('codigo');

if(aplicacao::isRequestPost()){
	$acao = aplicacao::getParam('acao');
	
	$numero = (int) aplicacao::getParam('numero');
	$nome = aplicacao::getParam('nome');
	$nome_urna = aplicacao::getParam('nome-urna');
	$sexo = aplicacao::getParam('sexo');
	$partido_num = aplicacao::getParam('partido');
	$cargo = aplicacao::getParam('cargo');
	$situacao = aplicacao::getParam('situacao');
	
	$partido = banco::listar('SELECT * from partido WHERE numero = ?' , array($partido_num));
	$coligacao = $partido[0]->coligacao;
	$partido_nome = $partido[0]->nome;
	
	if ($acao == 'novo'){
		
		$sql = 'SELECT * FORM candidato WHERE numero =?';
		$result = banco::listar($sql,array($numero));
		if (count($result)>0){
			mensagem::erro('Não foi possivel cadastrar o candidato. O número informado já existe no banco de dados.');
			aplicacao::redirect('candidato-cadastro.php');
		}	
		
		try{
			$sql = 'INSERT INTO candidato (numero, nome_candidato, nome_urna, situacao, partido, num_partido, coligacao, cargo, sexo) VALUES (?,?,?,?,?,?,?,?,?)';
			banco::executar($sql,array($numero,$nome,$nome_urna,$situacao,$partido_nome,$partido_num,$coligacao,$cargo,$sexo));
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('candidatos.php');
		}catch(Exception $e){
			mensagem::erro('Não foi possivel cadastrar usuário. Erro no banco de dados.');
			aplicacao::redirect('candidato-cadastro.php');
		}
		
	}
	
	if ($acao == 'editar'){
		$sql = 'SELECT * FROM candidato WHERE numero = ? and nome_candidato not like ?';
		$result = banco::listar($sql,array($numero,$nome));
		if (count($result)>0){
			mensagem::erro('Não foi possivel cadastrar o candidato. O número informado já existe no banco de dados.');
			aplicacao::redirect('candidato-cadastro.php?codigo='.$codigo);
		}			
		
		try{
			$sql = 'UPDATE candidato SET numero = ?, nome_candidato = ? , nome_urna = ?, situacao = ?, partido = ?, num_partido = ?, coligacao = ?, cargo = ?, sexo = ? WHERE numero = ?';
			banco::executar($sql,array($numero, $nome, $nome_urna, $situacao, $partido_nome, $partido_num, $coligacao, $cargo, $sexo, $numero));
			mensagem::sucesso('Operação realizada com sucesso!');
			aplicacao::redirect('candidatos.php');
		}catch(Exception $e){
			mensagem::erro('Não foi possivel alterar usuário. Erro no banco de dados.');
			aplicacao::redirect('candidato-cadastro.php?codigo='.$codigo);
		}
		
	}
}

$sql = "SELECT * FROM partido ORDER BY nome";
$partidos = banco::listar($sql);


if (!is_null($codigo)){
	$sql = "SELECT * FROM candidato WHERE numero = ?";
	$result = banco::listar($sql,array($codigo));
	if ($result){
		$objeto = $result[0];
	}
}



