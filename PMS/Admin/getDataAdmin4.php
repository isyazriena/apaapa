<?php
function getNameMembersOthers(){
        //$name = $_POST['members'];
        //$value = $name;

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        else {
            $projectToView=$_SESSION['projectToView'];
            $sql="SELECT * FROM user INNER JOIN assigned ON NOT assigned.userId=user.userId AND not assigned.projectId='".$projectToView."'";
            $qry = mysqli_query($con,$sql);
            return $qry;
        }
    }
?>