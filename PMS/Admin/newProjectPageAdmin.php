<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
	<img src='logosahaja.png'><br>
	<h1>Project Monitoring System</h1><br>
	<p>Management Information System</p><br><br>

	<?php
		include 'getDataAdmin2.php';
		include 'getDataAdmin3.php';
	?>

	<form action='projectPageAdmin.php' method='post'>
		<input type='submit' value='back'>
	</form><br><br>

	<hr><br>

	<h1>Enter New Project Details: </h1>

	*ada css container*<br>

	<form action='adminButtonProcesses.php' method='post' enctype='multipart/form-data'>

		Project Name:<br>
		<input type='text' name='projectName'><br><br>

		Report Owner:<br>
		<input type='text' name='reportOwner'><br><br>

		System Custodian:<br>
		<input type='text' name='systemCustodian'><br><br>

		Date of Initiation:<br>
		<input type='date' name='dateOfInitiation'><br><br>

		Estimated Date End:<br>
		<input type='date' name='estimatedDateEnd'><br><br>

		Project Description:<br>
		<input type='text' name='projectDescription'><br><br>

		Person In Charge:<br>
		<div>
			<select name="pic" id="pic">
				<?php 
					$list = getNamePic();
					while ($row = mysqli_fetch_assoc($list)){
						echo '<option value="'.$row['userId'].'">'.$row['userName'].'</option>';
					}
				?>
			</select>

		</div>
		
		
		<!-- <div>
			<select name="members" id="members">
				
					/*$list = getNameMembers();
					while ($row = mysqli_fetch_assoc($list)){
						echo '<option value="'.$row['userId'].'">'.$row['userName'].'</option>';
					}*/
				
			</select>

		</div> -->
		Members:<br>
		<script>
			//$(document).ready(function(){
				$('#buttonAdd').click(function(){
					var idcount = $("select[id^='members']").length;
					var newel = $('#members1').clone();
					newel.attr("id", "members" + (idcount + 1));
					$("#list").append(newel);
				});
			//});
    	</script>

		<button id="buttonAdd">add</button>
		<div id="list">
			<?php
				$list = getNameMembers();
				echo "<select name='members[]' id='members1' style='display:block;'>";						
						while ($row = mysqli_fetch_assoc($list)){
							echo '<option value="'.$row['userId'].'">'.$row['userName'].'</option>';
						}

				echo "</select>";
			?>
		</div>

		Attachment:<br>
		<input type="file" name="myfile"/>

		<input type='submit' value='Done' name='addProjectButton'>
	</form>

	<?php
		session_start();
		$adminId = $_SESSION['adminId'];

		function addNewProject(){
			$projectName=$_POST['projectName'];
			$reportOwner=$_POST['reportOwner'];
			$systemCustodian=$_POST['systemCustodian'];
			$dateOfInitiation=$_POST['dateOfInitiation'];
			$estimatedDateEnd=$_POST['estimatedDateEnd'];
			$projectDescription=$_POST['projectDescription'];
			$personInCharge=$_POST['pic'];
			$members=$_POST['members']; //sql untuk members buat baru masukkan dalam table assigned settled but untuk ramai belum

			//1.create connection
			$con = mysqli_connect("localhost","web2","web2","mispms");
			if(mysqli_connect_errno()){
				echo 'connection error.<br>';
				echo mysqli_connect_error();
			}
			else{
				echo "database connected";


				$sql= "insert into project(projectName,reportOwner,systemCustodian,dateOfInitiation,estimatedDateEnd,projectDescription,
				personInCharge, projectCategory, projectCategoryValue)
					values('$projectName','$reportOwner','$systemCustodian','$dateOfInitiation','$estimatedDateEnd','$projectDescription',
					'$personInCharge', 'running', '2')";
				$sql1= "insert into log(dateOfInitiation, estimatedDateEnd, remarks, projectCategory, projectCategoryValue, dateOfUpdate)
					values ('$dateOfInitiation','$estimatedDateEnd',' ', 'running', '2', CURDATE())";

				echo $sql;
				echo $sql1;

				if($con->query($sql)==TRUE){
					$adminId = $_SESSION['adminId'];
					$last_id = $con->insert_id; //projectId
					$dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
					$name = $_FILES['myfile']['name'];
					$type = $_FILES['myfile']['type'];
					$data = file_get_contents($_FILES['myfile']['tmp_name']);
					$stmt = $dbh->prepare("insert into attachmentproject values('',?,?,?, '$last_id')");
					$stmt->bindParam(1,$name);
					$stmt->bindParam(2,$type);
					$stmt->bindParam(3,$data);
					$stmt->execute();
					$sql3= "insert into created(adminId, projectId) values ('$adminId', '$last_id')";
					$qry = mysqli_query($con,$sql3);
					foreach ($_POST['members'] as $key=>$value) {
						$sql = "INSERT INTO assigned(projectId, userId) VALUES('$last_id','$value')";
						$con->query($con);
					}
				}
				else{
					echo "Error: " .$sql. "<br>" .$con->error;
				}
				if($con->query($sql1)==TRUE){
					$adminId = $_SESSION['adminId'];
					$last_id2 = $con->insert_id; //logId
					$sql2 = "insert into projectlog(projectId, logId) values('$last_id', '$last_id2')";
					$sql4= "insert into dates(projectId, logId, dateOfInitiation, estimatedDateEnd, dateOfUpdate, nameId) 
					values('$last_id', '$last_id2', '$dateOfInitiation', '$estimatedDateEnd', CURDATE(), '$adminId')";
					$qry = mysqli_query($con,$sql2);
					$qry = mysqli_query($con,$sql4);
				}
				else{
					echo "Error: " .$sql. "<br>" .$con->error;
				}
			}
		}
	?>
	<?php

	?>
	<?php
		
	?>
</html>