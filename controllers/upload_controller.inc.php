<?php

declare(strict_types=1);

// VALIDAÇÃO DE CAMPOS VAZIOS
function is_input_empty(string $document_title, string $document_wordkey, string $document_summary, string $document_description, int $collections_id, int $access_id, int $state_id)
{
	if (empty($document_title) || empty($document_wordkey) || empty($document_summary) || empty($document_description) || empty($collections_id) || empty($access_id || empty($state_id))) {
		return true;
	}
	else{
		return false;
	}
}

// Permitir apenas letras maiúsculas e minúsculas e espaços
function validate_title($document_title) {

    return !preg_match('/^[a-zA-Z\s]+$/', $document_title);
}

function validateWordkey(string $document_wordkey) {

    return !preg_match('/^[a-zA-Z\s]+$/', $document_wordkey);
}

function validateSummary(string $document_summary) {

    return !preg_match('/^[a-zA-Z\s]+$/', $document_summary);
}

function validateDescription(string $document_description) {

    return !preg_match('/^[a-zA-Z\s]+$/', $document_description);
}

?>