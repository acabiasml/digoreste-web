<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "DELETE FROM desafio WHERE id = :filmId";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmId", $_POST["id"], PDO::PARAM_INT);      
$consulta->execute();

$resposta = [];
$resposta["status"] = "ok";

echo json_encode($resposta);