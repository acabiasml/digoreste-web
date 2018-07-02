<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

date_default_timezone_set("America/Cuiaba");
$inicio = date("Y-m-d H:i:s");

$sql = "SELECT * FROM desafio WHERE id = :filmDesafio";
$consulta = $conexao->prepare($sql);
$consulta->bindParam(":filmDesafio", $_POST["desafio"] , PDO::PARAM_INT);
$consulta->execute();

if($consulta->rowCount() > 0){
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
    
    $resposta["fim"] = $linha["fim"];
    
    $sql2 = "SELECT * FROM matricula WHERE turma_id = ".$linha["turma_id"]." AND usuario_id = ".$_POST["jogador"];
    $consulta2 = $conexao->prepare($sql2);
    $consulta2->execute();
    
    if($consulta2->rowCount() > 0){
        $linha2 = $consulta2->fetch(PDO::FETCH_ASSOC);
        $matricula = $linha2["id"];
        
        $resposta["matricula"] = $matricula;
        
        $sql3 = "INSERT INTO tentativa (inicio, desafio_id, matricula_id) VALUES (
            :filmInicio, :filmDesafio, :filmMatricula)";
        $consulta3 = $conexao->prepare($sql3);

        //echo $sql3." ".$inicio." ".$_POST["desafio"]." ".$matricula;
        
        $consulta3->bindParam(":filmInicio", $inicio , PDO::PARAM_STR);
        $consulta3->bindParam(":filmDesafio", $_POST["desafio"], PDO::PARAM_INT);
        $consulta3->bindParam(":filmMatricula", $matricula, PDO::PARAM_INT); 

        $consulta3->execute();
        
        $idtentativa = $conexao->lastInsertId();
        
        $resposta["tentativa"] = $idtentativa;
    }
}

$resposta["status"] = "ok";

echo json_encode($resposta);

