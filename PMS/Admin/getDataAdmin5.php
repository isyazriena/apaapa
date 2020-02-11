<?php
    session_start();
    function getList1() {
        $month = $_POST['month'];
        $projectId = $_POST['projectId'];
        $value = $month;

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        
        if ($month == '0' || $month == null){
            $sql="select * from project";
        }
        else{
            $sql = "with base1 as 
            (select a.logId,b.projectId,b.lastUpdate 
            from log a,
            (SELECT project.projectId,max(log.dateOfUpdate)lastUpdate
            from project,log,projectlog
            where log.logId = projectlog.logId
            and project.projectId = projectlog.projectId
            group by project.projectId)b, projectlog c
            where a.logId = c.logId
            and b.projectId = c.projectId
            and a.dateOfUpdate = b.lastUpdate)
            select projectId from base1";
        }
        $qry = mysqli_query($con,$sql);
        return $qry;
    }
    
?>
