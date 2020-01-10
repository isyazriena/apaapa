<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    .header img {
      float: left;
      /* width: 100px;
      height: 100px;
      background: #555; */
    }

    .header h1 {
      position: relative;
      top: 18px;
      left: 10px;
    }
  </style>
  </head>
  
  <div class='header'>
    <img src='logosahaja.png'>
    <h3>Project Monitoring System</h3><br>
    <p>Management Information System</p><br><br>
  </div>

<?php
    include 'getDataAdmin.php';
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
                        if ($val[$i] == $_POST['projects']) { 
                          $select = 'selected="selected"'; 
                        }
                        else { 
                          $select = ''; 
                        }
                        echo '<option value="'.$i.'" '.$select.'>'.$list[$i].'</option>';
                    }
                ?>
            </select>
        </form>

</div>

  <form action='newProjectPageAdmin.php' method='post'>
    <input type='submit' value='add project'>
  </form>

  <form action='logoutPageAdmin.php' method='post'>
    <input type='submit' value='logout'>
  </form><br>

  <hr>

  <h4>Welcome to Management Information System</h4><br><br>

  *ada css container*<br>

  <img src='logopenuh.png'><br>

  *ada tempat nak search*<br><br>

  <?php
    session_start(); 

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

    echo 'User ID: ' .$_SESSION['adminId']. '<br>';

    echo '<p>No of projects: ' . mysqli_num_rows($projectOverview).'</p>';

    echo '<table border="2">';
    echo '<h2><tr><th>No</th>
        <th>Project Name</th>
            <th>Person In Charge</th>
            <th>Status</th>
            <th>Estimated Date End</th>
            <th>(i)</th>
            <th>Delete</th>
            </tr></h2>';

    $list = getList();
    $count=1;
    while($row = mysqli_fetch_assoc($list)) {
     
      //display data
        echo '<tr>';
        echo '<td>'.$count."</td>";
        echo '<td>' . $row['projectName'] . "</td>"; //display regNumber
        echo '<td>' . $row['projectName'] . "</td>";
        echo '<td>' . $row['projectName'] . "</td>";
        echo '<td>' . $row['estimatedDateEnd'] . "</td>";
        echo '<td>';
          echo '<form action="dashboardProjectPageAdmin.php" method="post" >';
          echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToView'>";
          echo $row['projectId'];
          echo '<input type="submit" name="viewProjectButton" value="Details">';
            echo '</form>';
        echo '</td>';
        echo '<td>';
        echo '<form action="adminButtonProcesses.php" method="post">';
        echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToDelete'>";
        echo '<input type="submit" name="deleteProjectButton" value="X">';
        echo '</form>';
        echo '</td>';
        $count++;
      }
      echo '</table>';

  ?>

  <?php
    session_start();
    //function delete project

    function deleteProject()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
      }
      $projectToDelete= $_POST['projectToDelete'];
      $sql="delete from project where projectId='".$projectToDelete."'";
      //delete log of $projectToDelete thru table projectlog
      //delete project of $projectToDelete from projectlog
      //delete attachment project of $projectToDelete from attachmentproject
      //delete attachment log of $projectToDelete from attachmentproject using logid from table log
      //mende sia
      echo $sql;
      $qry = mysqli_query($con,$sql);  //run query
    } 
  ?>
</html>