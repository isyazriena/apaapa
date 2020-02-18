<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="csstable/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/css/util.css">
	<link rel="stylesheet" type="text/css" href="csstable/css/main.css">
<!--===============================================================================================-->
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
    <h5>Management Information System</h5></a>
    
    <?php
      session_start(); 
      include 'getDataAdmin.php';
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
      <input type="text" onkeyup="myFunction()" placeholder="Search.." id="myInput">

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
<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">

				<div class="table100 ver3 m-b-110">
					<div class="table100-head">
    <?php

    echo '<table id="myTable" border="2"><thead>';
    echo '<h2><tr class="row100 head"><th class="cell100 column1">No</th>
        <th class="cell100 column2">Project Name</th>
            <th class="cell100 column3">Person In Charge</th>
            <th class="cell100 column4">Status</th>
            <th class="cell100 column5">Estimated Date End</th>
            <th class="cell100 column6">(i)</th>
            <th class="cell100 column7">Delete</th>
            </h2></tr></thead></table></div>';

            $list = getList();
            if(isset($_POST['month'])){
              $list = getList1();
            }
            else if(isset($_POST['year'])){
              $list = getList2();
            }
            else{
              $list = getList();
            }
    $count=1;
    while($row = mysqli_fetch_assoc($list)) {
     
      //display data
        echo '<div class="table100-body js-pscroll"><table><tbody><tr class="row100 body">';
        echo '<td class="cell100 column1">'.$count."</td>";
        echo '<td class="cell100 column2">' . $row['projectName'] . "</td>"; //display regNumber
        echo '<td class="cell100 column3">' . $row['personInCharge'] . "</td>";
        echo '<td class="cell100 column4">' . $row['projectCategory'] . "</td>";
        echo '<td class="cell100 column5">' . $row['estimatedDateEnd'] . "</td>";
        echo '<td class="cell100 column6">';
          echo '<form action="differentDestinationPageAdmin.php" method="post">';
          echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToView'>";
          echo $row['projectId'];
          echo '<input type="submit" name="viewProjectButton" value="Details">';
          echo '</form>';
        echo '</td>';
        echo '<td class="cell100 column7">';
          echo '<form action="adminButtonProcesses.php" method="post" onsubmit="return warn(event)">';
          echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToDelete'>";
          echo '<input type="submit" name="deleteProjectButton" value="X">';
          echo '</form>';
        echo '</td>';
        $count++;
      }
      echo '</tbody></table></div>';

  ?>
</div>
				</div>
			</div>
		</div>
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