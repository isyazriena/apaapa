<html>
<head>
        <style>
            .container{
            background-color: lightgrey;
            /* width: 300px; */
            border: 3px solid green;
            padding: 50px;
            margin: 50px;
            }
        </style>
    </head>
    <div style="text-align:center">
    <img style='' src='logopenuh.png'><br>
    <h1>Project Monitoring System</h1><br><br>
    </div>

    <div class="container">
  <div style="text-align:center">

    User Login<br><br>
    
    <hr><br>

    <form action='userValidatePassword.php' method='post'>
        User Id:
        <input type='text' name='userId'><br><br>

        Password:
        <input type='password' name='userPassword'><br><br>
        <input type='submit' value='Login'><br><br>
    </form>
    
    <!-- <form action='' method=''>
        <input type='submit' value='Admin Login'>
    </form><br><br> -->
    <a href="../Admin/loginPageAdmin.php">Admin Login</a>

    </div>
        </div>

        <div style="text-align:center">
    <form action='' method='post'>
        <input type='submit' value='User Manual'>
    </form><br><br>
    </div>
    
    <?php
    session_start();
    ?>
</html>