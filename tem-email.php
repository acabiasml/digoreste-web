<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT * FROM usuario WHERE email = :filmEmail";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmEmail", $_POST["email"], PDO::PARAM_INT); 
$consulta->execute();

$resposta = [];

if($consulta->rowCount() > 0){
    $resposta["status"] = "erro";
}else{
    $resposta["status"] = "ok";   
}

echo json_encode($resposta);