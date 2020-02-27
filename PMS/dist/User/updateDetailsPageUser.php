<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB User</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="projectPageUser.php"><img src='logosahaja2.png' style="width:63px; float:left;"><h5>Project Monitoring System</h5><h6 style="font-family: sans-serif;">Management Information System</h6></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <div style="color:#ffffff">
                        <?php
                            session_start();
                            echo "Hello, " .$_SESSION['userId'];
                        ?>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="editAccountUser.php">Edit Account</a>
                        <a class="dropdown-item" href="logoutPageUser.php">Logout</a>
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
                            <a class="nav-link" href="differentDestinationPageUser2.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Back</a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"></a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            echo $_SESSION['userId'];
                            $getOldData = getOldData();

                            function getOldData(){
                                $con = mysqli_connect('localhost','web2','web2','mispms');
                                if (mysqli_connect_errno())     //check connection is establish
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit;   //terminate the script
                                }
                                $projectId=$_SESSION['projectToView'];
                                $sql5="select * from log inner join projectlog on log.logId=projectlog.logId and projectlog.projectId='".$projectId."' order by log.logId desc limit 1";
                                $qry = mysqli_query($con,$sql5);
                                return $qry;
                            }

                            $row=mysqli_fetch_assoc(getOldData());

                            function passValueStatus($value) {

                                $row=mysqli_fetch_assoc(getOldData());
                                if ($row['projectStatusValue'] == $value){
                                    return 'checked="true"';
                                } 
                                else 
                                return '';
                            }

                            function passValueCategory($value) {

                                $row=mysqli_fetch_assoc(getOldData());
                                if ($row['projectCategoryValue'] == $value){
                                    return 'checked="true"';
                                } 
                                else 
                                return '';
                            }

                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">Enter Update on Project Log:</h1><br>                        
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                <form action='userButtonProcesses.php' method='post'>

                                    Remarks:
                                    <input type="text" name="remarks"><br><br>

                                    Category: <br>
                                    <input  type="radio" name="category" <?php echo passValueCategory(2); if (isset($category) && $category=="running") echo "checked";?> value="running">Running <br>
                                    <input  type="radio" name="category" <?php echo passValueCategory(3); if (isset($category) && $category=="completed") echo "checked";?> value="completed">Completed <br>
                                    <input  type="radio" name="category" <?php echo passValueCategory(4); if (isset($category) && $category=="terminated") echo "checked";?> value="terminated">Terminated <br><br>

                                    Status: <br>
                                    <input  type="radio" name="status" value="seacapp" <?php echo passValueStatus(1); if (isset($status) && $status=="seacapp") echo "checked";?> >SEAC Approve <br>
                                    <input  type="radio" name="status" value="ur" <?php echo passValueStatus(2); if (isset($status) && $status=="ur") echo "checked";?> >User Requirement <br>
                                    <input  type="radio" name="status" value="dev" <?php echo passValueStatus(3); if (isset($status) && $status=="dev") echo "checked";?> >Development <br>
                                    <input  type="radio" name="status" value="uat" <?php echo passValueStatus(4); if (isset($status) && $status=="uat") echo "checked";?> >UAT <br>
                                    <input  type="radio" name="status" value="sit" <?php echo passValueStatus(5); if (isset($status) && $status=="sit") echo "checked";?> >SIT <br>
                                    <input  type="radio" name="status" value="dep" <?php echo passValueStatus(6); if (isset($status) && $status=="dep") echo "checked";?> >Deployment <br><br>

                                    Attachment:
                                    <input type="file" name="myfile"/><br><br>

                                    <?php
                                        $projectId=$_SESSION['projectToView'];;
                                        echo "<input type='submit' value='Done' name='updateDetailsButton'>";
                                        echo "<input type='hidden' value='$projectId' name='projectId'>";
                                    ?>
                                    </form>
                                </div>
                        </div>
                    </div>
                </main>
                <?php
			
                    function updateDetails(){
                        $remarks=$_POST['remarks'];
                        $category=$_POST['category'];
                        $projectCategoryValue = '0';
                        $status=$_POST['status'];
                        $projectStatusValue = '0';
                        $userId = $_SESSION['userId'];

                        if($category == 'running'){
                            $projectCategoryValue = '2';
                        }
                        else if($category == 'completed'){			
                            $projectCategoryValue = '3';
                        }
                        else{
                            $projectCategoryValue ='4';
                        }

                        if($status == 'seacapp'){
                            $projectStatusValue = '1';
                        }
                        else if($status == 'ur'){
                            $projectStatusValue = '2';
                        }
                        else if($status == 'dev'){
                            $projectStatusValue = '3';
                        }
                        else if($status == 'uat'){
                            $projectStatusValue = '4';
                        }
                        else if($status == 'sit'){
                            $projectStatusValue = '5';
                        }
                        else{
                            $projectStatusValue = '6';
                        }

                        $con = mysqli_connect("localhost","web2","web2","mispms");

                        if(mysqli_connect_errno()){
                            echo 'connection error.<br>';
                            echo mysqli_connect_error();
                        }
                        else{
                            echo "database connected";
                            $projectId=$_SESSION['projectToView'];;

                            $row=mysqli_fetch_assoc(getOldData());

                            $sql= 'update project SET projectCategory = "'.$category.'", projectCategoryValue = "'.$projectCategoryValue.'", projectStatus = "'.$status.'", projectStatusValue = "'.$projectStatusValue.'"
                                WHERE projectId ="'.$projectId.'"';
                            $sql1= "insert into log(remarks, projectCategory, projectCategoryValue, dateOfUpdate, projectStatus, projectStatusValue, nameId)
                                values ('$remarks', '$category', '$projectCategoryValue', CURDATE(), '$status', '$projectStatusValue', '$userId')";
                            
                            echo $sql;
                            echo $sql1;
                            
                            $qry=mysqli_query($con,$sql);//execute qry

                            if($con->query($sql1)==TRUE){
                                $projectId=$_SESSION['projectToView'];;
                                $last_id = $con->insert_id; //logId
                                $userId = $_SESSION['userId'];
                                $dbh = new PDO("mysql:host=localhost;dbname=mispms", "web2", "web2");
                                $name = $_FILES['myfile']['name'];
                                $type = $_FILES['myfile']['type'];
                                $data = file_get_contents($_FILES['myfile']['tmp_name']);
                                $stmt = $dbh->prepare("insert into attachmentlog values('',?,?,?, '$last_id')");
                                $stmt->bindParam(1,$name);
                                $stmt->bindParam(2,$type);
                                $stmt->bindParam(3,$data);
                                if($data != null){
                                    $stmt->execute();
                                }
                                $sql2 = "insert into projectlog(projectId, logId) values('$projectId', '$last_id')";
                                $qry=mysqli_query($con,$sql2);								
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
