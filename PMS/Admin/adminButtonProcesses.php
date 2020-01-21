<?php
	session_start();
	include "newProjectPageAdmin.php";
	include "projectPageAdmin.php";
	include "logListPageAdmin.php";
	include "datePageAdmin.php";

	if(isset($_POST["addProjectButton"])){
		addNewProject();
		echo '<script type="text/javascript"> document.location="projectPageAdmin.php"; </script>';
	}
	else if(isset($_POST['deleteProjectButton'])){
		deleteProject();
		header('Location: projectPageAdmin.php');
	}
	else if(isset($_POST['deleteLogButton'])){
		deleteLog();
		echo '<script type="text/javascript"> document.location="logListPageAdmin.php"; </script>';
	}
	else if(isset($_POST['deleteDateButton'])){
		deleteDate();
		header('Location: datePageAdmin.php');
	}
?>