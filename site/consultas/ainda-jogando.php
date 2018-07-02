<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

date_default_timezone_set("America/Cuiaba");
$agora = date("Y-m-d H:i:s");

$sql = "UPDATE tentativa SET fim = '$agora' WHERE id = ".$_POST["tentativa"];
$consulta = $conexao->prepare($sql);
$consulta->execute(); 

$resposta["status"] = "ok";

echo json_encode($resposta);

