<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/associar-advogados.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		   <?php include "aplicacao/componentes/topo.php" ; ?>
		   <script>
		   		function addOption(){
			   		$("#associar_local option:selected").each(function () {
			   			$(this).removeAttr('selected');
	               		$(this).remove().appendTo('#cod_local');

	               		$("#cod_local option").each(function () {
	               			$(this).attr('selected','selected');
	               		});
	               		$('#acao').val('atualizar');
	               		
	             	});
			   		$('#frm-associar').submit();
		   		}
		   		function delOption(){
			   		$("#cod_local option:selected").each(function () {
			   			$(this).removeAttr('selected');
	               		$(this).remove().appendTo('#associar_local');

	               		$("#cod_local option").each(function () {
	               			$(this).attr('selected','selected');
	               		});
	               		$('#acao').val('atualizar');
	               		
			   		});
			   		$('#frm-associar').submit();
		   		}
		   </script>
	</head>

	<body>
		<?php include "aplicacao/componentes/menu.php" ; ?>
		
		<div class="container" id="container-principal">
			<div class="row">
				<div class="span12">
					<h3>Associar Advogados</h3>
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
					    	Associar Advogados
					  </li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<form id="frm-associar" action="associar-advogados.php" method="post" class="well">
						<fieldset>
							<legend>Associar</legend>
							<input id="acao" name="acao" type="hidden" />
							<div style="float:left;width:50%;">
						  		<label for="cod_adv" style="font-weight: bold;">Advogados:</label>
						  		<select id="cod_adv" name="cod_adv"  style="width:95%;" >
								 <?php 
								 	foreach ($lista_advogados as $item){
										print "<option value='".$item->cod_advogado."'";
										if (!is_null($advogado)){
											if ($advogado == $item->cod_advogado){
												print " selected='selected' ";
											}
										}
										print ">".$item->nome."</option>";
								 	}
								 ?>
								</select>
						  		
						  	</div>
					  		<div style="float:left;width:50%;margin-top:25px;height:40px">
					  			<span><a class="btn" onclick="document.forms[0].submit();"><i class="icon icon-refresh"></i></a></span>
					  		</div>
					  		<?php if (!is_null($advogado)): ?>
							  	<div style="float:left;width:30%">
							  		<label for="associar_local" style="font-weight: bold;">Todos os Locais de votação:</label>
							  		<select id="associar_local" name="associar_local[]" multiple="multiple" style="height:200px;width:95%;">
									 <?php 
									 	foreach ($lista_locais as $item){
											if ($advogado <> $item->cod_advogado){
												print "<option value='$item->cod_local'>";
												if ($item->total >0) print "* ";						
												print $item->local;
												print "</option>";
											}
									 	}
									 ?>
									</select>
							  	</div>
						  		<div style="float:left;width:10%; margin-top:80px;">
						  			<span><a class="btn" onclick="addOption();"><i class="icon icon-chevron-right"></i></a></span>
						  			<br/><br/>
						  			<span><a class="btn" onclick="delOption();"><i class="icon icon-chevron-left"></i></a></span>
						  		</div>
						  		<div style="float:left;width:30%">
							  		<label for="cod_local" style="font-weight: bold;">Locais de votação do Advogado:</label>
							  		<select id="cod_local" name="cod_local[]" multiple="multiple" style="height:200px;width:95%;">
									 <?php 
									 	foreach ($lista_locais as $item){
											if ($advogado == $item->cod_advogado){
												print "<option value='".$item->cod_local."'>".$item->local."</option>";
											}
									 	}
									 ?>
									</select>
							  	</div>							  	
						  	<?php endif;?>							  	
						</fieldset>
					</form>
				</div>
			</div>
		
			<?php include "aplicacao/componentes/rodape.php" ; ?>
    	</div> <!-- /container -->
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
		
		
	</body>
</html>