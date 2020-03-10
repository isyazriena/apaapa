<?php
    session_start();
	$projectToView=$_POST['projectToView'];
	$projectToViewName=$_POST['projectToViewName'];	

	$_SESSION['projectToView'] = $projectToView;
	$_SESSION['projectToViewName'] = $projectToViewName;
	header('Location: dashboardProjectPageAdmin.php'); //creator of project
?>