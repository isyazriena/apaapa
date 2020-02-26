<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB User</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary" style="height: 100%;">
        <div style="text-align:center; color:#ffffff;">
            <br><h2 style="font-family: 'Courier New', Courier, monospace"><b>Project Monitoring System</b></h2>
            <div style="text-align:center"><img src='logopenuh.jpg'></div>
        </div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">User Login</h3></div>
                                    <div class="card-body">
                                        <form action='userValidatePassword.php' method='post'>
                                            <div class="form-group">
                                                <label class="small mb-1">User ID:</label>
                                                <input class="form-control py-4" type="text" placeholder="Enter User Id" name="userId"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password:</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter Password" name="userPassword"/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="btn btn-primary" type='submit' value='Login'><br><br>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">
                                            <a href=../Admin/loginPageAdmin.php>Admin Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <br><br><br><footer class="py-4 bg-dark mt-auto">
                    <div class="container-fluid" style="padding-top:0.05rem;">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-white-50">Copyright &copy; Intan Syazriena 2020</div>
                            <div class="text-white-50">
                                <a class="text-white-50" href="#">User Manual</a>
                                &middot;
                                <a class="text-white-50" href="#">Sign Up</a>
                            </div>
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
