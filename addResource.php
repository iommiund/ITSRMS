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
					<div class="form-style">
						<h1>Add a New Resource</h1>
	
						<form action="addResource_submitted.php" method="post">
							<table>
								<tr>
									<td>
										<label>Brand:</label> 
										<select name="brands">
											<?php
												
												//GET LIST BRANDS.PHP PAGE
												include_once ("brands.php");
											?>
										</select>
									</td>
									<td>
										<label>Resource Type:</label> 
										<select name="resourceTypes">
											<?php
												
												//GET LIST RESOURCE_TYPES.PHP PAGE
												include_once ("resource_types.php");
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>Model:</label> 
										<select name="models">
											<?php
												
												//GET LIST MODELS.PHP PAGE
												include_once ("models.php");
											?>
										</select>
									</td>
									<td>
										<label>Serial Number</label>
										<input type="text" name="serialNumber" placeholder="Example: 0353201620225" required="required"/>
									</td>
								</tr>
								<tr>
									<td>
										<label>State:</label> 							
										<select name="states">
											<?php
												
												//GET LIST STATES.PHP PAGE
												include_once ("states.php");
											?>
										</select>
									</td>
									<td>
										<label>Condition:</label> 							
										<select name="conditions">
											<?php
												
												//GET LIST CONDITIONS.PHP PAGE
												include_once ("conditions.php");
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>Status:</label> 							
										<select name="statuses">
											<?php
												
												//GET LIST STATUSES.PHP PAGE
												include_once ("statuses.php");
											?>
										</select>
									</td>
									<td>
										<label>Current Owner:</label> 							
										<select name="currentOwner">
											<?php
												
												//GET LIST OWNERS.PHP PAGE
												include_once ("owners.php");
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>Location:</label> 							
										<select name="location">
											<?php
												
												//GET LIST LOCATIONS.PHP PAGE
												include_once ("locations.php");
											?>
										</select>
									</td>
									<td>
										<label>Current &#8364; Value:</label>
										<input type="text" name="value" placeholder="Example: 790" required="required"/>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="submit" value="ADD RESOURCE" />
									</td>
								</tr>
							</table>
						</form>
						<br>
						<!--ADDING ADD ATTRIBUTE BUTTON-->
						<div class="form-link">
							<?php
							//SUPER USER VALIDATION - STANDARD USERS ARE REDIRECTED TO MAIN.PHP
								$username=$_SESSION['username'];
								
								include_once ("dbc.php");	
							
								$get=mysql_query ("SELECT user_type_id FROM users WHERE USERNAME = \"$username\"");
								
								$result=mysql_result($get,0);
													
									if ($result != 1) {
									

			  					
									} else {
									
										echo "<a href='addAttributes.php'>Add New Attributes</a>";
									
									}
							?>
						</div>
						<br>
						<!--ERROR MESSAGES-->
						<div class="form-link">
							<?php
								if (isset($_GET['emptyfield'])) {
									echo "<div id='error'>One or more fields were empty, try again!</div>";
								} else if (isset($_GET['notnumeric'])) {
									echo "<div id='error'>Current &#8364; Value must only contain numbers</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
