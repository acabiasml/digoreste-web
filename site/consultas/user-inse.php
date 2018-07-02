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
            :filmPerfil)";

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$consulta = $conexao->prepare($sql);
                                              
$consulta->bindParam(":filmNome", $_POST["nome"], PDO::PARAM_STR);
$consulta->bindParam(":filmEmail", $_POST["email"], PDO::PARAM_STR);  
$consulta->bindParam(":filmSenha", $_POST["senha"], PDO::PARAM_STR); 
$consulta->bindParam(":filmPerfil", $_POST["perfil"], PDO::PARAM_INT); 
                                      
$consulta->execute(); 

$resposta = [];
$resposta["status"] = "ok";

echo json_encode($resposta);

