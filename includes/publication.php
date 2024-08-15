<?php
require_once 'functions/config_session.inc.php';
require_once 'functions/publication.inc.php';
?>

<html>
<div class="container">
    		<div class="p-5 my-4 bg-light rounded-3">
				<div>   
        			<h2 class="pb-2 border-bottom">Relatorio publicado</h2>   
        			</br>
        			<table class="table table-hover tablecss1">   
          				<thead>
            				<tr>
								<td width="30%">Autor(a):</td>
								<td><?php echo htmlspecialchars($documento['UserFName'] ." ". $documento['UserLName']); ?></td>
            				</tr>   
          				</thead>   
          				<tbody>        
            				<tr>
								<td width="30%">Título:</td>
								<td><?php echo htmlspecialchars($documento['DocumentTitle']); ?></td>
            				</tr>
							<tr>
								<td width="30%">Palavras-chave:</td>
								<td><?php echo htmlspecialchars($documento['DocumentWordKey']); ?></td>
            				</tr> 
            				<tr>
								<td width="30%">Data de publicação:</td>
								<td><?php echo htmlspecialchars($documento['PublicationDate']); ?></td>
            				</tr> 
							<tr>
								<td width="30%">Resumo:</td>
								<td><?php echo htmlspecialchars($documento['DocumentSummary']); ?></td>
            				</tr>
          				</tbody>   
        			</table>
					<!-- TABELA COM DADOS DO DOCUMENTO PUBLICADO PELO AUTOR! -->
					<table class="table table-hover">
          				<thead>
            				<tr>
								<th>Ficheiro desta publicação</th>
								<th></th>
								<th></th>
								<th></th>
            				</tr>   
          				</thead>
						<tr>
							<td width="30%"><b>Nome</b></td>
							<td width="20%"><b>Tamanho</b></td>
							<td width="30%"><b>Formato</b></td>
							<td width=""></td>
            			</tr>
						<tr>
							<td><?php echo htmlspecialchars($documento['FileName']); ?></td>
							<td><?php echo htmlspecialchars($formattedSize); ?></td>
							<td><?php echo htmlspecialchars($documento['FileType']); ?></td>
							<td><a href="functions/view_pdf.php?id=<?php echo htmlspecialchars($documento['FileID']); ?>" target="_blank" class="btn btn-secondary btn-sm">Ver/Abrir</a></td>
            			</tr>
					</table>
				</div>
			</div>
		</div>
</html>
