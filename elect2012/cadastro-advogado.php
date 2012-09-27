<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/cadastro-advogado.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		   <?php include "aplicacao/componentes/topo.php" ; ?>
	</head>

	<body>
		<?php include "aplicacao/componentes/menu.php" ; ?>
		
		<div class="container" id="container-principal">
			<div class="row">
				<div class="span12">
					<?php print mensagem::exibir(); ?>
					<div class="well">	
						<form id="avalidateForm" class="form-horizontal" method="POST">
							<fieldset>
								<legend>Advogado</legend>
								<div class="control-group">
									<label class="control-label" >Nome</label>
									<div class="controls">
										<input type="text"  class="input-xxlarge required" name="nome" value="<?php print $nome; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >OAB</label>
									<div class="controls">
										<input type="text"  class="input-small required" name="oab" value="<?php print $oab; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Celular 1</label>
									<div class="controls">
										<input type="text"  class="input-medium required mask-phone_with_ddd" name="celular1" value="<?php print $celular1; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Celular 2</label>
									<div class="controls">
										<input type="text" class="input-medium required mask-phone_with_ddd" name="celular2" value="<?php print $celular2; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Telefone residencial</label>
									<div class="controls">
										<input type="text" class="input-medium required mask-phone_with_ddd" name="tel_residencial" value="<?php print $tel_residencial; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Telefone comercial</label>
									<div class="controls">
										<input type="text"  class="input-medium required mask-phone_with_ddd" name="tel_comercial" value="<?php print $tel_comercial; ?>">
									</div>								
								</div>
								<div class="control-group">
									<label class="control-label" >* Email 1</label>
									<div class="controls">
										<input type="text"  class="input-medium required email" name="email1" value="<?php print  ($objeto)? $objeto->email1:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Email 2</label>
									<div class="controls">
										<input type="text"  class="input-medium email" name="email2" value="<?php print  ($objeto)? $objeto->email2:""; ?>">
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" >Indicação 1</label>
									<div class="controls">
										<input type="text"  class="input-large required" name="indicacao1" value="<?php print $indicacao1; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Indicação 2</label>
									<div class="controls">
										<input type="text"  class="input-large required" name="indicacao2" value="<?php print $indicacao2; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >CPF</label>
									<div class="controls">
										<input type="text"  class="input-medium required mask-cpf required" name="cpf" value="<?php print $cpf; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Título</label>
									<div class="controls">
										<input type="text"  class="input-medium required" name="titulo" value="<?php print $titulo; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Zona</label>
									<div class="controls">
										<input type="text"  class="input-mini required" name="zona" value="<?php print $zona; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Seção</label>
									<div class="controls">
										<input type="text"  class="input-mini required" name="secao" value="<?php print $secao; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="eleicoesAnt">Você já trabalhou como advogado em eleições anteriores?</label>
									<div class="controls">
										<label class="radio">
											<input type="radio" name="eleicoesAnt" value="1" <?php print($objeto->eleicoesAnt == "1")? "checked":""; ?>>Sim<br>
										</label>
										<label class="radio">										
											<input type="radio" name="eleicoesAnt" value="2" <?php print($objeto->eleicoesAnt == "2")? "checked":""; ?>>Não						        		</label>
									</div>										      
								</div>
								
								<hr/>
											<div class="control-group">
												<label class="control-label" for="cep">* CEP</label>
												<div class="controls">
													<input type="text" class="input-medium mask-cep " id="cep" name="cep" value="<?php print $cep;  ?>">	
													<a id="correios" class="btn btn-primary"><i class="icon icon-white icon-globe"></i> Preencher endereço </a>										        
												</div>
											</div>
													   
											<div class="control-group">
												<label class="control-label" for="endereco">* Endereço</label>
												<div class="controls">
													<input type="text" class="input-xlarge required" id="endereco" name="endereco" readonly="true" value="<?php print $endereco;  ?>">											        
												</div>
											</div>
											
											<div class="control-group">
												<label class="control-label" for="numero">* Numero</label>
												<div class="controls">
													<input type="text" class="span2 required" id="numero" name="numero" readonly="true" value="<?php print $numero;  ?>">											        
												</div>
											</div>
											
											<div class="control-group">
												<label class="control-label" for="complemento">Complemento</label>
												<div class="controls">
													<input type="text" class="input-xlarge " id="complemento" name="complemento" readonly="true" value="<?php print $complemento;  ?>"> 											        
												</div>
											</div>
											
											<div class="control-group">
												<label class="control-label" for="bairro">* Bairro</label>
												<div class="controls">
													<input type="text" class="input-medium required" id="bairro" name="bairro" readonly="true" value="<?php print $bairro;  ?>">											        
												</div>
											</div>
													    
											<div class="control-group">
												<label class="control-label" for="cidade">* Cidade</label>
												<div class="controls">
													<input type="text" class="input-medium required" id="cidade" name="cidade" readonly="true" value="<?php print $cidade;  ?>">											        
												</div>
											</div>
											
											<div class="control-group">
												<label class="control-label" for="uf">* UF</label>
												<div class="controls">
													<input type="text" class="span1 required" id="uf" name="uf" readonly="true" value="<?php print $uf;  ?>">								        
												</div>										      
											</div>
											
											<hr/>		    
										    <div class="control-group">
												<label class="control-label" for="codigo">* Código de verificação</label>
												<div class="controls">													
													<div style="float:left;width:200px;background-color: #000;">
														<img id="captcha" src="captcha.php" >	
														<a id="refresh_captcha" class="btn" ><i class="icon icon-refresh"></i></a>
													</div>
													<div style="float:left;width:460px;margin-left:10px">
														<input type="text" class="input-medium required" name="captcha" minlength="6" value="">
													</div>						        
												</div>
											</div>									
								
							</fieldset>
							<div class="form-actions">
								<input type="hidden" name="acao" value="novo-adv"/>
								<button type="submit" class="btn btn-success">Salvar</button>
								<a style="margin-left:20px;" href="index.php" class="btn">Voltar</a>
							</div>
						</form>
					</div>	
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
    	</div> <!-- /container -->
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
		
		
	</body>
</html>