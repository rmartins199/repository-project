<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

// Certifica que user tem um login efetuado
if(!isset($_SESSION['user_id'])){
    header("Location:/?page=login");
}

// Atribui valor a variavel $userId atraves da variavel armazenada na SESSION
$userId = $_SESSION['user_id'];

// Consulta de SQL para selecionar informações do aluno
$sql = 'SELECT * 
		FROM useraccount 
		WHERE userLogin_UserID = :user_id';

try {
    $stmt = $pdo->prepare($sql);
	// Bind dos parâmetros
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // Recupera o resultado da consulta
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

	} catch (PDOException $e) {
	die('Consulta falhou: ' . $e->getMessage());
	}
?>