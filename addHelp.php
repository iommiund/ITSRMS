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
						<p><b>Note:</b> Advanced topics are only viewable by Super Users.</p>
						<h1>Add a New Help Topic</h1>
	
						<form action="addHelp_submitted.php" method="post">
							<input type="text" name="subject" placeholder="Type Subject Here" required="required"/>
							<label>Level:</label> 
							<select name="helpLevel">
								<?php
									
									//GET LIST BRANDS.PHP PAGE
									include_once ("helpLevels.php");
								?>
							</select>
							<label>Content:</label>
							<textarea name="helpContent" placeholder="Ex: If you wish to add a new resource........." required="required" maxlength="60000"></textarea>
							<input type="submit" value="ADD" />
						</form>
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
