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
						<?php
							
							$id=$_GET['id'];
							
								if (empty($_POST['subject'])){
								
									header ('location: modifyHelpTopic.php?id='. $id .'?emptyfield');
									die();
									exit();

								} else if (empty($_POST['helpContent'])){
								
									header ('location: modifyHelpTopic.php?id='. $id .'?emptyfield');
									die();
									exit();

								} else {
																
									include_once ("dbc.php");
									
									$subject=$_POST['subject'];
									$helpContent=$_POST['helpContent'];
									$helpLevel=$_POST['helpLevel'];
																		
									$modifyHelpTopic = mysql_query ("UPDATE help SET help_subject = \"$subject\", help_content = \"$helpContent\", help_level_id = (SELECT help_level_id FROM help_levels WHERE help_level = \"$helpLevel\") where help_id = \"$id\"");
									
									if (!$modifyHelpTopic) {
									
										$error = mysql_error();
										
										if (strpos($error,'Duplicate entry') !== false) {
										
											header ('location: modifyHelpTopic.php?id='. $id .'&duplicate');
											die();
											exit();
										
										}
									
									} else {
										
										echo "<h1>Help Topic Modified</h1>";		
									
									}
																							    		
					    		}
			    		?>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>