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
			<div class="content">
				<div class="container">
					<h1>
						User Administration Page
					</h1>
					<hr>
					<p>
						Use this page for user administrations, options below:
					</p>
					<div class="admin">
						<ul class="admin">
							<li><a href="addUser.php">Add User</a></li><br><br>
							<li><a href="userStatus.php">Change User Status</a></li><br><br>
							<li><a href="userProfile.php">Change User Profile</a></li><br><br>
							<hr>
							<li><a href="addAttributes.php">Add Resource Attributes</a></li><br><br>
							<li><a href="deleteAttributes.php">Delete Resource Attributes</a></li><br><br>
							<hr>
							<li><a href="addHelp.php">Add Help Topic</a></li><br><br>
							<li><a href="deleteHelp.php">Delete Help Topic</a></li><br><br>
							<li><a href="modifyHelp.php">Modify Help Topic</a></li>
						</ul>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
