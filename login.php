<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
$consulta = $conexao->query($sql);

$resposta = [];

if($consulta->rowCount() > 0){
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
    $resposta["status"] = "ok";
    $resposta["mensagem"] = $linha;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);

