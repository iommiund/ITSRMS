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
						<p><b>Tip:</b> Delete a help topic by selecting it's subject.</p>
						<h1>Delete a New Help Topic</h1>
	
						<form action="deleteHelp_submitted.php" method="post">
							<select name="helpSubject">
								<?php
									
									//GET LIST BRANDS.PHP PAGE
									include_once ("helpSubjects.php");
								?>
							</select>
							<input type="submit" value="DELETE" />
						</form>
						<?php
							/*if (isset($_GET['emptyfield'])) {
								echo "<div id='error'>One or more fields were empty, try again!</div>";
							} else*/
						?>

					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
