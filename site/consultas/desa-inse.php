<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "INSERT INTO desafio (inicio, fim, maxtentativas, turma_id) VALUES (
            :filmInicio, :filmFim, :filmMaxtentativas, :filmTurma)";

$consulta = $conexao->prepare($sql);

$datahorainicio = date("Y-m-d H:i:s", strtotime($_POST["inicio"]));
$datahorafim = date("Y-m-d H:i:s", strtotime($_POST["fim"]));

$consulta->bindParam(":filmInicio", $datahorainicio , PDO::PARAM_STR);
$consulta->bindParam(":filmFim", $datahorafim, PDO::PARAM_STR);
$consulta->bindParam(":filmMaxtentativas", $_POST["tentativas"], PDO::PARAM_INT);
$consulta->bindParam(":filmTurma", $_POST["id"], PDO::PARAM_INT); 
                                      
$consulta->execute(); 

$idques = $conexao->lastInsertId();

$sql2 = "SELECT * FROM questao WHERE tema_id = :filmTema";
$consulta2 = $conexao->prepare($sql2);                                    
$consulta2->bindParam(":filmTema", $_POST["tema"], PDO::PARAM_STR);
$consulta2->execute(); 

if($consulta2->rowCount() > 0){
    $registros = $consulta2->fetchAll();
    
    foreach($registros as $linha){
        $sql3 = "INSERT INTO questionario(desafio_id, desafio_turma_id, pergunta_id) VALUES (:filmDesaId, :filmTurma, :filmPerg)";
        $consulta3 = $conexao->prepare($sql3);                            
        //:filmDesaId, :filmTurma, :filmPerg
        $consulta3->bindParam(":filmDesaId", $idques, PDO::PARAM_INT);
        $consulta3->bindParam(":filmTurma", $_POST["id"], PDO::PARAM_INT); 
        $consulta3->bindParam(":filmPerg", $linha["id"], PDO::PARAM_INT);        
        $consulta3->execute(); 
    }
}

$resposta["status"] = "ok";

echo json_encode($resposta);

