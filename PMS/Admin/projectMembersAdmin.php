<html>
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
      </style>
  </head>

  <div class="header">
    <a href="projectPageAdmin.php" class="logo"><img src='logosahaja.png'>
      <h4>Project Monitoring System</h4>
      <h5>Management Information System</h5></a>
    <div class="header-right">
      
      <?php
        session_start();
        include "getDataAdmin4.php";
        $projectToView = $_SESSION['projectToView'];
        echo '<form action="differentDestinationPageAdmin.php" method="post" >';
        echo "<input type='hidden' value=" . $projectToView . " name='projectToView'>";
        echo '<input type="submit" name="backButton" value="Back">';
        echo '</form>';
      ?>

    </div>
  </div>

  <br><pre><h1>   Project Members: </h1></pre>

  <div class="container">
    <?php
    session_start();

    $projectMembers = displayMembersList();
    $projectToView=$_SESSION['projectToView'];
    echo $projectToView;

    function displayMembersList(){
        //create connection
        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno())     //check connection is establish
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;   //terminate the script
        }
        $projectToView=$_SESSION['projectToView'];
        $sql="select * from assigned where projectId ='".$projectToView."' AND not position = 'person in charge'";
        $qry = mysqli_query($con,$sql);
        return $qry;
        echo $sql;
    } 

    echo '<p>No of members: ' . mysqli_num_rows($projectMembers).'</p>';
      echo '<table border="2">';
      echo '<h2><tr><th>No</th>
              <th>Name</th>
              <th>Delete</th>
              </tr></h2>';
      $count=1;
      //display data
      while($row=mysqli_fetch_assoc($projectMembers))//repeat for each record
        {
            //echo "<br> - " . $row['userId'] . " ";
            echo '<tr>';
            echo '<td>'.$count."</td>";
            echo '<td>' . $row['userId'] . "</td>";
            echo '<td>';
            echo '<form action="adminButtonProcesses.php" method="post">';
            echo "<input type='hidden' value=" . $row['userId'] . " name='userToDelete'>";
            echo '<input type="submit" name="deleteUserButton" value="X">';
            echo '</form>';
            echo '</td>';
            $count++;
        }
      echo '</table>';
    ?>
    <br>
    <form action="adminButtonProcesses.php" method="post">
    <?php $list = getNameMembersOthers(); ?>
				<button type="button" id="buttonAdd">Add</button>
				<div id="list">
        <br>
					<?php
						echo "<select name='members[]' id='members1' style='display:block;'>";						
								while ($row = mysqli_fetch_assoc($list)){
									echo '<option value="'.$row['user.userId'].'">'.$row['user.userName'].'</option>';
								}
						echo "</select>";
					?>
				</div>
        
    <script>
					$(document).ready(function(){
						$('#buttonAdd').click(function(){
							var idcount = $("select[id^='members']").length;
							var newel = $('#members1').clone();
							newel.attr("id", "members" + (idcount + 1));
							$("#list").append(newel);	
							return false;
						});
					});
				</script><br>

    <input type='submit' value='Done' name='editMembersButton'>
          </form>
    <?php
    //function delete user
    function deleteUser()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
        $userToDelete= $_POST['userToDelete'];
        $projectToView=$_SESSION['projectToView'];
        $sql="delete from assigned where userId='".$userToDelete."' AND projectId='".$projectToView."'";
        $qry = mysqli_query($con,$sql);  //run query
        return $qry;
      } 
    ?>
    <?php
      function editAssignedUser(){
        //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
        $projectToView=$_SESSION['projectToView'];
        foreach ($_POST['members'] as $key=>$value) {
          $sqlmembers = "INSERT INTO assigned(projectId, userId, position) VALUES('$projectToView','".$value."', 'members');";
          $con->multi_query($sqlmembers);
        }
        return $qry;
      } 
      
    ?>
  </div>
</html>