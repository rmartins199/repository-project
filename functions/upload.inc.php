<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
	require_once 'config_session.inc.php';

    // Diretório onde os arquivos serão armazenados
    $uploadDir = 'uploads/';
	//Preenchimento do form
	$document_title = $_POST["DocumentTitle"];
	$document_wordkey = $_POST["DocumentWordkey"];
	$document_summary = $_POST["DocumentSummary"];
	$document_description = $_POST["DocumentDescription"];
	$collections_id = $_POST["CollectionsID"];
	$access_id = $_POST["AccessID"];
	$state_id = $_POST["StateID"];
	$id_login = $_SESSION["user_id"];

    try {
        // Conecta a ficheiros externos
        require_once 'db.inc.php';
		require_once '../controllers/upload_controller.inc.php';
		
		// CONTROLADOR DE ERROS		
		$errors = [];
		
		if (is_input_empty($document_title, $document_wordkey, $document_summary, $document_description, $collections_id, $access_id, $state_id)){
			$errors["empty_input"] = "Preenche todos os campos!";
		}

		if (validate_title($document_title)){
			$errors["title_invalid"] = "Caracteres proibidos à serem utilizados no titulo!";
		}
		
		if (validate_title($document_wordkey)){
			$errors["workey_invalid"] = "Caracteres proibidos à serem utilizados nas palavras-chave!";
		}
		
		if (validate_title($document_summary)){
			$errors["summary_invalid"] = "Caracteres proibidos à serem utilizados no sumário!";
		}

		if (validate_title($document_description)){
			$errors["description_invalid"] = "Caracteres proibidos à serem utilizados na descrição!";
		}
		
		if ($errors){
			$_SESSION["errors_upload"] = $errors;

			header("Location: /?page=publish");
			exit(); // Certifica que após o redirecionamento, interrompe a execução do script
		}

        // Verifica se o arquivo foi enviado sem erros
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            // Gera um nome único para evitar repetições
            $newFileName = uniqid() . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            // Move o arquivo para o diretório de uploads
            if (move_uploaded_file($fileTmpPath, $destPath)) {
				
    			$query ="INSERT INTO document (DocumentTitle, DocumentWordKey, DocumentSummary, DocumentDescription, UserID, collections_CollectionsID, documentAccess_AccessID, documentState_StateID) 
				VALUES (:document_title, :document_wordkey, :document_summary, :document_description, :id_login, :collections_id, :access_id, :state_id);";
				$stmt = $pdo->prepare($query);
				// CONVERSÃO DE VARIAVEIS
				$stmt->bindParam(":document_title", $document_title);
				$stmt->bindParam(":document_wordkey", $document_wordkey);
				$stmt->bindParam(":document_summary", $document_summary);
				$stmt->bindParam(":document_description", $document_description);
    			$stmt->bindParam(':id_login', $id_login, PDO::PARAM_INT);
    			$stmt->bindParam(':collections_id', $collections_id, PDO::PARAM_INT);
				$stmt->bindParam(':access_id', $access_id, PDO::PARAM_INT);
				$stmt->bindParam(':state_id', $state_id, PDO::PARAM_INT);
				$stmt->execute();
				
				// Ultimo ID inserido (Documento)
				$id_document  = $pdo->lastInsertId();
				
                // Prepara a consulta SQL para inserir o caminho do arquivo
                $sql = "INSERT INTO documentfile (FileID, FileName, FilePath, FileType, FileSize) 
				VALUES (:id_document ,:nome, :caminho, :tipo, :tamanho)";
                $stmt = $pdo->prepare($sql);

                // Bind dos parâmetros
				$stmt->bindParam(':id_document', $id_document, PDO::PARAM_INT);
                $stmt->bindParam(':nome', $fileName);
                $stmt->bindParam(':caminho', $destPath);
                $stmt->bindParam(':tipo', $fileType);
                $stmt->bindParam(':tamanho', $fileSize);

                // Executa a consulta
                if ($stmt->execute()) {
                    header("Location:/?page=publish&upload=success");
                } else {
                    echo "Erro ao armazenar informações na base de dados.";
                }
            } else {
                echo "Erro ao mover o arquivo para o diretório de uploads.";
            }
        } else {
            echo "Erro no upload: " . $_FILES['file']['error'];
        }
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido ou arquivo não enviado.";
}
?>