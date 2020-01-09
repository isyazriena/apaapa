<html>
  <img src='logosahaja.png'><br>

  <h1>Project Monitoring System</h1><br>

  <p>Management Information System</p><br><br>

  <form action='logListPageUser.php' method='post'>
    <input type='submit' value='back'>
  </form><br><br>

  <hr><br>

  <h1>Log Details: </h1>

  *ada css container*<br>

  <?php
    session_start();
    $logDetails = getDetailsOfLog();
    $logToView=$_POST["logToView"];

    function getDetailsOfLog(){
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno()){     //check connection is establish
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
      }

      $logToView=$_POST["logToView"];
      $sql="select * from log where logId ='".$logToView."'";
      $qry = mysqli_query($con,$sql);  //run query
      return $qry;
    }
    
    $row=mysqli_fetch_assoc($logDetails);
    echo "<br>Project Code: ";
    echo "  " . $logToView . " ";

    echo '<br>Project Name: ';
    echo 'ni from different table';

    echo '<br>Date of Initiation: ';
    echo "  " . $row['dateOfInitiation'] . " ";

    echo '<br>Estimated Date End: ';
    echo "  " . $row['estimatedDateEnd'] . " ";

    echo '<br>Remarks: ';
    echo "  " . $row['remarks'] . " ";

    echo '<br>Project Status: ';
    echo 'ni from drop down';

    echo '<br>Date of Update: ';
    echo "  " . $row['dateOfUpdate'] . " ";

    echo '<br>Attachment: ';
    echo '<p></p>';
    echo '<ol>';

    $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
    $stat = $dbh->prepare('select * from attachmentlog where logId ="'.$logToView.'"');
    $stat->execute();
    while($row = $stat->fetch()){
        echo "<li><a target='_blank' href='viewLogAttachmentUser.php?attachmentId=".$row['attachmentId']."'>".$row['attachmentName']."</a></li>";
    }    
    echo "</ol>";

    echo '<br>Update Date: ';
    echo 'LATER COME BACK TO THIS';
  ?>
</html>