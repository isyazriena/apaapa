<?php
	session_start();
	include "updateDetailsPageUser.php";
	include "signUpUser.php";
	
	if(isset($_POST["updateDetailsButton"])){
		updateDetails();
		header('Location: logListPageUser.php');
	}
	else if(isset($_POST["addUser"])){
		addUser();
		header('Location: loginPageUser.php');
	}
?>
