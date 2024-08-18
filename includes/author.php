<?php
require_once 'functions/author.inc.php';
?>
<html>
	<div class="container p-5 my-4 bg-light rounded-3">
		<h2 class="pb-2 border-bottom h2title">Pesquisar por autor</h2>
		<div class="browse_controls">
    		<form method="GET" action="">
				<div class="row justify-content-md-center">
              		<div class="col-sm">
        				<input type="hidden" name="page" value="author">
        				<label for="order"><b>Ordenar por:</b></label>
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
						<label for="letter"><b>Nome começa com:</b></label>
        				<select name="letter" id="letter">
            				<option value="">Todos</option>
            				<?php
            				foreach (range('A', 'Z') as $letter_option) {
                				$selected = isset($_GET['letter']) && $_GET['letter'] == $letter_option ? 'selected' : '';
                				echo "<option value=\"$letter_option\" $selected>$letter_option</option>";
            				}
            				?>
        				</select>
					</div>
					<div class="col-sm">
        				<button type="submit" class="btn">Filtrar</button>
					</div>
				</div>
    		</form>
		</div>
			<?php 
				foreach ($results as $row):
			?>
  			<ul class="list-group list-group-flush list-group-item">
    			<li class="list-group-item"><a href="/?page=show_author&id=<?php echo $row['userLogin_UserID']; ?>" class="linktable"><?php echo $row['UserFName'], " ", $row['UserLName']; ?>
				<span class="badge rounded-pill bg-secondary float-end"><?php echo $row['Total']; ?></span>
				</li>
  			</ul>
			<?php endforeach; ?>
    	<!-- Navegação de Paginação -->
    	<nav class="tableP">
        	<ul class="list-group list-group-horizontal">
            <?php if ($pg > 1): ?>
                <li class="list-group-item"><a href="?page=author&order=<?= $order ?>&per_page=<?= $per_page ?>&letter=<?= $letter ?>&pg=<?= $pg - 1; ?>" class="linktable">Anterior</a></li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="list-group-item"><a href="?page=author&order=<?= $order ?>&per_page=<?= $per_page ?>&letter=<?= $letter ?>&pg=<?= $i; ?>" class="linktable"><?= $i; ?></a></li>
            <?php endfor; ?>
            <?php if ($pg < $total_pages): ?>
                <li class="list-group-item"><a href="?page=author&order=<?= $order ?>&per_page=<?= $per_page ?>&letter=<?= $letter ?>&pg=<?= $pg + 1; ?>" class="linktable">Próxima</a></li>
            <?php endif; ?>
        	</ul>
    	</nav>
	</div>
</html>