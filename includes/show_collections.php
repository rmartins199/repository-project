<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'functions/show_collections.inc.php';

// É defenida uma chave de encriptação segura
$key = "xAHgjhu32bE%!Mop7u%Ae7g7%V6Pv6oC"; // A chave deve ter 16, 24 ou 32 caracteres (neste caso é de 32)
$method = "aes-256-cbc";
?>
<html>
    <div class="container">
        <div class="p-5 my-4 bg-light rounded-3">
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $result): ?>
                    <?php if (!in_array($result['CollectionName'], $unique_names)): ?>
                        <h2 class="pb-2 border-bottom h2title"><?php echo htmlspecialchars($result['CollectionName']); ?></h2>
                    <?php $unique_names[] = $result['CollectionName']; ?>
               	<?php endif; ?>
            <?php endforeach; ?>
			<div id="browse_controls" class="AFiltro">
				<div class="col-12 text-center">
    			<form method="GET" action="">
        			<input type="hidden" name="page" value="show_collections">
        			<input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        			<label for="order"><b>Ordenar por data:</b></label>
        			<select name="order" id="order">
            			<option value="ASC" <?= isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'selected' : '' ?>>Ascendente</option>
            			<option value="DESC" <?= isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'selected' : '' ?>>Descendente</option>
        			</select>
				</div>
				<div class="col-12 text-center">
        			<button type="submit" class="btn btn-primary">Ordenar</button>
				</div>
			</form>
			</div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%" scope="col">Data</th>
							<th scope="col">Autor(a)</th>
                            <th scope="col">Título</th>
                            <th scope="col">Resumo</th>
                            <th width="6%" scope="col">Estado</th>
                            <th width="6%" scope="col">Acesso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row): ?>
                            <?php $PubDate = (new DateTime($row['PublicationDate']))->format('Y-m-d'); 
							// Recolhe o ID pretendido para encriptação que neste caso é 'DocumentId'
							$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
							$encrypted_id = openssl_encrypt($row['DocumentId'], $method, $key, 0, $iv);
							$encrypted_id = base64_encode($encrypted_id . '::' . $iv); ?>
                            <tr>
                                <td><?php echo htmlspecialchars($PubDate); ?></td>
								<td><?php echo $row['UserFName'], " ", $row['UserLName']; ?></td>
                                <td><a href="/?page=publication&id=<?php echo urlencode($encrypted_id); ?>" class="linktable"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td>
                                <td><?php echo htmlspecialchars($row['DocumentSummary']); ?></td>
                                <td><?php echo htmlspecialchars($row['StateName']); ?></td>
                                <td><?php echo htmlspecialchars($row['AccessName']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Navegação de Paginação -->
                <nav class="tableP">
                    <ul class="pagination">
                        <?php if ($pg > 1): ?>
                            <li class="page-item"><a href="?page=show_collections&id=<?= $id ?>&order=<?= $order ?>&pg=<?= $pg - 1; ?>" class="page-link linktable">Anterior</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item"><a href="?page=show_collections&id=<?= $id ?>&order=<?= $order ?>&pg=<?= $i; ?>" class="page-link linktable"><?= $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($pg < $total_pages): ?>
                            <li class="page-item"><a href="?page=show_collections&id=<?= $id ?>&order=<?= $order ?>&pg=<?= $pg + 1; ?>" class="page-link linktable">Próxima</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php else: ?>
                <p>Nenhum resultado encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</html>