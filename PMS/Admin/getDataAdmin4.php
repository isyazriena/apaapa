<?php
    session_start();
    function getNameMembersOthers(){

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        else {
            $projectToView=$_SESSION['projectToView'];
            $sql="with base1 as (select a.userId,a.userName,b.projectId,b.position from user A left outer join assigned B on a.userId = b.userId ) , base2 as (select userID,projectId,userName, (case when projectId is null then '0' when projectId != '".$projectToView."' then '1' when projectId = '".$projectToView."' then '2' else 'na' end ) as remark from base1 group by userId,projectId) select * from base2 where remark <> 2";
            $qry = mysqli_query($con,$sql);
            return $qry;
        }
    }
    //cannot run this one
?>