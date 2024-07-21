<?php
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';
// Exemplo de consulta SQL para selecionar informações do aluno

if(!isset($_SESSION['user_id'])){ //if login in session is not set
    header("Location:/?page=login");
}

$userId = $_SESSION['user_id'];

$sql = 'SELECT * 
		FROM useraccount 
		WHERE userLogin_UserID = :user_id';

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // Recupera o resultado da consulta
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

	} catch (PDOException $e) {
	die('Consulta falhou: ' . $e->getMessage());
	}
?>