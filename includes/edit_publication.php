<?php
require_once 'functions/edit_publish.inc.php';
require_once 'views/update_view.inc.php';
?>
<html>
	<div class="container p-5 my-4 bg-light rounded-3"> 
    	<h2 class="pb-2 border-bottom h2title">Editar relatorio</h2>
		<form action="functions/edit_publish_update.inc.php" method="post">
		<?php
			check_update_errors();
			?>
			<div class="table-responsive">
        	<table class="table unstriped table-hover">	
          		<thead>
            		<tr>
						<td width="30%">Autor(a):</td>
						<td><?php echo htmlspecialchars($documento['UserFName'] ." ". $documento['UserLName']); ?></td>
            		</tr>   
          		</thead>   
          		<tbody>
            		<tr>
						<td width="30%">Título:</td>
						<td><textarea type='text' name='DocumentTitle' style="width: -webkit-fill-available" maxlength="45"><?php echo htmlspecialchars($documento['DocumentTitle']); ?></textarea></td>
            		</tr>
					<tr>
						<td width="30%">Palavras-chave:</td>
						<td><textarea type='text' name='DocumentWordkey' style="width: -webkit-fill-available" maxlength="45"><?php echo htmlspecialchars($documento['DocumentWordKey']); ?></textarea></td>
            		</tr> 
					<tr>
						<td width="30%">Descrição:</td>
						<td><textarea type='text' name='DocumentDescription' style="width: -webkit-fill-available"><?php echo htmlspecialchars($documento['DocumentDescription']); ?></textarea></td>
            		</tr> 
					<tr>
						<td width="30%">Resumo:</td>
						<td><textarea type='text' name='DocumentSummary' style="width: -webkit-fill-available"><?php echo htmlspecialchars($documento['DocumentSummary']); ?></textarea></td>
            		</tr>
					<tr>
						<td width="30%">Tipo de relatorio:</td>
						<td>
							<select class="select" name="CollectionsID" aria-label="Collection select" required>
								<option value="" selected disabled hidden>Escolher tipo de relatório!</option>
  								<option value="1">Relatorio de estágio</option>
  								<option value="2">Relatorio de projecto</option>
							</select>
						</td>
            		</tr>
					<tr>
						<td width="30%">Acesso:</td>
						<td>
							<select class="select" name="AccessID" aria-label="Access select" required>
								<option value="" selected disabled hidden>Escolher acesso ao documento!</option>
  								<option value="1">Publico</option>
  								<option value="2">Restrito</option>
							</select>
						</td>
            		</tr>
					<tr>
						<td width="30%">Estado:</td>
						<td>
							<select class="select" name="StateID" aria-label="State select" required>
								<option value="" selected disabled hidden>Escolher estado do documento!</option>
  								<option value="1">Aberto</option>
  								<option value="2">Fechado</option>
							</select>
						</td>
            		</tr>
          		</tbody>   
        	</table>
			</div>
			<!-- TABELA COM DADOS DO DOCUMENTO PUBLICADO PELO AUTOR! -->
			<div class="table-responsive">
			<table class="table unstriped table-hover">
          		<thead>
            		<tr>
						<th>Ficheiro desta publicação</th>
						<th></th>
						<th></th>
						<th></th>
            		</tr>   
          		</thead>
				<tbody>
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
				</tbody>
			</table>
			<div class="col-6 col-sm-4 mx-auto">
            	<div class="d-grid">
                  	<?php if ($doc_status != 2): ?>
        				<button class="btn btn-lg" data-toggle="button">Editar Relatorio</button>
    				<?php else: ?>
        				<p class="alert alert-danger" role="alert"><?= $status_message ?></p>
   	 				<?php endif; ?>
                </div>
          	</div>
			</div>
		</form>
	</div>
</html>
