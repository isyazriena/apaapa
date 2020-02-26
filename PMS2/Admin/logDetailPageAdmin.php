<html>
  <head>
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

  <div class="header"> <!--go to home when clicked-->
    <a href="projectPageAdmin.php" class="logo"><img src='logosahaja.png'>
      <h4>Project Monitoring System</h4>
      <h5>Management Information System</h5></a>
    <div class="header-right">
      
      <?php
        session_start();
        $projectToView = $_POST['projectToView'];
        echo '<form action="logListPageAdmin.php" method="post" >';
        echo "<input type='hidden' value=" . $projectToView . " name='projectToView'>";
        echo '<input type="submit" name="backButton" value="Back">';
        echo '</form>';
      ?>

    </div>
  </div>

  <br><pre><h1>   Log Details: </h1></pre>

  <div class="container">

    <?php
      $logDetails = getDetailsOfLog();
      $logToView=$_POST["logToView"];
      $projectName = getProjectName();
      $projectDates = getDetailsOfDates();

      function getDetailsOfLog(){
        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');

        if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
          $logToView=$_POST["logToView"];
          $sql="select * from log where logId ='".$logToView."'";
          $qry = mysqli_query($con,$sql);  //run query
          return $qry;
      }

      function getProjectName(){
        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');

        if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
          $logToView=$_POST["logToView"];
          $sql="SELECT * FROM project INNER JOIN projectlog ON projectlog.logId='".$logToView."' AND projectlog.projectId=project.projectId";
          $qry = mysqli_query($con,$sql);  //run query
          return $qry;
      }

      function getDetailsOfDates(){

        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
        $projectToView=$_SESSION['projectToView'];
        $sql2="select * from dates where projectId='".$projectToView."' order by dateOfUpdate desc limit 1";
        $qry = mysqli_query($con,$sql2);
        return $qry;
      }

      $row=mysqli_fetch_assoc($logDetails);
      $row2=mysqli_fetch_assoc($projectName);
      $row3=mysqli_fetch_assoc($projectDates);
      
      echo "<br>Log Code: ";
      echo "  " . $logToView . " ";

      echo '<br><br>Project Name: ';
      echo "  " . $row2['projectName'] . " ";

      echo '<br><br>Date of Initiation: ';
      echo "  " . $row3['dateOfInitiation'] . " ";

      echo '<br><br>Estimated Date End: ';
      echo "  " . $row3['estimatedDateEnd'] . " ";

      echo '<br><br>Remarks: ';
      echo "  " . $row['remarks'] . " ";

      echo '<br><br>Project Status: ';
      echo "  " . $row['projectStatus'] . " ";

      echo '<br><br>Date of Update: ';
      echo "  " . $row['dateOfUpdate'] . " ";

      echo '<br><br>Attachment: ';
      echo '<p></p>';
      echo '<ol>';
      $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
      $stat = $dbh->prepare('select * from attachmentlog where logId ="'.$logToView.'"');
      $stat->execute();
      while($row = $stat->fetch()){
          echo "<li><a target='_blank' href='viewLogAttachmentAdmin.php?attachmentId=".$row['attachmentId']."'>".$row['attachmentName']."</a></li>";
      }    
      echo "</ol>";
    ?>
  </div>
</html>