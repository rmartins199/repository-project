<?php

declare(strict_types=1);

// VALIDAÇÃO DE CAMPOS VAZIOS
// -- EM DESENVOLVIMENTO, REGISTO COM DUAS TABELAS  --

function is_input_empty(string $email, string $passwordhash, string $first_name, string $last_name, int $user_number, string $dateb)
{
	if (empty($email) || empty($passwordhash) || empty($first_name) || empty($last_name) || empty($user_number) || empty($dateb)) {
		return true;
	}
	else{
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
// VALIDAÇÃO SE EMAIL JÁ FOI UTILIZADO
function is_email_taken(object $pdo, string $email) 
{
	if (get_email($pdo, $email)) {
		return true;
	}
	else{
		return false;
	}
}
// CRIAR UTILIZADOR COM TODOS OS CAMPOS, EM DESENVOLVIMENTO
// -- TABELA UNICA --
function create_user(object $pdo, string $email, string $passwordhash, string $first_name, string $last_name, int $user_number, string $dateb) 
{
	set_login($pdo, $email, $passwordhash, $first_name, $last_name, $user_number, $dateb);
	
}