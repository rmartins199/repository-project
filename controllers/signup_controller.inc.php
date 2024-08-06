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

// VALIDAR PASSWORD DURANTE PROCESSO DE REGISTO
function validatePassword($passwordhash) {
    // Regex para validar se a string contém pelo menos 8 caracteres, um número e um caractere especial
    $pattern = '/^(?=.*[0-9])(?=.*[\W])(?=.{8,}).+$/';
    return !preg_match($pattern, $passwordhash);
}

// VALIDAR NÚMERO DE ALUNO DURANTE PROCESSO DE REGISTO
function validate_user_number(int $user_number) {
    if (!is_int($user_number) || $user_number < 1 || $user_number > 99999) {
        return true;
    }else{
		return false;
	}
}

// CRIAR UTILIZADOR COM TODOS OS CAMPOS, EM DESENVOLVIMENTO
// -- TABELA UNICA --
function create_user(object $pdo, string $email, string $passwordhash, string $first_name, string $last_name, int $user_number, string $dateb) 
{
	set_login($pdo, $email, $passwordhash, $first_name, $last_name, $user_number, $dateb);
	
}