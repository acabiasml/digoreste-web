<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT * FROM matricula LEFT JOIN usuario ON matricula.usuario_id = usuario.id WHERE turma_id = :filmTurma";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmTurma", $_POST["turma"], PDO::PARAM_INT); 
$consulta->execute();

$resposta = [];

if($consulta->rowCount() > 0){
    $registros = $consulta->fetchAll();
    $resposta["status"] = "ok";
    $resposta["mensagem"] = $registros;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);