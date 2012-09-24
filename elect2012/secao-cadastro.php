<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/secao-cadastro.php";
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
					<h3>Seções</h3>
				</div>
				<div class="span12">
					<ul class="breadcrumb">
					  <li>
					    <i class="icon icon-home"></i> <a href="index.php">Inicio</a> <span class="divider">/</span>
					  </li>
					  <li >
					    	<a href="secoes.php">Seções</a> <span class="divider">/</span>
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
						<form class="well" method="post" action="<?php print ($objeto)? "secao-cadastro.php?zona={$objeto->zona}&secao={$objeto->secao}":"secao-cadastro.php"; ?>">
							<input type="hidden"  name="acao" value="<?php print ($objeto)? "editar":"novo"; ?>" />
							<input type="hidden"  name="zona" value="<?php print($objeto)? $objeto->zona : "0"; ?>" />
							<input type="hidden"  name="secao" value="<?php print($objeto)? $objeto->secao : "0"; ?>" />
							<fieldset >
								<legend><?php print ($objeto)? "Editar":"Nova"; ?> Seção</legend>				
									
								<div class="control-group">
									<label class="control-label" for="nome">Zona *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="zona_cad" value="<?php print ($objeto)?$objeto->zona:''; ?>" >											        
									</div>
								</div>	
								<div class="control-group">
									<label class="control-label" for="nome">Seção *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="secao_cad" value="<?php print ($objeto)?$objeto->secao:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Cod. Municipio *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="cod_municipio" value="<?php print ($objeto)?$objeto->cod_municipio:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Municipio *</label>
									<div class="controls">
										<input type="text" class="input-large" name="municipio" value="<?php print ($objeto)?$objeto->municipio:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Cod. Local *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="cod_local" value="<?php print ($objeto)?$objeto->cod_local:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Local *</label>
									<div class="controls">
										<input type="text" class="input-xxlarge" name="local" value="<?php print ($objeto)?$objeto->local:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Endereço *</label>
									<div class="controls">
										<input type="text" class="input-xxlarge" name="endereco" value="<?php print ($objeto)?$objeto->endereco:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Bairro *</label>
									<div class="controls">
										<input type="text" class="input-large" name="bairro" value="<?php print ($objeto)?$objeto->bairro:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">CEP *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="cep" value="<?php print ($objeto)?$objeto->cep:''; ?>" >											        
									</div>
								</div>								
															    
							    <div class="control-group">
									<label class="control-label" for="nome">Total Aptos na seção principal *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="aptos_secao" value="<?php print ($objeto)?$objeto->aptos_secao:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Seções Agregadas *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="secao_agregadas" value="<?php print ($objeto)?$objeto->secao_agregadas:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Total Aptos nas seções agregadas *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="aptos_agregadas" value="<?php print ($objeto)?$objeto->aptos_agregadas:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Total geral de Aptos *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="aptos_total" value="<?php print ($objeto)?$objeto->aptos_total:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Latitude *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="latitude" value="<?php print ($objeto)?$objeto->latitude:''; ?>" >											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Longitude *</label>
									<div class="controls">
										<input type="text" class="input-medium" name="longitude" value="<?php print ($objeto)?$objeto->longitude:''; ?>" >											        
									</div>
								</div>
								
							</fieldset>	 
							<div class="form-actions">
								<button type="submit" class="btn btn-success">Salvar</button>
								<a class="btn" href="usuarios.php">Cancelar</a>
							</div>
							 	
						</form>		
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->
		
		
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>