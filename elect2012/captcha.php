<?php
	include "aplicacao/boot.php";   
    $largura = 140; // recebe a largura
    $altura = 40; // recebe a altura
    $tamanho_fonte = 18; // recebe o tamanho da fonte
    $quantidade_letras = 6; // recebe a quantidade de letras que o captcha terá
    aplicacao::captcha($largura,$altura,$tamanho_fonte,$quantidade_letras); // executa a funcao captcha passando os parametros recebidos
?>

