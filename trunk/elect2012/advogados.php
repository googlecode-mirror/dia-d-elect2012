<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/advogados.php";
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
					<h3>Advogados</h3>
				</div>
				<div class="span12">
					<ul class="breadcrumb">
					  <li>
					    <i class="icon icon-home"></i> <a href="index.php">Inicio</a> <span class="divider">/</span>
					  </li>
					  <li >
					    	<a href="advogados.php">Advogados</a> <span class="divider">/</span>
					  </li>
					   <li class="active">
					    	Pesquisar
					  </li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<a class="btn btn-success" href="advogado-cadastro.php"> <i class="icon icon-white icon-plus"></i> Novo Advogado</a>
				</div>
			</div>
			<div class="row" style="margin-top:15px">
				<div class="span12">
				<?php print mensagem::exibir(); ?>
				</div>
			</div>
			<div class="row">
				<div  class="span12">
					<table id="datatable" class="table table-striped table-bordered" style="width:100%;">
						<thead>		
							<tr>
								<th>OAB</th>
								<th>Nome</th>
								<th>Zona</th>
								<th>Seção</th>
								<th class="td-actions"></th>
							</tr>
						</thead>
						<tbody>
							<?php 												
								foreach($lista as $item){																																
									print '<tr>';
									print '<td>'.$item->oab.'</td>';
									print '<td>'.$item->nome.'</td>';
									print '<td>'.$item->zona.'</td>';	
									print '<td>'.$item->secao.'</td>';										
									print '<td class="td-actions" style="width:150px">';											
									print '		<a rel="tooltip" title="editar" href="advogado-cadastro.php?codigo='.$item->cod_advogado.'" class="btn btn-warning "><i class="icon-white icon-pencil "></i></a>';
									print '		<a rel="tooltip" title="deletar" class="btn btn-danger" onclick="'."document.getElementById('codigo').innerHTML='<p><b>OAB:</b> {$item->oab} <br/><b>Nome:</b> {$item->nome} <br/><b>Zona:</b> {$item->zona} <br/><b>Seção:</b> {$item->secao} </p>' ;document.getElementById('deletar_id').value = " . $item->cod_advogado .  "; $('#modalDeletar').modal('show');".'">';
									print '			<i class="icon-trash icon-white"></i>';
									print '		</a>';																										
									print '</td>';
									print '</tr>';
								}
							?>							
						</tbody>
					</table>				
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->
		
		<!-- MODAL DELETAR  -->
		<div class="modal hide" id="modalDeletar">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal">×</button>
		    <h3>Deletar</h3>
		  </div>
		  <div class="modal-body">
		    <p> Deseja realmente deletar este advogado ? </p> 
		    <span id="codigo"></span>  	    	    	   
		  </div>
		  <div class="modal-footer">
		  	 <form style="" action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_deletar">
		  	 	<input type="hidden" name="acao" value="deletar" />
		  	 	<input type="hidden" name="deletar_id" id="deletar_id" value="" />
		    	
		   		<button class="btn btn-primary" type="submit" > Deletar </button>
		   		<a class="btn" data-dismiss="modal">Cancelar</a>
		    </form>    
		  </div>
		</div>
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>