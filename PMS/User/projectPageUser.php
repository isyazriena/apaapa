<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>

  <img src='logosahaja.png'><br>
  <h1>Project Monitoring System</h1><br>
  <p>Management Information System</p><br><br>

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

  <form action='logoutPageUser.php' method='post'>
    <input type='submit' value='logout'>
  </form><br>

  <hr>

  <h3>Welcome to Management Information System</h3><br><br>

  *ada css container*<br>

  <img src='logopenuh.png'><br>

  *ada tempat nak search*<br><br>

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

  echo '<table border="2">';
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
      echo '<td>' . $row['projectName'] . "</td>";
      echo '<td>' . $row['projectName'] . "</td>";
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
</html>