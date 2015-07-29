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
					<div class="form-style">
						<h1>Search Resources</h1>
						<form action="searchResults.php?" method="get">
							<select name="where">
								<option id="1">Description</option>
								<option id="2">Serial Number</option>
								<option id="3">State</option>
								<option id="4">Condition</option>
								<option id="5">Status</option>
								<option id="6">Owner</option>
								<option id="7">Location</option>
							</select><br>
							<select name="condition">
								<option id="1">Is</option>
								<option id="2">Is Not</option>
								<option id="3">Contains</option>
							</select><br>
							<input type="text" name="value" required="required"/>
							<!--ERROR MESSAGE-->
							<div class="form-link">
								<?php
									if (isset($_GET['emptyfield'])) {
										echo "<div id='error'>You must not leave this field empty!</div>";
									}
								?>
							</div><br>
							<input type="submit" value="SEARCH" />
						</form>	
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
