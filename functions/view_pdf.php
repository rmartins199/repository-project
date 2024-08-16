<?php
// Ligação a base de dados
require_once 'db.inc.php';

// Define a mesma chave de encriptação e método usados na encriptação
$key = "%A!skkwHU9qJR8DSoVjZokJwDDQzC5FZ";
$method = "aes-256-cbc";

if (isset($_GET['id'])) {
    $encrypted_id = $_GET['id'];
    list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_id), 2);
    $fileid = openssl_decrypt($encrypted_data, $method, $key, 0, $iv);

if (is_numeric($fileid)) {

    	// Consulta o documento
    	$sql = "SELECT FileName, FilePath, FileType FROM documentfile WHERE FileID = :FileID";
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':FileID', $fileid, PDO::PARAM_INT);
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
	} else {
        echo "ID inválido.";
    }
} else {
    echo "ID não fornecido.";
}
?>
