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
                            $getOldData = getOldData();
                            
                            function getOldData(){
                                $con = mysqli_connect('localhost','web2','web2','mispms');
                                if (mysqli_connect_errno())     //check connection is establish
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit;   //terminate the script
                                }
                                $projectId=$_POST['projectId'];
                                $sql3="select * from project where projectId='".$projectId."'";
                                $qry = mysqli_query($con,$sql3);
                                return $qry;
                            }

                            function getOldDataAttachment(){
                                $con = mysqli_connect('localhost','web2','web2','mispms');
                                if (mysqli_connect_errno())     //check connection is establish
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit;   //terminate the script
                                }
                                $projectId=$_POST['projectId'];
                                $sql4="select * from attachmentproject where projectId='".$projectId."'";
                                $qry = mysqli_query($con,$sql4);
                                return $qry;
                            }
                            
                            function getFirstLog(){
                                $con = mysqli_connect('localhost','web2','web2','mispms');
                                if (mysqli_connect_errno())     //check connection is establish
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit;   //terminate the script
                                }
                                $projectId=$_POST['projectId'];
                                $sql5="select * from log a inner join projectlog b on a.logId=b.logId and b.projectId='".$projectId."' order by a.logId asc limit 1";
                                $qry = mysqli_query($con,$sql5);
                                return $qry;
                            }

                            $row=mysqli_fetch_assoc(getOldData());
                            $row2=mysqli_fetch_assoc(getOldDataAttachment());
                            $row3=mysqli_fetch_assoc(getFirstLog());

                            $_SESSION['logId']=$row3['logId'];
                            
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">Enter Update on Project Details:</h1><br>                        
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                <form action='adminButtonProcesses.php' method='post' enctype='multipart/form-data'>

                                    Project Name:
                                    <input type='text' name='projectName' value = "<?php echo $row['projectName']?>"><br><br>

                                    Report Owner:
                                    <input type='text' name='reportOwner' value = "<?php echo $row['reportOwner']?>"><br><br>

                                    System Custodian:
                                    <input type='text' name='systemCustodian' value = "<?php echo $row['systemCustodian']?>"><br><br>

                                    Project Description:<br>
                                    <textarea name='projectDescription' rows="4" cols="50"><?php echo $row['projectDescription']?></textarea><br><br>
                                    <!-- <input type='text' name='projectDescription' value = "<?php //echo $row['projectDescription']?>"><br><br> -->

                                    Attachment:
                                    <input type="file" name="myfile" value = "<?php echo $row2['attachmentName']?>"><br><br>
                                    <?php
                                        echo '<ol>';
                                        $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
                                        $projectId=$_POST['projectId'];
                                        $stat = $dbh->prepare('select * from attachmentproject where projectId ="'.$projectId.'"');
                                        $stat->execute();
                                        while($row = $stat->fetch()){
                                            echo "<li><a target='_blank' href='viewProjectAttachmentAdmin.php?attachmentId=".$row['attachmentId']."'>".$row['attachmentName']."</a></li>";
                                        }
                                        $projectId=$_POST['projectId'];
                                        echo '</ol>';
                                        echo "<input type='submit' value='Done' name='updateProjectButton'>";
                                        echo "<input type='hidden' value='$projectId' name='projectId'>";
                                    ?>
                                    </form>
                                </div>
                        </div>
                    </div>
                </main>
                <?php
                        $adminId = $_SESSION['adminId'];

                        function updateProject(){
                            $projectName=$_POST['projectName'];
                            $reportOwner=$_POST['reportOwner'];
                            $systemCustodian=$_POST['systemCustodian'];
                            $projectDescription=$_POST['projectDescription'];
                            $adminId = $_SESSION['adminId'];
                            $logId = $_SESSION['logId'];

                            //1.create connection
                            $con = mysqli_connect("localhost","web2","web2","mispms");
                            if(mysqli_connect_errno()){
                                echo 'connection error.<br>';
                                echo mysqli_connect_error();
                            }
                            else{
                                echo "database connected";
                                $projectId=$_POST['projectId'];

                                $sql= 'update project SET projectName = "'.$projectName.'", reportOwner = "'.$reportOwner.'", systemCustodian = "'.$systemCustodian.'", projectDescription = "'.$projectDescription.'"
                                    WHERE projectId ="'.$projectId.'"';

                                $qry = mysqli_query($con,$sql);
                                echo $sql;

                                $sql1= 'update log SET remarks = "admin updated project details", dateOfUpdate = CURDATE(), nameId = "'.$adminId.'"
                                WHERE logId ="'.$logId.'"'; //HERE CHECK BALIK

                                if($con->query($sql1)==TRUE){
                                    $projectId=$_POST['projectId'];
                                    $last_id2 = $con->insert_id; //logId
                                    $sql2 = "insert into projectlog(projectId, logId) values('$projectId', '$last_id2')";
                                    $qry = mysqli_query($con,$sql2);

                                    echo $sql1;
                                    echo $sql2;

                                }
                                else{
                                    echo "Error: " .$sql. "<br>" .$con->error;
                                }

                                $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
                                $name = $_FILES['myfile']['name'];
                                $type = $_FILES['myfile']['type'];
                                $data = file_get_contents($_FILES['myfile']['tmp_name']);
                                $stmt = $dbh->prepare("update attachmentproject SET attachmentName = ?, attachmentType = ?, attachmentData = ? where projectId ='".$projectId."'");
                                $stmt->bindParam(1,$name);
                                $stmt->bindParam(2,$type);
                                $stmt->bindParam(3,$data);
                                if($data != null){
                                    $stmt->execute();
                                    echo $stmt;
                                }
                                
                                else{
                                    echo "Error: " .$sql. "<br>" .$con->error;
                                }

                                
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
