<?php

declare(strict_types=1);

// VALIDAÇÃO DE CAMPOS VAZIOS
function is_input_empty(string $documentTitle, string $documentWordkey, string $documentSummary, string $documentDescription, int $collectionsId, int $access_id, int $state_id)
{
	if (empty($documentTitle) || empty($documentWordkey) || empty($documentSummary) || empty($documentDescription) || empty($collectionsId) || empty($access_id || empty($state_id))) {
		return true;
	}
	else{
		return false;
	}
}

// Permitir apenas letras maiúsculas e minúsculas e espaços
function validate_title($documentTitle) {

    return !preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿÁÉÍÓÚáéíóúâêîôûãõçÇ,.\+\-!:;()\s]+$/', $documentTitle);
}

function validateWordkey(string $documentWordkey) {

    return !preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿÁÉÍÓÚáéíóúâêîôûãõçÇ,.\+\-!:;()\s]+$/', $documentWordkey);
}

function validateSummary(string $documentSummary) {

    return !preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿÁÉÍÓÚáéíóúâêîôûãõçÇ,.\+\-!:;()\s]+$/', $documentSummary);
}

function validateDescription(string $documentDescription) {

    return !preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿÁÉÍÓÚáéíóúâêîôûãõçÇ,.\+\-!:;()\s]+$/', $documentDescription);
}
?>