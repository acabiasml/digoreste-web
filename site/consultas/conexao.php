<?php

define('SERVER', 'localhost');
define('BANCO', 'digoreste');
define('SENHA', '');
define('USER', 'root');
 
try{
    $conexao = new pdo('mysql:host=' . SERVER . ';dbname=' . BANCO, USER, SENHA, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}catch(PDOException $e){
    echo "Erro gerado " . $e->getMessage(); 
}