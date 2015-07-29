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
			<div class="content">
				<div class="container">
					<p><b>Tip:</b> Click on a Help Topic to view its contents.</p>
						<div class="form-link">
							<?php
								if (isset($_GET['error'])) {
									echo "<div id='error'>You can only choose from the Topics listed below!!!</div>";
								}
							?>
						</div>
						<div class="admin">
							<ul class="admin">
							<?php
							
								//SUPER USER VALIDATION - STANDARD USERS VIEW HELP TOPICS CLASSIFIED AS NORMAL
								$username=$_SESSION['username'];
								
								include_once ("dbc.php");	
							
								$get=mysql_query ("SELECT user_type_id FROM users WHERE USERNAME = \"$username\"");
								
								$result=mysql_result($get,0);
													
									if ($result != 1) {
									
										$getNormalTopics = mysql_query ("SELECT help_id, help_subject FROM help WHERE help_level_id = '1' order by help_id asc");
										
										while ($normalTopics = mysql_fetch_array ($getNormalTopics)) {
										
										echo "<li><a href='viewHelp.php?id=" . $normalTopics ['help_id'] . "'>" . $normalTopics ['help_subject'] . "</a></li><br><br>";
										
										}
	
								  					
									} else if ($result == 1) {
									
										$getAllTopics = mysql_query ("SELECT help_id, help_subject FROM help order by help_id asc");
										
										while ($allTopics = mysql_fetch_array ($getAllTopics)) {
										
										echo "<li><a href='viewHelp.php?id=" . $allTopics ['help_id'] . "'>" . $allTopics ['help_subject'] . "</a></li><br><br>";
										
										}
									
									}
						
							?>
						</ul>
					</div>	
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
