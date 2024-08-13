<?php
// Inclui o arquivo de configuração da base de dados e outras dependências
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

// Recebe a ordem e a letra selecionada pelo utilizador
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'ASC';
$letter = isset($_GET['letter']) ? $_GET['letter'] : '';

// Configuração de paginação
$results_per_page = 10;
$pg = isset($_GET['pg']) && is_numeric($_GET['pg']) && $_GET['pg'] > 0 ? (int)$_GET['pg'] : 1;
$offset = ($pg - 1) * $results_per_page;

// Query para contar o número total de resultados
$count_query = "
        SELECT COUNT(DISTINCT u.userLogin_UserID) AS total
        FROM document d
        INNER JOIN (
            SELECT userLogin_UserID, UserFName, UserLName
            FROM useraccount
        ) u ON d.UserID = u.userLogin_UserID
        WHERE (:letter = '' OR u.UserFName LIKE :letterPattern)";

$stmt = $pdo->prepare($count_query);
$stmt->bindValue(':letter', $letter, PDO::PARAM_STR);
$stmt->bindValue(':letterPattern', $letter . '%', PDO::PARAM_STR);
$stmt->execute();
$total_results = $stmt->fetchColumn();

// Calcular o número total de páginas
$total_pages = ceil($total_results / $results_per_page);

// Query SQL com ordenação e filtro de letra inicial
$author_query = "
        SELECT u.userLogin_UserID, u.UserFName, u.UserLName, COUNT(d.UserID) AS Total
        FROM document d
        INNER JOIN (
            SELECT userLogin_UserID, UserFName, UserLName, COUNT(*) AS Total
            FROM useraccount
            GROUP BY userLogin_UserID
        ) u ON d.UserID = u.userLogin_UserID
        WHERE (:letter = '' OR u.UserFName LIKE :letterPattern)
        GROUP BY u.userLogin_UserID
        ORDER BY Total $order
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($author_query);
// Bind dos parâmetros
$stmt->bindValue(':limit', $results_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':letter', $letter, PDO::PARAM_STR);
$stmt->bindValue(':letterPattern', $letter . '%', PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>