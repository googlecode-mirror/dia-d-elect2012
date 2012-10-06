<!-- <div id="dvLoading"><img src="img/loading.gif"> carregando...</div> -->
<?php if (aplicacao::isUsuarioLogado()): ?>
	<div class="navbar  navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php">Dia D</a>
				
				<div class="nav-collapse collapse">				
						<ul class="nav">					
							<li ><a href="painel-controle.php"><i class="icon-white icon-eye-open"></i> Painel de Controle</a></li>
							<li><a href="pesquisa-urna.php"><i class="icon-white icon-comment"></i> Pesquisa de Urna</a></li>
							<li><a href="advogados.php"><i class="icon-white icon-briefcase"></i> Advogados</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-wrench"></i> Administração <b class="caret"></b></a>
								<ul class="dropdown-menu">           
									<li><a href="candidatos.php">Candidatos</a></li>
									<li><a href="locais.php">Localidades</a></li>           
									<li><a href="secoes.php">Seções</a></li> 
									<li><a href="locais-votacao.php">Locais de Votação</a></li> 									
									<li><a href="usuarios.php">Usuários</a></li>  
								</ul>
							</li><!--
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-print"></i> Relatórios <b class="caret"></b></a>
								<ul class="dropdown-menu">           
									<li><a href="#">Substabelecimentos</a></li>
									<li><a href="#">Locais de Trabalho</a></li>   
								</ul>
							</li>-->
						</ul>	
						<ul class="nav pull-right">					
							<li><a><strong><?php print aplicacao::getUsuarioLogado()->nome; ?></strong></a></li>
							<li><a href="sair.php"><i class="icon icon-white icon-off"></i> Sair</a></li>
						</ul>	
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
<?php else:?>
	<div class="navbar  navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php">Dia D</a>
				
				<div class="nav-collapse collapse">								
					<form class="navbar-form pull-right form-inline" action="index.php" method="POST" >
						<div class="input-prepend">
					      <span class="add-on" style="background-color: darkred; border-color: darkred;"><i class=" icon-white icon-user"></i></span>
					      <input autocomplete="off" class="input-medium" name="login" id="inputIcon" type="text" placeholder="Usuário" style=" border-color: darkred;">
					    </div>
					    <div class="input-prepend">
							<span class="add-on" style="background-color: darkred; border-color: darkred;"><i class=" icon-white icon-lock"></i></span>
							<input autocomplete="off" class="input-medium" name="senha" id="inputIcon" type="password" placeholder="Senha" style=" border-color: darkred;">
						</div>
						<input type="hidden" name="acao" value="login" />
						<button type="submit" class="btn btn-primary">Entrar</button>
					</form>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
<?php endif;?>

