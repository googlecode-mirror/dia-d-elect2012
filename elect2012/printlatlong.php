<?php
include "aplicacao/boot.php";
$endereco = '313, 243 - Conjunto Ceará Fortaleza - CE, 60530-620';
$result = gmaps::getLatLong($endereco);
var_dump($result);