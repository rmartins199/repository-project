<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';

// Recebe ordenação escolhida pelo utilizador e define por default Descendente
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';
// Recebe número maximo de resultados por pagina pelo utilizador
$per_page = isset($_GET['per_page']) && in_array($_GET['per_page'], ['5', '10', '20', '50']) ? $_GET['per_page'] : '10';

// Configuração de paginação
$results_per_page = $per_page;

// Determina a página atual
$pg = isset($_GET['pg']) && is_numeric($_GET['pg']) && $_GET['pg'] > 0 ? (int)$_GET['pg'] : 1;

// Calcula o offset
$offset = ($pg - 1) * $results_per_page;

// Obtém o número total de resultados
$total_query = "SELECT COUNT(DISTINCT collection_CollectionID) FROM document";
$total_stmt = $pdo->prepare($total_query);
$total_stmt->execute();
$total_results = $total_stmt->fetchColumn();

// Calcula o número total de páginas
$total_pages = ceil($total_results / $results_per_page);

// Obtém os dados dos relatorios publicados e ordenados por data DESC
$collection_query = "
        SELECT d.collection_CollectionID,c.CollectionName, COUNT(c.CollectionID) AS Total
		FROM document d
		INNER JOIN (
    	SELECT CollectionID, CollectionName, COUNT(*) AS Total
    	FROM collection
    	GROUP BY CollectionID
		) c ON d.collection_CollectionID = c.CollectionID
		GROUP BY c.CollectionID
		ORDER BY c.CollectionName $order
		LIMIT :limit OFFSET :offset";
		$stmt = $pdo->prepare($collection_query);
		// Bind dos parâmetros
		$stmt->bindValue(':limit', $results_per_page, PDO::PARAM_INT);
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		$collection_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>