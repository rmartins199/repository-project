<?php
require_once 'db.inc.php';

// Número de resultados por página
$results_per_page = 10;

// Determina a página atual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Calcula o offset
$offset = ($page - 1) * $results_per_page;

// Obtém o número total de resultados
$total_query = "SELECT COUNT(*) FROM document";
$total_stmt = $pdo->prepare($total_query);
$total_stmt->execute();
$total_results = $total_stmt->fetchColumn();

// Calcula o número total de páginas
$total_pages = ceil($total_results / $results_per_page);

// Obtém os resultados para a página atual
$query = "
        SELECT document.DocumentId, document.PublicationDate, document.DocumentTitle, useraccount.UserFName, useraccount.UserLName, documentaccess.AccessName, collections.CollectionsName
		FROM document
		INNER JOIN useraccount ON useraccount.userLogin_UserID = document.UserID
		INNER JOIN documentaccess ON documentaccess.AccessID = document.documentAccess_AccessID
		INNER JOIN collections ON collections.CollectionsID = document.collections_CollectionsID
		ORDER BY document.PublicationDate DESC
		LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':limit', $results_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>