<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';

// Função para obter o estado do documento
function get_document_status($doc_id, $pdo) {
    // Consulta SQL para obter o estado do documento pelo seu ID
    $stmt = $pdo->prepare("SELECT documentAccess_AccessID FROM document WHERE DocumentId = :id");
    $stmt->execute([':id' => $doc_id]);
    return $stmt->fetchColumn(); // Retorna o estado do documento
}

// Obtém o ID do relatório publicado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Obtenha o status do documento e armazene em uma variável
    $doc_status = get_document_status($id, $pdo);

    // Verifica se o estado é igual a 2 (fechado) e redirecione se necessário
    if ($doc_status == 2) {
        // Se o status for 2, enviar mensagem e redirecionar
        $previous_page = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // Padrão caso HTTP_REFERER não esteja definido
        echo "<script>
                alert('Este documento está fechado e não pode ser visualizado.');
                window.location.href = '$previous_page';
              </script>";
        exit();
    }

    // Consulta de SQL para selecionar informação do relatorio publicado
    try {
        $query_publication = "
        SELECT useraccount.UserFName, useraccount.UserLName, document.DocumentTitle, document.DocumentWordKey, document.PublicationDate, document.DocumentSummary, document.DocumentDescription, documentstate.StateName, collections.CollectionsName, documentfile.FileID, documentfile.FileName, documentfile.FileSize, documentfile.FileType
        FROM document
        INNER JOIN useraccount ON useraccount.userLogin_UserID = document.UserID
        INNER JOIN documentstate ON documentstate.StateID = document.documentState_StateID
        INNER JOIN collections ON collections.CollectionsID = document.collections_CollectionsID
        INNER JOIN documentfile ON documentfile.FileID = document.DocumentId
        WHERE document.DocumentId = :id ";
        
        $stmt = $pdo->prepare($query_publication);
        // Bind dos parâmetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Recupera o resultado da consulta
        $documento = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$documento) {
            die("Documento não encontrado.");
        }
    } catch (PDOException $e) {
        die("Erro ao conectar a base de dados: " . $e->getMessage());
    }
} else {
    die("ID de documento inválido.");
}
?>