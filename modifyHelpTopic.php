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
						<p><b>Note:</b> Advanced topics are only viewable by Super Users.</p>
						<h1>Add a New Help Topic</h1>
						<?php
								
							//CONNECT TO DATABASE
							include_once ("dbc.php");
							
							$id = $_GET['id'];
							
							$getTopicInfo = mysql_query ("SELECT h.help_id, h.help_subject, h.help_content, h.help_level_id, hl.help_level FROM help h LEFT JOIN help_levels hl ON h.help_level_id = hl.help_level_id WHERE h.help_id = \"$id\"");
							
							//POPULATE FORM WITH TOPIC INFO
							while ($topicInfo = mysql_fetch_array ($getTopicInfo)) {
								
								//FORM TO MODIFY HELP TOPIC
								echo "<form id='form' action='modifyHelp_submitted.php?id=" . $id . "' method='post'>";
									echo "<input type='text' name='subject' required='required' value='" . $topicInfo['help_subject'] . "'/>";
									echo "<label>Level:</label>";
									echo "<select name='helpLevel'>";
									
									//GET DATA FROM HELP LEVELS TABLE AND INSERT INTO A LIST
									$getLevels = mysql_query ("SELECT * FROM help_levels order by help_level asc");

										while ($allLevels = mysql_fetch_array($getLevels )) {
									?>
									
									<?php echo "<option id='". $allLevels ['help_level_id'] ."'"?>
									<?php 
									
																				
										if ($allLevels ['help_level_id'] == $topicInfo ['help_level_id']){
											
											echo "selected>";
											
										} else {
										
											echo ">";
										
										}
									
									?>
									<?php echo $allLevels ['help_level']; ?><?php echo "</option>"; ?>
										<?php } ?>
								
								<?PHP
									echo "</select>";

									echo "<label>Content:</label>";
									echo "<textarea name='helpContent' required='required' maxlength='40000'>" . $topicInfo['help_content'] . "</textarea>";
									echo "<input type='submit' value='MODIFY' />";
								echo "</form>";
			
							}	
						?>
						<br>
						<div class="form-link">
						<?php
							if (isset($_GET['emptyfield'])) {
								echo "<div id='error'>One or more fields were empty, try again!</div>";
							} else
						?>
						</div>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
