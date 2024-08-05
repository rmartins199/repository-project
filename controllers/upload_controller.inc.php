<?php

declare(strict_types=1);

// VALIDAÇÃO DE CAMPOS VAZIOS
// -- EM DESENVOLVIMENTO, REGISTO COM DUAS TABELAS  --

function is_input_empty(string $document_title, string $document_wordkey, string $document_summary, string $document_description, int $collections_id, int $access_id, int $state_id)
{
	if (empty($document_title) || empty($document_wordkey) || empty($document_summary) || empty($document_description) || empty($collections_id) || empty($access_id || empty($state_id))) {
		return true;
	}
	else{
		return false;
	}
}

function validate_title($document_title) {
    // Permitir apenas letras maiúsculas e minúsculas e espaços
    return !preg_match('/^[a-zA-Z\s]+$/', $document_title);
}
/*
function validateWordkey(string $document_wordkey) {
    // Permitir apenas letras maiúsculas e minúsculas e espaços
    return !preg_match('/^[a-zA-Z\s]+$/', $document_wordkey);
}

function validateSummary(string $document_summary) {
    // Permitir apenas letras maiúsculas e minúsculas e espaços
    return !preg_match('/^[a-zA-Z\s]+$/', $document_summary);
}

function validateDescription(string $document_description) {
    // Permitir apenas letras maiúsculas e minúsculas e espaços
    return !preg_match('/^[a-zA-Z\s]+$/', $document_description);
}
*/
?>