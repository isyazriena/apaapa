<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MIS - Project Monitoring</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="projectPageAdmin.php"><img src='logosahaja2.png' style="width:63px; float:left;"><h5>Project Monitoring System</h5><h6 style="font-family: sans-serif;">Management Information System</h6></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <div style="color:#ffffff">
                        <?php
                            session_start();
                            echo "Hello, " .$_SESSION['adminName'];
                        ?>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="editAccountAdmin.php">Edit Account</a>
                        <a class="dropdown-item" href="logoutPageAdmin.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!--Side Nav-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="differentDestinationPageAdmin2.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Back</a> <!--here how to pass ID-->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"></a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            echo $_SESSION['adminId'];
                            include "getDataAdmin4.php";
                            $projectMembers = displayMembersList();
                            $projectPic = getProjectPic();
                            $projectToView=$_POST['projectToView'];

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
                        
                            function getProjectPic(){
                              $con = mysqli_connect('localhost','web2','web2','mispms');
                                if (mysqli_connect_errno())     //check connection is establish
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit;   //terminate the script
                                }
                                $projectToView=$_SESSION['projectToView'];
                                $sql="select * from project where projectId ='".$projectToView."'";
                                $qry = mysqli_query($con,$sql);
                                return $qry;
                                echo $sql;
                            }
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">Project Members:</h1><br>                        
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                        $row2 = mysqli_fetch_assoc($projectPic);
                                        echo '<p>Person In Charge: ' . $row2['personInCharge']; //tak sesuai here
                                    ?>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                while($row=mysqli_fetch_assoc($projectMembers))//repeat for each record
                                                {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['userId'] . "</td>";
                                                    echo '<td>';
                                                    echo '<form action="adminButtonProcesses.php" method="post">';
                                                    echo "<input type='hidden' value=" . $row['userId'] . " name='userToDelete'>";
                                                    echo '<input type="submit" name="deleteUserButton" value="X">';
                                                    echo '</form>';
                                                    echo '</td>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            <form action="adminButtonProcesses.php" method="post" enctype='multipart/form-data'>
                            <?php $list = getNameMembersOthers(); ?>
                                        <button type="button" id="buttonAdd">Add</button>
                                        <div id="list">
                                <br>
                                            <?php
                                                echo "<select name='members[]' id='members1' style='display:block;'>";						
                                                        while ($row = mysqli_fetch_assoc($list)){
                                                            echo '<option value="'.$row['userId'].'">'.$row['userName'].'</option>';
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
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Intan Syazriena 2020</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
