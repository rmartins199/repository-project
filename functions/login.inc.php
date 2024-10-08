<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
	$email = $_POST["email"];
	$passwordhash = $_POST["passwordhash"];
	
	try{
		require_once 'db.inc.php';
		require_once '../controllers/login_controller.inc.php';
		require_once '../models/login_model.inc.php';
		
		// CONTROLADOR DE ERROS
		$errors = [];
		
		if (is_input_empty($email, $passwordhash)){
			$errors["empty_input"] = "Preenche todos os campos!";
		}
		if (is_email_invalid($email)){
			$errors["login_incorrect"] = "Email utilizado está invalido!";
		}
		
		$result = get_email($pdo, $email);
		
		if(is_email_wrong($result)){
			$errors["login_incorrect"] = "Email está incorreto!";
		}
		
		if(!is_email_wrong($result) && is_password_wrong($passwordhash, $result["PasswordHash"])){
			$errors["login_incorrect"] = "Email ou Password incorreta!";
		}
		
		require_once 'config_session.inc.php';
		
		if ($errors){
			$_SESSION["errors_login"] = $errors;

			header("Location:/?page=login");
			die();
		}
		
		// Fecha a sessão atual se estiver ativa
		if (session_status() == PHP_SESSION_ACTIVE) {
    		session_write_close();
		}
		
		// Cria um novo ID de sessão e o define com o ID do utilizador
		$newSessionId = session_create_id();
		$sessionId = $newSessionId . "_" . $result["UserID"];
		session_id($sessionId);
		
		// Certifica que a sessão está iniciada
		session_start();
		
		// Armazena informações do usuário na sessão
		$_SESSION["user_id"] = $result["UserID"];
		$_SESSION["user_email"] = htmlspecialchars($result["UserEmail"]);
		$_SESSION["user_nome"] = htmlspecialchars($result["UserFName"]);
		$_SESSION["last_regeneration"] = time();
		
		header("Location:/?page=logged");
		
		// Encerra a conexão PDO e a instrução
		$pdo = null;
		$statement = null;
		
		die();
			
	} catch (PDOException $e) {
		die("Query failed: " . $e->getMessage());	
	}
	
} else{
	header("Location:/?page=login");
	die();
}
?>