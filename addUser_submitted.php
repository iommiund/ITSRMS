<?php
	include_once ("topSection.php");
?>
<?php
	//IF THE SESSION USERNAME IS EMPTY, REDIRECT TO LOGIN SCREEN
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
		}
?>
			<div class="content">
				<div class="container">
					<div class="form-style">
						<?php
								if (empty($_POST['name'])){
								
									header ('location: addUser.php?emptyfield');
									die();
									exit();

								} else if (empty($_POST['surname'])){
									
									header ('location: addUser.php?emptyfield');
									die();
									exit();

								} else if (empty($_POST['email'])){
									
									header ('location: addUser.php?emptyfield');
									die();
									exit();
									
								}else if (empty($_POST['username'])){
									
									header ('location: addUser.php?emptyfield');
									die();
									exit();

								} else if (empty($_POST['password'])){
									
									header ('location: addUser.php?emptyfield');
									die();
									exit();

								} else {
																
									//SETTING VARIABLES
									$name=$_POST['name'];
									$surname=$_POST['surname'];
									$email=$_POST['email'];
									$aUsername=$_POST['username'];
									$password=md5($_POST['password']);
									//CONNECT TO DATABASE
									include_once ("dbc.php");
									
									//CHECK IF USERNAME ALREADY EXISTS
									$getUserCount = mysql_query ("select count(*) from users where username = \"$aUsername\"");
									$userCount = mysql_result ($getUserCount,0);
									
									if ($userCount != 0) {
									
										header ('location: addUser.php?uExists');
										die();
										exit();
									
									}
									
									//CHECK IF EMAIL ALREADY EXISTS
									$getEmailCount = mysql_query ("select count(*) from users where email = \"$email\"");
									$emailCount = mysql_result ($getEmailCount,0);
									
									if ($emailCount != 0) {
									
										header ('location: addUser.php?eExists');
										die();
										exit();
									
									}									
									
					    			//INSERT DATA INTO TABLE        					
					    			$insert = "insert into users (user_name, user_surname, email, username, user_password) values 
					    						( \"$name\", \"$surname\", \"$email\", \"$aUsername\", \"$password\")";
					    			$ret = mysql_query ($insert, $conn);
					    			
					    			if ($ret) {
					    				echo "<h1><b>". $name ."</b> has been aded as a <b>Standard User</b></h1>";
					    			}
					    			else {
					    				echo "<h1>Something Went Wrong: " .mysql_error(); + "</h1>";
					    			}
					    		
					    		}
			    		?>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>