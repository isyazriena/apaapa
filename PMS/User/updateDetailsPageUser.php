<html>
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
		<a href="projectPageUser.php" class="logo"><img src='logosahaja.png'>
		<h4>Project Monitoring System</h4>
		<h5>Management Information System</h5></a>
		<div class="header-right">
			<a href="dashboardProjectPageUser.php">Back</a>
		</div>
	</div>

	<br><pre><h1>	Enter Update Details: </h1></pre>

	<div class="container">
		<div class="grid-container">
			<form action='userButtonProcesses.php' method='post' enctype='multipart/form-data'>

				Date of Initiation:
				<input type="date" name="dateOfInitiation"><br><br>
				
				Estimated Date End:
				<input type="date" name="estimatedDateEnd"><br><br>

				Remarks:
				<input type="text" name="remarks"><br><br>

				Category: <br>
				<input type="radio" name="category" <?php if (isset($category) && $category=="running") echo "checked";?> value="running">Running <br>
				<input type="radio" name="category" <?php if (isset($category) && $category=="completed") echo "checked";?> value="completed">Completed <br>
				<input type="radio" name="category" <?php if (isset($category) && $category=="terminated") echo "checked";?> value="terminated">Terminated <br><br>

				Status: <br>
				<input type="radio" name="status" <?php if (isset($status) && $status=="seacapp") echo "checked";?> value="seacapp">SEAC Approve <br>
				<input type="radio" name="status" <?php if (isset($status) && $status=="ur") echo "checked";?> value="ur">User Requirement <br>
				<input type="radio" name="status" <?php if (isset($status) && $status=="dev") echo "checked";?> value="dev">Development <br>
				<input type="radio" name="status" <?php if (isset($status) && $status=="uat") echo "checked";?> value="uat">UAT <br>
				<input type="radio" name="status" <?php if (isset($status) && $status=="sit") echo "checked";?> value="sit">SIT <br>
				<input type="radio" name="status" <?php if (isset($status) && $status=="dep") echo "checked";?> value="dep">Deployment <br>

				Attachment:
				<input type="file" name="myfile"/><br>
				
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
				$status=$_POST['status'];
				$projectStatusValue = '0';

				if($category == 'running'){
					$projectCategoryValue = '2';
				}
				else if($category == 'completed'){			
					$projectCategoryValue = '3';
				}
				else{
					$projectCategoryValue ='4';
				}

				if($status == 'seacapp'){
					$projectStatusValue = '1';
				}
				else if($status == 'ur'){
					$projectStatusValue = '2';
				}
				else if($status == 'dev'){
					$projectStatusValue = '3';
				}
				else if($status == 'uat'){
					$projectStatusValue = '4';
				}
				else if($status == 'sit'){
					$projectStatusValue = '5';
				}
				else{
					$projectStatusValue = '6';
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
					projectCategory = "'.$category.'", projectCategoryValue = "'.$projectCategoryValue.'", projectStatus = "'.$status.'", projectStatusValue = "'.$projectStatusValue.'"
						WHERE projectId ="'.$projectId.'"';
					$sql1= "insert into log(dateOfInitiation, estimatedDateEnd, remarks, projectCategory, projectCategoryValue, dateOfUpdate, projectStatus, projectStatusValue)
						values ('$dateOfInitiation','$estimatedDateEnd','$remarks', '$category', '$projectCategoryValue', CURDATE(), '$status', '$projectStatusValue')";
					
					echo $sql;
					echo $sql1;
					
					$qry=mysqli_query($con,$sql);//execute qry

					if($con->query($sql1)==TRUE){
						$projectId=$_POST['projectId'];
						$last_id = $con->insert_id; //logId
						$userId = $_SESSION['userId'];
						$dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
						$name = $_FILES['myfile']['name'];
						$type = $_FILES['myfile']['type'];
						$data = file_get_contents($_FILES['myfile']['tmp_name']);
						$stmt = $dbh->prepare("insert into attachmentlog values('',?,?,?, '$last_id')");
						$stmt->bindParam(1,$name);
						$stmt->bindParam(2,$type);
						$stmt->bindParam(3,$data);
						if($data != null){
							$stmt->execute();
						}
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
		</div>
	</div>
</html>
