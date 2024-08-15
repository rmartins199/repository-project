<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

// Certifica que user tem um login efetuado
if(!isset($_SESSION['user_id'])){
    header("Location:/?page=login");
}

// Função para obter o estado do documento
function get_document_status($doc_id, $pdo) {
    // Consulta SQL para obter o estado do documento pelo seu ID
    $stmt = $pdo->prepare("SELECT documentState_StateID FROM document WHERE DocumentId = :id");
    $stmt->execute([':id' => $doc_id]);
    return $stmt->fetchColumn(); // Retorna o estado do documento
}
//Recebe ID do relátorio publicado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
	
    // Obtém o status do documento e armazena em uma variável
    $doc_status = get_document_status($id, $pdo);

    // Variável para armazenar mensagem de estado do documento
    $status_message = "";

    // Verifica se o status é igual a 2 (fechado) e gera mensagem de erro
    if ($doc_status == 2) {
        $status_message = "Este relatorio está fechado e não pode ser editado.";
    }
	
	try{
		$query_publication = "
        SELECT useraccount.UserFName, useraccount.UserLName, 
		document.DocumentTitle, document.DocumentWordKey, 
		document.DocumentSummary, document.DocumentDescription, 
		documentstate.StateName, collections.CollectionsName, 
		documentfile.FileID, documentfile.FileName, 
		documentfile.FileSize, documentfile.FileType,
		document.DocumentId
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
		$documento = $stmt->fetch(PDO::FETCH_ASSOC);
		
		// Supondo que $document_id contém o ID do documento a ser editado
		$_SESSION['DocumentId'] = $id;
		
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