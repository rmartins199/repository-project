<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';
require_once 'functions/config_session.inc.php';

// É defenida uma chave de encriptação segura
$key = "RgCPvRNnwNDwt8$9NqXmd8jZYJ&SheWG"; // A chave deve ter 16, 24 ou 32 caracteres (neste caso é de 32)
$method = "aes-256-cbc";

// Recebe a ordem selecionada pelo utilizador ou por default DESC
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';
// Recebe número maximo de resultados por pagina pelo utilizador
$per_page = isset($_GET['per_page']) && in_array($_GET['per_page'], ['5', '10', '20', '50']) ? $_GET['per_page'] : '10';

// Configuração de paginação
$results_per_page = $per_page;
$pg = isset($_GET['pg']) && is_numeric($_GET['pg']) && $_GET['pg'] > 0 ? (int)$_GET['pg'] : 1;
// Calcula o offset
$offset = ($pg - 1) * $results_per_page;

//Recebe ID do utilizador
if (isset($_GET['id'])) {
    $encrypted_userid = $_GET['id'];
    list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_userid), 2);
    $id = openssl_decrypt($encrypted_data, $method, $key, 0, $iv);

    // Query para contar o número total de resultados
    $count_query = "
        SELECT COUNT(DISTINCT d.DocumentId) AS total
        FROM document d
        INNER JOIN (
            SELECT UserID, UserFName, UserLName
            FROM user_account
        ) u ON d.user_account_UserID = u.UserID
        WHERE u.UserID = :id ";

    $stmt = $pdo->prepare($count_query);
    // Bind dos parâmetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $total_results = $stmt->fetchColumn();

    // Calcula o número total de páginas
    $total_pages = ceil($total_results / $results_per_page);

    try {
        $query_user = "
        SELECT user_account.UserFName, user_account.UserLName, document.DocumentId, document.DocumentTitle, document.DocumentWordKey, document.PublicationDate, 
        document.DocumentSummary, document.DocumentDescription, document.user_account_UserID , document.collection_CollectionID, document.document_access_AccessID, 
        collection.CollectionName, document_access.AccessName
        FROM user_account
        INNER JOIN document ON document.user_account_UserID  = user_account.UserID
        INNER JOIN document_access ON document_access.AccessID = document.document_access_AccessID
        INNER JOIN collection ON collection.CollectionID = document.collection_CollectionID
        WHERE user_account.UserID = :id 
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