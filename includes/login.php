<?php
require_once 'functions/config_session.inc.php';
require_once 'views/login_view.inc.php';
?>
<html>
<div class="container vertical-center">
  <div class="panel-group">
    <div class="panel panel-default bg-light">
      <div class="panel-heading bg-light"><h5>Entrar no repositório</h5></div>
      	<div class="panel-body bg-light">
    		<div class="row align-items-md-stretch">
      		<div class="col-md-6">
        	<div class="h-100 p-5 bg-light rounded-3">
			<?php
				check_login_errors();
			?>
        	<form action="functions/login.inc.php" method="post">
            <div class="row gy-3 gy-md-4 overflow-hidden">
				<p>Introduza o seu endereço de correio eletrónico e palavra de acesso no formulário em baixo.</p>
              <div class="col-12">
                <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="nome@exemplo.com" required>
              </div>
              <div class="col-12">
                <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="passwordhash" id="password" value="" required>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                  <label class="form-check-label text-secondary" for="remember_me">
                    Manter sessão iniciada
                  </label>
                </div>
              </div>
              <div class="col-8 mx-auto">
                <div class="d-grid">
                  <button class="btn btn-lg text-white" data-toggle="button" type="submit">Entrar</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                <a href="/?page=registration" class="link-secondary text-decoration-none">Não tem conta? clique aqui para se registar!</a>
				  <div class="text-secondary"><p>|</p></div>
                <a href="#!" class="link-secondary text-decoration-none">Recuperar Password</a>
              </div>
            </div>
          </div>
        	</div>
      		</div>
      		<div class="col-md-6">
        	<div class="h-100 p-5 bg-light rounded-3">
          		<h2>Em desenvolvimento</h2>
          		<p>Para inserir novos relatorios de estagio ou projeto no repositorio é necessario uma conta registada, para consultar relatorios de estágio/projeto  com acesso restrito tambem é necessario ter uma conta iniciada.</p>
				<p>Caso o relatorio esteja com acesso restrito a todos os docentes, o mesmo apenas será visivel ao utilizador que o criou.</p>
        	</div>
      		</div>
    		</div>
		</div>
    </div>
  </div>
</div>
</html>