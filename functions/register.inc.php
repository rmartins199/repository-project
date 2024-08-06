<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
	
	require_once 'db.inc.php';
	
	$email = $_POST["email"];
	$passwordhash = $_POST["passwordhash"];
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$user_number_str = $_POST["user_number"];
	/* NECESSARIO CORRIGIR, NÃO INSERE DATA */
	$dateb = trim($_POST['dateb']);
	$user_number = (int)$user_number_str;
	
	try{
		require_once '../models/signup_model.inc.php';
		require_once '../controllers/signup_controller.inc.php';
		
		// CONTROLADOR DE ERROS		
		$errors = [];
		
		if (is_input_empty($email, $passwordhash, $first_name, $last_name, $user_number, $dateb)){
			$errors["empty_input"] = "Preenche todos os campos.";
		}
		if (is_email_invalid($email)){
			$errors["invalid_email"] = "Email utilizado está invalido.";
		}
		if (is_email_taken($pdo, $email)) {
			$errors["email_used"] = "Email já está registado.";
		}
		if (validatePassword($passwordhash)){
			$errors["invalid_password"] = "Senha inválida. Deve conter pelo menos 8 caracteres, um número e um caractere especial.";
		}
		if (validate_user_number($user_number)){
			$errors["invalid_user_number"] = "Número de aluno invalido, deve conter apenas números e até 5 caracteres.";
		}
		
		require_once 'config_session.inc.php';
		
		if ($errors){
			$_SESSION["errors_signup"] = $errors;

			header("Location: /?page=registration");
			exit(); // Certifica que após o redirecionamento, interrompe a execução do script
		}
		
		create_user($pdo, $email, $passwordhash, $first_name, $last_name, $user_number, $dateb);
		
		header("Location:/?page=registration&signup=success");
		
		$pdo = null;
		$stmt = null;
		
		die();
		
	} catch (PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}
} else{
	header("Location:/?page=home");
	die();
}