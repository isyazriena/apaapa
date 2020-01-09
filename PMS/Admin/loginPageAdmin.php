<html>
    <img style='' src='logopenuh.png'><br>

    <h1>Project Monitoring System</h1><br><br>

    *ada css container*<br><br>

    Admin Login<br><br>

    <hr><br>

    <form action='adminValidatePassword.php' method='post'>
        ID:
        <input type='text' name='adminId'><br><br>

        Password:
        <input type='password' name='adminPassword'><br><br>

        <input type='submit' value='Login'><br><br>
    </form>

    <form action='' method=''>
        <input type='submit' value='User Login'>
    </form><br><br>

    *tutup container*<br><br>

    <form action='' method='post'>
        <input type='submit' value='Admin Manual'>
    </form><br><br>

    <form action='' method='post'>
        <input type='submit' value='PhpMyAdmin Manual'>
    </form><br><br>

    <?php
        session_start();
    ?>
</html>