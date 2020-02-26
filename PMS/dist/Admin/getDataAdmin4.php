<?php
    //session_start();
    function getNameMembersOthers(){

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        else {
            $projectToView=$_SESSION['projectToView'];
            $sql="select * from user where userId not in (select userId from assigned where projectId = '".$projectToView."')";
            $qry = mysqli_query($con,$sql);
            return $qry;
        }
    }
    //cannot run this one
?>