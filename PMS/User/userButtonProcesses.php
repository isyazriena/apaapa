<?php
	session_start();
	include "updateDetailsPageUser.php";
	include "signUpUser.php";
	
	if(isset($_POST["updateDetailsButton"])){
		updateDetails();
		//echo '<script type="text/javascript"> document.location="logListPageUser.php"; </script>';
	}
	else if(isset($_POST["addUser"])){
		addUser();
		header('Location: loginPageUser.php');
	}
?>
