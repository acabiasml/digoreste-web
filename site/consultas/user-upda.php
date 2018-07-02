<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "UPDATE usuario 
            SET 
            nome = :filmNome, 
            email = :filmEmail, 
            senha = :filmSenha, 
            perfil_id = :filmPerfil
            WHERE
            id = :filmId";

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$consulta = $conexao->prepare($sql);

$consulta->bindParam(":filmNome", $_POST["nome"], PDO::PARAM_STR); 
$consulta->bindParam(":filmEmail", $_POST["email"], PDO::PARAM_STR); 
$consulta->bindParam(":filmSenha", $_POST["senha"], PDO::PARAM_STR);
$consulta->bindParam(":filmPerfil", $_POST["perfil"], PDO::PARAM_INT);
$consulta->bindParam(":filmId", $_POST["id"], PDO::PARAM_INT);      
                                      
$consulta->execute();

$resposta = [];
$resposta["status"] = "ok";

echo json_encode($resposta);