<?php
	include "aplicacao/boot.php";   
    $cep = aplicacao::getParam('cep'); 
    if (!is_null($cep))  print aplicacao::getEnderecoCorreios($cep);
?>

