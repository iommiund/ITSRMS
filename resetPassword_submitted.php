<?php
	include_once ("topSection.php");
?>
<?php

	//print variables being inserted into database table
	//echo "<pre>";
	//print_r($_POST);
	
	//IF THE SESSION USERNAME IS EMPTY, REDIRECT TO LOGIN SCREEN
	if (empty($_SESSION['username'])){
	
		header ('location: index.php?nologin');
		die();
		exit();	
	
	} else	if (isset($_POST['oldPassword'], $_POST['newPassword'])) {
	
		//connection to database
		include_once ("dbc.php");
		
		//setting variables for user login
		$username=$_SESSION['username'];
		$oldPassword=md5($_POST['oldPassword']);
		$newPassword=md5($_POST['newPassword']);
		
		//Authenticate user before changing password
		$get=mysql_query ("select count(user_id) from users where username=\"$username\" and user_password=\"$oldPassword\"");
		$result=mysql_result($get,0);
							
			if ($result!=1) {
		  		
				header ('location: resetPassword.php?error');
				die();
				exit();
		  					
			} else {
		  		
				//VALIDATE IF THE SAME PASSWORD IS BEING USED
				$checkOldLikeNew = mysql_query ("select count(*) from users where username = \"$username\" and user_password = \"$newPassword\"");
				$oldLikeNew = mysql_result($checkOldLikeNew,0);
				
				if ($oldLikeNew > 0) {
				
					header ('location: resetPassword.php?oldLikeNew');
					die();
					exit();
				
				} else {
			
					//Query to change password
					$resetPassword = mysql_query ("update users set user_password = \"$newPassword\" where username = \"$username\" and user_password = \"$oldPassword\"");
					
						if ($resetPassword) {
							
							header ('location: index.php?resetPassword');
							session_destroy();
							die();
							exit();		
						
						} else {
						
							echo mysql_error();	
						
						}
				
				}
	  		
	  		}
		
	} else {
	
		header ('location: resetPassword.php?emptyfield');
		die();
		exit();
	
	}
			
?>
<?php
	include_once ("bottomSection.php");
?>