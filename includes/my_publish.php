<?php
require_once 'functions/my_publish.inc.php';
?>
<html>
<div class="container">
    		<div class="p-5 my-4 bg-light rounded-3">	 
	<h2>
        As minhas publicações. 
	</h2>
	<br>
	<div>   
    	<table class="table table-striped table-condensed table-bordered">   
        	<thead>
            	<tr>   
            		<th width="14%">Data de publicação</th>
					<th >Titulo</th>
					<th width="20%">Tipo</th>
					<th width="10%">Estado</th>
            	</tr>   
          	</thead>   
     		<tbody>   
    		<?php 
			foreach ($reports as $row) {
					$PublicationDateTime = new DateTime($row['PublicationDate']);
        			$PubDate = $PublicationDateTime->format('Y-m-d');
			?>     
            	<tr>
					<td><?php echo htmlspecialchars($PubDate); ?></td>
            		<td><a href="/?page=edit_publication&id=<?php echo $row['DocumentId']; ?>"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td>     
            		<td><?php echo htmlspecialchars($row['CollectionsName']); ?></td>
					<td><?php echo htmlspecialchars($row['StateName']); ?></td>
            	</tr>     
            <?php     
            };    
           	?>
          	</tbody>   
        </table>
		<div>
        <?php if ($page > 1): ?>
        	<a href="?page=<?php echo $page - 1; ?>">Anterior</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Próxima</a>
        <?php endif; ?>
    	</div>
	</div>
</div>
</html>