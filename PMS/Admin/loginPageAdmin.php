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

    Admin Login<br><br>

    <hr><br>

    <form action='adminValidatePassword.php' method='post'>
        ID:
        <input type='text' name='adminId'><br><br>

        Password:
        <input type='password' name='adminPassword'><br><br>

        <input type='submit' value='Login'><br><br>
    </form>

    <!-- <form action='' method=''>
        <input type='submit' value='User Login'>
    </form><br><br> -->
    <a href="../User/loginPageUser.php">User Login</a>

    </div>
        </div>

        <div style="text-align:center">
    <form action='' method='post'>
        <input type='submit' value='Admin Manual'>
    </form>

    <form action='' method='post'>
        <input type='submit' value='PhpMyAdmin Manual'>
    </form><br><br>
        </div>

    <?php
        session_start();
    ?>
</html>