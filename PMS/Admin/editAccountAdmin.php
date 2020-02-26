<html>
    <head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<?php
        session_start();
        $getOldData = getOldData2();
        $adminId = $_SESSION['adminId'];		

		function getOldData2(){
			$con = mysqli_connect('localhost','web2','web2','mispms');
			if (mysqli_connect_errno())     //check connection is establish
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;   //terminate the script
			}
			$adminId = $_SESSION['adminId'];
			$sql3="select * from admin where adminId='".$adminId."'";
			$qry = mysqli_query($con,$sql3);
			return $qry;
		}

		$row=mysqli_fetch_assoc(getOldData2());
	?>

	<br><pre><h1>	Enter Update on Account: </h1></pre>

	<div class="container">
		<div class="grid-container">
			<form action='adminButtonProcesses.php' method='post'>

				Admin Id:
				<input type='text' name='adminId' value = "<?php echo $row['adminId']?>"><br><br>

				Admin Name:
				<input type='text' name='adminName' value = "<?php echo $row['adminName']?>"><br><br>

				Password:
				<input type='password' name='adminPassword'><br><br>

				<input type='submit' value='Done' name='updateAccountAdminButton'>
			</form>


    <?php
			function updateAccountAdmin(){
                $adminIdNew = $_POST['adminId'];
                $adminNameNew = $_POST['adminName'];
                $adminPasswordNew = $_POST['adminPassword'];
				$adminId = $_SESSION['adminId'];

				//1.create connection
				$con = mysqli_connect("localhost","web2","web2","mispms");
				if(mysqli_connect_errno()){
					echo 'connection error.<br>';
					echo mysqli_connect_error();
				}
				else{
					echo "database connected";
					$adminId = $_SESSION['adminId'];

					$sql= 'update admin SET adminId = "'.$adminIdNew.'", adminName = "'.$adminNameNew.'", adminPassword = "'.$adminPasswordNew.'"
						WHERE adminId ="'.$adminId.'"';
					$qry = mysqli_query($con,$sql);
					echo $sql;
                    return $sql;					
				}
			}

    ?>

		</div>
	</div>

</html>