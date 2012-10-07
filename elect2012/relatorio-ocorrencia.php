<?php 
	include "aplicacao/boot.php";
	$sql = "SELECT 
				cod_ocorrencia  as codigo,
				( SELECT local FROM secao s WHERE s.hash_local = o.cod_local LIMIT 0,1 ) as nome, 
				DATE_FORMAT( data_criacao,  '%d/%m/%y %H:%i' ) AS data, 
				autor ,
				descricao,
				status 
			FROM ocorrencia o
			WHERE status > 0 
			ORDER BY data_criacao DESC
			";
	 $lista = banco::listar($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		   <?php include "aplicacao/componentes/topo.php" ; ?>
	</head>

	<body>
		
		
		<div class="container" id="container-principal">
			<table  class="table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>Cód</th>
								<th>Data/Hora</th>
								<th>Local</th>
								<th>Reportado por</th>
								<th>Ocorrencia</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 												
								foreach($lista as $item){	
									$status = ($item->status == 1)?'Pendente':'Resolvido';																															
									print '<tr>';
									print '<td>'.$item->codigo.'</td>';
									print '<td>'.$item->data.'</td>';
									print '<td>'.$item->nome.'</td>';
									print '<td>'.$item->autor.'</td>';
									print '<td>'.$item->descricao.'</td>';
									print '<td>'.$status.'</td>';									
									print '</tr>';
								}
							?>							
						</tbody>
					</table>				
		</div> <!-- /container -->
		
		
		<?php include "aplicacao/componentes/javascript.php" ; ?>
	</body>
</html>