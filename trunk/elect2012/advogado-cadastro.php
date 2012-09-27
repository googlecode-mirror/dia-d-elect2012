<?php 
	include "aplicacao/boot.php"; 
	include "aplicacao/acoes/advogado-cadastro.php";
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
					    	Cadastro
					  </li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<?php print mensagem::exibir(); ?>
				</div>
			</div>
			<div class="row">
				<div class="span12">
						<form class="well" method="post" action="<?php print ($objeto)? "advogado-cadastro.php?codigo=".$objeto->cod_advogado:"advogado-cadastro.php"; ?>">
							<input type="hidden"  name="acao" value="<?php print ($objeto)? "editar":"novo"; ?>" />
							<input type="hidden"  name="codigo" value="<?php print ($objeto)? $objeto->cod_advogado:"0"; ?>" />
							<fieldset >
								<legend><?php print ($objeto)? "Editar":"Novo"; ?> Advogado</legend>
								
								<div class="control-group">
									<label class="control-label" >Nome</label>
									<div class="controls">
										<input type="text"  class="input-xxlarge required" name="nome" value="<?php  print ($objeto)? $objeto->nome:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >OAB</label>
									<div class="controls">
										<input type="text"  class="input-small required" name="oab" value="<?php print  ($objeto)? $objeto->oab:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Celular 1</label>
									<div class="controls">
										<input type="text"  class="input-medium required mask-phone_with_ddd" name="celular1" value="<?php print  ($objeto)? $objeto->celular1:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Celular 2</label>
									<div class="controls">
										<input type="text" class="input-medium required mask-phone_with_ddd" name="celular2" value="<?php print  ($objeto)? $objeto->celular2:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Telefone residencial</label>
									<div class="controls">
										<input type="text" class="input-medium required mask-phone_with_ddd" name="tel_residencial" value="<?php print  ($objeto)? $objeto->tel_residencial:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Telefone comercial</label>
									<div class="controls">
										<input type="text"  class="input-medium required mask-phone_with_ddd" name="tel_comercial" value="<?php print  ($objeto)? $objeto->tel_comercial:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >* Email 1</label>
									<div class="controls">
										<input type="text"  class="input-medium required email" name="email1" value="<?php print  ($objeto)? $objeto->email1:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Email 2</label>
									<div class="controls">
										<input type="text"  class="input-medium email" name="email2" value="<?php print  ($objeto)? $objeto->email2:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Indicação 1</label>
									<div class="controls">
										<input type="text"  class="input-large required" name="indicacao1" value="<?php print  ($objeto)? $objeto->indicacao1:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Indicação 2</label>
									<div class="controls">
										<input type="text"  class="input-large required" name="indicacao2" value="<?php print  ($objeto)? $objeto->indicacao2:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >CPF</label>
									<div class="controls">
										<input type="text"  class="input-medium required mask-cpf required" name="cpf" value="<?php print  ($objeto)? $objeto->cpf:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Título</label>
									<div class="controls">
										<input type="text"  class="input-medium required" name="titulo" value="<?php print  ($objeto)? $objeto->titulo:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Zona</label>
									<div class="controls">
										<input type="text"  class="input-mini required" name="zona" value="<?php print  ($objeto)? $objeto->zona:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Seção</label>
									<div class="controls">
										<input type="text"  class="input-mini required" name="secao" value="<?php print  ($objeto)? $objeto->secao:""; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="eleicoesAnt">Você já trabalhou como advogado em eleições anteriores?</label>
									<div class="controls">
										<label class="radio">
											<input type="radio" name="eleicoesAnt" value="1" <?php print($objeto->eleicoesAnt == "1")? "checked":""; ?>>Sim<br>
										</label>
										<label class="radio">										
											<input type="radio" name="eleicoesAnt" value="2" <?php print($objeto->eleicoesAnt == "2")? "checked":""; ?>>Não</label>
									</div>										      
								</div>
								<div class="control-group">
									<label class="control-label" for="eleicoesAntAnos">Em caso afirmativo, quais eleições?</label>
									<div class="controls">
										<label class="checkbox">
											<input type="checkbox" name="eleicoesAntAnos[]" value="2002" <?php print($objeto->eleicoesAntAnos == "2002")? "checked":""; ?>>2002
										</label>
										<label class="checkbox">										
											<input type="checkbox" name="eleicoesAntAnos[]" value="2004" <?php print($objeto->eleicoesAntAnos == "2004")? "checked":""; ?>>2004
										</label>
										<label class="checkbox">										
											<input type="checkbox" name="eleicoesAntAnos[]" value="2006" <?php print($objeto->eleicoesAntAnos == "2006")? "checked":""; ?>>2006
										</label>
										<label class="checkbox">										
											<input type="checkbox" name="eleicoesAntAnos[]" value="2008" <?php print($objeto->eleicoesAntAnos == "2008")? "checked":""; ?>>2008
										</label>
										<label class="checkbox">										
											<input type="checkbox" name="eleicoesAntAnos[]" value="2010" <?php print($objeto->eleicoesAntAnos == "2010")? "checked":""; ?>>2010
										</label>
									</div>										      
								</div>
								<div class="control-group">
									<label class="control-label" >Bairro preferencial para atuação</label>
									<div class="controls">
										<input type="text"  class="input-medium required" name="bairroPreferido1" value="<?php print $objeto->bairroPreferido1; ?>">
									</div>
								</div>
								<hr/>
								<div class="control-group">
									<label class="control-label" for="cep">* CEP</label>
									<div class="controls">
										<input type="text" class="input-medium mask-cep " id="cep" name="cep" value="<?php print  ($objeto)? $objeto->cep:"";  ?>">	
										<a id="correios" class="btn btn-primary"><i class="icon icon-white icon-globe"></i> Preencher endereço </a>										        
									</div>
								</div>
										   
								<div class="control-group">
									<label class="control-label" for="endereco">* Endereço</label>
									<div class="controls">
										<input type="text" class="input-xlarge required" id="endereco" name="endereco" readonly="true" value="<?php print  ($objeto)? $objeto->endereco:"";  ?>">											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="numero">* Numero</label>
									<div class="controls">
										<input type="text" class="span2 required" id="numero" name="numero" readonly="true" value="<?php print  ($objeto)? $objeto->numero:"";  ?>">											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="complemento">Complemento</label>
									<div class="controls">
										<input type="text" class="input-xlarge " id="complemento" name="complemento" readonly="true" value="<?php print  ($objeto)? $objeto->complemento:"";  ?>"> 											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="bairro">* Bairro</label>
									<div class="controls">
										<input type="text" class="input-medium required" id="bairro" name="bairro" readonly="true" value="<?php print  ($objeto)? $objeto->bairro:"";  ?>">											        
									</div>
								</div>
										    
								<div class="control-group">
									<label class="control-label" for="cidade">* Cidade</label>
									<div class="controls">
										<input type="text" class="input-medium required" id="cidade" name="cidade" readonly="true" value="<?php print  ($objeto)? $objeto->cidade:"";  ?>">											        
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="uf">* UF</label>
									<div class="controls">
										<input type="text" class="span1 required" id="uf" name="uf" readonly="true" value="<?php print  ($objeto)? $objeto->uf:"";  ?>">								        
									</div>										      
								</div>								
							</fieldset>	 
							<div class="form-actions">
								<button type="submit" class="btn btn-success">Salvar</button>
								<a class="btn" href="usuarios.php">Cancelar</a>
							</div>
							 	
						</form>		
				</div>
			</div>
			<?php include "aplicacao/componentes/rodape.php" ; ?>
		</div> <!-- /container -->
		
		
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>