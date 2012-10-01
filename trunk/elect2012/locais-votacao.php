<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/locais-votacao.php";
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
					<h3>Locais de Votação</h3>
				</div>
				<div class="span12">
					<ul class="breadcrumb">
					  <li>
					    <i class="icon icon-home"></i> <a href="index.php">Inicio</a> <span class="divider">/</span>
					  </li>
					  <li >
					    	<a href="locais-votacao.php">Locais de Votação</a> <span class="divider">/</span>
					  </li>
					   <li class="active">
					    	Pesquisar
					  </li>
					</ul>
				</div>
			</div>
			<!--<div class="row">
				<div class="span12">
					<a class="btn btn-success" href="secao-cadastro.php"> <i class="icon icon-white icon-plus"></i> Nova Seção</a>
				</div>
			</div>
			<div class="row" style="margin-top:15px">
				<div class="span12">
				<?php print mensagem::exibir(); ?>
				</div>
			</div>-->
			<div class="row">
				<div  class="span12">
					<table id="datatable" class="table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>Locais de Votação</th>
								<th>Endereço</th>
								<th>Bairro</th>
								<th>Total de urnas</th>
								<th>Total de votantes</th>								
							</tr>
						</thead>
						<tbody>
							<?php 												
								foreach($lista as $item){																																
									print '<tr>';
									print '<td>'.$item->local.'</td>';
									print '<td>'.$item->endereco.'</td>';
									print '<td>'.$item->bairro.'</td>';
									print '<td>'.$item->urnas.'</td>';
									print '<td>'.$item->totalLocal.'</td>';
									print '</tr>';
								}
							?>							
						</tbody>
					</table>				
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>