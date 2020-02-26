<?php
	session_start();
	include "updateDetailsPageUser.php";
	include "signUpUser.php";
	include "updateDatePageUser.php";
	include "editAccountUser.php";
	
	if(isset($_POST["updateDetailsButton"])){
		updateDetails();
		//echo '<script type="text/javascript"> document.location="logListPageUser.php"; </script>';
	}
	else if(isset($_POST["addUser"])){
		addUser();
		header('Location: loginPageUser.php');
	}
	else if(isset($_POST["updateDateButton"])){
		updateDate();
		//header('Location: loginPageUser.php');
	}
	else if(isset($_POST['updateAccountUserButton'])){
		updateAccountUser(); //call function kept in projectMembers when button clicked
		echo '<script type="text/javascript"> document.location="projectPageUser.php"; </script>';
	}
?>
