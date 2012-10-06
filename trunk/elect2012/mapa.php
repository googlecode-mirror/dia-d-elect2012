<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

include "aplicacao/boot.php"; 

$acao= aplicacao::getParam("acao");
$json = null;

if($acao == 'deletar-ocorrencias'){
	$genericObject = new stdClass();
	$genericObject->sucesso = 0;
	try{
		$md5Local = aplicacao::getParam("local");
		$sql ="UPDATE ocorrencia SET status = 0 WHERE cod_local = ?";
		banco::executar($sql,array($md5Local));
		$genericObject->sucesso = 1;
	}catch (Exception $e){
		$genericObject->sucesso = 0;
	}	
	$json = json_encode($genericObject);
}

if($acao == 'abrir-ocorrencias'){
	$genericObject = new stdClass();
	$genericObject->sucesso = 0;
	try{
		$md5Local = aplicacao::getParam("local");
		$sql ="UPDATE ocorrencia SET status = 1, data_resolvido = null WHERE cod_local = ?";
		banco::executar($sql,array($md5Local));
		$genericObject->sucesso = 1;
	}catch (Exception $e){
		$genericObject->sucesso = 0;
	}
	$json = json_encode($genericObject);
}

if($acao == 'resolver-ocorrencias'){
	$genericObject = new stdClass();
	$genericObject->sucesso = 0;
	$data_resolvido = date('Y-m-d H:i:s');
	try{
		$md5Local = aplicacao::getParam("local");
		$sql ="UPDATE ocorrencia SET status = 2, data_resolvido = ? WHERE cod_local = ?";
		banco::executar($sql,array($data_resolvido,$md5Local));
		$genericObject->sucesso = 1;
	}catch (Exception $e){
		$genericObject->sucesso = 0;
	}
	$json = json_encode($genericObject);
}

