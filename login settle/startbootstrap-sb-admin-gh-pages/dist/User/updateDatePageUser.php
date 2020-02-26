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
            <a class="navbar-brand" href="index.php"><img src='logosahaja2.png' style="width:63px; float:left;"><h5>Project Monitoring System</h5><h6 style="font-family: sans-serif;">Management Information System</h6></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <div style="color:#ffffff">
                        <?php
                            session_start();
                            echo "Hello, " .$_SESSION['adminId'];
                        ?>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Edit Account</a>
                        <a class="dropdown-item" href="login.html">Logout</a>
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
                            <a class="nav-link" href="index.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Back</a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"></a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            echo $_SESSION['adminId'];
                            $getOldDate = getOldDate();
                            $projectId = $_POST['projectId'];

                                function getOldDate(){
                                    $con = mysqli_connect('localhost','web2','web2','mispms');
                                    if (mysqli_connect_errno())     //check connection is establish
                                    {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                    exit;   //terminate the script
                                    }
                                    $projectId=$_POST['projectId'];
                                    $sql5="select * from dates where projectId='".$projectId."' order by dateOfUpdate desc limit 1";
                            $qry = mysqli_query($con,$sql5);
                                    return $qry;
                                }

                            $row=mysqli_fetch_assoc(getOldDate());
                            echo $row['dateOfInitiation'];
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">Enter Update on Date:</h1><br>                        
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                <form action='userButtonProcesses.php' method='post'>

                                    Date Of Initiation:
                                    <input type="date" name="dateOfInitiation" value="<?php echo $row['dateOfInitiation']; ?>"><br><br>

                                    Estimated Date End:
                                    <input type="date" name="estimatedDateEnd" value="<?php echo $row['estimatedDateEnd']; ?>"><br><br>

                                    <?php
                                            $projectId=$_POST['projectId'];
                                            echo "<input type='submit' value='Done' name='updateDateButton'>";
                                            echo "<input type='hidden' value='$projectId' name='projectId'>";
                                        ?>
                                </form>
                                </div>
                        </div>
                    </div>
                </main>
                <?php
            function updateDate(){
            $dateOfInitiation=$_POST['dateOfInitiation'];
            $estimatedDateEnd=$_POST['estimatedDateEnd'];
            $userId = $_SESSION['userId'];
            $projectId=$_POST['projectId'];

            echo $dateOfInitiation;
            echo $estimatedDateEnd;
            echo $userId;

            $con = mysqli_connect("localhost","web2","web2","mispms");

				if(mysqli_connect_errno()){
					echo 'connection error.<br>';
					echo mysqli_connect_error();
				}
				else{
          echo "database connected";
          
          $sql = "insert into dates(projectId, dateOfInitiation, estimatedDateEnd, dateOfUpdate, nameId) values('$projectId', '$dateOfInitiation', '$estimatedDateEnd', CURDATE(), '$userId')";
          $sql2 = 'update project SET dateOfInitiation = "'.$dateOfInitiation.'", estimatedDateEnd = "'.$estimatedDateEnd.'" WHERE projectId ="'.$projectId.'"';
            $qry=mysqli_query($con,$sql);
            $qry=mysqli_query($con,$sql2);
            echo $sql;
            return $qry;
            return $qry2;
        }
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
