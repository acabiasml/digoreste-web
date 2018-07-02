<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "INSERT INTO turma (senha,
            descricao,
            usuario_id) VALUES (
            :filmSenha,
            :filmDescricao,
            :filmUsuario)";

$consulta = $conexao->prepare($sql);
                                              
$consulta->bindParam(":filmDescricao", $_POST["descricao"], PDO::PARAM_STR);
$consulta->bindParam(":filmSenha", $_POST["senha"], PDO::PARAM_STR);
$consulta->bindParam(":filmUsuario", $_POST["usuario"], PDO::PARAM_INT); 
                                      
$consulta->execute(); 

$resposta["status"] = "ok";

echo json_encode($resposta);

