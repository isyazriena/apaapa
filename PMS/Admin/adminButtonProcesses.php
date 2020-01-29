<?php
	session_start();
	include "newProjectPageAdmin.php";
	include "projectPageAdmin.php";
	include "logListPageAdmin.php";
	include "datePageAdmin.php";
	include "updateProjectPageAdmin.php";
	include "dashboardProjectPageAdmin.php";
	include "projectMembersAdmin.php";

	if(isset($_POST["addProjectButton"])){
		addNewProject();
		echo '<script type="text/javascript"> document.location="projectPageAdmin.php"; </script>';
	}
	else if(isset($_POST['deleteProjectButton'])){
		deleteProject();
		header('Location: projectPageAdmin.php');
	}
	else if(isset($_POST['deleteLogButton'])){
		deleteLog();
		echo '<script type="text/javascript"> document.location="logListPageAdmin.php"; </script>';
	}
	else if(isset($_POST['deleteDateButton'])){
		deleteDate();
		header('Location: datePageAdmin.php');
	}
	else if(isset($_POST['updateProjectButton'])){
		updateProject();
		header('Location: dashboardProjectPageAdmin.php');
	}
	else if(isset($_POST['viewMembersButton'])){
		displayMembersList();
		//header('Location: projectMembersAdmin.php');
		echo '<script type="text/javascript"> document.location="projectMembersAdmin.php"; </script>';
	}
	else if(isset($_POST['deleteUserButton'])){
		deleteUser();
		echo '<script type="text/javascript"> document.location="projectMembersAdmin.php"; </script>';
	}
	else if(isset($_POST['editMembersButton'])){
		editAssignedUser();
		echo '<script type="text/javascript"> document.location="projectMembersAdmin.php"; </script>';
	}
?>
