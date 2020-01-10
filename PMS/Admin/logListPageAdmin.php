<html>
  <img src='logosahaja.png'><br>

  <h1>Project Monitoring System</h1><br>

  <p>Management Information System</p><br><br>

  <form action='projectPageAdmin.php' method='post'>
    <input type='submit' value='back'>
  </form><br><br>

  <hr><br>

  *Ada 3 tab dashboard and log*<br>

  <?php
    session_start();
    $projectToView=$_POST['projectToView'];
    echo $projectToView;
  ?>

  <form action='dashboardProjectPageAdmin.php' method='post'>
    <input type='submit' value='Dashboard'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  <form action='logListPageAdmin.php' method='post'>
    <input type='submit' value='Log'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  <form action='datePageAdmin.php' method='post'>
    <input type='submit' value='Dates'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form><br><br>

  *ada tempat nak search*<br><br>

  <?php
    //session_start();
    //$projectToView=$_POST['projectToView'];
    $logOverview = getOverviewOfLog();

    function getOverviewOfLog()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
      }
      $projectToView=$_POST['projectToView'];
      $sql='select * from projectlog where projectId ="'.$projectToView.'"';
      
      $qry = mysqli_query($con,$sql);  //run query
      return $qry;
    } 
    echo '<p>No of logs: ' . mysqli_num_rows($logOverview).'</p>';
    echo $projectToView;
    echo '<table border="2">';
    echo '<h2><tr><th>No</th>
        <th>Update Date</th>
            <th>Status Project</th>
            <th>Remarks</th>
            <th>(i)</th>
            <th>Delete</th>
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
          echo '<form action="logDetailPageAdmin.php" method="post" >';
          echo "<input type='hidden' value=" . $row['logId'] . " name='logToView'>";
          echo '<input type="submit" name="viewLogButton" value="Details">';
            echo '</form>';
        echo '</td>';
        echo '<td>';
        echo '<form action="adminButtonProcesses.php" method="post">';
        echo "<input type='hidden' value=" . $row['logId'] . " name='logToDelete'>";
        echo '<input type="submit" name="deleteLogButton" value="X">';
        echo '</form>';
        echo '</td>';
        $count++;
      }
    echo '</table>';
  ?>
  <?php
    //function delete log
    function deleteLog()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
      }
      $logToDelete= $_POST['logToDelete'];
      $sql="delete from log where logId='".$logToDelete."'";
      echo $sql;
      $qry = mysqli_query($con,$sql);  //run query
    } 
  ?>
</html>