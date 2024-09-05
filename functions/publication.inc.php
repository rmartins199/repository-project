<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'db.inc.php';

// Define a mesma chave de encriptação e método usados na encriptação
$key = "xAHgjhu32bE%!Mop7u%Ae7g7%V6Pv6oC";
$method = "aes-256-cbc";

// Função que obtém o nível de acesso e o ID do autor do documento
function get_document_info($doc_id, $pdo) {
    // Consulta SQL para obter o nível de acesso e o ID do autor do documento pelo ID do documento
    $stmt = $pdo->prepare("SELECT user_account_UserID, document_access_AccessID FROM document WHERE DocumentId = :id");
    $stmt->execute([':id' => $doc_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array associativo com o estado do documento e o ID do autor
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

    // Obtém as informações do documento e armazena em variáveis
    $document_info = get_document_info($PublishId, $pdo);

    // Exemplo de valores de $doc_status:
    // 1 = Todos os alunos e/ou docentes tem acesso (Público)
    // 2 = Apenas alunos e/ou docentes registados tem acesso (Restrito)
    // 3 = Fechado (Apenas autor consegue visualizar publicação)

    $previous_page = $_SERVER['HTTP_REFERER'] ?? '/?page=home'; // Página anterior ou índice padrão

    if ($document_info) {
        $doc_status = $document_info['document_access_AccessID']; // Nível de acesso do documento
        $publisher_id = $document_info['user_account_UserID'];    // ID do autor do documento

    // Recupera ID do utilizador logado atraves do $_SESSION
    $user_id = $_SESSION['user_id'] ?? null; // ID do utilizador logado, se houver

    // Verifica o nível de acesso e o ID do utilizador
    if ($doc_status == 3) { // Acesso fechado (Apenas Autor)
        if ($user_id !== $publisher_id) {
            echo "<script>
                    alert('Este documento está fechado e só pode ser aberto pelo autor.');
                    window.location.href = '$previous_page';
                  </script>";
            exit();
        }
    } elseif ($doc_status == 2) { // Necessita de Login (restrito)
        if (empty($user_id)) { // Verifica se o utilizador não está logado
            echo "<script>
                    alert('Este documento está restrito, é necessário efetuar login para ser aberto.');
                    window.location.href = '$previous_page';
                  </script>";
            exit();
        }
    }
    // Se $doc_status for 1 ou as condições anteriores forem satisfeitas, o relatorio é acessível
    } else {
        echo "<script>
                alert('Documento não encontrado.');
                window.location.href = '$previous_page';
            </script>";
        exit();
    }

    // Consulta de SQL para selecionar informação do relatorio publicado
    if (is_numeric($PublishId)) {
        $query_publication = "
        SELECT user_account.UserFName, user_account.UserLName, document.DocumentTitle, document.DocumentWordKey, document.PublicationDate, document.DocumentSummary, 
                document.DocumentDescription, document_state.StateName, collection.CollectionName, document_file.FileID, document_file.FileName, document_file.FileSize,
                document_file.FileType
        FROM document
        INNER JOIN user_account ON user_account.UserID = document.user_account_UserID 
        INNER JOIN document_state ON document_state.StateID = document.document_state_StateID
        INNER JOIN collection ON collection.CollectionID = document.collection_CollectionID
        INNER JOIN document_file ON document_file.FileID = document.DocumentId 
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