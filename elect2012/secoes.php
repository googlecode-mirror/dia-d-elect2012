<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/secoes.php";
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
					    	Pesquisar
					  </li>
					</ul>
				</div>
			</div>
			<?php if(aplicacao::getUsuarioLogado()->perfil == 1) :?>   
			<div class="row">
				<div class="span12">
					<a class="btn btn-success" href="secao-cadastro.php"> <i class="icon icon-white icon-plus"></i> Nova Seção</a>
				</div>
			</div>
			<?php endif;?>
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
								<th>Zona</th>
								<th>Seção</th>
								<th>Local</th>
								<th>Endereço</th>
								<th>Total de votantes</th>
								<?php if(aplicacao::getUsuarioLogado()->perfil == 1) :?> 
								<th class="td-actions"></th>
								<?php endif;?>
							</tr>
						</thead>
						<tbody>
							<?php 												
								foreach($lista as $item){																																
									print '<tr>';
									print '<td>'.$item->zona.'</td>';
									print '<td>'.$item->secao.'</td>';
									print '<td>'.$item->local.'</td>';
									print '<td>'.$item->endereco.'. '.$item->bairro.'</td>';
									print '<td>'.$item->aptos_total.'</td>';
									if(aplicacao::getUsuarioLogado()->perfil == 1){
										print '<td class="td-actions" style="width:150px">';
										print '		<a rel="tooltip" title="editar" href="secao-cadastro.php?zona='.$item->zona.'&secao='.$item->secao.'" class="btn btn-warning "><i class="icon-white icon-pencil "></i></a>';
										print '		<a rel="tooltip" title="deletar" class="btn btn-danger" onclick="'."document.getElementById('codigo').innerHTML='<p><b>Zona:</b> {$item->zona} <br/><b>Seção:</b> {$item->secao} <br/><b>Local:</b> {$item->local} </p>' ;document.getElementById('zona').value = " . $item->zona .  ";document.getElementById('secao').value = " . $item->secao .  "; $('#modalDeletar').modal('show');".'">';
										print '			<i class="icon-trash icon-white"></i>';
										print '		</a>';
										print '</td>';
									}
									
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
		    <p> Deseja realmente deletar esta seção ? </p> 
		    <span id="codigo"></span>  	    	    	   
		  </div>
		  <div class="modal-footer">
		  	 <form style="" action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_deletar">
		  	 	<input type="hidden" name="acao" value="deletar" />
		  	 	<input type="hidden" name="secao" id="secao" value="" />
		  	 	<input type="hidden" name="zona" id="zona" value="" />
		    	
		   		<button class="btn btn-primary" type="submit" > Deletar </button>
		   		<a class="btn" data-dismiss="modal">Cancelar</a>
		    </form>    
		  </div>
		</div>
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>