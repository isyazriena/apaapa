<html>
<?php
        session_start();
        session_destroy();
    ?>
<title>(logged out)</title>
    <form action='loginPageUser.php' method='post'>
        <h1>You are logged out<h1>
        <p>Login Again</p>
        <input type='submit' value='Login'>
    </form>

    
</html>