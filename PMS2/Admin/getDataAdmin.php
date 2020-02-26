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
            $sql="select * from project"; //all projects
        }
        else if ($status == '1'){
            $sql = "SELECT * FROM project INNER JOIN created ON created.adminId='".$_SESSION['adminId'] ."' AND created.projectId=project.projectId"; //projects for the creator logged in
        }
        else { 
            $sql="select * from project where projectCategoryValue = '".$status."'"; //running or terminated projects
        }
        $qry = mysqli_query($con,$sql);
        return $qry;
    }
    
?>
