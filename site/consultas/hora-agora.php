<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

date_default_timezone_set("America/Cuiaba");
$agora = date("Y-m-d H:i:s");

$resposta = [];
$resposta["status"] = "ok";
$resposta["mensagem"] = $agora;

echo json_encode($resposta);