<html lang="en">
    <head>
        <title>MIS - Project Monitoring System</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="csslogin/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="csslogin/css/main.css">
<!--===============================================================================================-->
    </head>

    <div style="text-align:center">
        <img src='logopenuh.png'><br>
        <h2>Project Monitoring System</h2><br>
    </div>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('csslogin/images/bg-01.jpg');">
            <div>
                <div class="wrap-login100 p-t-30 p-b-50">
                    <span class="login100-form-title p-b-41">
                        Admin Login
                    </span>

                    <form class="login100-form validate-form p-b-33 p-t-5" action='adminValidatePassword.php' method='post'>
                        
                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="text" name="adminId" placeholder="User name">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="adminPassword" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>
                    <div class="container-login100-form-btn m-t-32">
                        <input class="login100-form-btn" type='submit' value='Login'><br><br>
                    </div>
                    </form>

                    <div style="text-align:center">
                        <br><a href="../User/loginPageUser.php">User Login</a>

                        <br><a href="">Admin Manual</a> | 

                        <a href="">PhpMyAdmin Manual</a>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <!--===============================================================================================-->
	<script src="csslogin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/bootstrap/js/popper.js"></script>
	<script src="csslogin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/daterangepicker/moment.min.js"></script>
	<script src="csslogin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/js/main.js"></script>

    <?php
        session_start();
    ?>
</html>