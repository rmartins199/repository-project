<?php
// Conecta a ficheiros externos (por exemplo base dados)
require_once 'functions/show_author.inc.php';
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
			<div id="browse_controls" class="AFiltro">
				<div class="col-12 text-center">
    			<form method="GET" action="">
        			<input type="hidden" name="page" value="show_author">
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
                            <th width="15%" scope="col">Data</th>
                            <th scope="col">Título</th>
                            <th scope="col">Resumo</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Acesso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row): ?>
                            <?php $PubDate = (new DateTime($row['PublicationDate']))->format('Y-m-d'); ?>
                            <tr>
                                <td><?php echo htmlspecialchars($PubDate); ?></td>
                                <td><a href="/?page=publication&id=<?php echo $row['DocumentId']; ?>"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td>
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
                            <li class="page-item"><a href="?page=show_author&id=<?= $id ?>&order=<?= $order ?>&pg=<?= $pg - 1; ?>" class="page-link">Anterior</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item"><a href="?page=show_author&id=<?= $id ?>&order=<?= $order ?>&pg=<?= $i; ?>" class="page-link"><?= $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($pg < $total_pages): ?>
                            <li class="page-item"><a href="?page=show_author&id=<?= $id ?>&order=<?= $order ?>&pg=<?= $pg + 1; ?>" class="page-link">Próxima</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php else: ?>
                <p>Nenhum resultado encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</html>