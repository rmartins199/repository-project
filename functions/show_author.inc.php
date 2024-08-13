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
        INNER JOIN (
            SELECT userLogin_UserID, UserFName, UserLName
            FROM useraccount
        ) u ON d.UserID = u.userLogin_UserID
        WHERE u.userLogin_UserID = :id ";

    $stmt = $pdo->prepare($count_query);
    // Bind dos parâmetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $total_results = $stmt->fetchColumn();

    // Calcular o número total de páginas
    $total_pages = ceil($total_results / $results_per_page);

    try {
        $query_user = "
        SELECT useraccount.UserFName, useraccount.UserLName, document.DocumentId, document.DocumentTitle, document.DocumentWordKey, document.PublicationDate, document.DocumentSummary, document.DocumentDescription, document.UserID, document.collections_CollectionsID, document.documentAccess_AccessID, collections.CollectionsName, documentaccess.AccessName
        FROM useraccount
        INNER JOIN document ON document.UserID = useraccount.userLogin_UserID
        INNER JOIN documentaccess ON documentaccess.AccessID = document.documentAccess_AccessID
        INNER JOIN collections ON collections.CollectionsID = document.collections_CollectionsID
        WHERE useraccount.userLogin_UserID = :id 
        ORDER BY document.PublicationDate $order
        LIMIT :offset, :results_per_page";

        $stmt = $pdo->prepare($query_user);
        // Bind dos parâmetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		// Array para armazenar os nomes únicos
		$unique_names = [];

        if (!$results) {
            die("Utilizador não encontrado.");
        }
    } catch (PDOException $e) {
        die("Erro ao conectar a base de dados: " . $e->getMessage());
    }
} else {
    die("ID de utilizador inválido.");
}
?>