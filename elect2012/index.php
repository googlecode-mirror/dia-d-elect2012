<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/index.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
	    <?php include "aplicacao/componentes/topo.php"; ?>
	</head>
	<body>
		<?php include "aplicacao/componentes/menu.php" ; ?>
		<div class="container" id="container-principal">  
			<?php print mensagem::exibir(); ?>   
			<div class="row">
				<div class="span2"><img src="img/logo.png"></div>
				<div class="span10">
					<h1>Dia D - Eleições 2012</h1>
					<p><em>Gerenciamento das ocorrências, pesquisa de urna e advogados em locais de votação.</em></p>
					<p><a class="btn btn-primary btn-large" href="pre-cadastro.php"> <i class="icon-white icon-briefcase"></i> Cadastrar advogado »</a></p>
					
				</div>        		
			</div>
			<div class="row">
				<div class="span4">
					<h2 style="border-bottom: 1px solid lightgray;">Eleições 2012</h2>
					<p style="text-align: justify;">
          				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Em 2012, serão realizadas as eleições municipais tanto para o âmbito do poder executivo (prefeitos) quanto para o poder legislativo (vereadores). Para candidatos torna-se indispensável o uso da tecnologia e redes sociais durante o período eleitoral, bem como para os meses que o antecedem. 
          			</p>
          			<p style="text-align: justify;">
          				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Além disso, o conhecimento técnico sobre organização de campanhas eleitorais, comunicação eleitoral na internet e sobre a legislação que regulamenta a disputa, aproxima a campanha do candidato com seu eleitorado. 
          			</p>
        		</div>
	        	<div class="span4">
	         		<h2 style="border-bottom: 1px solid lightgray;">Funcionalidades</h2>
					<ul>
			          	<li>Painel de controle geo-espacial (google maps) para gerenciamento de ocorrências e alocação de advogados;</li>
			          	<li>Pesquisa de Boca de Urna;</li>
			          	<li>Cadastros de Usuários;</li>
			          	<li>Cadastros de Advogados;</li>
			          	<li>Cadastros de Candidatos (vereadores / prefeitos);</li>
			          	<li>Cadastros de Seções, Locais e Zonas;</li>
					</ul>
	        	</div>
	        	<div class="span4">
	          		<h2 style="border-bottom: 1px solid lightgray;">Tecnologias</h2>         
	          		<img src="img/arquitetura.jpg" />
	          		<p style="text-align: right;margin-right:10px;"><small>Linux, Apache, PHP, Mysql, Bootstrap, Jquery.</small></p>
				</div>        
			</div>

      		<?php include "aplicacao/componentes/rodape.php" ; ?>

		</div> <!-- /container -->
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>