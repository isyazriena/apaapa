<?php
    session_start();
	$projectToView=$_POST['projectToView'];

    $con=mysqli_connect("localhost","web2","web2","mispms");
		if(!$con){
			echo  mysqli_connect_error(); 
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