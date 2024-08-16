<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'functions/config_session.inc.php';
require_once 'functions/publication.inc.php';

// É defenida uma chave de encriptação segura
$key = "%A!skkwHU9qJR8DSoVjZokJwDDQzC5FZ"; // A chave deve ter 16, 24 ou 32 caracteres (neste caso é de 32)
$method = "aes-256-cbc";
// Recolhe o ID pretendido para encriptação que neste caso é 'FileID'
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
$encrypted_id = openssl_encrypt($documento['FileID'], $method, $key, 0, $iv);
$encrypted_id = base64_encode($encrypted_id . '::' . $iv);
?>

<html>
<div class="container">
    		<div class="p-5 my-4 bg-light rounded-3">
				<div>   
        			<h2 class="pb-2 border-bottom">Relatorio publicado</h2>   
        			</br>
        			<table class="table table-hover tablecss1">   
          				<thead>
            				<tr>
								<td width="30%">Autor(a):</td>
								<td><?php echo htmlspecialchars($documento['UserFName'] ." ". $documento['UserLName']); ?></td>
            				</tr>   
          				</thead>   
          				<tbody>        
            				<tr>
								<td width="30%">Título:</td>
								<td><?php echo htmlspecialchars($documento['DocumentTitle']); ?></td>
            				</tr>
							<tr>
								<td width="30%">Palavras-chave:</td>
								<td><?php echo htmlspecialchars($documento['DocumentWordKey']); ?></td>
            				</tr> 
            				<tr>
								<td width="30%">Data de publicação:</td>
								<td><?php echo htmlspecialchars($documento['PublicationDate']); ?></td>
            				</tr> 
							<tr>
								<td width="30%">Resumo:</td>
								<td><?php echo htmlspecialchars($documento['DocumentSummary']); ?></td>
            				</tr>
          				</tbody>   
        			</table>
					<!-- TABELA COM DADOS DO DOCUMENTO PUBLICADO PELO AUTOR! -->
					<table class="table table-hover">
          				<thead>
            				<tr>
								<th>Ficheiro desta publicação</th>
								<th></th>
								<th></th>
								<th></th>
            				</tr>   
          				</thead>
						<tr>
							<td width="30%"><b>Nome</b></td>
							<td width="20%"><b>Tamanho</b></td>
							<td width="30%"><b>Formato</b></td>
							<td width=""></td>
            			</tr>
						<tr>
							<td><?php echo htmlspecialchars($documento['FileName']); ?></td>
							<td><?php echo htmlspecialchars($formattedSize); ?></td>
							<td><?php echo htmlspecialchars($documento['FileType']); ?></td>
							<td><a href="functions/view_pdf.php?id=<?php echo urlencode($encrypted_id); ?>" target="_blank" class="btn btn-secondary btn-sm">Ver/Abrir</a></td>
            			</tr>
					</table>
				</div>
			</div>
		</div>
</html>
