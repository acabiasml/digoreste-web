<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$sql = "SELECT t1.id, t1.descricao AS pergunta, t1.aprovacao, t1.dica, t1.tema_id AS idtema, t2.descricao AS otema, t3.id AS iduser,  t3.nome AS ouser
FROM questao AS t1
LEFT JOIN tema AS t2
ON t1.tema_id = t2.id
LEFT JOIN usuario AS t3
ON t1.usuario_id = t3.id
WHERE t1.aprovacao = 1;";
$consulta = $conexao->query($sql);

$resposta = [];

if($consulta->rowCount() > 0){
    $registros = $consulta->fetchAll();
    
    $fim = [];
    
    foreach($registros as $linha){
        $sql2 = "SELECT * FROM opcao WHERE descricao != ''  AND questao_id = ".$linha["id"];
        $consulta2 = $conexao->query($sql2);
        $opcoes = $consulta2->fetchAll();
        $linha["opcoes"] = $opcoes;
        array_push($fim, $linha);
    }
    
    $resposta["status"] = "ok";
    $resposta["mensagem"] = $fim;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);