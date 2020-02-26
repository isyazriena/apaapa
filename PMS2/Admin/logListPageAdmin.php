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

        .topnav {
          overflow: hidden;
          
        }

        .topnav input[type=text] {
          float: center;
          padding: 6px;
          margin-top: 8px;
          margin-right: 16px;
          /*border: none;*/
          border-color:black;
          font-size: 17px;
        }

        @media screen and (max-width: 600px) {
          .topnav input[type=text] {
            float: none;
            display: block;
            text-align: left;
            width: 100%;
            margin: 0;
            padding: 14px;
          }
          
          .topnav input[type=text] {
            border: 1px solid #ccc;  
          }
        }

        table {
          border-collapse: collapse;
          width: 100%;
        }

        th, td {
          padding: 8px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }

        tr:hover {background-color:#f5f5f5;}
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

  <div style="text-align:center; margin:50px;">

  <div class="topnav">
    <input type="text" onkeyup="myFunction()" placeholder="Search.." id="myInput">
  </div><br><br>

  <?php
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
      $projectToView=$_SESSION['projectToView'];
      $sql = "SELECT * FROM log INNER JOIN projectlog ON projectlog.logId=log.logId AND projectlog.projectId='".$projectToView."'";
        
      $qry = mysqli_query($con,$sql);  //run query
      return $qry;
    } 
    echo '<p>No of logs: ' . mysqli_num_rows($logOverview).'</p>';
    echo $projectToView;
    echo '<table id="myTable" border="2">';
    echo '<h2><tr><th>No</th>
          <th>Update Date</th>
          <th>Status Project</th>
          <th>Remarks</th>
          <th>Editor</th>
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
        echo '<td>' . $row['projectStatus'] . "</td>";
        echo '<td>' . $row['remarks'] . "</td>";
        echo '<td>' . $row['nameId'] . "</td>";
        echo '<td>';
          echo '<form action="logDetailPageAdmin.php" method="post" >';
          echo "<input type='hidden' value=" . $row['logId'] . " name='logToView'>";
          echo "<input type='hidden' value=" . $projectToView . " name='projectToView'>";
          echo '<input type="submit" name="viewLogButton" value="Details">';
          echo '</form>';
        echo '</td>';
        echo '<td>';
          echo '<form action="adminButtonProcesses.php" method="post" onsubmit="return warn(event)">';
          echo "<input type='hidden' value=" . $row['logId'] . " name='logToDelete'>";
          echo "<input type='hidden' value=" . $projectToView . " name='projectToView'>";
          echo '<input type="submit" name="deleteLogButton" value="X">';
          echo '</form>';
          echo "$projectToView";
        echo '</td>';
        $count++;
      }
      echo '</table>';
      echo $_SESSION['projectToView'];
  ?>
  <script>
    function warn(e) {
      if (confirm('Are you sure to delete?'))
        e.returnValue = true;
      else
        e.returnValue = false;
    }
  </script>
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
        $sql1="delete from projectlog where logId='".$logToDelete."'";
        $sql2="delete from attachmentlog where logId='".$logToDelete."'";
        $sql3="delete from dates where logId='".$logToDelete."'";
        
        $qry = mysqli_query($con,$sql);  //run query
        $qry = mysqli_query($con,$sql1);
        $qry = mysqli_query($con,$sql2);
        $qry = mysqli_query($con,$sql3);
      } 
    ?>
    </div>

    <script>
  function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, j, txtValue, txtValue2;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.rows;

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      td2 = tr[i].getElementsByTagName("td")[3];
      if (td) {
        txtValue = td.textContent || td.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>
</html>