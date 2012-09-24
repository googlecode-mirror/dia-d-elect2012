<?php
final class banco {
	
	/**
	 * Objeto de conexao
	 * @var PDO
	 */
	public static $banco_obj;
	
	/**
	 * Objeto de transacao
	 * @var PDO
	 */
	public static $transacao_obj;
	 
	/**
	 * Informacoes de configuracao
	 * @var array
	 */
	public static $banco_config;
	
	private function __construct(){}
	
	public static function configFile(){
		return  realpath(dirname(__FILE__).'\config.ini');
	}
			
	public static function conectar(){
						
		if(empty(self::$banco_obj)){
			
			$config = array();
			$config_file = self::configFile();
			
			
			if (file_exists($config_file)){
				$config = parse_ini_file($config_file);
				$servidor =  $config['banco_servidor'];
				$banco =  $config['banco_nome'];
				$usuario =  $config['banco_usuario'];
				$senha =  $config['banco_senha'];
				$porta = $config['banco_porta'];
					
				self::$banco_config = $config;
				self::$banco_obj = new PDO ("mysql:host={$servidor};port={$porta};dbname={$banco}",$usuario,$senha,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				self::$banco_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}else{
				throw new Exception('Arquivo de configuracao nao encontrado.');
			}	
			
		}
				
		return self::$banco_obj;
	}
	
	public static function executar($sql,$values=null){
		if (is_null($values)){
			return self::$banco_obj->exec($sql);
		}else{
			$consulta = self::$banco_obj->prepare($sql);
			return $consulta->execute($values);					
		}
		
	}
	
	public static function listar($sql,$values=null){
		if (is_null($values)){
			$consulta = self::$banco_obj->query($sql);
			if($consulta){
				return $consulta->fetchAll(PDO::FETCH_CLASS);
			}			
		}else{
			$consulta = self::$banco_obj->prepare($sql);
			$consulta->execute($values);
			return $consulta->fetchAll(PDO::FETCH_CLASS);			
		}
	}
		
	public static function abrirTransacao(){
		self::$banco_obj->beginTransaction();
		
		return true;
	}
	
	public static function fecharTransacao(){	
		return self::$banco_obj->commit();
	}
	
	public static function cancelarTransacao(){
		self::$banco_obj->rollBack();		
		return true;
	}
	
	public static function getId(){
		return self::$banco_obj->lastInsertId();
	}

	public static function errorInfo(){
		return self::$banco_obj->errorInfo();
	}
	
	
}