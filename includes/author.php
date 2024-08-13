<?php
require_once 'functions/author.inc.php';
?>
<html>
	<div class="container">
    	<div class="p-5 my-4 bg-light rounded-3">
		<h2 class="pb-2 border-bottom h2title">Pesquisar por autor</h2>
			<div id="browse_controls" class="AFiltro">
    			<form method="GET" action="">
					<div class="row gy-3 gy-md-4 overflow-hidden">
              			<div class="col-6 aligncenter">
        					<input type="hidden" name="page" value="author">
        					<label for="order"><b>Ordenar por:</b></label>
        					<select name="order" id="order">
            					<option value="ASC" <?= isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'selected' : '' ?>>Ascendente</option>
            					<option value="DESC" <?= isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'selected' : '' ?>>Descendente</option>
        					</select>
						</div>
						<div class="col-6 aligncenter">
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
						<div class="col-12 aligncenter_btn">
        					<button class="btn_filtro text-white" type="submit">Filtrar</button>
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
    		<nav>
        		<ul class="list-group list-group-horizontal">
            	<?php if ($pg > 1): ?>
                	<li class="list-group-item"><a href="?page=author&order=<?= $order ?>&letter=<?= $letter ?>&pg=<?= $pg - 1; ?>" class="linktable">Anterior</a></li>
            	<?php endif; ?>
            	<?php for ($i = 1; $i <= $total_pages; $i++): ?>
                	<li class="list-group-item"><a href="?page=author&order=<?= $order ?>&letter=<?= $letter ?>&pg=<?= $i; ?>" class="linktable"><?= $i; ?></a></li>
            	<?php endfor; ?>
            	<?php if ($pg < $total_pages): ?>
                	<li class="list-group-item"><a href="?page=author&order=<?= $order ?>&letter=<?= $letter ?>&pg=<?= $pg + 1; ?>" class="linktable">Próxima</a></li>
            	<?php endif; ?>
        		</ul>
    		</nav>
		</div>
	</div>
</html>