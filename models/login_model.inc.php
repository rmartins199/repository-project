<?php

declare(strict_types=1);

function get_email(object $pdo, string $email){
	$query ="SELECT * FROM userlogin where UserEmail = :email;";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(":email", $email);
	$stmt->execute();
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}