<html>
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <div class="header">
		<a href="projectPageUser.php" class="logo"><img src='logosahaja.png'>
		<h4>Project Monitoring System</h4>
		<h5>Management Information System</h5></a>
		<div class="header-right">
			<a href="dashboardProjectPageUser.php">Back</a>
		</div>
	</div>
  <?php
		session_start();
    $getOldDate = getOldDate();
    $projectId = $_POST['projectId'];

		function getOldDate(){
			$con = mysqli_connect('localhost','web2','web2','mispms');
			if (mysqli_connect_errno())     //check connection is establish
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;   //terminate the script
			}
			$projectId=$_POST['projectId'];
			$sql5="select * from dates where projectId='".$projectId."' order by dateOfUpdate desc limit 1";
      $qry = mysqli_query($con,$sql5);
			return $qry;
		}

    $row=mysqli_fetch_assoc(getOldDate());
    echo $row['dateOfInitiation'];
    ?>

    <br><pre><h1>	Enter Update Details: </h1></pre>
  
    <div class="container">
      <div class="grid-container">
        <form action='userButtonProcesses.php' method='post'>

            Date Of Initiation:
            <input type="date" name="dateOfInitiation" value="<?php echo $row['dateOfInitiation']; ?>"><br><br>

            Estimated Date End:
            <input type="date" name="estimatedDateEnd" value="<?php echo $row['estimatedDateEnd']; ?>"><br><br>

            <?php
					$projectId=$_POST['projectId'];
					echo "<input type='submit' value='Done' name='updateDateButton'>";
					echo "<input type='hidden' value='$projectId' name='projectId'>";
				?>
			</form>
            <?php
            function updateDate(){
            $dateOfInitiation=$_POST['dateOfInitiation'];
            $estimatedDateEnd=$_POST['estimatedDateEnd'];
            $userId = $_SESSION['userId'];
            $projectId=$_POST['projectId'];

            echo $dateOfInitiation;
            echo $estimatedDateEnd;
            echo $userId;

            $con = mysqli_connect("localhost","web2","web2","mispms");

				if(mysqli_connect_errno()){
					echo 'connection error.<br>';
					echo mysqli_connect_error();
				}
				else{
          echo "database connected";
          
          $sql = "insert into dates(projectId, dateOfInitiation, estimatedDateEnd, dateOfUpdate, nameId) values('$projectId', '$dateOfInitiation', '$estimatedDateEnd', CURDATE(), '$userId')";
          $sql2 = 'update project SET dateOfInitiation = "'.$dateOfInitiation.'", estimatedDateEnd = "'.$estimatedDateEnd.'" WHERE projectId ="'.$projectId.'"';
            $qry=mysqli_query($con,$sql);
            $qry=mysqli_query($con,$sql2);
            echo $sql;
            return $qry;
            return $qry2;
        }
      }
        ?>
</html>