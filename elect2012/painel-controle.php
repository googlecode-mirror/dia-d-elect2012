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
			<input type="hidden" name="local-selecionado" id="local-selecionado" />
			<div class="row">
				<div class="span8">
					<div id="painel-controle-gmap3" class="gmap3"></div>
					<div class="well">
						<div  style="width:25%;float:left;display:inline;">
							<a class="btn" id="refresh-map" style="margin-left:10px;" ><i class="icon icon-refresh"></i> Reload Mapa</a>
						</div>
						<div  style="width:50%;float:left;">
							<img src="./img/preto.png" style="width:30px;"/> Não possui Advogados
							<img src="./img/verde.png" style="margin-left:10px;width:30px;"/> Possui Advogados
							<img src="./img/estrela.png" style="margin-left:10px;width:30px;"/> Locais Especiais
						</div>
					</div>
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
			<div class="row" id="panel-local-detalhes">
				<div class="span12">
					<div  class="well">							
							<fieldset >
						  		<div style="float:left;width:80%; font-size:16px;color:darkred;font-weight:bold;height:26px;">
						  			Local:  <span id="panel-local-txtnome"></span> 
						  		</div>
						  		<div style="float:left;width:20%; text-align: right;height:26px;">
						  			<a rel="tooltip" id="ver-no-mapa" title="ver no mapa" class="btn btn-small"><i class="icon icon-map-marker"></i></a>
						  			<a id="minimize" rel="tooltip" title="minimizar" class="btn btn-small"><i class="icon icon-minus"></i></a>
						  			<a id="maximize" rel="tooltip" title="maximizar" class="btn btn-small"><i class="icon icon-folder-close"></i></a>
						  		</div>
						  		<div id="local-detalhes">
							  		<div style="float:left; width:30%;"><strong>Total de eleitores:</strong><br/><span id="panel-local-txttotaleleitores"></span></div>
								  	<div style="float:left; width:70%;"><strong>Seções:</strong><br/><span id="panel-local-txtsecoes"></span></div>
								   	<div style="color:darkred;float:left; width:100%;margin-top:10px;padding:10px 0px;font-size:16px;">
								  		<strong>Advogados</strong>
								  	</div>				
								  	<table class="table" id="local-table-advogados">								  		
								  	</table>		  	
							  </div>							  	
						  	</fieldset>					  	
					  	</div>	
				</div>
			</div>
			<div class="row" id="panel-ocorrencias-advogados">
				<div class="span12">
					<ul class="nav nav-tabs" id="tabPanelBottomOcorrencias">
					  <li  class="active"><a href="#tabOcorrencias">Ocorrências</a></li>
					  <li><a href="#tabAdvogados">Gerênciar Advogados</a></li>
					</ul>
					 
					<div class="tab-content">
					  <div class="tab-pane active" id="tabOcorrencias">
					  	<div class="form-inline well">
							<label class="control-label" for="filtroOcorrenciasLocais">Locais:</label>
							<select name="filtroOcorrenciasLocais" id="filtroOcorrenciasLocais" class="span4">
							</select>
							&nbsp;&nbsp;&nbsp;
							<label class="control-label" for="filtroOcorrenciasSecao">Seção:</label>
							<select name="filtroOcorrenciasSecao" id="filtroOcorrenciasSecao" class="span1">
							</select>
							&nbsp;&nbsp;&nbsp;
							<label class="control-label" for="filtroOcorrenciasStatus">Status:</label>
							<select name="filtroOcorrenciasStatus" id="filtroOcorrenciasStatus" class="span2">
							</select>
							&nbsp;&nbsp;&nbsp;
							<a class="btn"><i class="icon icon-filter"></i>Filtrar</a>
							&nbsp;&nbsp;&nbsp;
							<a class="btn"><i class="icon icon-download"></i>Todas as ocorrências</a>						   
						</div>			  
					  	<table id="datatable" class="table table-striped table-bordered" style="width:100%;">
							<thead>
								<tr style="background-color:#D44413;color:#fff">
									<th width="120px">Status</th>
									<th>Cod</th>
									<th>Hora</th>									
									<th>Local</th>
									<th>Seção</th>
									<th>Ocorrência</th>
									<th width="150px" >Ações</th>
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
										<a rel="tooltip" title="deletar" class="btn btn-small"><i class="icon  icon-trash"></i></a>
										<a rel="tooltip" title="editar" class="btn btn-small"><i class="icon  icon-pencil"></i></a>
										<a rel="tooltip" title="enviar mensagem" class="btn btn-small"><i class="icon  icon-envelope"></i></a>
										<a rel="tooltip" title="abrir" class="btn btn-small"><i class="icon   icon-folder-open"></i></a>
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
										<a rel="tooltip" title="deletar" class="btn btn-small"><i class="icon  icon-trash"></i></a>
										<a rel="tooltip" title="editar" class="btn btn-small"><i class="icon  icon-pencil"></i></a>
										<a rel="tooltip" title="enviar mensagem" class="btn btn-small"><i class="icon  icon-envelope"></i></a>
										<a rel="tooltip" title="resolvido" class="btn btn-small"><i class="icon   icon-ok-sign"></i></a>
									</td>
								</tr>
							</tbody>
						</table>
					  </div>
					  <div class="tab-pane" id="tabAdvogados">	
					  	<div id="form-associar-advogados">					
							<div style="float:left;width:40%">
						  		<label for="associar_advogado_origem" style="font-weight: bold;">Todos os Advogados:</label>
						  		<select id="associar_advogado_origem" name="associar_advogado_origem" multiple="multiple" style="height:200px;width:95%;">
								</select>
						  		
						  	</div>
					  		<div style="float:left;width:10%;margin-top:80px;text-align: center;">				  			
				  				<a class="btn" onclick="addAdvogado();"><i class="icon icon-chevron-right"></i></a>
				  				<br/><br/><br/>
				  				<a class="btn" onclick="delAdvogado();"><i class="icon icon-chevron-left"></i></a>				  			
					  		</div>
						  	<div style="float:left;width:40%">
						  		<label for="associar_advogado_destino" style="font-weight: bold;">Advogados selecionados:</label>
						  		<select id="associar_advogado_destino" name="associar_advogado_destino" multiple="multiple" style="height:200px;width:95%;">
								</select>
						  	</div>					  	
						  	<div style="float:left;width:100%;padding: 20px 0px;">
						  		<a class="btn btn-large btn-success" onClick="saveAdvogado();">Salvar</a>					  	
						  	</div>	
						  </div>
						  <div id="msg-associar-advogados">
						  	 Selecione um Local de votação para associar advogados.
						  </div>										  					  
					  </div>
					</div>
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
		
		<script type="text/javascript">
			//Lista de codigos dos advogados alocados
			var listaAdv,localLat,localLong;		
			var markerLocal,infoWindowLocal;
			
			$(function() {
				//Carrega o Mapa
				$("#painel-controle-gmap3").gmap3({
						action:'init',
						options:{
							center:[-3.7183943,-38.5433948],
							zoom: 13
						},
						callback: function(){
				            $('#refresh-map').click(loadMap);
						}		
				});

				//Acao minimizar os dados do local		
				$('#minimize').click(function (e) {
					$('#local-detalhes').hide();
				});
				
				//Acao maximizar os dados do local
				$('#maximize').click(function (e) {
					$('#local-detalhes').show();
				});

				//Abas de Ocorrencias e Gerenciar Advogados
				$('#tabPanelBottomOcorrencias a').click(function (e) {
					  e.preventDefault();
					  $(this).tab('show');
				});

				$('#form-associar-advogados').hide();
				$('#msg-associar-advogados').show();
				
				//Carrega os pontos do mapa
				loadMap();
			});

			
		    //Adiciona um advogado
	   		function addAdvogado(){
	   			$("#associar_advogado_origem option:selected").each(function () {
		   			$(this).removeAttr('selected');
               		$(this).remove().appendTo('#associar_advogado_destino');	               		             		
             	});
	   		}
	   		//Deleta um advogado
	   		function delAdvogado(){
		   		$("#associar_advogado_destino option:selected").each(function () {
		   			$(this).removeAttr('selected');
               		$(this).remove().appendTo('#associar_advogado_origem');	               			               		
		   		});
	   		}
	   		//Salva os advogados selecionados
	   		function saveAdvogado(){		
		   		localSelecionado = $('#local-selecionado').val();
	   			listaAdv = "";	   		
	   			$("#associar_advogado_destino option").each(function () {
	   				listaAdv = listaAdv +', ' + $(this).val();
	   			});
	   			if( listaAdv.length > 0 ) listaAdv=listaAdv.substr(1,listaAdv.length -1 );
	   			
	   			$.post("mapa.php", { "acao": "associar-advogados", "listaCodAdvg":listaAdv,"local":localSelecionado },
	   				 function(data){
	   					if(data.sucesso == 1){
	   						loadMap();
		   				   alert("Operação realizada com sucesso!");
	   				   }else{
	   					 alert("Erro! Tente novamente!");
	   				   }
	   				 }, "json");
	   		}

	   		function loadLocalVotacao(md5Local,marker,infowindow){
	   			markerLocal = marker;
	   			infoWindowLocal = infowindow;			

				$.get("mapa.php?acao=detalhes-local&local=" + md5Local,
					function(data){
						localLat = data.latitude ;
						localLong = data.longitude ;
						listaAdvogados = data.advogados;
						$('#ver-no-mapa').click(function(e){						
							$('#painel-controle-gmap3').gmap3('get').panTo(markerLocal.getPosition());
							var map = $('#painel-controle-gmap3').gmap3('get');
							var infowindow = $('#painel-controle-gmap3').gmap3({action:'get', name: 'infowindow'});
							if (infowindow){
								infowindow.open(map, markerLocal);
							}
						});
						$('#panel-local-txtnome').html(data.nome_local + " - " + data.endereco);
						$('#panel-local-txtsecoes').html(data.secoes);
						$('#panel-local-txttotaleleitores').html(data.total_votantes);

						$("#local-table-advogados tr").each(function () {
	   			   			$(this).remove();	               		             		
	   			     	});

						$('#local-table-advogados').append('<tr><th>Nome</th><th>OAB</th><th>Email</th><th>Telefones</th></tr>');

						for(i = 0 ; i < listaAdvogados.length ; i++) {
							telefones = formatPhone(listaAdvogados[i].celular1);

							if(listaAdvogados[i].celular2 > 0 ) {	
								telefones =	telefones + ' / ' +   formatPhone(listaAdvogados[i].celular2);
							}
							if(listaAdvogados[i].tel_residencial > 0){	
								telefones =	telefones + ' / ' +   formatPhone(listaAdvogados[i].tel_residencial);
							}
							if(listaAdvogados[i].tel_comercial > 0){	
								telefones =	telefones + ' / ' +   formatPhone(listaAdvogados[i].tel_comercial);
							}
							
							$('#local-table-advogados').append('<tr><td>'+listaAdvogados[i].nome+'</td><td>'+listaAdvogados[i].oab+'</td><td>'+listaAdvogados[i].email1+'</td><td>'+telefones+'</td></tr>');
						}
						
						//Mostra os detahes do local
			   			$('#panel-local-detalhes').show();
				}, "json");		
				
	   			//Lista dos advogados que ainda nao estao no local
	   			$('#local-selecionado').val(md5Local);
	   			$.get("mapa.php?acao=lista-advogados&local=" + md5Local,
	   				function(data){
	   					$("#associar_advogado_origem option").each(function () {
	   			   			$(this).removeAttr('selected');
	   			       		$(this).remove();	               		             		
	   			     	});
	   					$("#associar_advogado_destino option").each(function () {
	   			   			$(this).removeAttr('selected');
	   			       		$(this).remove();	               		             		
	   			     	});
	   					var listOrigem = document.getElementById("associar_advogado_origem");
	   					var listDestino = document.getElementById("associar_advogado_destino");
	   					
	   					for(i=0;i<data.length;i++) {
		   					if (data[i].total == 0 ){
	   							listOrigem.add(new Option(data[i].nome, data[i].cod_advogado));
		   					}else{
		   						listDestino.add(new Option(data[i].nome, data[i].cod_advogado));
		   					}		   					
	   					}
	   					//Mostra o formulario de associar advogados
	   		   			$('#form-associar-advogados').show();	
	   		   			   			
	   		   			//Esconde a mensagem padrao
	   					$('#msg-associar-advogados').hide();
	   					
	   					//Mostra a Aba de Associar Advogados
	   					$('#tabPanelBottomOcorrencias a[href="#tabAdvogados"]').tab('show');
	   			}, "json");		   			
	   			
	   		}

	   		function loadMap(){		
	   			$('#form-associar-advogados').hide();
				$('#msg-associar-advogados').show();
				$('#panel-local-detalhes').hide();
				
	   			$.get("mapa.php?acao=carregar-mapa",
	   				function(data){
	   					var dadosPontosMapa,lat,lng,local,total_pontos,total_adv,cod_local;
	   					var endereco,bairro,zona,total_votantes,todas_secoes;
	   					
	   					dadosPontosMapa = data;
	   					$('#painel-controle-gmap3').gmap3({action:'clear'});
	   					total_pontos = dadosPontosMapa.length;
	   					for (i = 0; i < total_pontos ; i++) {		
		   					
	   						lat = dadosPontosMapa[i].latitude;
	   						lng = dadosPontosMapa[i].longitude;	
	   						total_adv = dadosPontosMapa[i].total_adv;
	   						zona = dadosPontosMapa[i].zona;
	   						endereco = dadosPontosMapa[i].endereco;
	   						bairro = dadosPontosMapa[i].bairro;
	   						total_votantes = dadosPontosMapa[i].total_votantes;
	   						if (total_adv > 0){
	   							cor = "verde";	
	   						}else{
	   							cor = "preto";
	   						}				
	   						if(zona == 9999 ){
		   						 cor = "estrela";
	   						}	
	   						local = dadosPontosMapa[i].local;
	   						cod_local = dadosPontosMapa[i].cod_local;
	   						$('#painel-controle-gmap3').gmap3({ 
	   						    action: 'addMarker',
	   						    latLng:[lat, lng],
	   						    options:{
	   						      draggable: false,
	   						      icon: new google.maps.MarkerImage("http://diad.xlevel.inf.br/img/"+cor+".png")
	   						    },
	   						    data:[local,i,cod_local,endereco,bairro,total_votantes],
	   						    events:{
	   						    	click: function(marker, event, data){
	   						    		var map = $('#painel-controle-gmap3').gmap3('get');
	   						    		var infowindow = $('#painel-controle-gmap3').gmap3({action:'get', name: 'infowindow'});
	   						    		var conteudo;
	   						    		conteudo = "<b>"+data[0]+"</b>"+ "<br/>" +data[3] + " - " + data[4];
	   						    		conteudo = conteudo + "<br/> Total: " +data[5] + " eleitores.";
	   						    		if (infowindow){
	   							    		infowindow.open(map, marker);
	   						    			infowindow.setContent(conteudo);
	   						    		} else {
	   						    			$('#painel-controle-gmap3').gmap3({action:'addinfowindow', anchor:marker, options:{content: conteudo }});
	   						    		}
	   						    		loadLocalVotacao(data[2],marker,infowindow);
	   						    	}
	   					    	}
	   						    			   
	   						});					
	   					}
	   			}, "json");	
	   				
	   		}
		</script>
	</body>
</html>
