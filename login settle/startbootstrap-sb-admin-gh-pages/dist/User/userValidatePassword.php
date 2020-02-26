<?php
	session_start();

	$userId=$_POST['userId']; 
	$userPassword=$_POST['userPassword'];  

	validatePassword($userId,$userPassword);

	function validatePassword($userId,$userPassword)
	{
		$con=mysqli_connect("localhost","web2","web2","mispms");
		
		if(!$con){
			echo  mysqli_connect_error(); 
			exit;
		}

		$sql= "SELECT * FROM user where userId = '".$userId ."' and userPassword ='".$userPassword."'";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result); //check how many matching record - should be 1 if correct

		if($count == 1){
			$_SESSION['userId'] = $userId;
			header('Location: projectPageUser.php');
			return true;//username and password is valid
		}

		else{
			header('Location: loginPageUser.php');
			return false; //invalid password
		}
	}
?>