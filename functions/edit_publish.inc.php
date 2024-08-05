<?php
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

if(!isset($_SESSION['user_id'])){ //if login in session is not set
    header("Location:/?page=login");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
	
	try{
		$query_publication = "
        SELECT useraccount.UserFName, useraccount.UserLName, document.DocumentTitle, document.DocumentWordKey, document.DocumentSummary, document.DocumentDescription, documentstate.StateName, collections.CollectionsName, documentfile.FileID, documentfile.FileName, documentfile.FileSize, documentfile.FileType
		FROM document
		INNER JOIN useraccount ON useraccount.userLogin_UserID = document.UserID
		INNER JOIN documentstate ON documentstate.StateID = document.documentState_StateID
		INNER JOIN collections ON collections.CollectionsID = document.collections_CollectionsID
		INNER JOIN documentfile ON documentfile.FileID = document.DocumentId
		WHERE document.DocumentId = :id ";
		
		$stmt = $pdo->prepare($query_publication);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$documento = $stmt->fetch(PDO::FETCH_ASSOC);
		
	    if ($documento) {
        	$state = $documento['StateName'];
    	} else {
        	die('Estado do documento não encontrado.');
    	}

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