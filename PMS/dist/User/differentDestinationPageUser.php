<?php
    session_start();	    session_start();
	$projectToView=$_POST['projectToView'];		$projectToView=$_POST['projectToView'];

	$projectToViewName=$_POST['projectToViewName'];
    $con=mysqli_connect("localhost","web2","web2","mispms");		$_SESSION['projectToView'] = $projectToView;
		if(!$con){		$_SESSION['projectToViewName'] = $projectToViewName;
			echo  mysqli_connect_error(); 		header('Location: dashboardProjectPageUser.php');
			exit;	
		}	

	$sql= "SELECT * FROM assigned where userId = '".$_SESSION['userId'] ."' and projectId ='".$projectToView."'";	
	$result=mysqli_query($con,$sql);	
	$count=mysqli_num_rows($result); //check how many matching record - should be 1 if correct 	

    if($count == 1){	
        $_SESSION['projectToView'] = $projectToView;	
		header('Location: dashboardProjectPageUser.php');	
	}	

	else{	
		$_SESSION['projectToView'] = $projectToView;	
		header('Location: dashboardOtherProjectPageUser.php');	
	}	
?>