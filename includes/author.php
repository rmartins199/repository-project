<?php
require_once 'functions/config_session.inc.php';
require_once 'functions/author.inc.php';
?>
<html>
	<div class="container">
    	<div class="p-5 my-4 bg-light rounded-3">
			<div class="panel panel-primary">
				<h2 class="pb-2 border-bottom">Comunidades e Colecções</h2>
				</br>
				<?php 
				foreach ($results as $row):
				?>
  				<ul class="list-group list-group-flush list-group-item">
    				<li class="list-group-item"><?php echo $row['UserFName'], " ", $row['UserLName']; ?>
					<span class="badge rounded-pill bg-primary float-end"><?php echo $row['Total']; ?></span>
					</li>
  				</ul>
				<?php endforeach; ?>
				</br>
					<ul class="list-group list-group-horizontal">
						<?php if ($page > 1): ?>
  					<li class="list-group-item"><a href="?page=author&pg=<?php echo $page - 1; ?>">Anterior</a>
						</li>
						<?php endif; ?>
						<?php for ($i = 1; $i <= $total_pages; $i++): ?>
  					<li class="list-group-item"><a href="?page=author&pg=<?php echo $i; ?>"><?php echo $i; ?></a>
						</li>
						<?php endfor; ?>
						<?php if ($page < $total_pages): ?>
  					<li class="list-group-item"><a href="?page=author&pg=<?php echo $page + 1; ?>">Próxima</a>
						</li>
						<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</html>