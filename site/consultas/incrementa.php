<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "UPDATE tentativa SET pontos = ".$_POST["pontos"]." WHERE id = ".$_POST["tentativa"];
$consulta = $conexao->prepare($sql);
$consulta->execute(); 

$resposta["status"] = "ok";

echo json_encode($resposta);

