<?php
require_once 'functions/profile.php';
?>
<html>
	<div class="container">
    	<div class="p-5 my-4 bg-light rounded-3">
    		<h2 class="pb-2 border-bottom">Bem vindo(a) <?php echo htmlspecialchars($user['UserFName']); ?></h2>
    			<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      				<div class="col d-flex align-items-start">
        				<div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          					<svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
        				</div>
        				<div>
          					<h2>Editar perfil</h2>
          					<p>É possivel alterar os dados de acesso por exemplo, nome, email, data de nascimento e password da conta.</p>
          					<a href="#" class="btn btn-primary">Editar perfil</a>
        				</div>
      				</div>
      				<div class="col d-flex align-items-start">
        				<div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          					<svg class="bi" width="1em" height="1em"><use xlink:href="#cpu-fill"/></svg>
        				</div>
        				<div>
          					<h2>Publicar relatorio</h2>
          					<p>Adicionar novos relatorios ao repositorio.</p>
          					<a href="/?page=publish" class="btn btn-primary">Publicar relatorio</a>
        				</div>
      				</div>
      				<div class="col d-flex align-items-start">
        				<div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          					<svg class="bi" width="1em" height="1em"><use xlink:href="#tools"/></svg>
        				</div>
        				<div>
          					<h2>Editar relatorio</h2>
          					<p>Editar relatorios publicados com o estado em "Aberto", caso esteja fechado não poderá ser editado.</p>
          					<a href="?page=my_publish" class="btn btn-primary">Editar Relatorio</a>
        				</div>
      				</div>
    			</div>
			</div>
	</div>
</html>