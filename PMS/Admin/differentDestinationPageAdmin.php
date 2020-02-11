<?php
    session_start();
	$projectToView=$_POST['projectToView'];

    $con=mysqli_connect("localhost","web2","web2","mispms");
		if(!$con){
			echo  mysqli_connect_error(); 
			exit;
		}

	$sql= "SELECT * FROM created where adminId = '".$_SESSION['adminId'] ."' and projectId ='".$projectToView."'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result); //check how many matching record - should be 1 if correct 
        
    if($count == 1){
        $_SESSION['projectToView'] = $projectToView;
		header('Location: dashboardProjectPageAdmin.php'); //creator of project
	}

	else{
		$_SESSION['projectToView'] = $projectToView;
		header('Location: dashboardOtherProjectPageAdmin.php'); //non-creator of project
	}
?>