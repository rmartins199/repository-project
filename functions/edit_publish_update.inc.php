<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';
require_once 'config_session.inc.php';

// Fazer update com os dados alterados no FORM!
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Verifique se o ID do documento está na sessão
	if (isset($_SESSION['DocumentId'])) {
    	$document_id = $_SESSION['DocumentId'];

		// Obtém outros campos do formulário
		$documentTitle = $_POST["DocumentTitle"];
		$documentWordkey = $_POST["DocumentWordkey"];
		$documentSummary = $_POST["DocumentSummary"];
		$documentDescription = $_POST["DocumentDescription"];
		$collectionsId = $_POST["CollectionsID"];
		$access_id = $_POST["AccessID"];
		$state_id = $_POST["StateID"];

    	try {
        	// Verifique se o relatório está em estado "aberto"
        	$query = "SELECT documentState_StateID FROM document WHERE DocumentId = :id";
        	$stmt = $pdo->prepare($query);
        	$stmt->execute(['id' => $document_id]);
        	$document_update = $stmt->fetch(PDO::FETCH_ASSOC);

        	if ($document_update && $document_update['documentState_StateID'] == 1) {
    			// Preparar a query de update
    			$update_query = "UPDATE document SET 
        					DocumentTitle = :documentTitle, 
        					DocumentWordKey = :documentWordkey, 
        					DocumentSummary = :documentSummary, 
        					DocumentDescription = :documentDescription, 
        					collections_CollectionsID = :collectionsId, 
        					documentAccess_AccessID = :access_id, 
        					documentState_StateID = :state_id 
        					WHERE DocumentId = :document_id";
            	$update_stmt = $pdo->prepare($update_query);
				// Bind dos parâmetros
				$update_stmt->bindParam(":documentTitle", $documentTitle);
				$update_stmt->bindParam(":documentWordkey", $documentWordkey);
				$update_stmt->bindParam(":documentSummary", $documentSummary);
				$update_stmt->bindParam(":documentDescription", $documentDescription);
    			$update_stmt->bindParam(':collectionsId', $collectionsId, PDO::PARAM_INT);
				$update_stmt->bindParam(':access_id', $access_id, PDO::PARAM_INT);
				$update_stmt->bindParam(':state_id', $state_id, PDO::PARAM_INT);
				$update_stmt->bindParam(':document_id', $document_id, PDO::PARAM_INT);
            	$update_stmt->execute();

            	// Redirecione após a atualização
            	header("Location:/?page=edit_publication&id=$document_id&update=success");
            	die();
			
        	} else {
            	echo "Publicação encontra-se fechada, não é possivel ser editado.";
        	}
    	} catch (PDOException $e) {
        	echo 'Erro: ' . $e->getMessage();
    	}
	} else {
        echo "ID do documento não encontrado.";
   	}
}else {
    echo "Método de requisição inválido.";
}
?>