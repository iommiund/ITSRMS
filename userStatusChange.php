<?php
	include_once ("topSection.php");
?>
<?php
	if (empty($_SESSION['username'])) {
	
		header ('location: index.php?nologin');
		die();
		exit();

	}	
?>
<?php
//SUPER USER VALIDATION - STANDARD USERS ARE REDIRECTED TO MAIN.PHP
	$username=$_SESSION['username'];
	
	include_once ("dbc.php");	

	$get=mysql_query ("SELECT user_type_id FROM users WHERE USERNAME = \"$username\"");
	
	$result=mysql_result($get,0);
						
		if ($result != 1) {
			header ('location: main.php');
			die();
			exit();  					
		}
?>
<?php

	if (isset($_POST['user'], $_POST['status'])) {
	
		$user=$_POST['user'];
		$newStatus=$_POST['status'];
		
		//GET THE EXISTING STATUS TO VERIFY THAT STATUS WAS CHANGED
		$getCurrentStatus = mysql_query ("SELECT us.user_status FROM users u LEFT JOIN user_statuses us ON u.user_status_id = us.user_status_id WHERE u.username = \"$user\"");
		$currentStatus = mysql_result ($getCurrentStatus,0);
	
		if ($newStatus == $currentStatus) {
				
			//IF THE STATUS IS THE SAME, DISPLAY AN ERROR MESSAGE
			header ('location: userStatus.php?error');
			die();
			exit();
			
		} else if ($newStatus !== $currentStatus) {
			
			//GET THE STATUS ID TO UPDATE THE USERS TABLE
			$getStatusID = mysql_query ("SELECT user_status_id FROM user_statuses WHERE user_status = \"$newStatus\"");
			$statusID = mysql_result ($getStatusID,0);
			
			//UPDATE USERS TABLE
			$updateStatus = mysql_query ("UPDATE users SET user_status_id = \"$statusID\" WHERE username = \"$user\"");
			
			if ($updateStatus) {
			
				header ('location: userStatus.php?success');
				die();
				exit();
			
			} else {
			
				mysql_error();
				die();
				
			}
				
		}
	}
	
?>
<?php
	include_once ("bottomSection.php");
?>