<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

// Certifica que user tem um login efetuado
if(!isset($_SESSION['user_id'])){
    header("Location:/?page=login");
}
// Atribui valor a variavel $userId atraves da variavel armazenada na SESSION
$userId = $_SESSION['user_id'];

// Número de resultados por página
$results_per_page = 10;

// Determina a página atual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Calcula o offset
$offset = ($page - 1) * $results_per_page;

// Obtém o número total de resultados
$total_query = "SELECT COUNT(*) FROM document
				WHERE UserID = :user_id ";
$total_stmt = $pdo->prepare($total_query);
$total_stmt->execute(['user_id' => $userId]);
$total_results = $total_stmt->fetchColumn();

// Calcula o número total de páginas
$total_pages = ceil($total_results / $results_per_page);

// Obtém os resultados por autor
try {
    $query ="SELECT document.DocumentId, document.PublicationDate, document.DocumentTitle, documentstate.StateName, collections.CollectionsName
			FROM document
			INNER JOIN documentstate ON documentstate.StateID = document.documentState_StateID
			INNER JOIN collections ON collections.CollectionsID = document.collections_CollectionsID
			WHERE UserID = :user_id
			LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($query);
	// Bind dos parâmetros
	$stmt->bindValue(':limit', $results_per_page, PDO::PARAM_INT);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	$stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
	// Recupera o resultado da consulta
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
    exit();
}
?>