if($acao == 'listar-ocorrencias'){
	$md5Local = aplicacao::getParam("local");
	$status = aplicacao::getParam("status");
	$values = null;
	$genericObject = new stdClass();	
	$sql = "SELECT 
				CASE o.status 
					WHEN 1 THEN '<span class=\"btn btn-warning\">Pendente</span>'
					WHEN 2 THEN '<span class=\"btn btn-success\">Resolvido</span>'
					ELSE 'Invalido' 
				END	as status, 
				o.cod_ocorrencia,  
				DATE_FORMAT(o.data_criacao,'%H:%i') as data_criacao, 
				(SELECT s.local FROM secao s WHERE md5(s.local) = o.cod_local LIMIT 0,1) as local, 
				o.descricao,
				CASE o.status 
					WHEN 1 THEN CONCAT('<a rel=\"tooltip\" title=\"deletar\" class=\"btn btn-small\" onclick=\"excluirOcorrencias(',
							\"'\",o.cod_local,\"'\",')\"><i class=\"icon icon-trash\"></i></a>',
							
							' <a rel=\"tooltip\" title=\"editar\" class=\"btn btn-small\" onclick=\"editarOcorrencias(',
							\"'\",o.cod_ocorrencia,\"',\",
							\"'\",o.cod_local,\"',\",
							\"'\",o.autor,\"',\",
							\"'\",o.descricao,\"'\",')\"><i class=\"icon icon-pencil\"></i></a>',
				
							' <a rel=\"tooltip\" title=\"mensagem\" class=\"btn btn-small\" onclick=\"mensagemOcorrencias(',
							\"'\",o.cod_local,\"'\",')\"><i class=\"icon icon-envelope\"></i></a>',
				
							' <a rel=\"tooltip\" title=\"resolver\" class=\"btn btn-small\" onclick=\"resolverOcorrencias(',
							\"'\",o.cod_local,\"'\",')\"><i class=\"icon icon-ok\"></i></a>')
					WHEN 2 THEN CONCAT('<a rel=\"tooltip\" title=\"deletar\" class=\"btn btn-small\" onclick=\"excluirOcorrencias(',
							\"'\",o.cod_local,\"'\",')\"><i class=\"icon icon-trash\"></i></a>',
																	
							' <a rel=\"tooltip\" title=\"abrir\" class=\"btn btn-small\" onclick=\"abrirOcorrencias(',
							\"'\",o.cod_local,\"'\",')\"><i class=\"icon icon-folder-open\"></i></a>')							
					ELSE 'Invalido' 
				END	as acao
			FROM ocorrencia o
			WHERE o.status > 0 ";
	
	if ($status) {
		$sql .= " AND o.status = ?";
		$values = array();
		$values[]= $status;
	}
	
	if ($md5Local) {
		$sql .= " AND o.cod_local = ?";
		if($values){
			$values[]= $md5Local;
		}else{
			$values = array();
			$values[]= $md5Local;
		}
	}
	
	$result = banco::listar($sql,$values);
	$genericObject->aaData = $result;
	$json = json_encode($genericObject);
}

if($acao == 'cadastrar-ocorrencias'){
	$genericObject = new stdClass();
	
	banco::abrirTransacao();
	$codigo_ocorrencia = (int) aplicacao::getParam('cod-ocorrencia');
	$autor = aplicacao::getParam('autor');
	$descricao = aplicacao::getParam('ocorrencia');
	$data_criacao = date('Y-m-d H:i:s');
	$cod_usuario = aplicacao::getUsuarioLogado()->cod_usuario; 
	$cod_local = aplicacao::getParam('local');
	$status = 1;
	try{
		if ($codigo_ocorrencia == 0){
			$sql = "INSERT INTO ocorrencia (autor,descricao, data_criacao, cod_usuario, cod_local, status) VALUES (?, ?, ?, ?, ?, ?)";
			$values = array($autor,$descricao, $data_criacao, $cod_usuario, $cod_local, $status);
			banco::executar($sql, $values);
			banco::fecharTransacao();
			$genericObject->sucesso = 1;
		}else{
			$sql = "UPDATE ocorrencia SET autor = ?, descricao=?, data_criacao=?, cod_usuario=?, cod_local=?, status=? WHERE cod_ocorrencia = ?";
			$values = array($autor,$descricao, $data_criacao, $cod_usuario, $cod_local, $status, $codigo_ocorrencia);
			banco::executar($sql, $values);
			banco::fecharTransacao();
			$genericObject->sucesso = 1;
		}
		
	}catch(Exception $e){
		banco::cancelarTransacao();
		$genericObject->sucesso = 0;
	}	
	
	$json = json_encode($genericObject);
}

if($acao == 'secoes-local'){
	$md5Local = aplicacao::getParam("local");
	$sql = "SELECT zona, secao
			FROM secao 
			WHERE md5(local) = ?
			ORDER BY zona,secao";
	
	$value = banco::listar($sql,array($md5Local));
	$json = json_encode($value);
}

if ($acao == "carregar-mapa"){
	$sql = "SELECT UCASE(s1.local) as local, s1.latitude, s1.longitude, 1 as tipo, s1.zona, s1.endereco,s1.bairro,
				COALESCE(( select count(*) 
				  from secao s2
				  inner join advogado_secao a  ON s2.secao = a.secao AND s2.zona = a.zona
				  where md5(s2.local) = md5(s1.local)
				  group by s2.local
				),0) as total_adv,
				COALESCE(( select count(*) 
				  from ocorrencia oc
				  where oc.cod_local = md5(s1.local) and oc.status =1
				),0) as total_ocorr , md5(s1.local) as cod_local, SUM(aptos_total) as total_votantes
			FROM secao s1 
			GROUP BY s1.local, s1.latitude, s1.longitude, s1.zona, s1.endereco,s1.bairro";
		
	$value = banco::listar($sql);
	$json = json_encode($value);
}

if ($acao == "lista-advogados"){
	$md5Local = aplicacao::getParam("local");
		
	$sql = "SELECT cod_advogado, UCASE(nome) as nome,
				COALESCE(( select count(*)
						   from secao s
						   inner join advogado_secao asec  ON s.secao = asec.secao AND s.zona = asec.zona
						   where md5(s.local) = ? and asec.cod_advogado = a.cod_advogado
						   group by s.local
				),0) as total
			FROM advogado a ORDER BY total ASC, nome ASC";
	$value = banco::listar($sql,array($md5Local));
	$json = json_encode($value);
}

if($acao == "detalhes-local"){
	$md5Local = aplicacao::getParam("local");
	$genericObject = new stdClass();
	$genericObject->local = $md5Local;
	
	$sql = "SELECT * FROM local_todas_secoes WHERE local = ?";
	$result = banco::listar($sql,array($md5Local));
	$secoes = $result[0]->secoes;	
	$genericObject->secoes = $secoes;
	
	$sql = "select count(*) as total_ocorr
			from ocorrencia oc
			where oc.cod_local = ? and oc.status = 1 ";
	$result = banco::listar($sql,array($md5Local));
	$ocorrencias = $result[0];
	$genericObject->total_ocorr = $ocorrencias->total_ocorr;
	
	$sql = "SELECT local, zona, endereco, bairro,latitude,longitude, SUM(aptos_total) as total FROM secao WHERE md5(local) = ? GROUP BY local,zona,endereco,bairro,latitude,longitude";
	$result = banco::listar($sql,array($md5Local));
	$total_votantes = $result[0]->total;
	$genericObject->total_votantes = $total_votantes;
	$genericObject->nome_local = $result[0]->local;
	$genericObject->endereco = $result[0]->endereco;
	$genericObject->bairro = $result[0]->bairro;
	$genericObject->zona = $result[0]->zona;
	$genericObject->latitude = $result[0]->latitude;
	$genericObject->longitude = $result[0]->longitude;
	
	$sql = "SELECT cod_advogado, UCASE(nome) as nome, oab, email1, celular1, celular2, tel_residencial, tel_comercial
			FROM advogado 
			WHERE  cod_advogado IN ( select asec.cod_advogado
									   from secao s
									   inner join advogado_secao asec  ON s.secao = asec.secao AND s.zona = asec.zona
									  where md5(s.local) = ?)
			ORDER BY nome ASC";
	$advogados = banco::listar($sql,array($md5Local));
	$genericObject->advogados = $advogados;
	
	$resultado = $genericObject;
	$json = json_encode($resultado);
}

if($acao == "associar-advogados"){
	$values="";
	$sql="";
	$resultado = array("sucesso"=>0);
	$localSelecionado = aplicacao::getParam('local');
	if ($localSelecionado){
		$secaoResult = banco::listar("SELECT * FROM secao WHERE md5(local) = ? ",array($localSelecionado));
	}	
			
	if ( count($secaoResult) > 0){			
		banco::abrirTransacao();
		try{			
			//DELETAR OS REGISTROS DE Advogados associados ao LOCAL
			foreach ($secaoResult as $secao){					
				$sql="DELETE FROM advogado_secao WHERE secao = ? and zona = ?";
				banco::executar($sql,array($secao->secao,$secao->zona));
			}		

			$listaAdvg = aplicacao::getParam('listaCodAdvg');
			if ($listaAdvg){
				$lista = explode(",", $listaAdvg);
				if(count($lista) > 0){
					//Associar para cada advogado todas as secoes do local
					foreach ($lista as $cod_adv) {
						foreach ($secaoResult as $secao){
							//DELETAR OS REGISTROS DE Advogados associados ao LOCAL
							$sql="INSERT INTO advogado_secao (cod_advogado,secao,zona) VALUES (?,?,?)";
							banco::executar($sql,array($cod_adv, $secao->secao,$secao->zona));
						}
					}
				}			
			}
			$resultado = array("sucesso"=>1);
			
		}catch(excption $e){
			$resultado = array("sucesso"=>0);
			banco::cancelarTransacao();
		}
		banco::fecharTransacao();
	}
	
	$json = json_encode($resultado);
}

print $json;