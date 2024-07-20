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
			<img src = "/assets/images/construcao.png" class="mx-auto d-block">
		</div>
	</div>
</html>