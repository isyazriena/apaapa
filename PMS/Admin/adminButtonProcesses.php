<?php
	session_start();
	include "newProjectPageAdmin.php";
	include "projectPageAdmin.php";
	include "logListPageAdmin.php";
	include "datePageAdmin.php";
	include "updateProjectPageAdmin.php";
	include "dashboardProjectPageAdmin.php";
	//include "projectMembersAdmin.php";

	if(isset($_POST["addProjectButton"])){
		addNewProject(); //call function kept in newProjectPageAdmin when button clicked
		echo '<script type="text/javascript"> document.location="projectPageAdmin.php"; </script>';
	}
	else if(isset($_POST['deleteProjectButton'])){ //from projectPageAdmin
		deleteProject(); //call function kept in ProjectPageAdmin when button clicked
		echo '<script type="text/javascript"> document.location="projectPageAdmin.php"; </script>';
	}
	else if(isset($_POST['deleteLogButton'])){ //from logListPageAdmin
		deleteLog(); //call function kept in logListPageAdmin when button clicked
		echo '<script type="text/javascript"> document.location="logListPageAdmin.php"; </script>';
		$_SESSION['projectToView']=$_POST['projectToView'];
	}
	else if(isset($_POST['deleteDateButton'])){
		deleteDate(); //call function kept in datePageAdmin when button clicked
		echo '<script type="text/javascript"> document.location="datePageAdmin.php"; </script>';
		$_SESSION['projectToView']=$_POST['projectToView'];
	}
	else if(isset($_POST['updateProjectButton'])){
		updateProject(); //call function kept in updateProjectPageAdmin when button clicked
		echo '<script type="text/javascript"> document.location="dashboardProjectPageAdmin.php"; </script>';
	}
	/* else if(isset($_POST['viewMembersButton'])){
		displayMembersList(); //call function kept in dashboardProjectPageAdmin when button clicked
		//echo '<script type="text/javascript"> document.location="projectMembersAdmin.php"; </script>';
	} */
	else if(isset($_POST['deleteUserButton'])){
		deleteUser(); //call function kept in projectMembersAdmin when button clicked
		echo '<script type="text/javascript"> document.location="projectMembersAdmin.php"; </script>';
	}
	else if(isset($_POST['editMembersButton'])){
		editAssignedUser(); //call function kept in projectMembersAdmin when button clicked
		echo '<script type="text/javascript"> document.location="projectMembersAdmin.php"; </script>';
	}
?>
