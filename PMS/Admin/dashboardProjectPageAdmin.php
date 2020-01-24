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
    $projectToView=$_SESSION['projectToView'];
    echo $projectToView;
  ?>

  <div style="margin:25px">
    <form action='dashboardProjectPageAdmin.php' method='post'>
      <input type='submit' value='Dashboard'>
      <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
    </form>

    <form action='logListPageAdmin.php' method='post'>
      <input type='submit' value='Log'>
      <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
    </form>

    <form action='datePageAdmin.php' method='post'>
      <input type='submit' value='Dates'>
      <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
    </form>
  </div>

  <div class="container">
    <?php
      $projectDetails = getDetailsOfProject();
      $projectMembers = getDetailsOfMembers();

      function getDetailsOfProject(){

        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
        $projectToView=$_SESSION['projectToView'];
        $sql="select * from project where projectId ='".$projectToView."'";
        $qry = mysqli_query($con,$sql);  //run query
        return $qry;
      }

      function getDetailsOfMembers(){

        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
        $projectToView=$_SESSION['projectToView'];
        $sql1="select * from assigned where projectId ='".$projectToView."' AND not position = 'person in charge'";
        $qry = mysqli_query($con,$sql1);
        return $qry;
      }

      echo $projectToView;
      
      $row=mysqli_fetch_assoc($projectDetails);
      //$row2=mysqli_fetch_assoc($projectMembers);

      echo "<br>Project Code: ";
      echo "  " . $projectToView . " ";

      echo '<br><br>Project Name: ';
      echo "  " . $row['projectName'] . " ";

      echo '<br><br>Report Owner: ';
      echo "  " . $row['reportOwner'] . " ";

      echo '<br><br>System Custodian: ';
      echo "  " . $row['systemCustodian'] . " ";

      echo '<br><br>Date of Initiation: ';
      echo "  " . $row['dateOfInitiation'] . " ";

      echo '<br><br>Estimated Date End: ';
      echo "  " . $row['estimatedDateEnd'] . " ";

      echo '<br><br>Person In Charge: ';
      echo "  " . $row['personInCharge'] . " ";

      echo '<br><br>Members: ';
      while($row2=mysqli_fetch_assoc($projectMembers))//repeat for each record
      {
        echo "<br> - " . $row2['userId'] . " ";
      }

      echo '<br><br>Project Category: ';
      echo "  " . $row['projectCategory'] . " ";

      echo '<br><br>Project Status: ';
      echo "  " . $row['projectStatus'] . " ";

      echo '<br><br>Project Description: ';
      echo "  " . $row['projectDescription'] . " ";

      echo '<br><br>Attachment: ';
      echo '<p></p>';
      echo '<ol>';
      $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
      $stat = $dbh->prepare('select * from attachmentproject where projectId ="'.$projectToView.'"');
      $stat->execute();
      while($row = $stat->fetch()){
          echo "<li><a target='_blank' href='viewProjectAttachmentAdmin.php?attachmentId=".$row['attachmentId']."'>".$row['attachmentName']."</a></li>";
      }
      echo "</ol>";

      echo "<form action='updateProjectPageAdmin.php' method='post'>";
      echo "<input type='hidden' value=" . $projectToView . " name='projectId'>";
      echo "<input type='submit' value='Update'>";
    ?>
    </form>
  </div>
</html>