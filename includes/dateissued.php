<?php
require_once 'functions/config_session.inc.php';
require_once 'functions/dateissued.inc.php';
?>
<html>
<div class="container">
    <div class="p-5 my-4 bg-light rounded-3">	 
	<h2 class="pb-2 border-bottom h2title">Pesquisar por data</h2>
	<div>   
    	<table class="table unstriped table-hover">   
        	<thead>
            	<tr>   
            		<th width="15%" scope="col">Data de publicação</th>
					<th scope="col">Titulo</th>
            		<th scope="col">Autor(a)</th>
					<th scope="col">Tipo</th>
					<th scope="col">Acesso</th>
            	</tr>   
          	</thead>   
     		<tbody>   
    		<?php 
			foreach ($results as $row) {
					$PublicationDateTime = new DateTime($row['PublicationDate']);
        			$PubDate = $PublicationDateTime->format('Y-m-d');
			?>     
            	<tr>
					<td><?php echo htmlspecialchars($PubDate); ?></td>
            		<td><a href="/?page=publication&id=<?php echo $row['DocumentId']; ?>"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td>
					<td><?php echo $row['UserFName'], " ", $row['UserLName']; ?></td>     
            		<td><?php echo htmlspecialchars($row['CollectionsName']); ?></td>
					<td><?php echo htmlspecialchars($row['AccessName']); ?></td>
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
        		<li class="page-item"><a href="/?page=dateissued&pg=<?php echo $page - 1; ?>" class="page-link">Anterior</a></li>
        	<?php endif; ?>
        	<?php for ($i = 1; $i <= $total_pages; $i++): ?>
            	<li class="page-item"><a href="/?page=dateissued&pg=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
        	<?php endfor; ?>
        	<?php if ($page < $total_pages): ?>
            	<li class="page-item"><a href="/?page=dateissued&pg=<?php echo $page + 1; ?>" class="page-link">Próxima</a></li>
        	<?php endif; ?>
			</ul>
        </nav>
    	</div>
	</div>
</div>
</html>