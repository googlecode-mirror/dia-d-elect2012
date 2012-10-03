<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src='./js/jquery.mask.min.js'></script>
<script type="text/javascript" src='./js/jquery.validate.min.js'></script>
<script type="text/javascript" src="./js/jquery-validate/localization/messages_ptbr.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/dt_bootstrap.js"></script>
<script type="text/javascript" src="./js/app.js"></script>


<script type="text/javascript">
$(function() {
	$("#painel-controle-gmap3").gmap3({
			action:'init',
			options:{
				center:[-3.7183943,-38.5433948],
				zoom: 13
			},
			callback: function(){
	            $('#refresh-map').click(refreshMapa);
	          }		
	});

			
	$('#minimize').click(function (e) {
		$('#local-detalhes').hide();
	})
	
	$('#maximize').click(function (e) {
		$('#local-detalhes').show();
	})
	
	$('#tabPanelBottomOcorrencias a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
	})
	
	$('.mask-date').mask('11/11/1111');
	$('.mask-time').mask('00:00:00');
	$('.mask-date_time').mask('99/99/9999 00:00:00');
	$('.mask-cep').mask('99999-999');
	$('.mask-phone').mask('9999-9999');
	$('.mask-phone_with_ddd').mask('(99) 9999-9999');
	$('.mask-cpf').mask('999.999.999-99', {reverse: true});

	$('a[rel=tooltip]').tooltip({placement:'top'});

	$('#refresh_captcha').click(function() {
		$('#captcha').attr('src', $('#captcha').attr('src')+'?var='+Math.random());
	});

	$('#subirTopo').click(function() {
			window.scrollTo( 0, 0) ;
	});

	$('#correios').click(function() {
		$.get("correios.php?cep="+$('#cep').val(),
				function(data){
					if (data.sucesso == 1){
						$('#endereco').attr('value',data.tipo + ' ' + data.logradouro);
						$('#bairro').attr('value',data.bairro);
						$('#cidade').attr('value',data.cidade);
						$('#uf').attr('value',data.uf);
						//$("select[name='uf'] option[value='"+data.uf+"']").attr('selected','selected');
						$('#numero').removeAttr('readonly');
						$('#complemento').removeAttr('readonly');
						$('#numero').focus();
					}else{
						alert(data.erro);
					}
				}, "json");

			
	});

	$("#validateForm").validate();	

	//TODO: Carregar Secoes
	$("#cmbLocalOcorrencias").change(function () {
      
    });					 

	refreshMapa();
	
});

function carregarDadosLocal(local){
	//TODO - lista dos advogados que ainda nao estao no local
	$.get("mapa.php?acao=lista-advogados-nao-local&local=" + urlencode(local),
		function(data){
			var list = document.getElementById("associar_advogado_origem");
			for(i=0;i<data.length;i++) {
				list.add(new Option(data[i].nome, data[i].cod_advogado));
			}
	}, "json");	
	
	//TODO - lista dos advogdaos que estao no local
	$.get("mapa.php?acao=lista-advogados-local&local=" + urlencode(local),
		function(data){
			var list = document.getElementById("associar_advogado_destino");
			for(i=0;i<data.length;i++) {
				list.add(new Option(data[i].nome, data[i].cod_advogado));
			}
		}, "json");	
	
}

function refreshMapa(){		
	$.get("mapa.php?acao=carregar-mapa",
		function(data){
			var dadosPontosMapa,lat,lng,local,total_pontos,total_adv;
			
			dadosPontosMapa = data;
			$('#painel-controle-gmap3').gmap3({action:'clear'});
			total_pontos = dadosPontosMapa.length;
			for (i = 0; i < total_pontos ; i++) {		
				lat = dadosPontosMapa[i].latitude;
				lng = dadosPontosMapa[i].longitude;	
				total_adv = dadosPontosMapa[i].total_adv;
				if (total_adv > 0){
					cor = 3;	
				}else{
					cor = 4;
				}					
				local = dadosPontosMapa[i].local;
				$('#painel-controle-gmap3').gmap3({ 
				    action: 'addMarker',
				    latLng:[lat, lng],
				    options:{
				      draggable: false,
				      icon: new google.maps.MarkerImage("http://diad.xlevel.inf.br/img/gmap_pin"+cor+".png")
				    },
				    data:[local,i],
				    events:{
				    	click: function(marker, event, data){
				    		var map = $('#painel-controle-gmap3').gmap3('get');
				    		var infowindow = $('#painel-controle-gmap3').gmap3({action:'get', name: 'infowindow'});
				    		if (infowindow){
					    		infowindow.open(map, marker);
				    			infowindow.setContent(data[0]);
				    		} else {
				    			$('#painel-controle-gmap3').gmap3({action:'addinfowindow', anchor:marker, options:{content: data[0]}});
				    		}
				    		carregarDadosLocal(data[0]);
				    	}
			    	}
				    			   
				});					
			}
	}, "json");	
		
}

</script>

<script>

/* Problemas com o GMAP 
$(window).load(function(){
  $('#container-principal').fadeIn(2000);
  $('#dvLoading').fadeOut(2000);
});
*/

</script>
