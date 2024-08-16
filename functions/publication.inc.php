<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';

// Define a mesma chave de encriptação e método usados na encriptação
$key = "xAHgjhu32bE%!Mop7u%Ae7g7%V6Pv6oC";
$method = "aes-256-cbc";

// Função para obter o estado do documento
function get_document_status($doc_id, $pdo) {
    // Consulta SQL para obter o estado do documento pelo seu ID
    $stmt = $pdo->prepare("SELECT documentAccess_AccessID FROM document WHERE DocumentId = :id");
    $stmt->execute([':id' => $doc_id]);
    return $stmt->fetchColumn(); // Retorna o estado do documento
}

// Função de conversão do valor recebido da base de dados para MB/KB/bytes
function formatFileSize($size) {
    if ($size >= 1048576) {
        return number_format($size / 1048576, 2) . ' MB'; // Se o tamanho for maior ou igual a 1 MB (1048576 bytes), é convertido para megabytes (MB)
    } elseif ($size >= 1024) {
        return number_format($size / 1024, 2) . ' KB'; //Se o tamanho for maior ou igual a 1 KB (1024 bytes), é convertido para kilobytes (KB)
    } else {
        return $size . ' bytes'; // Se o tamanho for menor que 1 KB, o valor é exibido em bytes.
    }
}

// Obtém o ID do relatório publicado
if (isset($_GET['id'])) {
    $encrypted_id = $_GET['id'];
    list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_id), 2);
    $PublishId = openssl_decrypt($encrypted_data, $method, $key, 0, $iv);

    // Obtenha o status do documento e armazene em uma variável
    $doc_status = get_document_status($PublishId, $pdo);

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
    if (is_numeric($PublishId)) {
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
        $stmt->bindParam(':id', $PublishId, PDO::PARAM_INT);
        $stmt->execute();
        // Recupera o resultado da consulta
        $documento = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//Recupera tamanho do documento para conversão
		$fileSize = $documento['FileSize'];
        $formattedSize = formatFileSize($fileSize);

        if (!$documento) {
            die("Documento não encontrado.");
        }
		
    	} else {
        echo "<script>
                alert('ID inválido.');
                window.location.href = '/?page=home';
              </script>";
    	}
} else {
    echo "ID não disponivel.";
}
?>