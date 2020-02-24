<?php
    session_start();
    //include 'projectMembersAdmin.php';

    class User {
        function User($name, $id) {
            $this->name = $name;
            $this->id = $id;
        }
    }

    function getNameMembersOthers(){

        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        else {
            
                $projectMembers2 = function() {
                    // $list = displayMembersList();
                    while($row = mysqli_fetch_array(displayMembersList())) {
                        $user = new User(null, $row['userId']);
                        $output[] = $user;
                    }

                    return $output;
                };
                
                $getAllUsers = getAllUser();
                $memberss = array();
       
                for($i=0; $i<=count($projectMembers2); $i++) {
                  $u = $projectMembers2[$i]->id;
                  $index = array_search($u, $getAllUsers);
                  if ($index === -1) $memberss.array_push($projectMembers2[$i]);
                }
              
            /* $projectToView=$_SESSION['projectToView'];
            $sql="with base1 as (select a.userId,a.userName,b.projectId,b.position from user A left outer join assigned B on a.userId = b.userId ) , base2 as (select userID,projectId,userName, (case when projectId is null then '0' when projectId != '".$projectToView."' then '1' when projectId = '".$projectToView."' then '2' else 'na' end ) as remark from base1 group by userId,projectId) select * from base2 where remark <> 2";
            $qry = mysqli_query($con,$sql);
            return $qry; */
        }
    }
    function getAllUser(){
        $con = mysqli_connect('localhost','web2','web2','mispms');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
        else {
            $sql = "select * from user";
            $qry = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($qry)){
                // $output = {$this->id=$row['userId'], $this->name=$row['userName']};
                $user = new User($row['userName'], $row['userId']);
                $output[] = $user;
            }
            return $output;
        }
    }
    //cannot run this one
?>