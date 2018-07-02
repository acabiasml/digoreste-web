<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
   exit;
}

include "conexao.php";

$email = $_POST["email"];

$sql = "SELECT * FROM usuario WHERE email = '$email'";
$consulta = $conexao->query($sql);

$resposta = [];

if($consulta->rowCount() > 0){
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
    
    $subject = 'Digoreste - Lembre de senha';
    $from = 'acabiasmarques@ufmt.br';
    $to = $linha["email"];
    $bcc = null; 
    $cc = null;
    $message = "Sua senha é". $linha["senha"];

    $headers = sprintf( 'Date: %s%s', date( "D, d M Y H:i:s O" ), PHP_EOL );
    $headers .= sprintf( 'Return-Path: %s%s', $from, PHP_EOL );
    $headers .= sprintf( 'To: %s%s', $to, PHP_EOL );
    $headers .= sprintf( 'Cc: %s%s', $cc, PHP_EOL );
    $headers .= sprintf( 'Bcc: %s%s', $bcc, PHP_EOL );
    $headers .= sprintf( 'From: %s%s', $from, PHP_EOL );
    $headers .= sprintf( 'Reply-To: %s%s', $from, PHP_EOL );
    $headers .= sprintf( 'Message-ID: <%s@%s>%s', md5( uniqid( rand( ), true ) ), $_SERVER[ 'HTTP_HOST' ], PHP_EOL );
    $headers .= sprintf( 'X-Priority: %d%s', 3, PHP_EOL );
    $headers .= sprintf( 'X-Mailer: PHP/%s%s', phpversion( ), PHP_EOL );
    $headers .= sprintf( 'Disposition-Notification-To: %s%s', $from, PHP_EOL );
    $headers .= sprintf( 'MIME-Version: 1.0%s', PHP_EOL );
    $headers .= sprintf( 'Content-Transfer-Encoding: 8bit%s', PHP_EOL );
    $headers .= sprintf( 'Content-Type: text/html; charset="iso-8859-1"%s', PHP_EOL );

    mail( null, $subject, $message, $headers );

    $resposta["status"] = "ok";
    $resposta["mensagem"] = $linha;
}else{
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "$sql";   
}

echo json_encode($resposta);

