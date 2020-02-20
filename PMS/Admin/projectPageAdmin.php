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
          border: 1px solid white;
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
    </style>
  </head>
  
  <div class='header'>
    <a href="projectPageAdmin.php" class="logo"><img src='logosahaja.png'>
    <h4>Project Monitoring System</h4>
    <h5>Management Information System wtf</h5></a>
    
    <?php
      session_start(); 
      include 'getDataAdmin.php';
      $_SESSION['projectToView'] = $projectToView;
    ?>

    <div class="header-right">
      <a class="active" href="projectPageAdmin.php">Home</a>
      <a href="newProjectPageAdmin.php">Add Project</a>
      <a href="logoutPageAdmin.php">Logout</a>
    </div>
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
      <input type="text" placeholder="Search.." id="searchId" onkeyup="searchList(this.id)">

      <div style="float: right">
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
            <th>Status</th>
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
  function searchList(searchId) {
    var table = document.getElementById('list');
    var tbody = table.getElementsByTagName('tbody');
    var tr = tbody[0].getElementsByTagName('tr');

    let input = document.querySelector('#'+searchId).value.toUpperCase();

    for(i=0; i<tr.length; i++) {
        let td = tr[i].getElementsByTagName('td');
        tr[i].style.display = 'none';

        for(j=0; j<td.length-1; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(input) > -1) {
                tr[i].style.display = '';
                continue;
            }
        }
    }
}
//console.log();
  </script>

  <script>
    function warn(e) {
      if (confirm('Are you sure to delete?'))
        e.returnValue = true;
      else
        e.returnValue = false;
    }
  </script>

  <script>
    function generateOptionsRange(parentId, start, end){
      var parent = document.querySelector('#' + parentId);

      for(i=0; i<=(end-start); i++){
        var option = document.createElement('option');
        option.textContent = start + i;
        parent.appendChild(option);
      }
    }
  </script>

  </div>
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
  <!--===============================================================================================-->	
	<script src="csstable/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="csstable/vendor/bootstrap/js/popper.js"></script>
	<script src="csstable/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="csstable/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="csstable/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
<!--===============================================================================================-->
	<script src="csstable/js/main.js"></script>
</html>