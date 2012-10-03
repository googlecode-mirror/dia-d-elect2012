<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

include "aplicacao/boot.php"; 

$acao= aplicacao::getParam("acao");
$json = null;

if ($acao == "carregar-mapa"){
	$sql = "SELECT UCASE(s1.local) as local, s1.latitude, s1.longitude, 1 as tipo, 
				COALESCE(( select count(*) 
				  from secao s2
				  inner join advogado_secao a  ON s2.secao = a.secao AND s2.zona = a.zona
				  where md5(s2.local) = md5(s1.local)
				  group by s2.local
				),0) as total_adv
			FROM secao s1 GROUP BY s1.local, s1.latitude, s1.longitude
			
			UNION
			
			SELECT UCASE(nome) as local, latitude, longitude, 2 as tipo, 0 as total_adv FROM localidades";	
	$value = banco::listar($sql);
	$json = json_encode($value);
}

if ($acao == "lista-advogados-local"){
	$local = aplicacao::getParam("local"); 
	$sql =" SELECT cod_advogado, UCASE(nome) as nome FROM advogado a
			WHERE a.cod_advogado IN (
									 SELECT advgs.cod_advogado FROM advogado_secao advgs 
									 INNER JOIN secao s ON s.secao = advgs.secao AND s.zona = advgs.zona
									 WHERE s.local like '$local'
									 )
			ORDER BY nome ASC";
	$value = banco::listar($sql);
	$json = json_encode($value);
}

if ($acao == "lista-advogados-nao-local"){
	$local = aplicacao::getParam("local"); 
	$sql =" SELECT cod_advogado, UCASE(nome) as nome FROM advogado a
			WHERE a.cod_advogado NOT  IN (
									 SELECT advgs.cod_advogado FROM advogado_secao advgs 
									 INNER JOIN secao s ON s.secao = advgs.secao AND s.zona = advgs.zona
									 WHERE s.local  like '$local'
									 )
			ORDER BY nome ASC";
	$value = banco::listar($sql);
	$json = json_encode($value);
}

if($acao == "associar-advogados"){
	$vaues="";
	$sql="";
	$resultado = array("sucesso"=>0);
	$listaAdvg = aplicacao::getParam('listaCodAdvg');
	$localSelecionado = urldecode(aplicacao::getParam('local'));
	if ($listaAdvg){		
		$secaoResult = banco::listar("SELECT * FROM secao WHERE local = ? ",array($localSelecionado));		
		if (count($secaoResult)>0){			
			banco::abrirTransacao();
			try{			
				//DELETAR OS REGISTROS DE Advogados associados ao LOCAL
				foreach ($secaoResult as $secao){					
					$sql="DELETE FROM advogado_secao WHERE secao = ? and zona = ?";
					banco::executar($sql,array($secao->secao,$secao->zona));
				}							
				$lista = explode(",", $listaAdvg);
				//Associar para cada advogado todas as secoes do local
				foreach ($lista as $cod_adv) {
					foreach ($secaoResult as $secao){
						//DELETAR OS REGISTROS DE Advogados associados ao LOCAL
						$sql="INSERT INTO advogado_secao (cod_advogado,secao,zona) VALUES (?,?,?)";
						banco::executar($sql,array($cod_adv, $secao->secao,$secao->zona));
					}
				}
				$resultado = array("sucesso"=>1);
			}catch(excption $e){
				$resultado = array("sucesso"=>0);
				banco::cancelarTransacao();
			}
			banco::fecharTransacao();
		}		
	}
	$json = json_encode($resultado);
}

print $json;