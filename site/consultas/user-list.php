<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT * FROM usuario LEFT JOIN perfil as p ON (usuario.perfil_id = p.id) WHERE perfil_id NOT IN ('1')";
$consulta = $conexao->query($sql);

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