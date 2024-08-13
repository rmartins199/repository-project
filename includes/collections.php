<?php
require_once 'functions/collections.inc.php';
?>

<html>
	<div class="container">
    	<div class="p-5 my-4 bg-light rounded-3">
			<h2 class="pb-2 border-bottom h2title">Pesquisar por coleção</h2>
			</br>
			<?php 
			foreach ($collection_results as $row):
			?>
  				<ul class="list-group list-group-flush list-group-item">
    				<li class="list-group-item"><a href="/?page=show_collections&id=<?php echo $row['collections_CollectionsID']; ?>" class="linktable"><?php echo htmlspecialchars($row['CollectionsName']); ?>
					<span class="badge rounded-pill bg-secondary float-end"><?php echo htmlspecialchars($row['Total']); ?></span>
					</li>
  				</ul>
			<?php endforeach; ?>
			</br>
			<ul class="list-group list-group-horizontal">
				<?php if ($page > 1): ?>
  				<li class="list-group-item"><a href="?page=collections&pg=<?php echo $page - 1; ?>" class="linktable">Anterior</a>
					</li>
				<?php endif; ?>
				<?php for ($i = 1; $i <= $total_pages; $i++): ?>
  				<li class="list-group-item"><a href="?page=collections&pg=<?php echo $i; ?>" class="linktable"><?php echo $i; ?></a>
					</li>
				<?php endfor; ?>
				<?php if ($page < $total_pages): ?>
  				<li class="list-group-item"><a href="?page=collections&pg=<?php echo $page + 1; ?>" class="linktable">Próxima</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</html>
