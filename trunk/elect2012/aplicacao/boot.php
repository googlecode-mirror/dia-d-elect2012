<?php
// INICIO DE TODAS AS PAGINAS
session_start();
include "bibliotecas/aplicacao.php";
include "bibliotecas/banco.php";
include "bibliotecas/utils.php";
include "bibliotecas/mensagem.php";
include "bibliotecas/gmaps.php";

banco::conectar();

aplicacao::verificaUsuarioLogado();