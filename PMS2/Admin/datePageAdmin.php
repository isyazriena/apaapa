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

  <div class="header"> <!--go to home when clicked-->
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

  <form action='dashboardProjectPageAdmin.php' method='post'> <!--tab dashboard-->
    <input type='submit' value='Dashboard'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form>

  <form action='logListPageAdmin.php' method='post'> <!--tab log-->
    <input type='submit' value='Log'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form>

  <form action='datePageAdmin.php' method='post'> <!--tab dates-->
    <input type='submit' value='Dates'>
    <input type='hidden' <?php echo "value='$projectToView'"; ?> name='projectToView'>
  </form>

  <div style="text-align:center; margin:50px;">

    <?php
      $dateOverview = getOverviewOfDate();

      function getOverviewOfDate(){
        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno())     //check connection is establish
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
          }
          $projectToView=$_SESSION['projectToView'];
        $sql='select * from dates where projectId ="'.$projectToView.'"'; //tengok balik
        
        $qry = mysqli_query($con,$sql);  //run query
        return $qry;
      }

      echo '<p>No of dates: ' . mysqli_num_rows($dateOverview).'</p>';
      echo '<table border="2">';
      echo '<h2><tr><th>No</th>
              <th>Date of Initiation</th>
              <th>Estimated Date End</th>
              <th>Date of Update</th>
              <th>Edited By</th>
              <th>Delete</th>
              </tr></h2>';
      $count=1;
      //display data
      while($row=mysqli_fetch_assoc($dateOverview))//repeat for each record
        {
          echo '<tr>';
          echo '<td>'.$count."</td>";
          echo '<td>' . $row['dateOfInitiation'] . "</td>";
          echo '<td>' . $row['estimatedDateEnd'] . "</td>";
          echo '<td>' . $row['dateOfUpdate'] . "</td>";
          echo '<td>' . $row['nameId'] . "</td>";
          echo '<td>';
          echo '<form action="adminButtonProcesses.php" method="post" onsubmit="return warn(event)">';
          echo "<input type='hidden' value=" . $row['dateId'] . " name='dateToDelete'>";
          echo "<input type='hidden' value=" . $projectToView . " name='projectToView'>";
          echo '<input type="submit" name="deleteDateButton" value="X">';
          echo '</form>';
        echo '</td>';
          $count++;
        }
      echo '</table>';
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
    function deleteDate()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
        $dateToDelete= $_POST['dateToDelete'];

        $sql="delete from dates where dateId='".$dateToDelete."'";
        $qry = mysqli_query($con,$sql);  //run query
        return $qry;
      } 
    ?>
  </div>
</html>