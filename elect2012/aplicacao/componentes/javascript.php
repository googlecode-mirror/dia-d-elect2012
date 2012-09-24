<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src='./js/jquery.mask.min.js'></script>
<script type="text/javascript" src='./js/jquery.validate.min.js'></script>
<script type="text/javascript" src="./js/jquery-validate/localization/messages_ptbr.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/dt_bootstrap.js"></script>

<script type="text/javascript">

$(function() {
	$('.mask-date').mask('11/11/1111');
	$('.mask-time').mask('00:00:00');
	$('.mask-date_time').mask('99/99/9999 00:00:00');
	$('.mask-cep').mask('99999-999');
	$('.mask-phone').mask('9999-9999');
	$('.mask-phone_with_ddd').mask('(99) 9999-9999');
	$('.mask-cpf').mask('999.999.999-99', {reverse: true});

	

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

});
</script>

<script>

$(window).load(function(){
  $('#container-principal').fadeIn(2000);
  $('#dvLoading').fadeOut(2000);
});

</script>
