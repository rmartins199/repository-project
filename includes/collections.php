<?php
require_once 'functions/db.inc.php';

$query = "
        SELECT d.collections_CollectionsID,c.CollectionsName, COUNT(c.CollectionsID) AS Total
		FROM document d
		INNER JOIN (
    	SELECT CollectionsID, CollectionsName, COUNT(*) AS Total
    	FROM collections
    	GROUP BY CollectionsID
		) c ON d.collections_CollectionsID = c.CollectionsID
		GROUP BY c.CollectionsID";
$stmt = $pdo->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
	<div class="container">
    	<div class="p-5 my-4 bg-light rounded-3">
			<h2 class="pb-2 border-bottom">Comunidades e Colecções</h2>
			</br>
		    <?php 
			foreach ($results as $row) {
			?>
			<div class="list-group w-100">
    			<a href="#" class="list-group-item list-group-item-action">
        			<i class="bi-camera-fill"></i> <?php echo htmlspecialchars($row['CollectionsName']); ?>
        			<span class="badge rounded-pill bg-primary float-end"><?php echo htmlspecialchars($row['Total']); ?></span>
    			</a>
			</div>
		    <?php     
            	};    
           	?>
		</div>
	</div>
</html>
