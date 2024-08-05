<?php

declare(strict_types=1);

function check_signup_errors()
{
	if (isset($_SESSION['errors_signup'])){
		$errors = $_SESSION['errors_signup'];
		
		foreach ($errors as $error){
			echo '<p class="alert alert-danger text-center" role="alert"><b>' . $error .  '</b></p>';
			
		}
		
		unset($_SESSION['errors_signup']);
	} else if (isset($_GET["signup"]) && $_GET["signup"] === "success"){
		
		echo '<p class="alert alert-success text-center" role="alert"><b> Registado com sucesso!</b></p>';
	}
}