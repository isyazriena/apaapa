<?php
    function getNameMembers(){
        //$name = $_POST['members'];
        //$value = $name;

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        else {
            echo "database connected";
            $sql="select * from user"; 
            $qry = mysqli_query($con,$sql);
            return $qry;
        }
    }
?>