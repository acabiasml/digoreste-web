<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "DELETE FROM matricula WHERE turma_id =".$_POST['turma']." AND usuario_id = ". $_POST['usuario'];
$consulta = $conexao->prepare($sql);
$consulta->execute();

$resposta = [];
$resposta["status"] = $sql;

echo json_encode($resposta);