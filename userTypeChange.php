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
	
	if (isset($_POST['user'], $_POST['profile'])) {
	
		$user=$_POST['user'];
		$newType=$_POST['profile'];
		
		//GET THE EXISTING TYPE TO VERIFY THAT STATUS WAS CHANGED
		$getCurrentType = mysql_query ("SELECT ut.user_type FROM users u LEFT JOIN user_types ut ON u.user_type_id = ut.user_type_id WHERE u.username = \"$user\"");
		$currentType = mysql_result ($getCurrentType,0);
		
		//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>". $currentType;
	
		if ($newType == $currentType) {
			//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>". $currentType . "  |  " . $newType;	
			//IF THE TYPE IS THE SAME, DISPLAY AN ERROR MESSAGE
			header ('location: userProfile.php?error');
			die();
			exit();
			
		} else if ($newType !== $currentType) {
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>Not The Same";			
			//GET THE TYPE ID TO UPDATE THE USERS TABLE
			$getTypeID = mysql_query ("SELECT user_type_id FROM user_types WHERE user_type = \"$newType\"");
			$typeID = mysql_result ($getTypeID,0);
			
			//UPDATE USERS TABLE
			$updateType = mysql_query ("UPDATE users SET user_type_id = \"$typeID\" WHERE username = \"$user\"");
			
			if ($updateType) {
			
				header ('location: userProfile.php?success');
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