<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tiwmrepo";
$port = 3306;

try{
    //Conexão com a porta
    //$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

    //Conexão sem a porta
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexão com banco de dados realizado com sucesso!";
}  catch(PDOException $e){
    echo "Erro: Conexão com base de dados não realizada com sucesso. Erro gerado " . $e->getMessage();
}
?>