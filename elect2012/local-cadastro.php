<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/local-cadastro.php";
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
					<h3>Localidade</h3>
				</div>
				<div class="span12">
					<ul class="breadcrumb">
					  <li>
					    <i class="icon icon-home"></i> <a href="index.php">Inicio</a> <span class="divider">/</span>
					  </li>
					  <li >
					    	<a href="localidades.php">Localidades</a> <span class="divider">/</span>
					  </li>
					   <li class="active">
					    	Cadastro
					  </li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<?php print mensagem::exibir(); ?>
				</div>
			</div>
			<div class="row">
				<div class="span12">
						<form class="well" method="post" action="local-cadastro.php">
							<input type="hidden"  name="acao" value="<?php print ($objeto)? "editar":"novo"; ?>" />
							<input type="hidden"  name="codigo" value="<?php print($objeto)? $objeto->cod_localidade : "0"; ?>" />
							<fieldset >
								<legend><?php print ($objeto)? "Editar":"Nova"; ?> Localidade</legend>
								<div class="control-group">
									<label class="control-label" for="nome">* Nome</label>
									<div class="controls">
										<input type="text" class="input-xxlarge" name="nome" value="<?php print ($objeto)?$objeto->nome:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="uf">* Observações</label>
									<div class="controls">
										<textarea rows="5" cols="100" class="span8" name="obs"></textarea>								        
									</div>										      
								</div>
							    
								<div class="control-group">
									<label class="control-label" for="cep">* CEP</label>
									<div class="controls">
										<input type="text" class="input-medium mask-cep " id="cep" name="cep" value="<?php print ($objeto)?$objeto->cep:'';  ?>">	
										<a id="correios" class="btn btn-primary" style="margin-top:-8px"><i class="icon icon-white icon-globe"></i> Preencher endereço </a>										        
									</div>
								</div>
										   
								<div class="control-group">
									<label class="control-label" for="endereco">* Endereço</label>
									<div class="controls">
										<input type="text" class="input-xlarge required" id="endereco" name="endereco" readonly="true" value="<?php print  ($objeto)?$objeto->endereco:'';  ?>">											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="numero">* Numero</label>
									<div class="controls">
										<input type="text" class="span2 required" id="numero" name="numero" readonly="true" value="<?php print  ($objeto)?$objeto->numero:'';  ?>">											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="complemento">Complemento</label>
									<div class="controls">
										<input type="text" class="input-xlarge " id="complemento" name="complemento" readonly="true" value="<?php print  ($objeto)?$objeto->complemento:'';  ?>"> 											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="bairro">* Bairro</label>
									<div class="controls">
										<input type="text" class="input-medium required" id="bairro" name="bairro" readonly="true" value="<?php print  ($objeto)?$objeto->bairro:'';  ?>">											        
									</div>
								</div>
										    
								<div class="control-group">
									<label class="control-label" for="cidade">* Cidade</label>
									<div class="controls">
										<input type="text" class="input-medium required" id="cidade" name="cidade" readonly="true" value="<?php print  ($objeto)?$objeto->cidade:'';  ?>">											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="uf">* UF</label>
									<div class="controls">
										<input type="text" class="span1 required" id="uf" name="uf" readonly="true" value="<?php print  ($objeto)?$objeto->uf:'';  ?>">								        
									</div>										      
								</div>								
							</fieldset>	 
							<div class="form-actions">
								<button type="submit" class="btn btn-success">Salvar</button>
								<a class="btn" href="localidades.php">Cancelar</a>
							</div>
							 	
						</form>		
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->
		
		
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>