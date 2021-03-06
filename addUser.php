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
						<h1>Add a New User</h1>
	
						<form action="addUser_submitted.php" method="post">
							<input type="text" name="name" placeholder="Name" required="required"/>
							<input type="text" name="surname" placeholder="Surname" required="required"/>
							<input type="email" name="email" placeholder="Email" required="required"/>
							<input type="text" name="username" placeholder="Username" required="required"/>
							<input type="password" name="password" placeholder="Password" required="required" min="4"/>
							<input type="submit" value="REGISTER" />
						</form>
						<br>
						<div class="form-link">
						<?php
							if (isset($_GET['emptyfield'])) {
								echo "<div id='error'>One or more fields were empty, try again!</div>";
							} else if (isset($_GET['uExists'])) {
								echo "<div id='error'>A user with this username already exists</div>";
							} else if (isset($_GET['eExists'])) {
								echo "<div id='error'>A user with this email already exists</div>";
							}
						?>
						</div>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
