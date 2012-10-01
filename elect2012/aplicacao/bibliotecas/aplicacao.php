<?php

 class aplicacao{
	
	public static function getAcao(){
		return (isset($_POST['acao']))?$_POST['acao']:null;
	}
		
	public static function isRequestPost(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public static function getParam($param){
		return (isset($_REQUEST[$param]))?$_REQUEST[$param]:null;
	}
	
	public static function redirect($url,$exit=true){
		header('Location:' .$url);
		if ($exit)	exit(0);
	}
	
	public static function isUsuarioLogado(){
		return isset($_SESSION['usuario']);		
	}
	
	public static function getUsuarioLogado(){
		return $_SESSION['usuario'];	
	}
	
	public static function setUsuarioLogado($usuario){
		$_SESSION['usuario'] = $usuario;	
	}
	
	public static function captcha($largura,$altura,$tamanho_fonte,$quantidade_letras){
		global $_SESSION;
		header("Content-type: image/jpeg");  // define o tipo do arquivo
		$imagem = imagecreate($largura,$altura); // define a largura e a altura da imagem
		$fonte = "./font/arial.ttf"; //voce deve ter essa ou outra fonte de sua preferencia em sua pasta
		$preto  = imagecolorallocate($imagem,0,0,0); // define a cor preta
		$branco = imagecolorallocate($imagem,255,255,255); // define a cor branca
	
		// define a palavra conforme a quantidade de letras definidas no parametro $quantidade_letras
		$palavra = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"),0,($quantidade_letras));
		$_SESSION["palavra"] = $palavra; // atribui para a sessao a palavra gerada
		for($i = 1; $i <= $quantidade_letras; $i++){
			imagettftext($imagem,$tamanho_fonte,rand(-25,25),($tamanho_fonte*$i),($tamanho_fonte + 10),$branco,$fonte,substr($palavra,($i-1),1)); // atribui as letras a imagem
		}
		imagejpeg($imagem); // gera a imagem
		imagedestroy($imagem); // limpa a imagem da memoria
	}
	
	public static function verificaCaptcha($palavra){
		global $_SESSION;
		if ($palavra == $_SESSION["palavra"]){
			return true;
		}else{
			return false;
		}
	}
	
	public static function getEnderecoCorreios($cep){
		$action="http://www.buscacep.correios.com.br/servicos/dnec/consultaLogradouroAction.do" ;
		$ch = curl_init($action);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_POSTFIELDS, "CEP=".$cep."&Metodo=listaLogradouro&TipoConsulta=cep&StartRow=1&EndRow=10");
	
		$r=utf8_encode(curl_exec($ch));
		curl_close($ch);
	
		$tipoLogr = "";
		$nomeLogr= "";
		$numeroLogr= "";
		$bairro= "";
		$cidade= "";
		$uf= "";
		$cep= "";
	
		//EXTRAINDO VALORES
		if($pos   = strpos($r, '<table border="0" cellspacing="1" cellpadding="5" bgcolor="gray">')){
			$table = substr($r,$pos,500);
			list($logradouro,$bairro,$cidade,$uf,$cep) = explode("     ",str_replace("\r\n","",(trim(strip_tags($table)))));
			list($tipoLogr,$nomeLogr) = explode(" ",$logradouro,2);
			list($nomeLogr,$numeroLogr) = explode(" - ",$nomeLogr,2);
	
			$data['sucesso'] = 1;
			$data['erro'] = "";
			$data['tipo'] = trim($tipoLogr);
			$data['logradouro'] = trim($nomeLogr);
			$data['numero'] = trim($numeroLogr);
			$data['bairro'] = trim($bairro);
			$data['cidade'] = trim($cidade);
			$data['uf'] = trim($uf);
			$data['cep'] = trim($cep);
	
			return json_encode($data);
	
		}else {
			$data['sucesso'] = 0;
			$data['erro'] = "CEP nao encontrado!";
			$data['tipo'] = $tipoLogr;
			$data['nome'] = $nomeLogr;
			$data['numero'] = $numeroLogr;
			$data['bairro'] = $bairro;
			$data['cidade'] = $cidade;
			$data['uf'] = $uf;
			$data['cep'] = $cep;
			return json_encode($data);
	
		}
	}
	
	public static function verificaUsuarioLogado(){
		if ( strpos($_SERVER['PHP_SELF'], "index.php") > -1 ) return true;
		if ( strpos($_SERVER['PHP_SELF'], "cadastro-advogado.php") > -1 ) return true;
		if ( strpos($_SERVER['PHP_SELF'], "pre-cadastro.php") > -1 ) return true;
				
		if (!self::isUsuarioLogado()){
			self::redirect('index.php');
			//print strpos($_SERVER['PHP_SELF'], "pre-cadastro.php");	
		}
		
		return true;		
	}

}