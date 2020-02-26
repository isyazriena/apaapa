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
                                Back</a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"></a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            echo $_SESSION['adminId'];
                            include 'getDataAdmin2.php';
                            include 'getDataAdmin3.php';
                            $adminId = $_SESSION['adminId'];

                            function addNewProject(){
                                $projectName=$_POST['projectName'];
                                $reportOwner=$_POST['reportOwner'];
                                $systemCustodian=$_POST['systemCustodian'];
                                $dateOfInitiation=$_POST['dateOfInitiation'];
                                $estimatedDateEnd=$_POST['estimatedDateEnd'];
                                $projectDescription=$_POST['projectDescription'];
                                $personInCharge=$_POST['pic'];
                                $members=$_POST['members'];
                                $adminId = $_SESSION['adminId'];

                                //1.create connection
                                $con = mysqli_connect("localhost","web2","web2","mispms");
                                if(mysqli_connect_errno()){
                                    echo 'connection error.<br>';
                                    echo mysqli_connect_error();
                                }
                                else{
                                    echo "database connected";

                                    $sql= "insert into project(projectName,reportOwner,systemCustodian,dateOfInitiation,estimatedDateEnd,projectDescription,personInCharge, projectStatus, projectStatusValue, projectCategory, projectCategoryValue)
                                        values('$projectName','$reportOwner','$systemCustodian','$dateOfInitiation','$estimatedDateEnd','$projectDescription',
                                        '$personInCharge', 'seacapp', '1', 'running', '2')";
                                    $sql1= "insert into log(remarks, projectStatus, projectStatusValue, projectCategory, projectCategoryValue, dateOfUpdate, nameId)
                                        values ('project first created by admin', 'seacapp', '1', 'running', '2', CURDATE(), '$adminId')";

                                    echo $sql;
                                    echo $sql1;

                                    if($con->query($sql)==TRUE){
                                        $adminId = $_SESSION['adminId'];
                                        $last_id = $con->insert_id; //projectId
                                        $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
                                        $name = $_FILES['myfile']['name'];
                                        $type = $_FILES['myfile']['type'];
                                        $data = file_get_contents($_FILES['myfile']['tmp_name']);
                                        $stmt = $dbh->prepare("insert into attachmentproject values('',?,?,?, '$last_id')");
                                        $stmt->bindParam(1,$name);
                                        $stmt->bindParam(2,$type);
                                        $stmt->bindParam(3,$data);
                                        if($data != null){
                                            $stmt->execute();
                                        }
                                        $sql3= "insert into created(adminId, projectId) values ('$adminId', '$last_id')";
                                        $sql5= "INSERT INTO assigned(projectId, userId, position) VALUES('$last_id','$personInCharge', 'person in charge')";
                                        $qry = mysqli_query($con,$sql3);
                                        $qry = mysqli_query($con,$sql5);
                                        foreach ($_POST['members'] as $key=>$value) {
                                            $sqlmembers = "INSERT INTO assigned(projectId, userId, position) VALUES('$last_id','$value', 'members')";
                                            $con->multi_query($sqlmembers);
                                        }
                                    }
                                    else{
                                        echo "Error: " .$sql. "<br>" .$con->error;
                                    }
                                    if($con->query($sql1)==TRUE){
                                        $adminId = $_SESSION['adminId'];
                                        $last_id2 = $con->insert_id; //logId
                                        $sql2 = "insert into projectlog(projectId, logId) values('$last_id', '$last_id2')";
                                        $sql4= "insert into dates(projectId, dateOfInitiation, estimatedDateEnd, dateOfUpdate, nameId) 
                                        values('$last_id', '$dateOfInitiation', '$estimatedDateEnd', CURDATE(), '$adminId')";
                                        $qry = mysqli_query($con,$sql2);
                                        $qry = mysqli_query($con,$sql4);
                                    }
                                    else{
                                        echo "Error: " .$sql. "<br>" .$con->error;
                                    }
                                }
                            }
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">Enter New Project Details:</h1><br>                        
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form action='adminButtonProcesses.php' method='post' enctype='multipart/form-data'>

                                        Project Name:
                                        <input type='text' name='projectName' required><br><br>

                                        Report Owner:
                                        <input type='text' name='reportOwner' required><br><br>

                                        System Custodian:
                                        <input type='text' name='systemCustodian' required><br><br>

                                        Date of Initiation:
                                        <input type='date' name='dateOfInitiation' required><br><br>

                                        Estimated Date End:
                                        <input type='date' name='estimatedDateEnd' required><br><br>

                                        Project Description:
                                        <input type='longtext' name='projectDescription'><br><br>

                                        Person In Charge:
                                        <div>
                                            <select name="pic" id="pic" required>
                                                <?php 
                                                    $list = getNamePic();
                                                    while ($row = mysqli_fetch_assoc($list)){
                                                        echo '<option value="'.$row['userId'].'">'.$row['userName'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div><br>

                                        Members:
                                        <?php $list = getNameMembers(); ?>
                                        <button type="button" id="buttonAdd">Add</button>
                                        <div id="list" required>
                                            <?php
                                                echo "<select name='members[]' id='members1' style='display:block;' required>";						
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

                                        Attachment:
                                        <input type="file" name="myfile"/><br><br>
                                        <input type='submit' value='Done' name='addProjectButton'>
                                    </form>
                                </div>
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
