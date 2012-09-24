<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/candidato-cadastro.php";
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
					<h3>Candidatos</h3>
				</div>
				<div class="span12">
					<ul class="breadcrumb">
					  <li>
					    <i class="icon icon-home"></i> <a href="index.php">Inicio</a> <span class="divider">/</span>
					  </li>
					  <li >
					    	<a href="candidatos.php">Candidatos</a> <span class="divider">/</span>
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
						<form class="well" method="post" action="candidato-cadastro.php">
							<input type="hidden"  name="acao" value="<?php print ($objeto)? "editar":"novo"; ?>" />
							<input type="hidden"  name="codigo" value="<?php print ($objeto)? $objeto->numero:"0"; ?>" />
							<fieldset >
								<legend><?php print ($objeto)? "Editar":"Novo"; ?> Candidato</legend>
								<div class="control-group">
									<label class="control-label" for="nome">Numero *</label>
										<div class="controls">
											<input type="text" class="input-large" name="numero" autocomplete="off" value="<?php print ($objeto)?$objeto->numero:''; ?>" >											        
										</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Nome *</label>
									<div class="controls">
										<input type="text" class="input-xxlarge" name="nome" value="<?php print ($objeto)?$objeto->nome_candidato:''; ?>" >											        
									</div>
								</div>
							    
								<div class="control-group">
									<label class="control-label" for="nome">Nome da Urna *</label>
										<div class="controls">
											<input type="text" class="input-large" name="nome-urna" autocomplete="off" value="<?php print ($objeto)?$objeto->nome_urna:''; ?>" >											        
										</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Sexo *</label>
										<div class="controls">
											<select name="sexo">
												<option value="Masculino" <?php print ($objeto and $objeto->sexo == 'Masculino')? 'selected':'';?> >Masculino</option>
												<option value="Feminino" <?php print ($objeto and $objeto->sexo == 'Feminino')? 'selected':'';?>>Feminino</option>
											</select>											        
										</div>
								</div>
								
								
							    
							    <div class="control-group">
									<label class="control-label" for="nome">Partido *</label>
										<div class="controls">
											<select class="span2" name="partido">
												<?php 
													foreach ($partidos as $item){
														if($objeto->num_partido == $item->numero ){
															print "<option value='{$item->numero}' selected> {$item->nome} </option>";
														} else{															
															print "<option value='{$item->numero}'> {$item->nome} </option>";
														}
													}												
												?>
											</select>											        
										</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="nome">Cargo *</label>
										<div class="controls">
											<select name="cargo">	
												<option value="Vereador" <?php print ($objeto and $objeto->cargo == 'Vereador')? 'selected':'';?>>Vereador</option>
												<option value="Prefeito" <?php print ($objeto and $objeto->cargo == 'Prefeito')? 'selected':'';?>>Prefeito</option>
											</select>											        
										</div>
								</div>
								
								
								
								<div class="control-group">
									<label class="control-label" for="nome">Situação *</label>
										<div class="controls">
											<select name="situacao">
												<option value="Deferido" <?php print ($objeto and $objeto->cargo == 'Deferido')? 'selected':'';?>>Deferido</option>
												<option value="Indeferido"  <?php print ($objeto and $objeto->cargo == 'Indeferido')? 'selected':'';?>>Indeferido</option>
											</select>												        
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