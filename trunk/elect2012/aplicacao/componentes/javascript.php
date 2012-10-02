<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src='./js/jquery.mask.min.js'></script>
<script type="text/javascript" src='./js/jquery.validate.min.js'></script>
<script type="text/javascript" src="./js/jquery-validate/localization/messages_ptbr.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/dt_bootstrap.js"></script>


<script type="text/javascript">

function refreshMapa(){
	var map = $('#painel-controle-gmap3').gmap3('get'),
    sw = map.getBounds().getSouthWest(),
    ne = map.getBounds().getNorthEast(),
    i;
	for (i = 0; i < 10; i++) {
	  setTimeout(function() {
	    var lat = Math.random() * (ne.lat() - sw.lat()) + sw.lat(),
	        lng = Math.random() * (ne.lng() - sw.lng()) + sw.lng();
	    $('#painel-controle-gmap3').gmap3({ 
	      action: 'addMarker',
	      latLng:[lat, lng],
	      options:{
	        draggable: true,
	        animation: google.maps.Animation.DROP
	      }
	    });
	  }, i * 200);
	}
}

$(function() {
	$("#painel-controle-gmap3").gmap3(
		{
			action:'init',
			options:{
				center:[-3.7183943,-38.5433948],
				zoom: 13
			},
			callback: function(){
	            $('#refresh-map').click(refreshMapa);
	          }
		
		}
	);
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

});
</script>

<script>

/* Problemas com o GMAP 
$(window).load(function(){
  $('#container-principal').fadeIn(2000);
  $('#dvLoading').fadeOut(2000);
});
*/

</script>
