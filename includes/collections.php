<?php
require_once 'functions/collections.inc.php';
?>
<html>
	<div class="container p-5 my-4 bg-light rounded-3">
		<h2 class="pb-2 border-bottom h2title">Pesquisar por coleção</h2>
		<div class="browse_controls">
			<form method="GET" action="">
			<div class="row justify-content-md-center">
    			<div class="col-sm">
        			<input type="hidden" name="page" value="collections">
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
			<?php 
			foreach ($collection_results as $row):
			?>
  				<ul class="list-group list-group-flush list-group-item">
    				<li class="list-group-item"><a href="/?page=show_collections&id=<?php echo $row['collections_CollectionsID']; ?>" class="linktable"><?php echo htmlspecialchars($row['CollectionsName']); ?>
					<span class="badge rounded-pill bg-secondary float-end"><?php echo htmlspecialchars($row['Total']); ?></span>
					</li>
  				</ul>
			<?php endforeach; ?>
        <!-- Navegação de Paginação -->
        <nav class="tableP">
        	<ul class="pagination">
			<?php if ($pg > 1): ?>
  				<li class="page-item">
					<a href="?page=collections&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $pg - 1; ?>" class="page-link">Anterior</a>
				</li>
			<?php endif; ?>
			<?php for ($i = 1; $i <= $total_pages; $i++): ?>
  				<li class="page-item">
					<a href="?page=collections&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $i; ?>" class="page-link"><?= $i; ?></a>
				</li>
			<?php endfor; ?>
			<?php if ($pg < $total_pages): ?>
  				<li class="page-item">
					<a href="?page=collections&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $pg + 1; ?>" class="page-link">Próxima</a>
				</li>
			<?php endif; ?>
        	</ul>
    	</nav>
	</div>
</html>
