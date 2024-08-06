<?php
require_once 'functions/config_session.inc.php';
require_once 'views/signup_view.inc.php';
?>
<html>
<div class="container">
    <div class="p-5 my-4 bg-light rounded-3">
		<h2 class="pb-2 border-bottom">Novo registo</h2>
		</br>
		<! FORMULARIO DE REGISTO !>
		<?php
		check_signup_errors();
		?>
        <form action="functions/register.inc.php" method="post">
		<div class="row justify-content-center rowregister">
  			<div class="col-6 col-sm-4">
				 <label for="first_name" class="form-label"><b>Primeiro nome:</b></label>
    			<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Primeiro nome" aria-label="Primeiro nome">
  			</div>
  			<div class="col-6 col-sm-4">
				<label for="last_name" class="form-label"><b>Último nome:</b></label>
    			<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Último nome">
  			</div>
		</div>
		<! LINHA DE EMAIL E NÚMERO DE DOCENTE/ALUNO !>
		<div class="row justify-content-center rowregister">
			<div class="col-6 col-sm-4">
				<label for="email" class="form-label"><b>Endereço de correio eletrónico:</b></label>
    			<input type="" class="form-control" name="email" id="email" placeholder="Preencher com endereço de correio eletrónico">
  			</div>
			
			  <div class="col-6 col-sm-4 justify-content-center">
				<label for="user_number" class="form-label"><b>Número de aluno/docente:</b></label>
    			<input type="text" class="form-control" name="user_number" id="user_number" placeholder="Preencher com número de aluno/docente">
  			</div>
		</div>
		<div class="row justify-content-center rowregister">
  			<div class="col-6 col-sm-4">
				<label for="passwordhash" class="form-label"><b>Inserir password:</b></label>
    			<input type="password" class="form-control" name="passwordhash" id="passwordhash" placeholder="Inserir password">
  			</div>
  			<div class="col-6 col-sm-4">
				 <label for="dateb" class="form-label"><b>Data de Nascimento:</b></label>
    			<input type="date" class="form-control" name="dateb" id="dateb">
  			</div>
		</div>
		<row>
              <div class="col-6 col-sm-4 mx-auto">
                <div class="d-grid">
                  <button class="btn btn-lg text-white btn-register" data-toggle="button">Registar</button>
                </div>
              </div>
		</row>
		</form>
		</div>
    </div>
</html>