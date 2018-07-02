<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "DELETE FROM questionario WHERE desafio_turma_id = :filmId";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmId", $_POST["id"], PDO::PARAM_INT);      
$consulta->execute();

$sql2 = "DELETE FROM desafio WHERE turma_id = :filmId";
$consulta2 = $conexao->prepare($sql2);
$consulta2->bindParam(":filmId", $_POST["id"], PDO::PARAM_INT);                                  
$consulta2->execute();

$sql3 = "DELETE tentativa, matricula FROM tentativa, matricula WHERE tentativa.matricula_id = matricula.id AND matricula.turma_id = :filmId";
$consulta3 = $conexao->prepare($sql3);
$consulta3->bindParam(":filmId", $_POST["id"], PDO::PARAM_INT);                                  
$consulta3->execute();

$sql4 = "DELETE FROM turma WHERE id = :filmId";
$consulta4 = $conexao->prepare($sql4);
$consulta4->bindParam(":filmId", $_POST["id"], PDO::PARAM_INT);                                  
$consulta4->execute();

$resposta = [];
$resposta["status"] = "ok";

echo json_encode($resposta);