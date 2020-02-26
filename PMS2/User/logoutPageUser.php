<html>
    <form action='loginPageUser.php' method='post'>
        <h1>You are logged out<h1>
        <p>Login Again</p>
        <input type='submit' value='Login'>
    </form>

    <?php
        session_unset();
        session_destroy();
    ?>
</html>