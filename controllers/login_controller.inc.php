<?php

declare(strict_types=1);

function is_input_empty(string $email, string $passwordhash){
	
	if(empty($email) || empty($passwordhash)){
		return true;
	} else {
		return false;
	}
}

// VALIDAÇÃO SE O EMAIL É VALIDO
function is_email_invalid(string $email) 
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else{
		return false;
	}
}

function is_email_wrong(bool|array $result){
	
	if(!$result){
		return true;
	} else {
		return false;
	}
}

function is_password_wrong(string $passwordhash, string $hashedPassword){
	
	if(!password_verify($passwordhash, $hashedPassword)){
		return true;
	} else {
		return false;
	}
}