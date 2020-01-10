<html>
  <img src='logosahaja.png'><br>

  <h1>Project Monitoring System</h1><br>

  <p>Management Information System</p><br><br>

  <form action='projectPageUser.php' method='post'>
    <input type='submit' value='back'>
  </form><br><br>

  <hr><br>

  *Ada tiga tab dashboard and log*<br>

  <?php
    session_start();
    $projectToView=$_SESSION['projectToView'];
    echo $projectToView;
  ?>

  <form action='dashboardProjectPageUser.php' method='post'>
    <input type='submit' value='Dashboard'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  <form action='logListPageUser.php' method='post'>
    <input type='submit' value='Log'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  <form action='datePageUser.php' method='post'>
    <input type='submit' value='Dates'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  *ada tempat nak search*<br><br>

  <?php
  session_start();
  $logOverview = getOverviewOfLog();

  function getOverviewOfLog(){
    //create connection
    $con = mysqli_connect('localhost','web2','web2','mispms');

    if (mysqli_connect_errno()){     //check connection is establish
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit;   //terminate the script
    }

    $sql="select * from log";
    $qry = mysqli_query($con,$sql);  //run query
    return $qry;
  } 

  echo '<p>No of logs: ' . mysqli_num_rows($logOverview).'</p>';

  echo '<table border="2">';
  echo '<h2><tr><th>No</th>
        <th>Update Date</th>
        <th>Status Project</th>
        <th>Remarks</th>
        <th>(i)</th>
        </tr></h2>';
  $count=1;
  //display data
  while($row=mysqli_fetch_assoc($logOverview))//repeat for each record
    {
      echo '<tr>';
      echo '<td>'.$count."</td>";
      echo '<td>' . $row['dateOfUpdate'] . "</td>";
      //echo '<td>' . $row['projectName'] . "</td>"; //untuk drop down status project
      echo '<td> Later </td>';
      echo '<td>' . $row['remarks'] . "</td>";
      echo '<td>';
      //$logToView=$row['logId'];
      echo '<form action="logDetailPageUser.php" method="post" >';
      echo "<input type='hidden' value=" . $row['logId'] . " name='logToView'>";
      echo '<input type="submit" name="viewLogButton" value="Details">';
      echo '</form>';
      echo '</td>';
      $count++;
    }
  echo '</table>';
  ?>
</html>