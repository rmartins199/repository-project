<?php

declare(strict_types=1);

function check_update_errors()
{
	if (isset($_SESSION['errors_update'])){
		$errors = $_SESSION['errors_update'];
		
		foreach ($errors as $error){
			echo '<p class="alert alert-danger text-center" role="alert"><b>' . $error .  '</b></p>';
			
		}
		
		unset($_SESSION['errors_update']);
	} else if (isset($_GET["update"]) && $_GET["update"] === "success"){
		
		echo '<p class="alert alert-success text-center" role="alert"><b> Editado com sucesso!</b></p>';
	}
}