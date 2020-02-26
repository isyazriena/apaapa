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

    <form action='userButtonProcesses.php' method='post'>
        Sign Up:<br><br>
        <hr><br>

        Id:
        <input type='text' name='userId'><br><br>
        Password:
        <input type='password' name='userPassword'><br><br>
        Name:
        <input type='text' name='userName'><br><br>
        <input type='submit' name='addUser'>
    </form>

    </div>
    </div>
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
</html>