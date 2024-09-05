<?php
// Inclui o arquivo de configuração da base de dados e outras dependências
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

// Recebe ordenação escolhida pelo utilizador e define por default Descendente
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';
// Recebe letra inicial escolhida pelo utilizador pelo qual começa o nome do autor
$letter = isset($_GET['letter']) ? $_GET['letter'] : '';
// Recebe número maximo de resultados por pagina pelo utilizador
$per_page = isset($_GET['per_page']) && in_array($_GET['per_page'], ['5', '10', '20', '50']) ? $_GET['per_page'] : '10';

// Configuração de paginação
$results_per_page = $per_page;
$pg = isset($_GET['pg']) && is_numeric($_GET['pg']) && $_GET['pg'] > 0 ? (int)$_GET['pg'] : 1;
$offset = ($pg - 1) * $results_per_page;

// Query para contar o número total de resultados
$count_query = "
        SELECT COUNT(DISTINCT u.UserID) AS total
        FROM document d
        INNER JOIN (
            SELECT UserID , UserFName, UserLName
            FROM user_account
        ) u ON d.user_account_UserID = u.UserID
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
        SELECT u.UserID, u.UserFName, u.UserLName, COUNT(d.user_account_UserID ) AS Total
        FROM document d
        INNER JOIN (
            SELECT UserID, UserFName, UserLName, COUNT(*) AS Total
            FROM user_account
            GROUP BY UserID
        ) u ON d.user_account_UserID  = u.UserID
        WHERE (:letter = '' OR u.UserFName LIKE :letterPattern)
        GROUP BY u.UserID
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