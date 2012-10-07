<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/usuario-cadastro.php";
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
					<h3>Usuários</h3>
				</div>
				<div class="span12">
					<ul class="breadcrumb">
					  <li>
					    <i class="icon icon-home"></i> <a href="index.php">Inicio</a> <span class="divider">/</span>
					  </li>
					  <li >
					    	<a href="usuarios.php">Usuários</a> <span class="divider">/</span>
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
						<form class="well" method="post" action="usuario-cadastro.php">
							<input type="hidden"  name="acao" value="<?php print ($objeto)? "editar":"novo"; ?>" />
							<input type="hidden"  name="codigo" value="<?php print($objeto)? $objeto->cod_usuario : "0"; ?>" />
							<fieldset >
								<legend><?php print ($objeto)? "Editar":"Novo"; ?> Usuário</legend>
								<div class="control-group">
									<label class="control-label" for="nome">Nome *</label>
									<div class="controls">
										<input type="text" class="input-xxlarge" name="nome" value="<?php print ($objeto)?$objeto->nome:''; ?>" >											        
									</div>
								</div>
							    
								<div class="control-group">
									<label class="control-label" for="nome">Login *</label>
										<div class="controls">
											<input type="text" class="input-large" name="login" autocomplete="off" value="<?php print ($objeto)?$objeto->login:''; ?>" >											        
										</div>
								</div>
							    
								<div class="control-group">
									<label class="control-label" for="nome">Senha *</label>
									<div class="controls">
										<input type="password" class="input-medium" name="senha" value="" autocomplete="off">											        
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="perfil">Perfil</label>
									<div class="controls">
										<select name="perfil">											
											<option value="2" <?php print ($objeto and $objeto->perfil==2)?'selected':''; ?>>Usuário</option>
											<option value="1" <?php print ($objeto and $objeto->perfil==1)?'selected':''; ?>>Administrador</option>
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