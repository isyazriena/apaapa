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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div style="text-align:center; color:#ffffff;">
            <br><h2 style="font-family: 'Courier New', Courier, monospace"><b>Project Monitoring System</b></h2>
            <div style="text-align:center"><img src='logopenuh.jpg'></div>
        </div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create User Account</h3></div>
                                    <div class="card-body">
                                        <form action='userButtonProcesses.php' method='post'>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">User Id</label>
                                                        <input class="form-control py-4" type="text" placeholder="Enter staff no" name="userId" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Name</label>
                                                        <input class="form-control py-4" type="text" placeholder="Enter name" name="userName"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" type="password" placeholder="Enter password" name="userPassword"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control py-4" type="password" placeholder="Confirm password" name="userPassword" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <input type='submit' name='addUser' class="btn btn-primary btn-block" value="Create Account">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="loginPageUser.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main><br><br><br>
            </div>
            <div id="layoutAuthentication_footer">
            <?php
                function addUser(){
                    $userId=$_POST['userId'];
                    $userPassword=$_POST['userPassword'];
                    $userName=$_POST['userName'];

                    //1.create connection
                    $con = mysqli_connect("localhost","web2","web2","mispms");
                    if(mysqli_connect_errno()){
                        echo 'connection error.<br>';
                        echo mysqli_connect_error();
                    }
                    else{
                        echo "database connected";
                        $sql= "insert into user(userId, userPassword, userName) values ('$userId', '$userPassword', '$userName')";
                        $qry = mysqli_query($con,$sql);
                        return $qry;
                    }
                }
            ?>
                <footer class="py-4 bg-dark mt-auto">
                    <div class="container-fluid" style="padding-top:0.05rem;">
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
    </body>
</html>
