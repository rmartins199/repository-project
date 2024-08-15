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
        WHERE collections_CollectionsID = :id ";

    $stmt = $pdo->prepare($count_query);
    // Bind dos parâmetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $total_results = $stmt->fetchColumn();

    // Calcular o número total de páginas
    $total_pages = ceil($total_results / $results_per_page);

    try {
        $query_collections = "
        SELECT `DocumentId`,`PublicationDate`,useraccount.UserFName, useraccount.UserLName, `DocumentTitle`, `DocumentSummary`, documentstate.StateName, documentaccess.AccessName, collections.CollectionsName
		FROM `document` 
		INNER JOIN useraccount ON useraccount.userLogin_UserID = document.UserID
		INNER JOIN collections ON collections.CollectionsID = document.collections_CollectionsID
		INNER JOIN documentaccess ON documentaccess.AccessID = document.documentAccess_AccessID
		INNER JOIN documentstate ON documentstate.StateID = document.documentState_StateID
		WHERE collections_CollectionsID = :id 
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