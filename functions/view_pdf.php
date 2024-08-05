<?php
// Ligação a base de dados
require_once 'db.inc.php';

try {
    // Obtém o ID do documento
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Consulta o documento
    $sql = "SELECT FileName, FilePath, FileType FROM documentfile WHERE FileID = :FileID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':FileID', $id, PDO::PARAM_INT);
    $stmt->execute();
    $documento = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($documento) {
        $filePath = $documento['FilePath'];

        if (file_exists($filePath)) {
            header('Content-Type: ' . $documento['FileType']);
            header('Content-Disposition: inline; filename="' . $documento['FileName'] . '"');
            readfile($filePath);
            exit;
        } else {
            echo "Arquivo não encontrado.";
        }
    } else {
        echo "Documento não encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
