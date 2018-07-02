<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];

$sql = "INSERT INTO usuario(nome,
            email,
            senha,
            perfil_id) VALUES (
            :filmNome, 
            :filmEmail, 
            :filmSenha, 
            3)";

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$stmt = $conexao->prepare($sql);
                                              
$stmt->bindParam(":filmNome", $_POST["nome"], PDO::PARAM_STR);       
$stmt->bindParam(":filmSenha", $_POST["senha"], PDO::PARAM_STR); 
$stmt->bindParam(":filmEmail", $_POST["email"], PDO::PARAM_STR);   
                                      
$stmt->execute(); 
$novoId = $conexao->lastInsertId();

if($novoId > 0){
    $resposta["status"] = "ok";
    $resposta["mensagem"] = "Novo usuário inserido com sucesso. ID: ".$novoId;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = $conexao->errorInfo();
}

echo json_encode($resposta);

