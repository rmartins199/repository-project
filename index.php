<?php
require_once 'functions/config_session.inc.php';
//require_once 'functions/pagination.inc.php';

// Função para carregar a página solicitada
function loadPage($page) {
    $allowed_pages = ['home', 'login', 'registration', 'collections', 'dateissued', 'author', 'publication', 'logged', 'publish', 'my_publish', 'edit_publication', 'show_author', 'show_collections', 'edit_perfil'];
    if (in_array($page, $allowed_pages)) {
        include __DIR__ . '/includes/' . $page . '.php';
    } else {
        echo "<h2>Página não encontrada</h2>";
        echo "<p>A página que procura não existe.</p>";
    }
}

// Determina a página a ser carregada com base no parâmetro 'page' da URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
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
    <div class="px-3 py-2 imgheader">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="?page=home" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-decoration-none">
            <img class="img-responsive" src="assets/images/logo_ipmaia.png" alt="Repositório TIWM">
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="/" class="btn">
                Página principal
              </a>
            </li>
			  
            <li>                                        
  				<a class="btn dropdown-toggle nav-link text-white" href="#" role="button" id="dropdownPercorrer" data-bs-toggle="dropdown" aria-expanded="false">
    			Percorrer
  				</a>

  				<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<li><a class="dropdown-item" href="?page=collections">Coleções</a></li>
    				<li><a class="dropdown-item" href="?page=dateissued">Data de Publicação</a></li>
    				<li><a class="dropdown-item" href="?page=author">Autor</a></li>
  				</ul>
            </li>

            <li>                                        
  				<a class="btn dropdown-toggle nav-link text-white" href="#" role="button" id="dropdownIdioma" data-bs-toggle="dropdown" aria-expanded="false">
    			Idioma
  				</a>
  				<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    				<li><a class="dropdown-item" href="/">PT</a></li>
    				<li><a class="dropdown-item" href="?page=teste">EN</a></li>
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
				<a href="?page=logged" class="btn text-white" role="button">
				<svg xmlns="assets/bootstrap-icons-1.11.3/person-fill.svg" width="18" height="22" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 18 22">
  					<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
				</svg>Área Pessoal</a>
		<?php }else { ?>
        	<div class="text-end">
				<a href="?page=login" class="btn text-white" role="button">
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
<main class="flex-shrink-0 maincss">
	<?php loadPage($page); ?>
</main>
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
</body>
</html>