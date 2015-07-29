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
					<div class="form-style">
						<h1>Delete Resource Attributes</h1>
						<form action="deleteAttributes_submitted.php" method="post">
							<select name="select">
								<option id="1">Brand</option>
								<option id="2">Resource Type</option>
								<option id="3">Model</option>
								<option id="4">Location</option>
							</select><br>
							<input type="text" name="value" required="required"/>
							<!--ERROR MESSAGE-->
							<div class="form-link">
								<?php
									if (isset($_GET['emptyfield'])) {
										echo "<div id='error'>You must not leave this field empty!</div>";
									} else if (isset($_GET['notexist'])) {
										echo "<div id='error'>The value entered does not exist!</div>";
									} else if (isset($_GET['used'])) {
										echo "<div id='error'>The value entered is being used and cannot be deleted!</div>";
									}

								?>
							</div>
							<input type="submit" value="DELETE" />
						</form>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
