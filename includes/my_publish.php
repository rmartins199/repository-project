<?php
require_once 'functions/my_publish.inc.php';

// É defenida uma chave de encriptação segura
$key = "xAHgjhu32bE%!Mop7u%Ae7g7%V6Pv6oC"; // A chave deve ter 16, 24 ou 32 caracteres (neste caso é de 32)
$method = "aes-256-cbc";
?>
<html>
<div class="container">
    		<div class="p-5 my-4 bg-light rounded-3">	 
	<h2>
        As minhas publicações. 
	</h2>
	<br>
	<div>   
    	<table class="table unstriped table-hover">   
        	<thead>
            	<tr>   
            		<th width="10%" scope="col">Data de publicação</th>
					<th >Titulo</th>
					<th scope="col">Resumo</th>
					<th width="15%" scope="col">Tipo</th>
					<th width="6%" scope="col">Estado</th>
            	</tr>   
          	</thead>   
     		<tbody>   
    		<?php 
			foreach ($reports as $row) {
					$PublicationDateTime = new DateTime($row['PublicationDate']);
        			$PubDate = $PublicationDateTime->format('Y-m-d');
					// Supondo que $document_id é o ID do documento
					$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
					$encrypted_id = openssl_encrypt($row['DocumentId'], $method, $key, 0, $iv);
					$encrypted_id = base64_encode($encrypted_id . '::' . $iv);
			?>     
            	<tr>
					<td><?php echo htmlspecialchars($PubDate); ?></td>
            		<td><a href="/?page=edit_publication&id=<?php echo urlencode($encrypted_id); ?>" class="linktable"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td> 
					<td><?php echo htmlspecialchars($row['DocumentSummary']); ?></td>    
            		<td><?php echo htmlspecialchars($row['CollectionName']); ?></td>
					<td><?php echo htmlspecialchars($row['StateName']); ?></td>
            	</tr>     
            <?php     
            };    
           	?>
          	</tbody>   
        </table>
        <!-- Navegação de Paginação -->
        <nav class="tableP">
        	<ul class="pagination">
        	<?php if ($page > 1): ?>
        		<li class="page-item"><a href="/?page=my_publish&pg=<?php echo $page - 1; ?>" class="page-link">Anterior</a></li>
        	<?php endif; ?>
        	<?php for ($i = 1; $i <= $total_pages; $i++): ?>
            	<li class="page-item"><a href="/?page=my_publish&pg=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
        	<?php endfor; ?>
        	<?php if ($page < $total_pages): ?>
            	<li class="page-item"><a href="/?page=my_publish&pg=<?php echo $page + 1; ?>" class="page-link">Próxima</a></li>
        	<?php endif; ?>
			</ul>
        </nav>
	</div>
</div>
</html>