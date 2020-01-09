<?php
    session_start();
    function getList() {
        $status = $_POST['projects'];
        $value = $status;

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        if ($status == '0' || $status == null) {
            $sql="select * from project";
        }
        else if ($status == '1'){
            $sql = "SELECT assigned.*, project.* from assigned where userId = '".$_SESSION['userId'] ."' JOIN project ON assigned.projectId =";
        }
        else {
            $sql="select * from project where projectCategoryValue = '".$status."'"; 
        }
        $qry = mysqli_query($con,$sql);
        return $qry;
    }
?>