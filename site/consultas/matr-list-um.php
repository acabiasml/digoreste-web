<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT * FROM matricula LEFT JOIN turma ON turma.id = matricula.turma_id WHERE matricula.usuario_id = :filmUsuario";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmUsuario", $_POST["usuario"], PDO::PARAM_INT); 
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