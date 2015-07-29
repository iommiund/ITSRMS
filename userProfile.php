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
			die();
			exit();

		}
?>
			<div class="content">
				<div class="container">
					<div class="form-style">
						<h1>Change User Profile</h1>
	
						<form action="userTypeChange.php" method="post">
							<label>User:</label> 
							<select name="user">
								<?php
									
									//GET LIST BRANDS.PHP PAGE
									include_once ("users.php");
								?>
							</select>
							<label>New Profile:</label> 
							<select name="profile">
								<?php
												
									//GET LIST RESOURCE_TYPES.PHP PAGE
									include_once ("user_types.php");
								?>
							</select>
							<input type="submit" value="CHANGE PROFILE" />
						</form>
						<br>
						<!--ERROR MESSAGES-->
						<div class="form-link">
							<?php
								if (isset($_GET['error'])) {
									echo "<div id='error'>The user already has this Profile!</div>";
								} else if (isset($_GET['success'])) {
									echo "<div id='success'>Profile Changed!</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
