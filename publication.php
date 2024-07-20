<?php
require_once 'functions/config_session.inc.php';
require_once 'functions/publication.inc.php';
?>
<!DOCTYPE html>
<html lang="PT-pt" class="h-100">	
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<title>Repositorio TIWM</title>
	<link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
	<link href="assets/css/style.css" rel="stylesheet">
	<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</head>
	
<body class="d-flex flex-column h-100">
<!--		DEDICADO AO HEADER		-->
  <header>
	  <!--		TOP MENU		-->
    <div class="px-3 py-2 text-white imgheader">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="?page=home" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <img class="img-responsive" src="assets/image/logo_ipmaia.png" alt="Repositório TIWM">
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="/" class="btn text-white">
                Página principal
              </a>
            </li>
			  
            <li>                                        
  				<a class="btn dropdown-toggle nav-link text-white" href="#" role="button" id="dropdownPercorrer" data-bs-toggle="dropdown" aria-expanded="false">
    			Percorrer
  				</a>

  				<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<li><a class="dropdown-item" href="/?page=collections">Coleções</a></li>
					<li><hr class="dropdown-divider"></li>
    				<li><a class="dropdown-item" href="/?page=dateissued">Data de Publicação</a></li>
    				<li><a class="dropdown-item" href="/?page=author">Autor</a></li>
    				<li><a class="dropdown-item" href="/?page=type">Assunto</a></li>
  				</ul>
            </li>

            <li>                                        
  				<a class="btn dropdown-toggle nav-link text-white" href="#" role="button" id="dropdownIdioma" data-bs-toggle="dropdown" aria-expanded="false">
    			Idioma
  				</a>
  				<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    				<li><a class="dropdown-item" href="#">PT</a></li>
    				<li><a class="dropdown-item" href="#">EN</a></li>
  				</ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
	  <!--		FIM DE TOP MENU		-->
    <div class="px-3 py-2 border-bottom mb-3">
      <div class="container d-flex flex-wrap justify-content-center">
        <form class="d-flex col-lg-auto me-lg-auto">
          	<input type="search" class="form-control" placeholder="Pesquisar...">
		 		<button class="btn text-white" type="submit">
				<svg xmlns="assets/bootstrap-icons-1.11.3/search.svg" width="22" height="22" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
				</svg>
			</button>
        </form>
		<?php 
		if (isset($_SESSION["user_id"])){ ?>
        	<div class="text-end">
				<a href="/?page=logged" class="btn text-white" role="button">
				<svg xmlns="assets/bootstrap-icons-1.11.3/person-fill.svg" width="18" height="22" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 18 22">
  					<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
				</svg>Área Pessoal</a>
		<?php }else { ?>
        	<div class="text-end">
				<a href="/?page=login" class="btn text-white" role="button">
				<svg xmlns="assets/bootstrap-icons-1.11.3/person-fill.svg" width="18" height="22" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 18 22">
  					<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
				</svg>Área Pessoal</a>
		<?php } ?>
        	</div>
		<?php 
		if (isset($_SESSION["user_id"])){ ?>
        	<div class="text-end">
				<a href="functions/logout.inc.php" class="btn text-white" role="button">
				<svg xmlns="assets/bootstrap-icons-1.11.3/door-closed-fill.svg" width="18" height="22" fill="currentColor" class="bi door-closed-fill" viewBox="0 0 18 22">
  					<path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
				</svg>Logout</a>
        	</div>
			<?php } ?>
      		</div>
    	</div>
	</div>
  </header>
<!--	!!	 FIM DO HEADER	 !! 	-->
	<main class="flex-shrink-0">
		<div class="container">
    		<div class="p-5 my-4 bg-light rounded-3">
				<div>   
        			<h1>Pagination Simple Example</h1>   
        			<p>This page demonstrates the basic pagination using PHP and MySQL.</p>
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
								<td><?php echo htmlspecialchars($documento['DocumentoSummary']); ?></td>
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
							<td><?php echo htmlspecialchars((string)$documento['FileSize']); ?></td>
							<td><?php echo htmlspecialchars($documento['FileType']); ?></td>
							<td><a href="functions/view_pdf.php?id=<?php echo htmlspecialchars($documento['FileID']); ?>" target="_blank" class="btn btn-secondary btn-sm">Ver/Abrir</a></td>
            			</tr>
					</table>
				</div>
			</div>
		</div>
	</main>
	<!--	!!	DEDICADO AO FOOTER	!! 	-->
	<footer class="footer mt-auto px-3 py-2 imgfooter">
  		<div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="text-white">Copyright &copy; 2024</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-white">Ricardo Martins</p>
            </div>
        </div>
  		</div>
	</footer>
	<!--		FIM DO FOOTER		-->
</body>
</html>