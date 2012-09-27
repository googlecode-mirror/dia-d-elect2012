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
					<div class="well"  style="margin-top:20px;">
						<form action="cadastro-advogado.php" method="get" >
							<fieldset>
								<legend>Atualizar Dados</legend>
								<div class="control-group">
								<label class="control-label" >OAB</label>
								<div class="controls">
									<input type="text"  class="input-small" name="oab" value="">
									<input style="margin-left:20px;margin-top:-8px" class="btn btn-success" type="submit" VALUE="Ok"/>
								</div>
								
								<div class="form-actions">
									<input class="btn btn-primary" type="submit" VALUE="Novo Cadastro"/>
									<input class="btn" style="margin-left:20px;" type="button" onclick="location.href='index.php'" VALUE="Voltar"/>
								</div>
								
							</div>
							</fieldset>
							
						</form>	
					</div>
				</div>
			</div>			
			<?php include "aplicacao/componentes/rodape.php" ; ?>
    	</div> <!-- /container -->
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
		
		
	</body>
</html>