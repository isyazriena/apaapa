<html>
  <img src='logosahaja.png'><br>

  <h1>Project Monitoring System</h1><br>

  <p>Management Information System</p><br><br>

  <form action='projectPageAdmin.php' method='post'>
    <input type='submit' value='back'>
  </form><br><br>

  <hr><br>

  *Ada 3 tab dashboard, log, dates*<br>

  <form action='dashboardProjectPageAdmin.php' method='post'>
    <input type='submit' value='Dashboard'>
  </form><br><br>

  <?php
    session_start();
    $projectToView=$_POST['projectToView'];
    echo $projectToView;
  ?>

  <form action='logListPageAdmin.php' method='post'>
    <input type='submit' value='Log'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  <form action='datePageAdmin.php' method='post'>
    <input type='submit' value='Dates'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  *ada css container*

  <?php
    $projectDetails = getDetailsOfProject();
    $projectMembers = getDetailsOfMembers();

    function getDetailsOfProject()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
      }
      $projectToView=$_POST['projectToView'];
      $sql="select * from project where projectId ='".$projectToView."'";
      $qry = mysqli_query($con,$sql);  //run query
      return $qry;
    }
    function getDetailsOfMembers()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
      }
      $projectToView=$_POST['projectToView'];
      $sql1="select * from assigned where projectId ='".$projectToView."'";
      $qry = mysqli_query($con,$sql1);
      return $qry;
    }

    echo $projectToView;
    
    $row=mysqli_fetch_assoc($projectDetails);
    $row2=mysqli_fetch_assoc($projectMembers);
    echo "<br>Project Code: ";
    echo "  " . $projectToView . " ";

    echo '<br>Project Name: ';
    echo "  " . $row['projectName'] . " ";

    echo '<br>Report Owner: ';
    echo "  " . $row['reportOwner'] . " ";

    echo '<br>System Custodian: ';
    echo "  " . $row['systemCustodian'] . " ";

    echo '<br>Date of Initiation: ';
    echo "  " . $row['dateOfInitiation'] . " ";

    echo '<br>Estimated Date End: ';
    echo "  " . $row['estimatedDateEnd'] . " ";

    echo '<br>Person In Charge: ';
    echo "  " . $row['personInCharge'] . " ";

    echo '<br>Members: ';
    echo "  " . $row2['userId'] . " ";

    echo '<br>Project Description: ';
    echo "  " . $row['projectDescription'] . " ";

    echo '<br>Attachment: ';
    echo '<p></p>';
    echo '<ol>';

    $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
    $stat = $dbh->prepare('select * from attachmentproject where projectId ="'.$projectToView.'"');
    $stat->execute();
    while($row = $stat->fetch()){
        echo "<li><a target='_blank' href='viewProjectAttachmentAdmin.php?attachmentId=".$row['attachmentId']."'>".$row['attachmentName']."</a></li>";
    }
  ?>
  
  </ol>


</html>