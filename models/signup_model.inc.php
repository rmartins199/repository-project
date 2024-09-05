<?php

declare(strict_types=1);

function get_email(object $pdo, string $email)
{
	$query ="SELECT UserEmail FROM user_account where UserEmail = :email;";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(":email", $email);
	$stmt->execute();
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function set_login(object $pdo, string $email, string $passwordhash, string $first_name, string $last_name, string $dateb, int $user_number){
	$query ="INSERT INTO user_account (UserEmail, PasswordHash, UserFName, UserLName, UserBirth, UserNumber, UserCreationDate) 
	VALUES (:email, :passwordhash, :first_name, :last_name, :dateb, :user_number, NOW());";
	$stmt = $pdo->prepare($query);
	
	//INCRIPETAÇÃO PASSWORD
	$options = [
		'cost' => 12
	];
	$hashedPassword = password_hash($passwordhash, PASSWORD_BCRYPT, $options);
	// CONVERSÃO DE VARIAVEIS
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":passwordhash", $hashedPassword);
	$stmt->bindParam(":first_name", $first_name);
	$stmt->bindParam(":last_name", $last_name);
	$stmt->bindParam(':dateb', $dateb);
    $stmt->bindParam(':user_number', $user_number, PDO::PARAM_INT);
	$stmt->execute();
}