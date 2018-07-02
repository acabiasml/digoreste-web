<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "UPDATE questao SET aprovacao = 1 WHERE id = :filmId";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmId", $_POST["id"], PDO::PARAM_INT);  
$consulta->execute();

$resposta = [];
$resposta["status"] = "ok";

echo json_encode($resposta);