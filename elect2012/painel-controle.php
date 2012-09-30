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
			
			<div class="row">
				<div class="span8">
					<div id="painel-controle-gmap3" class="gmap3"></div>
				</div>
				<div class="span4">
					<form class="well" style="padding:10px; height:480px; margin-top:20px;font-size:12px;">
						<fieldset>
							<label class="control-label" for="local">Local:</label>
							<select name="local" id="cmbLocalOcorrencias" style="width:100%">
								<?php 
									foreach ($lista_locais as $item){
										print "<option value='".$item->cod_local."'>".$item->local."</option>";
									}
								?>
								
							</select>
							<label class="control-label" for="secao">Seção:</label>
							<select name="secao" id="cmbSecaoOcorrencias" style="width:30%">
							</select>
							<label class="control-label" for="ocorrencia">Reportado por:</label>
							<input type="text" name="autor"/>
							<label class="control-label" for="ocorrencia">Ocorrência:</label>
							<textarea rows="10"  name="ocorrencia" style="width:95%"></textarea>
							<div style="width:100%; padding:10px;" >
								<a class="btn btn-success" > <i class="icon icon-white icon-exclamation-sign"></i> Nova Ocorrência</a>
								<a class="btn" style="margin-left:20px;" >Cancelar</a>
							</div>
							
						</fieldset>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<div id="local-detalhes" class="well">
						  	<fieldset >
						  		<legend style="font-size:16px;color:darkred;font-weight:bold;">Local:  Colégio 7 de Setembro</legend>
						  		<div style="float:left; width:25%;"><strong>Ocorrências: </strong><br/> 1 pendente(s) de 4 ocorrência(s) </div>
						  		<div style="float:left; width:15%;"><strong>Seções:</strong><br/> 524, 525.</div>
							  	<div style="float:left; width:20%;"><strong>Seções Agregadas:</strong><br/> 512 </div>
							  	<div style="float:left; width:20%;"><strong>Total de eleitores:</strong><br/> 1.204	</div>
							  	<div style="float:left; width:20%;"><a class="btn btn-success"><i class="icon icon-white icon-plus"></i> Advogado</a><br/></div>
							  	<div style="color:darkred;float:left; width:100%;margin-top:10px;padding:10px 0px;">
							  		<strong>Advogados</strong>
							  	</div>
							  	
							  	<div style="float:left; width:25%;">
							  		<strong>Cristiano de Souza Therrien </strong><br/>
							  		<strong>OAB:</strong> 13869.<br/>
							  		<strong>Seções:</strong> 524, 525, 512.<br/>
							  		<strong>Telefone(s):</strong><br/>
							  		<span style="margin-left:10px;">(85) 88352008</span><br/>
							  		<span style="margin-left:10px;">(85) 91141392</span><br/>
							  		<span style="margin-left:10px;">(85) 88745038</span><br/>
							  		<span style="margin-left:10px;">(85) 30330374</span>
							  	</div>
							  	<div style="float:left; width:25%;">
							  		<strong>Cristiano de Souza Therrien </strong><br/>
							  		<strong>OAB:</strong> 13869.<br/>
							  		<strong>Seções:</strong> 524, 525, 512.<br/>
							  		<strong>Telefone(s):</strong><br/>
							  		<span style="margin-left:10px;">(85) 88352008</span><br/>
							  		<span style="margin-left:10px;">(85) 91141392</span><br/>
							  		<span style="margin-left:10px;">(85) 88745038</span><br/>
							  		<span style="margin-left:10px;">(85) 30330374</span>
							  	</div>
							  	<div style="float:left; width:25%;">
							  		<strong>Cristiano de Souza Therrien </strong><br/>
							  		<strong>OAB:</strong> 13869.<br/>
							  		<strong>Seções:</strong> 524, 525, 512.<br/>
							  		<strong>Telefone(s):</strong><br/>
							  		<span style="margin-left:10px;">(85) 88352008</span><br/>
							  		<span style="margin-left:10px;">(85) 91141392</span><br/>
							  		<span style="margin-left:10px;">(85) 88745038</span><br/>
							  		<span style="margin-left:10px;">(85) 30330374</span>
							  	</div>
							  	<div style="float:left; width:25%;">
							  		<strong>Cristiano de Souza Therrien </strong><br/>
							  		<strong>OAB:</strong> 13869.<br/>
							  		<strong>Seções:</strong> 524, 525, 512.<br/>
							  		<strong>Telefone(s):</strong><br/>
							  		<span style="margin-left:10px;">(85) 88352008</span><br/>
							  		<span style="margin-left:10px;">(85) 91141392</span><br/>
							  		<span style="margin-left:10px;">(85) 88745038</span><br/>
							  		<span style="margin-left:10px;">(85) 30330374</span>
							  	</div>		  		
						  	</fieldset>					  	
					  	</div>	
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<ul class="nav nav-tabs" id="tabPanelBottomOcorrencias">
					  <li class="active"><a href="#tabOcorrencias">Ocorrências</a></li>
					  <li><a href="#tabAdvogados">Gerênciar Advogados</a></li>
					</ul>
					 
					<div class="tab-content">
					  <div class="tab-pane active" id="tabOcorrencias">
					  				  
					  	<table id="datatable" class="table table-striped table-bordered" style="width:100%;">
							<thead>
								<tr style="background-color:#D44413;color:#fff">
									<th width="120px">Status</th>
									<th>Cod</th>
									<th>Hora</th>									
									<th>Local</th>
									<th>Seção</th>
									<th>Ocorrência</th>
									<th class="td-actions">Ações</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a class="btn btn-success"><i class="icon icon-ok"></i> Resolvido</a></td>
									<td>2</td>
									<td>12:31</td>									
									<td><a href="#">COLEGIO 7 DE SETEMBRO</a></td>
									<td>524</td>
									<td>Problemas com a sinalização</td>
									<td>
										<a rel="tooltip" title="deletar" class="btn"><i class="icon  icon-trash"></i></a>
										<a rel="tooltip" title="editar" class="btn"><i class="icon  icon-pencil"></i></a>
										<a rel="tooltip" title="enviar mensagem" class="btn"><i class="icon  icon-envelope"></i></a>
										<a rel="tooltip" title="ver no mapa" class="btn"><i class="icon   icon-map-marker"></i></a>
										<a rel="tooltip" title="abrir" class="btn"><i class="icon   icon-folder-open"></i></a>
									</td>
								</tr>
								<tr>
									<td><a class="btn btn-warning"><i class="icon icon-exclamation-sign"></i> Pendente</a></td>
									<td>1</td>
									<td>12:31</td>									
									<td><a  href="#">COLEGIO FARIAS BRITO</a></td>
									<td>524</td>
									<td>Problemas com a sinalização</td>
									<td>
										<a rel="tooltip" title="deletar" class="btn"><i class="icon  icon-trash"></i></a>
										<a rel="tooltip" title="editar" class="btn"><i class="icon  icon-pencil"></i></a>
										<a rel="tooltip" title="enviar mensagem" class="btn"><i class="icon  icon-envelope"></i></a>
										<a rel="tooltip" title="ver no mapa" class="btn"><i class="icon   icon-map-marker"></i></a>
										<a rel="tooltip" title="resolvido" class="btn"><i class="icon   icon-ok-sign"></i></a>
									</td>
								</tr>
							</tbody>
						</table>
					  </div>
					  <div class="tab-pane" id="tabAdvogados">.a..</div>
					</div>
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>
