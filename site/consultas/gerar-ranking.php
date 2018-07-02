<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT DISTINCT matricula_id FROM tentativa WHERE desafio_id = :filmDesafio";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmDesafio", $_POST["id"], PDO::PARAM_INT); 
$consulta->execute();

$resposta = [];

if($consulta->rowCount() > 0){
    $registros = $consulta->fetchAll();
    
    $fim = [];
    
    foreach($registros as $linha){
        $sql2 = "SELECT * FROM tentativa WHERE desafio_id = :filmDesafio AND matricula_id = ".$linha["matricula_id"]." ORDER BY pontos DESC LIMIT 1";
        $consulta2 = $conexao->prepare($sql2);
        $consulta2->bindParam(":filmDesafio", $_POST["id"], PDO::PARAM_INT); 
        $consulta2->execute(); 
        
        if($consulta2->rowCount() > 0){
            $linha2 = $consulta2->fetch(PDO::FETCH_ASSOC);
            
            $sql3 = "SELECT usuario.nome, tentativa.pontos FROM usuario LEFT JOIN matricula ON usuario.id = matricula.usuario_id LEFT JOIN tentativa ON tentativa.matricula_id = matricula.id WHERE tentativa.id = ".$linha2["id"];
            $consulta3 = $conexao->query($sql3);
            $respostafim = $consulta3->fetch(PDO::FETCH_ASSOC);
            
            array_push($fim, $respostafim);
        }
    }
    
    $resposta["status"] = "ok";
    $resposta["mensagem"] = $fim;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);