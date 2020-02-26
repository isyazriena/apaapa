<?php
    //session_start();
    function getNameMembers(){

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        else {
            $sql="select * from user"; 
            $qry = mysqli_query($con,$sql);
            return $qry;
        }
    }
?>