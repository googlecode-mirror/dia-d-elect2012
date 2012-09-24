<?php
final class mensagem{
	
	public static function erro($mensagem){
		$_SESSION['mensagem'] = $mensagem;
		$_SESSION['mensagem_tipo'] = 1;
		$_SESSION['beep_error'] = "<script>
								$('#sound').remove();
								var sound = $(\"<embed id='sound' style='visibility:hidden;' type='audio/wav' />\");
								sound.attr('src', 'sounds/error.wav');
								sound.attr('loop', false);
								sound.attr('hidden', true);
								sound.attr('autostart', true);
								$('body').append(sound);
							</script>
							";	

		
	}
	
	public static function info($mensagem){
		$_SESSION['mensagem'] = $mensagem;
		$_SESSION['mensagem_tipo'] = 2;
	}
	
	public static function sucesso($mensagem){
		$_SESSION['mensagem'] = $mensagem;
		$_SESSION['mensagem_tipo'] = 3;
		
		$_SESSION['beep_success'] = "<script>
								$('#sound').remove();
								var sound = $(\"<embed id='sound' style='visibility:hidden;' type='audio/wav' />\");
								sound.attr('src', 'sounds/success.wav');
								sound.attr('loop', false);
								sound.attr('hidden', true);
								sound.attr('autostart', true);
								$('body').append(sound);
							</script>
							";
	}
	
	public static function exibir(){
		$mensagem_html = '';
		$mensagem= (isset($_SESSION['mensagem']))?$_SESSION['mensagem']:'';
		
		$tipo = (isset($_SESSION['mensagem_tipo']))?$_SESSION['mensagem_tipo']:0;
		
		switch($tipo){
			case 1:
				$beep= (isset($_SESSION['beep_error']))?$_SESSION['beep_error']:'';
				$mensagem_html='<div class="alert alert-error fade in">
									<button type="button" class="close" data-dismiss="alert">×</button>
           							<strong>Erro!</strong> '.$mensagem.'
								</div>'.$beep;
				break;
			case 2:
				$mensagem_html='<div class="alert alert-info fade in">
									<button type="button" class="close" data-dismiss="alert">×</button>
           							<strong>Informação:</strong> '.$mensagem.'
								</div>';
				break;
			case 3:
				$beep= (isset($_SESSION['beep_success']))?$_SESSION['beep_success']:'';
				$mensagem_html='<div class="alert alert-success fade in">
									<button type="button" class="close" data-dismiss="alert">×</button>
           							<strong>Sucesso!</strong> '.$mensagem.'
								</div>'.$beep;
				
				break;
			default:
				break;	
			}
			$_SESSION['mensagem'] = null;
			$_SESSION['beep_error'] = null;
			$_SESSION['beep_success'] = null;
			$_SESSION['mensagem_tipo'] = null;
		
		return 	$mensagem_html;	
	}
	
	
}