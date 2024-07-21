<?php
require_once 'functions/config_session.inc.php';
require_once 'functions/pagination.inc.php';
?>
<html>
<div class="container">
    		<div class="p-5 my-4 bg-light rounded-3">	 
	<h2>
        Pesquisar por data de publicação 
	</h2>
	
	<!--PESQUISAR POR DATA DE PUBLICAÇÃO -->
	<div id="browse_navigation" class="well text-center">
	<form method="get" action="/browse">
			<input type="hidden" name="type" value="dateissued"/>
			<input type="hidden" name="sort_by" value="2"/>
			<input type="hidden" name="order" value="ASC"/>
			<input type="hidden" name="rpp" value="20"/>
			<input type="hidden" name="etal" value="-1" />
	
		<span>Seleccione:</span>
		<select name="year">
	        <option selected="selected" value="-1">(Seleccione ano)</option>
            <option>2024</option>
            <option>2023</option>
            <option>2022</option>
            <option>2021</option>

        </select>
        <select name="month">
            <option selected="selected" value="-1">(Seleccione mês)</option>
	         <option value="1">Janeiro</option>
	         <option value="2">Fevereiro</option>
	         <option value="3">Março</option>
	         <option value="4">Abril</option>
	         <option value="5">Maio</option>
	         <option value="6">Junho</option>
	         <option value="7">Julho</option>
	         <option value="8">Agosto</option>
	         <option value="9">Setembro</option>
	         <option value="10">Outubro</option>
	         <option value="11">Novembro</option>
	         <option value="12">Dezembro</option>
        </select>
        <input type="submit" class="btn btn-default" value="Enviar" />
		</form>
	</div>		
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
            		<td><a href="publication.php?id=<?php echo $row['DocumentId']; ?>"><?php echo htmlspecialchars($row['DocumentTitle']); ?></a></td>
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