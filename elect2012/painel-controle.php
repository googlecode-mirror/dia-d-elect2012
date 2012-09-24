<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/painel-controle.php";
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
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>
