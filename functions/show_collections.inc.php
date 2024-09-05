<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

// Recebe a ordem selecionada pelo utilizador
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'ASC';

// Configuração de paginação
$results_per_page = 10;
$pg = isset($_GET['pg']) && is_numeric($_GET['pg']) && $_GET['pg'] > 0 ? (int)$_GET['pg'] : 1;
$offset = ($pg - 1) * $results_per_page;

//Recebe ID do utilizador
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Query para contar o número total de resultados
    $count_query = "
        SELECT COUNT(DISTINCT d.DocumentId) AS total
  		FROM document d
        WHERE collection_CollectionID = :id ";

    $stmt = $pdo->prepare($count_query);
    // Bind dos parâmetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $total_results = $stmt->fetchColumn();

    // Calcular o número total de páginas
    $total_pages = ceil($total_results / $results_per_page);

    try {
        $query_collections = "
        SELECT document.DocumentId, document.PublicationDate, user_account.UserFName, user_account.UserLName, document.DocumentTitle, document.DocumentSummary, document_state.StateName, document_access.AccessName, collection.CollectionName
		FROM document 
		INNER JOIN user_account ON user_account.UserID = document.user_account_UserID
		INNER JOIN collection ON collection.CollectionID = document.collection_CollectionID
		INNER JOIN document_access ON document_access.AccessID = document.document_Access_AccessID
		INNER JOIN document_state ON document_state.StateID = document.document_State_StateID
		WHERE collection_CollectionID = :id 
        ORDER BY document.PublicationDate $order
        LIMIT :offset, :results_per_page";

        $stmt = $pdo->prepare($query_collections);
        // Bind dos parâmetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		// Array para armazenar os nomes únicos
		$unique_names = [];

        if (!$results) {
            die("Coleção não existe.");
        }
    } catch (PDOException $e) {
        die("Erro ao conectar a base de dados: " . $e->getMessage());
    }
} else {
    die("ID da coleção está inválida.");
}
?>