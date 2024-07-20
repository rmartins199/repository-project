<?php

declare(strict_types=1);

function output_email()
{
	if (isset($_SESSION["user_id"])){
		echo "Bem vindo " . $_SESSION["user_id"];	
	} else{	
	header("Location:../index.php");
	die();	
	}
}

function check_login_errors()
{
	if(isset($_SESSION["errors_login"]))
	{
		$errors = $_SESSION["errors_login"];
		
		foreach ($errors as $error){
			echo '<p class="alert alert-danger text-center" role="alert"><b>' . $error .  '</b></p>';
		}
		
		unset($_SESSION['errors_login']);
	}
	else if (isset($_GET['login']) && $_GET['login'] === "success"){
		
	}
}