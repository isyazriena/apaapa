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
		<a href="projectPageAdmin.php" class="logo"><img src='logosahaja.png'>
		<h4>Project Monitoring System</h4>
		<h5>Management Information System</h5></a>
		<div class="header-right">
			<a href="projectPageAdmin.php">Back</a>
		</div>
	</div>

	<?php
		session_start();
		$getOldData = getOldData();

		function getOldData(){
			$con = mysqli_connect('localhost','web2','web2','mispms');
			if (mysqli_connect_errno())     //check connection is establish
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;   //terminate the script
			}
			$projectId=$_POST['projectId'];
			$sql3="select * from project where projectId='".$projectId."'";
			$qry = mysqli_query($con,$sql3);
			return $qry;
		}

		function getOldDataAttachment(){
			$con = mysqli_connect('localhost','web2','web2','mispms');
			if (mysqli_connect_errno())     //check connection is establish
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;   //terminate the script
			}
			$projectId=$_POST['projectId'];
			$sql4="select * from attachmentproject where projectId='".$projectId."'";
			$qry = mysqli_query($con,$sql4);
			return $qry;
		}
		
		function getFirstLog(){
			$con = mysqli_connect('localhost','web2','web2','mispms');
			if (mysqli_connect_errno())     //check connection is establish
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;   //terminate the script
			}
			$projectId=$_POST['projectId'];
			$sql5="select * from log a inner join projectlog b on a.logId=b.logId and b.projectId='".$projectId."' order by a.logId asc limit 1";
			$qry = mysqli_query($con,$sql5);
			return $qry;
		}

		$row=mysqli_fetch_assoc(getOldData());
		$row2=mysqli_fetch_assoc(getOldDataAttachment());
		$row3=mysqli_fetch_assoc(getFirstLog());

	?>

	<br><pre><h1>	Enter Project Update Details: </h1></pre>

	<div class="container">
		<div class="grid-container">
			<form action='adminButtonProcesses.php' method='post' enctype='multipart/form-data'>

				Project Name:
				<input type='text' name='projectName' value = "<?php echo $row['projectName']?>"><br><br>

				Report Owner:
				<input type='text' name='reportOwner' value = "<?php echo $row['reportOwner']?>"><br><br>

				System Custodian:
				<input type='text' name='systemCustodian' value = "<?php echo $row['systemCustodian']?>"><br><br>

				Project Description:
				<input type='text' name='projectDescription' value = "<?php echo $row['projectDescription']?>"><br><br>

				Attachment:
				<input type="file" name="myfile" value = "<?php echo $row2['attachmentName']?>"><br><br>
				<?php
					echo '<ol>';
					$dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
					$projectId=$_POST['projectId'];
					$stat = $dbh->prepare('select * from attachmentproject where projectId ="'.$projectId.'"');
					$stat->execute();
					while($row = $stat->fetch()){
						echo "<li><a target='_blank' href='viewProjectAttachmentAdmin.php?attachmentId=".$row['attachmentId']."'>".$row['attachmentName']."</a></li>";
					}
					$projectId=$_POST['projectId'];
					echo '</ol>';
					echo "<input type='submit' value='Done' name='updateProjectButton'>";
					echo "<input type='hidden' value='$projectId' name='projectId'>";
				?>
			</form>


    <?php
		session_start();
			$adminId = $_SESSION['adminId'];

			function updateProject(){
				$projectName=$_POST['projectName'];
				$reportOwner=$_POST['reportOwner'];
				$systemCustodian=$_POST['systemCustodian'];
				$projectDescription=$_POST['projectDescription'];
				$adminId = $_SESSION['adminId'];

				//1.create connection
				$con = mysqli_connect("localhost","web2","web2","mispms");
				if(mysqli_connect_errno()){
					echo 'connection error.<br>';
					echo mysqli_connect_error();
				}
				else{
					echo "database connected";
					$projectId=$_POST['projectId'];

					$sql= 'update project SET projectName = "'.$projectName.'", reportOwner = "'.$reportOwner.'", systemCustodian = "'.$systemCustodian.'", projectDescription = "'.$projectDescription.'"
						WHERE projectId ="'.$projectId.'"';

					$qry = mysqli_query($con,$sql);
					echo $sql;

					$sql1= 'update log SET remarks = "admin updated project details", dateOfUpdate = CURDATE(), nameId = "'.$adminId.'"
					WHERE logId ="'.$row3['logId'].'"';

					if($con->query($sql1)==TRUE){
						$projectId=$_POST['projectId'];
						$last_id2 = $con->insert_id; //logId
						$sql2 = "insert into projectlog(projectId, logId) values('$projectId', '$last_id2')";
						$qry = mysqli_query($con,$sql2);

						echo $sql1;
						echo $sql2;

					}
					else{
						echo "Error: " .$sql. "<br>" .$con->error;
					}

					$dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
					$name = $_FILES['myfile']['name'];
					$type = $_FILES['myfile']['type'];
					$data = file_get_contents($_FILES['myfile']['tmp_name']);
					$stmt = $dbh->prepare("update attachmentproject SET attachmentName = ?, attachmentType = ?, attachmentData = ? where projectId ='".$projectId."'");
					$stmt->bindParam(1,$name);
					$stmt->bindParam(2,$type);
					$stmt->bindParam(3,$data);
					if($data != null){
						$stmt->execute();
						echo $stmt;
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