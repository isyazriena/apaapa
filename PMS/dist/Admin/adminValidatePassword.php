<?php
	session_start();

	$adminId=$_POST['adminId']; 
	$adminPassword=$_POST['adminPassword'];  

	validatePassword($adminId,$adminPassword);


	function validatePassword($adminId,$adminPassword){

		$con=mysqli_connect("localhost","web2","web2","mispms");
		
		if(!$con){
			echo  mysqli_connect_error(); 
			exit;
		}

		$sql= "SELECT * FROM admin where adminId = '".$adminId ."' and adminPassword ='".$adminPassword."'";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result); //check how many matching record - should be 1 if correct

		$row = mysqli_fetch_assoc($result);
		$adminName = $row['adminName'];
		
		if($count == 1){
			$_SESSION['adminId'] = $adminId;
			echo $_SESSION['adminId'];
			$_SESSION['adminName'] = $adminName;
			echo $_SESSION['adminName'];
			header('Location: projectPageAdmin.php');
			return true;//username and password is valid
		}
		else{
			header('Location: loginPageAdmin.php');
			echo 'Wrong Password. Try Again';
			return false; //invalid password
		}
	}
?>