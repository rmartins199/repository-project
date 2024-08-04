<?php

declare(strict_types=1);

function check_upload_errors()
{
	if (isset($_SESSION['errors_upload'])){
		$errors = $_SESSION['errors_upload'];
		
		foreach ($errors as $error){
			echo '<p class="alert alert-danger text-center" role="alert"><b>' . $error .  '</b></p>';
			
		}
		
		unset($_SESSION['errors_upload']);
	} else if (isset($_GET["upload"]) && $_GET["upload"] === "success"){
		
		echo '<p class="alert alert-success text-center" role="alert"><b> Publicado com sucesso!</b></p>';
	}
}