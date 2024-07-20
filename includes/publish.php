<?php
require_once 'functions/config_session.inc.php';

if(!isset($_SESSION['user_id'])){ //if login in session is not set
    header("Location:./login.php");
}

require_once 'views/login_view.inc.php';
?>
<html>
<div class="container">
    		<div class="p-5 my-4 bg-light rounded-3">
				<form action="functions/upload.inc.php" method="post" enctype="multipart/form-data">
					<div class="row justify-content-center rowregister">
  						<div class="col-6 col-sm-8">
				 			<label for="DocumentTitle" class="form-label"><b>Titulo do relatorio:</b></label>
    						<input type="text" class="form-control" name="DocumentTitle" id="DocumentTitle" placeholder="Titulo do relatorio!">
  						</div>
  						<div class="col-6 col-sm-8">
				 			<label for="DocumentWordkey" class="form-label"><b>Palavras chaves:</b></label>
    						<input type="text" class="form-control" name="DocumentWordkey" id="DocumentWordkey" placeholder="Palavras chaves!">
  						</div>
  						<div class="col-6 col-sm-8">
				 			<label for="DocumentSummary" class="form-label"><b>Resumo:</b></label>
    						<input type="text" class="form-control" name="DocumentSummary" id="DocumentSummary" placeholder="Resumo!">
  						</div>
  						<div class="col-6 col-sm-8">
				 			<label for="DocumentDescription" class="form-label"><b>Descrição:</b></label>
    						<input type="text" class="form-control" name="DocumentDescription" id="DocumentDescription" placeholder="Descrição!">
  						</div>
  						<div class="col-6 col-sm-8">
				 			<label for="DocumentFile" class="form-label"><b>Upload relatorio:</b></label>
    						<input type="file" name="file" class="form-control" accept=".pdf" title="Upload PDF"/>
  						</div>
						<hr style="width:65%;text-align:left;margin-bottom: 20px;margin-top: 20px">
  						<div class="col-6 col-sm-8">
							<label for="CollectionsID" class="form-label"><b>Tipo de relatorio:</b></label>
				 			<select class="form-select" name="CollectionsID" aria-label="Default select example">
  								<option value="1">Relatorio de estágio</option>
  								<option value="2">Relatorio de projecto</option>
							</select>
  						</div>
						<hr style="width:65%;text-align:left;margin-bottom: 20px;margin-top: 20px">
  						<div class="col-6 col-sm-8">
							<label for="AccessID" class="form-label"><b>Nivel de acesso permitido:</b></label>
				 			<select class="form-select" name="AccessID" aria-label="Default select example">
  								<option value="1">Publico</option>
  								<option value="2">Restrito</option>
							</select>
  						</div>
						<hr style="width:65%;text-align:left;margin-bottom: 20px;margin-top: 20px">
  						<div class="col-6 col-sm-8">
							<label for="StateID" class="form-label"><b>Estado do relatorio:</b></label>
				 			<select class="form-select" name="StateID" aria-label="Default select example">
  								<option value="1">Aberto</option>
  								<option value="2">Fechado</option>
							</select>
  						</div>
						<row>
              				<div class="col-6 col-sm-4 mx-auto">
                				<div class="d-grid">
                  				<button class="btn btn-lg text-white btn-register" data-toggle="button">Submeter Relatorio</button>
                				</div>
              				</div>
						</row>
  					</div>
				</form>
				<h2>
					<?php
					output_email();
					?>
				</h2>
			</div>
		</div>
</html>