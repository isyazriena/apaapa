<html>
  <img src='logosahaja.png'><br>

  <h1>Project Monitoring System</h1><br>

  <p>Management Information System</p><br><br>

  <form action='projectPageAdmin.php' method='post'>
    <input type='submit' value='back'>
  </form><br><br>

  <hr><br>

  *Ada 3 tab dashboard and log*<br>

  <form action='dashboardProjectPageAdmin.php' method='post'>
    <input type='submit' value='Dashboard'>
  </form><br><br>

  <form action='logListPageAdmin.php' method='post'>
    <input type='submit' value='Log'>
  </form><br><br>

  <form action='.php' method='post'>
    <input type='submit' value='Dates'>
  </form><br><br>

  *ada tempat nak search*<br><br>

  <?php
    session_start();
    $projectToView=$_POST['projectToView'];
    $dateOverview = getOverviewOfDate();

    function getOverviewOfDate()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
      }
      $projectToView=$_POST['projectToView'];
      $sql='select * from dates where projectId ="'.$projectToView.'"'; //tengok balik
      
      $qry = mysqli_query($con,$sql);  //run query
      return $qry;
    } 
    echo '<p>No of dates: ' . mysqli_num_rows($dateOverview).'</p>';
    echo $projectToView;
    echo '<table border="2">';
    echo '<h2><tr><th>No</th>
        <th>Project Name</th>
            <th>Date of Initiation</th>
            <th>Estimated Date End</th>
            <th>Date of Update</th>
            <th>Edited By</th>
            <th>Log Id</th>
            </tr></h2>';
    $count=1;
    //display data
    while($row=mysqli_fetch_assoc($dateOverview))//repeat for each record
      {
        echo '<tr>';
        echo '<td>'.$count."</td>";
        //echo '<td>' . $row['projectName'] . "</td>"; kena query untuk dapatkan projectname
        echo '<td> Later </td>';
        echo '<td>' . $row['dateOfInitiation'] . "</td>";
        echo '<td>' . $row['estimatedDateEnd'] . "</td>";
        echo '<td>' . $row['dateOfUpdate'] . "</td>";
        //echo '<td>' . $row['nameId'] . "</td>"; task 9 belum settle masukkan nama editor dalam table (admin&user)
        echo '<td> Later </td>';
        echo '<td>' . $row['logId'] . "</td>";
        $count++;
      }
    echo '</table>';
  ?>

</html>