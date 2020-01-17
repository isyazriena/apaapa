<?php
	session_start();
	include "updateDetailsPageUser.php";
	
	if(isset($_POST["updateDetailsButton"])){
		updateDetails();
		header('Location: logListPageUser.php');
	}
?>
