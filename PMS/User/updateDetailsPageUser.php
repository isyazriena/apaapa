<html>
	<img src='logosahaja.png'><br>

	<h1>Project Monitoring System</h1><br>

	<p>Management Information System</p><br><br>

	<form action='dashboardProjectPageUser.php' method='post'>
		<input type='submit' value='back'>
	</form><br><br>

	<hr><br>

	<h1>Enter New Project Details: </h1>

	*ada css container*<br><br>

	<form action='userButtonProcesses.php' method='post' enctype='multipart/form-data'>

		Date of Initiation:<br>
		<input type="date" name="dateOfInitiation"><br><br>
		
		Estimated Date End:<br>
		<input type="date" name="estimatedDateEnd"><br><br>

		isi dia<br>Project Status *drop down input* <br><br>

		Remarks:<br>
		<input type="text" name="remarks"><br><br>

		Category: <br>
		<input type="radio" name="category" <?php if (isset($category) && $category=="running") echo "checked";?> value="running">Running <br>
		<input type="radio" name="category" <?php if (isset($category) && $category=="completed") echo "checked";?> value="completed">Completed <br>
		<input type="radio" name="category" <?php if (isset($category) && $category=="terminated") echo "checked";?> value="terminated">Terminated <br><br>

		Attachment:<br>
		<input type="file" name="myfile"/>
		
		<?php
			$projectId=$_POST['projectId'];
			echo "<input type='submit' value='Done' name='updateDetailsButton'>";
			echo "<input type='hidden' value='$projectId' name='projectId'>";
		?>
	</form>

	<?php
	session_start();
	function updateDetails(){
		$dateOfInitiation=$_POST['dateOfInitiation'];
		$estimatedDateEnd=$_POST['estimatedDateEnd'];
		//$systemCustodian=$_POST['systemCustodian']; //drop down project status
		$remarks=$_POST['remarks'];
		$category=$_POST['category'];
		$projectCategoryValue = '0';

		if($category == 'running'){
			$projectCategoryValue = '2';
		}
		else if($category == 'completed'){			
			$projectCategoryValue = '3';
		}
		else{
			$projectCategoryValue ='4';
		}

		$con = mysqli_connect("localhost","web2","web2","mispms");

		if(mysqli_connect_errno()){
			echo 'connection error.<br>';
			echo mysqli_connect_error();
		}
		else{
			echo "database connected";
			$projectId=$_POST['projectId'];

			$sql= 'update project SET dateOfInitiation = "'.$dateOfInitiation.'", estimatedDateEnd = "'.$estimatedDateEnd.'", 
			projectCategory = "'.$category.'", projectCategoryValue = "'.$projectCategoryValue.'"
				WHERE projectId ="'.$projectId.'"';
			$sql1= "insert into log(dateOfInitiation, estimatedDateEnd, remarks, projectCategory, projectCategoryValue, dateOfUpdate)
				values ('$dateOfInitiation','$estimatedDateEnd','$remarks', '$category', '$projectCategoryValue', CURDATE())";
			
			echo $sql;
			echo $sql1;
			
			$qry=mysqli_query($con,$sql);//execute qry

			if($con->query($sql1)==TRUE){
				$projectId=$_POST['projectId'];
				$last_id = $con->insert_id; //logId
				$userId = $_SESSION['userId'];
				//echo "New record created successfully. Last inserted ID is: ".$last_id;
				$dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
				$name = $_FILES['myfile']['name'];
				$type = $_FILES['myfile']['type'];
				$data = file_get_contents($_FILES['myfile']['tmp_name']);
				$stmt = $dbh->prepare("insert into attachmentlog values('',?,?,?, '$last_id')");
				$stmt->bindParam(1,$name);
				$stmt->bindParam(2,$type);
				$stmt->bindParam(3,$data);
				$stmt->execute();
				$sql2 = "insert into projectlog(projectId, logId) values('$projectId', '$last_id')";
				$sql4= "insert into dates(projectId, logId, dateOfInitiation, estimatedDateEnd, dateOfUpdate, nameId) 
						values('$projectId', '$last_id', '$dateOfInitiation', '$estimatedDateEnd', CURDATE(), '$userId')";
				$qry=mysqli_query($con,$sql2);
				$qry=mysqli_query($con,$sql4);
				return $qry;
			}
			else{
				echo "Error: " .$sql. "<br>" .$con->error;
			}
		} 
	}
	?>
	<?php

	?>
</html>
