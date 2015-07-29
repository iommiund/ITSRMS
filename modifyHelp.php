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
					<div class="center-table">
						<p><b>Tip:</b> Click on the subject to View contents and Modify</p>
						<table>
							<tr>
								<th>Topic Subject</th>
								<th>Topic Level</th>
							</tr>
							<?php
							
								include_once ("helpTopicsModifyGet.php");
								
							?>						
						</table>
						<script type="text/javascript">
							$(document).ready(function () {
							$('table tr:nth-child(odd)').addClass('alt');
							});
						</script>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
