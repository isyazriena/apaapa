<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
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
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="projectPageAdmin.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Project Category
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="projectPageAdminMyProject.php">My Projects</a>
                                <a class="nav-link" href="projectPageAdminRunningProject.php">Running Projects</a>
                                <a class="nav-link" href="projectPageAdminCompletedProject.php">Completed Projects</a>
                                <a class="nav-link" href="projectPageAdminTerminatedProject.php">Terminated Projects</a></nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"></a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            echo $_SESSION['adminId'];
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div style="text-align:center">
                            <img src='logopenuh2.png'><br>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart Example</div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Bar Chart Example</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <?php
                            //include 'getDataAdmin.php';

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
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                
                                <a href="newProjectPageAdmin.php" style="float:right">Add Project</a><br><br>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Person In Charge</th>
                                                <th>Status</th>
                                                <th>DateOfInitiation</th>
                                                <th>EstimatedDateEnd</th>
                                                <!--<th>Last Update</th>-->
                                                <th>(i)</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Person In Charge</th>
                                                <th>Status</th>
                                                <th>DateOfInitiation</th>
                                                <th>EstimatedDateEnd</th>
                                                <!--<th>Last Update</th>-->
                                                <th>(i)</th>
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $list = getOverviewOfProject();
                                                while($row = mysqli_fetch_assoc($list)) {
                                                    //display data
                                                      echo '<tr>';
                                                      //echo '<td>'.$count."</td>";
                                                      echo '<td>' . $row['projectName'] . "</td>"; //display regNumber
                                                      echo '<td>' . $row['personInCharge'] . "</td>";
                                                      echo '<td>' . $row['projectStatus'] . "</td>";
                                                      echo '<td>' . $row['dateOfInitiation'] . "</td>";
                                                      echo '<td>' . $row['estimatedDateEnd'] . "</td>";
                                                      echo '<td>';
                                                        echo '<form action="differentDestinationPageAdmin.php" method="post">';
                                                        echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToView'>";
                                                        echo '<input type="submit" name="viewProjectButton" value="Details">';
                                                        echo '</form>';
                                                      echo '</td>';
                                                      echo '<td>';
                                                        echo '<form action="adminButtonProcesses.php" method="post" onsubmit="return warn(event)">';
                                                        echo "<input type='hidden' value=" . $row['projectId'] . " name='projectToDelete'>";
                                                        echo '<input type="submit" name="deleteProjectButton" value="X">';
                                                        echo '</form>';
                                                      echo '</td>';
                                                    }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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
