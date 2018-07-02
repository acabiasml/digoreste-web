<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT * FROM questao WHERE id IN (SELECT DISTINCT pergunta_id FROM questionario WHERE desafio_id = ".$_POST["desafio"].") ORDER BY RAND() LIMIT 1";
$consulta = $conexao->prepare($sql); 
$consulta->execute();

$resposta = [];

if($consulta->rowCount() > 0){
    $registros = $consulta->fetchAll();
    
    $fim = [];
    
    foreach($registros as $linha){
        $sql2 = "SELECT * FROM opcao WHERE descricao != '' AND questao_id = ".$linha["id"]." ORDER BY RAND() LIMIT 6";
        $consulta2 = $conexao->query($sql2);
        $linha["opcoes"] = $consulta2->fetchAll();
        array_push($fim, $linha);
    }
    
    $resposta["status"] = "ok";
    $resposta["mensagem"] = $fim;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);