<?php
require_once 'functions/config_session.inc.php';
require_once 'functions/dateissued.inc.php';

// É defenida uma chave de encriptação segura
$key = "xAHgjhu32bE%!Mop7u%Ae7g7%V6Pv6oC"; // A chave deve ter 16, 24 ou 32 caracteres (neste caso é de 32)
$method = "aes-256-cbc";
?>
<html>
<div class="container p-5 my-4 bg-light rounded-3">	 
	<h2 class="pb-2 border-bottom h2title">Pesquisar por data</h2>
		<div class="browse_controls">
			<form method="GET" action="">
			<div class="row justify-content-md-center">
    			<div class="col-sm">
        			<input type="hidden" name="page" value="dateissued">
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
			<div class="table-responsive">
    		<table class="table unstriped table-hover">   
        		<thead>
            		<tr>   
            			<th width="10%" scope="col">Data de publicação</th>
						<th scope="col">Autor(a)</th>
						<th scope="col">Titulo</th>
						<th scope="col">Resumo</th>
						<th width="15%" scope="col">Tipo</th>
						<th width="6%" scope="col">Acesso</th>
            		</tr>   
          		</thead>   
     			<tbody>   
    			<?php 
				foreach ($results as $row) {
						$PublicationDateTime = new DateTime($row['PublicationDate']);
        				$PubDate = $PublicationDateTime->format('Y-m-d');
						// Encripta DocumentId
						$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
						$encrypted_id = openssl_encrypt($row['DocumentId'], $method, $key, 0, $iv);
						$encrypted_id = base64_encode($encrypted_id . '::' . $iv);
				?>     
            		<tr>
						<td><?php echo htmlspecialchars($PubDate); ?></td>
						<td><?php echo $row['UserFName'], " ", $row['UserLName']; ?></td>
            			<td><a href="/?page=publication&id=<?php echo urlencode($encrypted_id); ?>" class="linktable"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td>
						<td><?php echo htmlspecialchars($row['DocumentSummary']); ?></td>
            			<td><?php echo htmlspecialchars($row['CollectionsName']); ?></td>
						<td><?php echo htmlspecialchars($row['AccessName']); ?></td>
            		</tr>     
            	<?php }; ?>
          		</tbody>   
        	</table>
			</div>
        <!-- Navegação de Paginação -->
        <nav class="tableP">
        	<ul class="pagination">
        	<?php if ($pg > 1): ?>
        		<li class="page-item">
					<a href="/?page=dateissued&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $pg - 1; ?>" class="page-link">Anterior</a>
				</li>
        	<?php endif; ?>
        	<?php for ($i = 1; $i <= $total_pages; $i++): ?>
            	<li class="page-item">
					<a href="?page=dateissued&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $i; ?>" class="page-link"><?= $i; ?></a>
				</li>
        	<?php endfor; ?>
        	<?php if ($pg < $total_pages): ?>
            	<li class="page-item">
					<a href="/?page=dateissued&order=<?= $order ?>&per_page=<?= $per_page ?>&pg=<?= $pg + 1; ?>" class="page-link">Próxima</a>
				</li>
        	<?php endif; ?>
			</ul>
        </nav>
</div>
</html>