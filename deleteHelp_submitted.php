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
						<?php
							
							if (isset($_POST['helpSubject'])) {
							
								include_once ("dbc.php");
								
								$helpSubject=$_POST['helpSubject'];
								
								$getHelpID = mysql_query ("SELECT help_id FROM help WHERE help_subject = \"$helpSubject\"");
								$helpID = mysql_result ($getHelpID,0);
								
								$deleteHelpTopic = mysql_query ("DELETE FROM help WHERE help_id = \"$helpID\"");
								
								if ($deleteHelpTopic) {
								
									echo "<h1>Topic Deleted</h1>";
								
								} else {
								
									echo mysql_error();
								
								}
							
							}
																									    		
			    		?>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>