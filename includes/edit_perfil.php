<?php
require_once 'functions/profile.php';
?>
<html>
	<div class="container p-5 my-4 bg-light rounded-3">
		<h2 class="pb-2 border-bottom h2title">Editar perfil</h2>
		<div class="row justify-content-center rowregister">
  			<div class="col-6 col-sm-4">
				 <label for="first_name" class="form-label"><b>Primeiro nome:</b></label>
    			<input type="text" class="form-control" name="update_firstname" id="update_firstname" value="<?php echo htmlspecialchars($user['UserFName']); ?>">
  			</div>
  			<div class="col-6 col-sm-4">
				<label for="last_name" class="form-label"><b>Último nome:</b></label>
    			<input type="text" class="form-control" name="update_lastname" id="update_lastname" value="<?php echo htmlspecialchars($user['UserLName']); ?>">
  			</div>
		</div>
		<!-- Email e número de aluno/docente -->
		<div class="row justify-content-center rowregister">
			<div class="col-6 col-sm-4">
				<label for="email" class="form-label"><b>Endereço de correio eletrónico:</b></label>
    			<input type="" class="form-control" name="update_email" id="update_email" value="<?php echo htmlspecialchars($user['UserEmail']); ?>">
  			</div>
			
			  <div class="col-6 col-sm-4 justify-content-center">
				<label for="user_number" class="form-label"><b>Número de aluno/docente:</b></label>
    			<input type="text" class="form-control" name="update_usernumber" id="update_usernumber" value="<?php echo htmlspecialchars($user['UserNumber']); ?>">
  			</div>
		</div>
		<!-- Password e data de nascimento de aluno/docente -->
		<div class="row justify-content-center rowregister">
  			<div class="col-6 col-sm-4">
				<label for="passwordhash" class="form-label"><b>Inserir nova password:</b></label>
    			<input type="password" class="form-control" name="update_passwordhash" id="update_passwordhash" value="<?php echo htmlspecialchars($user['PasswordHash']); ?>">
  			</div>
  			<div class="col-6 col-sm-4">
				 <label for="dateb" class="form-label"><b>Data de Nascimento:</b></label>
    			<input type="date" class="form-control" name="update_datebirth" id="update_datebirth" value="<?php echo htmlspecialchars($user['UserBirth']); ?>">
  			</div>
		</div>
	</div>
</html>