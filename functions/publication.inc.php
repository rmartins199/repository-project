<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';

// Obtém o ID do relatorio publicado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
	
	// Consulta de SQL para selecionar informação do relatorio publicado
	try{
		$query_publication = "
        SELECT useraccount.UserFName, useraccount.UserLName, document.DocumentTitle, document.DocumentWordKey, document.PublicationDate, document.DocumentSummary, document.DocumentDescription, documentstate.StateName, collections.CollectionsName, documentfile.FileID, documentfile.FileName, documentfile.FileSize, documentfile.FileType
		FROM document
		INNER JOIN useraccount ON useraccount.userLogin_UserID = document.UserID
		INNER JOIN documentstate ON documentstate.StateID = document.documentState_StateID
		INNER JOIN collections ON collections.CollectionsID = document.collections_CollectionsID
		INNER JOIN documentfile ON documentfile.FileID = document.DocumentId
		WHERE document.DocumentId = :id ";
		
		$stmt = $pdo->prepare($query_publication);
		// Bind dos parâmetros
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		// Recupera o resultado da consulta
		$documento = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!$documento) {
        	die("Documento não encontrado.");
        	}
    	} catch (PDOException $e) {
        	die("Erro ao conectar a base de dados: " . $e->getMessage());
    	}
	} else {
	die("ID de documento inválido.");
}
?>