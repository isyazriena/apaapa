<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

      .topnav {
      overflow: hidden;
      }

      .topnav input[type=text] {
        float: center;
        padding: 6px;
        margin-top: 8px;
        margin-right: 16px;
        border: none;
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

  <div class='header'>
    <a href="projectPageUser.php" class="logo"><img src='logosahaja.png'>
    <h4>Project Monitoring System</h4>
    <h5>Management Information System</h5></a>

    <?php
      session_start();
      include 'getDataUser.php';
    ?>

  <div>
    <script>
      $(document).ready(function(){ /* PREPARE THE SCRIPT */
      $("#projects").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
      document.getElementById('jsform').submit();
      });
      });
    </script>

    <form id="jsform" action="" method="POST">
      <select name="projects" id="projects">
        <?php 
          $list = ['Projects', 'My Projects', 'Running Projects', 'Completed Projects', 'Terminated Projects'];
          $val = ['0', '1', '2', '3', '4'];

          for ($i=0; $i < count($list); $i++) {
          if ($val[$i] == $_POST['projects']) { $select = 'selected="selected"'; }
          else { $select = ''; }
          echo '<option value="'.$i.'" '.$select.'>'.$list[$i].'</option>';
          }
        ?>
      </select>
    </form>

  </div>

  <div class="header-right">
    <a class="active" href="projectPageAdmin.php">Home</a>
    <a href="logoutPageUser.php">Logout</a>
  </div>

  <div style="padding-left:20px; text-align:center;">
    <br><br>
    <p><b>Welcome to Management Information System</b></p>
  </div>

  <div class="container">

    <div style="text-align:center">
      <img src='logopenuh.png'><br>
    </div>

    <div class="topnav">
      <input type="text" onkeyup="myFunction()" placeholder="Search.." id="myInput">
    </div><br><br>

    <?php
      $projectOverview = getOverviewOfProject();

      function getOverviewOfProject(){
        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');

        if (mysqli_connect_errno())     //check connection is establish
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }

        $sql="select * from project";
        $qry = mysqli_query($con,$sql);  //run query
        return $qry;
      } 

      echo 'User ID: ' .$_SESSION['userId']. '<br>';

      echo '<p>No of projects: ' . mysqli_num_rows($projectOverview).'</p>';

      echo '<table id="myTable" border="2">';
      echo '<h2><tr><th>No</th>
          <th>Project Name</th>
              <th>Person In Charge</th>
              <th>Status</th>
              <th>Estimated Date End</th>
              <th>(i)</th>
              </tr></h2>';

      $list = getList();
        $count=1;
        //display data
        while($row = mysqli_fetch_assoc($list)) {
          echo '<tr>';
          echo '<td>'.$count."</td>";
          echo '<td>' . $row['projectName'] . "</td>"; //display regNumber
          echo '<td>' . $row['personInCharge'] . "</td>";
          echo '<td>' . $row['projectCategory'] . "</td>";
          echo '<td>' . $row['estimatedDateEnd'] . "</td>";
          echo '<td>';
            echo '<form action="differentDestinationPageUser.php" method="post" >';
            echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToView'>";
            echo '<input type="submit" name="viewProjectButton" value="Details">';
            echo '</form>';
          echo '</td>';
          $count++;
          }
        echo '</table>';
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
      td = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
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