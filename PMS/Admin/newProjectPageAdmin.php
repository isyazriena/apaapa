<html lang="en">
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<style>
				* {box-sizing: border-box;}

				body { 
				margin: 0;
				font-family: Arial, Helvetica, sans-serif;
				}

				.header {
				overflow: hidden;
				background-color: #f1f1f1;
				padding: 20px 10px;
				}

				.header a {
				float: left;
				color: black;
				text-align: center;
				padding: 12px;
				text-decoration: none;
				font-size: 18px; 
				line-height: 25px;
				border-radius: 4px;
				}

				.header a.logo {
				font-size: 25px;
				font-weight: bold;
				}

				.header a:hover {
				background-color: #ddd;
				color: black;
				}

				.header a.active {
				background-color: dodgerblue;
				color: white;
				}

				.header-right {
				float: right;
				}

				@media screen and (max-width: 500px) {
				.header a {
					float: none;
					display: block;
					text-align: left;
				}
				
				.header-right {
					float: none;
				}
				}

				.container{
				background-color: lightgrey;
				/* width: 300px; */
				border: 3px solid green;
				padding: 50px;
				margin: 50px;
				}
			</style>
	</head>

	<div class="header">
		<a href="projectPageAdmin.php" class="logo"><img src='logosahaja.png'>
		<h4>Project Monitoring System</h4>
		<h5>Management Information System</h5></a>
		<div class="header-right">
			<a href="projectPageAdmin.php">Back</a>
		</div>
	</div>

	<?php
		include 'getDataAdmin2.php';
		include 'getDataAdmin3.php';
	?>

	<br><pre><h1>	Enter New Project Details: </h1></pre>

	<div class="container">
		<div class="grid-container">
			<form action='adminButtonProcesses.php' method='post' enctype='multipart/form-data'>

				Project Name:
				<input type='text' name='projectName' required><br><br>

				Report Owner:
				<input type='text' name='reportOwner' required><br><br>

				System Custodian:
				<input type='text' name='systemCustodian' required><br><br>

				Date of Initiation:
				<input type='date' name='dateOfInitiation' required><br><br>

				Estimated Date End:
				<input type='date' name='estimatedDateEnd' required><br><br>

				Project Description:
				<input type='text' name='projectDescription'><br><br>

				Person In Charge:
				<div>
					<select name="pic" id="pic" required>
						<?php 
							$list = getNamePic();
							while ($row = mysqli_fetch_assoc($list)){
								echo '<option value="'.$row['userId'].'">'.$row['userName'].'</option>';
							}
						?>
					</select>
				</div><br>

				Members:
				<?php $list = getNameMembers(); ?>
				<button type="button" id="buttonAdd">Add</button>
				<div id="list" required>
					<?php
						echo "<select name='members[]' id='members1' style='display:block;' required>";						
								while ($row = mysqli_fetch_assoc($list)){
									echo '<option value="'.$row['userId'].'">'.$row['userName'].'</option>';
								}
						echo "</select>";
					?>
				</div>
				<script>
					$(document).ready(function(){
						$('#buttonAdd').click(function(){
							var idcount = $("select[id^='members']").length;
							var newel = $('#members1').clone();
							newel.attr("id", "members" + (idcount + 1));
							$("#list").append(newel);	
							return false;
						});
					});
				</script><br>

				Attachment:
				<input type="file" name="myfile"/><br><br>
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
				$members=$_POST['members'];
				$adminId = $_SESSION['adminId'];

				//1.create connection
				$con = mysqli_connect("localhost","web2","web2","mispms");
				if(mysqli_connect_errno()){
					echo 'connection error.<br>';
					echo mysqli_connect_error();
				}
				else{
					echo "database connected";

					$sql= "insert into project(projectName,reportOwner,systemCustodian,dateOfInitiation,estimatedDateEnd,projectDescription,personInCharge, projectStatus, projectStatusValue, projectCategory, projectCategoryValue)
						values('$projectName','$reportOwner','$systemCustodian','$dateOfInitiation','$estimatedDateEnd','$projectDescription',
						'$personInCharge', 'seacapp', '1', 'running', '2')";
					$sql1= "insert into log(dateOfInitiation, estimatedDateEnd, remarks, projectStatus, projectStatusValue, projectCategory, projectCategoryValue, dateOfUpdate, nameId)
						values ('$dateOfInitiation','$estimatedDateEnd','project first created by admin', 'seacapp', '1', 'running', '2', CURDATE(), '$adminId')";

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
						if($data != null){
							$stmt->execute();
						}
						$sql3= "insert into created(adminId, projectId) values ('$adminId', '$last_id')";
						$sql5= "INSERT INTO assigned(projectId, userId, position) VALUES('$last_id','$personInCharge', 'person in charge')";
						$qry = mysqli_query($con,$sql3);
						$qry = mysqli_query($con,$sql5);
						foreach ($_POST['members'] as $key=>$value) {
							$sqlmembers = "INSERT INTO assigned(projectId, userId, position) VALUES('$last_id','$value', 'members')";
							$con->multi_query($sqlmembers);
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
		</div>
	</div>
</html>