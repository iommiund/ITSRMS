<?php
	include_once ("topSection.php");
?>
<?php

	//print variables being inserted into database table
	//echo "<pre>";
	//print_r($_POST);
	
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

	} else {
	
		header ('location: resetPassword.php?emptyfield');
		die();
		exit();
	
	}
			
?>
<?php
	include_once ("bottomSection.php");
?>