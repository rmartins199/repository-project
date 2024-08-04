<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
	$email = $_POST["email"];
	$passwordhash = $_POST["passwordhash"];
	//varivel = $_POST["campo do form"];
	// -- EM DESENVOLVIMENTO, REGISTO COM DUAS TABELAS --
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$user_number = $_POST["user_number"];
	$dateb = trim($_POST['dateb']);
	
	try{
		require_once 'db.inc.php';
		require_once '../models/signup_model.inc.php';
		require_once '../controllers/signup_controller.inc.php';
		
		// CONTROLADOR DE ERROS		
		$errors = [];
		
		if (is_input_empty($email, $passwordhash, $first_name, $last_name, $user_number, $dateb)){
			$errors["empty_input"] = "Preenche todos os campos!";
		}
		if (is_email_invalid($email)){
			$errors["invalid_email"] = "Email utilizado está invalido!";
		}
		if (is_email_taken($pdo, $email)) {
			$errors["email_used"] = "Email já está registado!";
		}
		
		require_once 'config_session.inc.php';
		
		if ($errors){
			$_SESSION["errors_signup"] = $errors;

			header("Location:Location:/?page=registration");
			die();
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