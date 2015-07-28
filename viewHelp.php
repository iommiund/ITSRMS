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
			<div class="content">
				<div class="container">
					<?php
					 
						$id=$_GET['id'];
						$username=$_SESSION['username'];
						
						//SUPER USER VALIDATION - STANDARD USERS VIEW HELP TOPICS CLASSIFIED AS NORMAL
							include_once ("dbc.php");	
							
							//GET THE USER TYPE ID TO DETERMINE WHETHER THE USER IS A STANDARD USER
							$getUserTypeID = mysql_query ("SELECT user_type_id FROM users WHERE USERNAME = \"$username\"");
							$result = mysql_result ($getUserTypeID,0);
							
							//GET THE HELP LEVEL ID TO DETERMINE THE LEVEL OF THE TOPIC					
							$getHelpLevelID = mysql_query ("SELECT help_level_id FROM help WHERE help_id = \"$id\"");	
							$helpLevelID = mysql_result ($getHelpLevelID,0);	
							
							//IF THE USER IS A STANDARD USER AND THE HELP LEVEL IS ADVANCED REDIRECT WITH ERROR
							if (($result != 1) && ($helpLevelID == 2)) {
							
								header ('location: help.php?error');
								die();
								exit();
	
							}
							
							//GET THE TOPIC CONTENT TO POPULATE SUBJECT AND CONTENT
							$getTopic = mysql_query ("select help_subject, help_content from help where help_id = \"$id\"");
							$topic = mysql_fetch_array ($getTopic);
							
							if ($topic) {
							
							//GET SPECIAL HTML CHARACHTERS AND SET VARIABLE TO LATER CONVERT INTO CONTENT
							$content = htmlspecialchars($topic ['help_content'], ENT_QUOTES);
							
								echo "<H1>" . $topic ['help_subject'] . "</H1>";
								echo "<p>" . str_replace(array("\r\n", "\n"), array("<br />", "<br />"), $content) . "</p>";
							
							} else {
							
								echo mysql_error();
							
							}
						
					?>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
