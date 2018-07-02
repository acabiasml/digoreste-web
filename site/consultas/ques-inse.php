<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";
$resposta = [];
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$sql = "INSERT INTO questao(descricao,
            aprovacao,
            imagem,
            dica,
            formula,
            tema_id,
            usuario_id) VALUES (
            :filmDescricao, 
            0, 
            '0',
            :filmDica,
            '0',
            :filmTema,
            :filmUsuario)";

$consulta = $conexao->prepare($sql);
                                              
$consulta->bindParam(":filmDescricao", $_POST["descricao"], PDO::PARAM_STR);
$consulta->bindParam(":filmDica", $_POST["dica"], PDO::PARAM_STR);  
$consulta->bindParam(":filmTema", $_POST["tema"], PDO::PARAM_INT); 
$consulta->bindParam(":filmUsuario", $_POST["usuario"], PDO::PARAM_INT); 
                                      
$consulta->execute(); 

$idquestao = $conexao->lastInsertId();

$sql2 = "INSERT INTO opcao(descricao,
            correta,
            questao_id) VALUES (
            :filmDescricao, 
            :filmCorreta, 
            $idquestao)";

$consulta2 = $conexao->prepare($sql2);


for($i = 1; $i<6; $i++){
    $desccont = "desc".$i;
    $alternat = "alt".$i;
    $sim = "s";
    $nao = "n";
    
    if($_POST[$desccont] != ""){
        $consulta2->bindParam(":filmDescricao", $_POST[$desccont], PDO::PARAM_STR);

        if($_POST["correto"] == $alternat){
            $consulta2->bindParam(":filmCorreta", $sim, PDO::PARAM_STR);        
        }else{
            $consulta2->bindParam(":filmCorreta", $nao, PDO::PARAM_STR);
        }

        $consulta2->execute();
    }
}

$resposta["status"] = "ok";

echo json_encode($resposta);

