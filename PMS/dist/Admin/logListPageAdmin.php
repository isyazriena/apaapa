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
                            $projectToViewName=$_SESSION['projectToViewName'];
                            $projectToView=$_SESSION['projectToView'];
                            $logOverview = getOverviewOfLog();

                            function getOverviewOfLog()
                            {
                            //create connection
                            $con = mysqli_connect('localhost','web2','web2','mispms');
                            if (mysqli_connect_errno())     //check connection is establish
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit;   //terminate the script
                            }
                            $projectToView=$_SESSION['projectToView'];
                            $sql = "SELECT * FROM log INNER JOIN projectlog ON projectlog.logId=log.logId AND projectlog.projectId='".$projectToView."'";
                                
                            $qry = mysqli_query($con,$sql);  //run query
                            return $qry;
                            } 

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
                            <a class="nav-link" href="projectPageAdmin.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Back</a> <!--here how to pass ID-->
                                <div class="sb-sidenav-menu-heading">Core</div>
                                <a class="nav-link" href="differentDestinationPageAdmin2.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Project Background</a
                            ><a class="nav-link" href="#"
                                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Log</a
                            >
                            <a class="nav-link" href="datePageAdmin.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Dates</a>
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
                    <br>
                    <div class="container-fluid">
                        <div class="card mb-4">
                            <div class="card-body">
                            <?php
                                echo "  Project Name : " .$projectToViewName;
                            ?>
                                <div class="table-responsive"><br>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Update Date</th>
                                                <th>Status Project</th>
                                                <th>Remarks</th>
                                                <th>Editor</th>
                                                <th>Details</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Update Date</th>
                                                <th>Status Project</th>
                                                <th>Remarks</th>
                                                <th>Editor</th>
                                                <th>Details</th>
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                while($row=mysqli_fetch_assoc($logOverview))//repeat for each record
                                                {
                                                  echo '<tr>';
                                                  echo '<td>' . $row['dateOfUpdate'] . "</td>";
                                                  echo '<td>' . $row['projectStatus'] . "</td>";
                                                  echo '<td>' . $row['remarks'] . "</td>";
                                                  echo '<td>' . $row['nameId'] . "</td>";
                                                  echo '<td>';
                                                    echo '<form action="logDetailPageAdmin.php" method="post" >';
                                                    echo "<input type='hidden' value=" . $row['logId'] . " name='logToView'>";
                                                    echo "<input type='hidden' value=" . $projectToView . " name='projectToView'>";
                                                    echo '<input type="submit" name="viewLogButton" value="Details">';
                                                    echo '</form>';
                                                  echo '</td>';
                                                  echo '<td>';
                                                    echo '<form action="adminButtonProcesses.php" method="post" onsubmit="return warn(event)">';
                                                    echo "<input type='hidden' value=" . $row['logId'] . " name='logToDelete'>";
                                                    echo "<input type='hidden' value=" . $projectToView . " name='projectToView'>";
                                                    echo '<input type="submit" name="deleteLogButton" value="X">';
                                                    echo '</form>';
                                                    echo "$projectToView";
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
    //function delete log
    function deleteLog()
    {
      //create connection
      $con = mysqli_connect('localhost','web2','web2','mispms');
      if (mysqli_connect_errno())     //check connection is establish
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;   //terminate the script
        }
        $logToDelete= $_POST['logToDelete'];
        
        $sql="delete from log where logId='".$logToDelete."'";
        $sql1="delete from projectlog where logId='".$logToDelete."'";
        $sql2="delete from attachmentlog where logId='".$logToDelete."'";
        $sql3="delete from dates where logId='".$logToDelete."'";
        
        $qry = mysqli_query($con,$sql);  //run query
        $qry = mysqli_query($con,$sql1);
        $qry = mysqli_query($con,$sql2);
        $qry = mysqli_query($con,$sql3);
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
