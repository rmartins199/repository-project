<?php

declare(strict_types=1);

function get_email(object $pdo, string $email)
{
	$query ="SELECT UserEmail FROM userlogin where UserEmail = :email;";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(":email", $email);
	$stmt->execute();
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function set_login(object $pdo, string $email, string $passwordhash, string $first_name, string $last_name, int $user_number, string $dateb){
	$query ="INSERT INTO userlogin (UserEmail, PasswordHash) 
	VALUES (:email, :passwordhash);";
	$stmt = $pdo->prepare($query);
	
	//INCRIPETAÇÃO PASSWORD
	$options = [
		'cost' => 12
	];
	$hashedPassword = password_hash($passwordhash, PASSWORD_BCRYPT, $options);
	// CONVERSÃO DE VARIAVEIS
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":passwordhash", $hashedPassword);
	$stmt->execute();
	
	$id_login = $pdo->lastInsertId();
	
    $query_account= "INSERT INTO useraccount (userLogin_UserID, UserFName, UserLName, UserBirth, UserNumber) 
	VALUES (:LoginID, :first_name, :last_name, :dateb, :user_number)";
    $stmt = $pdo->prepare($query_account);
	$stmt->bindParam(':LoginID', $id_login, PDO::PARAM_INT);
	$stmt->bindParam(":first_name", $first_name);
	$stmt->bindParam(":last_name", $last_name);
	$stmt->bindParam (":dateb", strtotime (date ("Y-m-d H:i:s")), PDO::PARAM_STR);
    $stmt->bindParam(':user_number', $user_number, PDO::PARAM_INT);
    $stmt->execute();
}