<html>
    <img src='logopenuh.png'><br>

    Project Monitoring System<br><br>

    *ada css container*<br><br>

    User Login<br><br>
    
    <hr><br>

    <form action='userValidatePassword.php' method='post'>
        User Id:
        <input type='text' name='userId'><br><br>

        Password:
        <input type='password' name='userPassword'><br><br>
        <input type='hidden' name='' value=''> <!--stopped here-->
        <input type='submit' value='Login'><br><br>
    </form>
    
    <form action='' method=''>
        <input type='submit' value='Admin Login'> <!--ni belum settle-->
    </form><br><br>

    *tutup container*<br><br>

    <form action='' method='post'>
        <input type='submit' value='User Manual'>
    </form><br><br>
    
    <?php
    session_start();
    ?>
</html>