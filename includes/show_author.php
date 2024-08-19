<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'functions/show_author.inc.php';

// É defenida uma chave de encriptação segura para os relatorios publicados
$key = "xAHgjhu32bE%!Mop7u%Ae7g7%V6Pv6oC"; // A chave deve ter 16, 24 ou 32 caracteres (neste caso é de 32)
$method = "aes-256-cbc";

// É defenida uma chave de encriptação segura para o id do utilizador
$key_user = "RgCPvRNnwNDwt8$9NqXmd8jZYJ&SheWG"; // A chave deve ter 16, 24 ou 32 caracteres (neste caso é de 32)
$method_user = "aes-256-cbc";
// Encripta userLogin_UserID
$iv_user = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method_user));
$encrypted_userid = openssl_encrypt($id, $method_user, $key_user, 0, $iv_user);
$encrypted_userid = base64_encode($encrypted_userid . '::' . $iv_user);
?>
<html>
    <div class="container">
        <div class="p-5 my-4 bg-light rounded-3">
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $result): ?>
                    <?php if (!in_array($result['UserFName'] . " " . $result['UserLName'], $unique_names)): ?>
                        <h2 class="pb-2 border-bottom h2title">Relatórios de <?php echo htmlspecialchars($result['UserFName'] . " " . $result['UserLName']); ?></h2>
                    <?php $unique_names[] = $result['UserFName'] . " " . $result['UserLName']; ?>
               	<?php endif; ?>
            <?php endforeach; ?>
		<div class="browse_controls">
			<form method="GET" action="">
			<div class="row justify-content-md-center">
    			<div class="col-sm">
        			<input type="hidden" name="page" value="show_author">
					<input type="hidden" name="id" value="<?= htmlspecialchars($encrypted_userid) ?>">
        			<label for="order"><b>Ordenar por data:</b></label>
        			<select name="order" id="order">
						<option value="ASC" <?= isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'selected' : '' ?>>Ascendente</option>
						<option value="DESC" <?= isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'selected' : '' ?> selected="selected">Descendente</option>
        			</select>
    			</div>
    			<div class="col-sm">
        			<label for="per_page"><b>Resultados/Página:</b></label>
        			<select name="per_page" id="per_page">
						<option value="5" <?= isset($_GET['per_page']) && $_GET['per_page'] == '5' ? 'selected' : '' ?>>5</option>
            			<option value="10" <?= isset($_GET['per_page']) && $_GET['per_page'] == '10' ? 'selected' : '' ?> selected="selected">10</option>
						<option value="20" <?= isset($_GET['per_page']) && $_GET['per_page'] == '20' ? 'selected' : '' ?>>20</option>
						<option value="50" <?= isset($_GET['per_page']) && $_GET['per_page'] == '50' ? 'selected' : '' ?>>50</option>
        			</select>
    			</div>
    			<div class="col-sm">
    			</div>
    			<div class="col-sm">
      				<button type="submit" class="btn btn-primary">Filtrar</button>
    			</div>
  			</div>
			</form>
    	</div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%" scope="col">Data</th>
                            <th scope="col">Título</th>
                            <th scope="col">Resumo</th>
                            <th width="15%" scope="col">Tipo</th>
                            <th width="6%" scope="col">Acesso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row): ?>
                            <?php $PubDate = (new DateTime($row['PublicationDate']))->format('Y-m-d'); ?>
							<?php // Supondo que $document_id é o ID do documento
									$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
									$encrypted_id = openssl_encrypt($row['DocumentId'], $method, $key, 0, $iv);
									$encrypted_id = base64_encode($encrypted_id . '::' . $iv); ?>
                            <tr>
                                <td><?php echo htmlspecialchars($PubDate); ?></td>
                                <td><a href="/?page=publication&id=<?php echo urlencode($encrypted_id); ?>" class="linktable"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td>
                                <td><?php echo htmlspecialchars($row['DocumentSummary']); ?></td>
                                <td><?php echo htmlspecialchars($row['CollectionsName']); ?></td>
                                <td><?php echo htmlspecialchars($row['AccessName']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Navegação de Paginação -->
                <nav class="tableP">
                    <ul class="pagination">
                        <?php if ($pg > 1): ?>
                            <li class="page-item">
								<a href="?page=show_author&id=<?= $encrypted_userid ?>&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $pg - 1; ?>" class="page-link linktable">Anterior</a>
							</li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item">
								<a href="?page=show_author&id=<?= $encrypted_userid ?>&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $i; ?>" class="page-link linktable"><?= $i; ?></a>
							</li>
                        <?php endfor; ?>
                        <?php if ($pg < $total_pages): ?>
                            <li class="page-item">
								<a href="?page=show_author&id=<?= $encrypted_userid ?>&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $pg + 1; ?>" class="page-link linktable ">Próxima</a>
							</li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php else: ?>
                <p>Nenhum resultado encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</html>