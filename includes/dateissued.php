<?php
require_once 'functions/config_session.inc.php';
require_once 'functions/dateissued.inc.php';
?>
<html>
<div class="container">
    <div class="p-5 my-4 bg-light rounded-3">	 
	<h2 class="pb-2 border-bottom">Por data de publicação</h2>
	</br>
	<div>   
    	<table class="table table-striped table-condensed table-bordered">   
        	<thead>
            	<tr>   
            		<th width="15%">Data de publicação</th>
					<th >Titulo</th>
            		<th>Autor(a)</th>
					<th>Tipo</th>
					<th>Acesso</th>
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
		<div>
        <?php if ($page > 1): ?>
        	<a href="/?page=dateissued&pg=<?php echo $page - 1; ?>">Anterior</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="/?page=dateissued&pg=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
            <a href="/?page=dateissued&pg=<?php echo $page + 1; ?>">Próxima</a>
        <?php endif; ?>
    	</div>
	</div>
</div>
</html>