<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT * FROM turma WHERE usuario_id = :filmUsuario";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmUsuario", $_POST["usuario"], PDO::PARAM_INT); 
$consulta->execute();

$resposta = [];

if($consulta->rowCount() > 0){
    $registros = $consulta->fetchAll();
    
    $fim = [];
    
    foreach($registros as $linha){
        $sql2 = "SELECT * FROM desafio WHERE turma_id = ".$linha["id"];
        $consulta2 = $conexao->query($sql2);
        $linha["desafios"] = $consulta2->fetchAll();
        array_push($fim, $linha);
    }
    
    $resposta["status"] = "ok";
    $resposta["mensagem"] = $fim;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);