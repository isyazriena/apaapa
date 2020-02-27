<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

    <?php
      session_start(); 
      include 'getDataAdmin.php';
      $_SESSION['projectToView'] = $projectToView;
    ?>

<a href="newProjectPageAdmin.php" style="float:right">Add Project</a><br><br>

  <div class="container">

    <div class="topnav">
     
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

    echo 'User ID: ' .$_SESSION['adminId']. '<br>';

    echo '<p>No of projects: ' . mysqli_num_rows($projectOverview).'</p>';
    ?>
    <?php

    echo '<table id="list" border="2"><thead>';
    echo '<h2><tr><th>No</th>
        <th>Project Name</th>
            <th>Person In Charge</th>
            <th>
            Status';
            echo '</th>
            <th>Estimated Date End</th>
            <th>(i)</th>
            <th>Delete</th>
            </h2></tr></thead>';
      $list = getList();


    $count=1;
    while($row = mysqli_fetch_assoc($list)) {
     
      //display data
        echo '<tbody><tr>';
        echo '<td>'.$count."</td>";
        echo '<td>' . $row['projectName'] . "</td>"; //display regNumber
        echo '<td>' . $row['personInCharge'] . "</td>";
        echo '<td>' . $row['projectCategory'] . "</td>";
        echo '<td>' . $row['estimatedDateEnd'] . "</td>";
        echo '<td>';
          echo '<form action="differentDestinationPageAdmin.php" method="post">';
          echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToView'>";
          echo $row['projectId'];
          echo '<input type="submit" name="viewProjectButton" value="Details">';
          echo '</form>';
        echo '</td>';
        echo '<td>';
          echo '<form action="adminButtonProcesses.php" method="post" onsubmit="return warn(event)">';
          echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToDelete'>";
          echo '<input type="submit" name="deleteProjectButton" value="X">';
          echo '</form>';
        echo '</td>';
        $count++;
      }
      echo '</tbody></table>';

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
      $sql1="delete from attachmentproject where projectId='".$projectToDelete."'";
      $sql2 = "DELETE log FROM log INNER JOIN projectlog ON projectlog.logId=log.logId AND projectlog.projectId='".$projectToDelete."'";
      $sql3 = "DELETE attachmentlog FROM attachmentlog INNER JOIN projectlog ON projectlog.logId=attachmentlog.logId AND projectlog.projectId='".$projectToDelete."'";
      $sql4="delete from projectlog where projectId='".$projectToDelete."'";
      $sql5="delete from created where projectId='".$projectToDelete."'";
      $sql6="delete from assigned where projectId='".$projectToDelete."'";
      $sql7="delete from dates where projectId='".$projectToDelete."'";

      $qry = mysqli_query($con,$sql);  //run query
      $qry = mysqli_query($con,$sql1); 
      $qry = mysqli_query($con,$sql2);
      $qry = mysqli_query($con,$sql3);
      $qry = mysqli_query($con,$sql4);
      $qry = mysqli_query($con,$sql5);
      $qry = mysqli_query($con,$sql6);
      $qry = mysqli_query($con,$sql7);
    } 
  ?>
 
</html>