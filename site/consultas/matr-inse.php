<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


$sql = "SELECT * FROM turma WHERE id = :filmTurma AND senha = :filmSenha";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmTurma", $_POST["turma"], PDO::PARAM_INT); 
$consulta->bindParam(":filmSenha", $_POST["senha"], PDO::PARAM_STR); 
$consulta->execute();

$resposta = [];

if($consulta->rowCount() > 0){
    
    $sql2 = "INSERT INTO matricula(turma_id, usuario_id) VALUES (:filmTurma, :filmUsuario)";
    $consulta = $conexao->prepare($sql2);
    $consulta->bindParam(":filmTurma", $_POST["turma"], PDO::PARAM_INT); 
    $consulta->bindParam(":filmUsuario", $_POST["usuario"], PDO::PARAM_INT); 
    $consulta->execute();
    
    $resposta["status"] = "ok";
    $resposta["mensagem"] = "$sql2";
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);

