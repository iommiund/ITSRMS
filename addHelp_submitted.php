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
								if (empty($_POST['subject'])){
								
									header ('location: addHelp.php?emptyfield');
									die();
									exit();

								} else if (empty($_POST['helpContent'])){
								
									header ('location: addHelp.php?emptyfield');
									die();
									exit();

								} else {
																
									include_once ("dbc.php");
									
									$subject=$_POST['subject'];
									$helpContent=$_POST['helpContent'];
									$helpLevel=$_POST['helpLevel'];
									
									$addHelpTopic = mysql_query ("INSERT INTO help (`help_subject`, `help_content`, `help_level_id`) VALUES (\"$subject\", \"$helpContent\", (select HL.help_level_id ID FROM help_levels HL WHERE HL.help_level = \"$helpLevel\"))");
									
									if ($addHelpTopic) {
									
										echo "<h1>New Help Topic Added</h1>";
									
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