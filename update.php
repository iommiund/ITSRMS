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
	//CONNECT TO DATABASE
	include_once ("dbc.php");
?>
			<div class="content">
				<div class="container">
					<div class="form-style">
						<h1>Update Resource</h1>
						
						<?php 
						
						$id = $_GET['id'];
						
						echo "<form action='updateResource.php?id=".$id."' method='post'>";
						
						?>
						
							<table>
								<tr>
									<td>
										<label>State:</label> 							
										<?PHP
											$id = $_GET['id'];
											
											
											echo "<select name='states'>";
											
												//GET DATA FROM RESOURCE STATES TABLE AND INSERT INTO A LIST
											$getStates = mysql_query ("SELECT * FROM resource_states order by resource_state asc");
	
												while ($allStates = mysql_fetch_array($getStates)) {
											?>
											
											<?php echo "<option id='". $allStates ['resource_state_id'] ."'"?>
											<?php 
											
												$getStateID = mysql_query ("SELECT RS.RESOURCE_STATE_ID FROM resource_states RS WHERE RESOURCE_STATE = (select resource_state from resource_history where rh_id = (SELECT max(rh_id) from resource_history where resource_id = \"$id\"))");
												$stateID = mysql_result ($getStateID,0);
	
												if ($allStates ['resource_state_id'] == $stateID){
													
													echo "selected>";
													
												} else {
												
													echo ">";
												
												}
											
											?>
											<?php echo $allStates ['resource_state']; ?><?php echo "</option>"; ?>
												<?php } ?>
										
										<?PHP
											echo "</select>";

										?>
									</td>
									<td>
										<label>Condition:</label> 							
										<?PHP
											$id = $_GET['id'];
											
											
											echo "<select name='conditions'>";
											
												//GET DATA FROM RESOURCE CONDITIONS TABLE AND INSERT INTO A LIST
											$getConditions = mysql_query ("SELECT * FROM resource_conditions order by resource_condition asc");
	
												while ($allConditions = mysql_fetch_array($getConditions)) {
											?>
											
											<?php echo "<option id='". $allConditions ['resource_condition_id'] ."'"?>
											<?php 
											
												$getConditionID = mysql_query ("SELECT RC.RESOURCE_CONDITION_ID FROM resource_conditions RC WHERE RESOURCE_CONDITION = (select resource_condition from resource_history where rh_id = (SELECT max(rh_id) from resource_history where resource_id = \"$id\"))");
												$conditionID = mysql_result ($getConditionID,0);
	
												if ($allConditions ['resource_condition_id'] == $conditionID){
													
													echo "selected>";
													
												} else {
												
													echo ">";
												
												}
											
											?>
											<?php echo $allConditions ['resource_condition']; ?><?php echo "</option>"; ?>
												<?php } ?>
										
										<?PHP
											echo "</select>";

										?>
									</td>
								</tr>
								<tr>
									<td>
										<label>Status:</label> 							
										<?PHP
											$id = $_GET['id'];
											
											
											echo "<select name='statuses'>";
											
												//GET DATA FROM RESOURCE STATUSES TABLE AND INSERT INTO A LIST
											$getStatuses = mysql_query ("SELECT * FROM resource_statuses order by resource_status asc");
	
												while ($allStatuses = mysql_fetch_array($getStatuses)) {
											?>
											
											<?php echo "<option id='". $allStatuses ['resource_status_id'] ."'"?>
											<?php 
											
												$getStatusID = mysql_query ("SELECT RS.RESOURCE_STATUS_ID FROM resource_statuses RS WHERE RESOURCE_STATUS = (select resource_status from resource_history where rh_id = (SELECT max(rh_id) from resource_history where resource_id = \"$id\"))");
												$statusID = mysql_result ($getStatusID,0);
	
												if ($allStatuses ['resource_status_id'] == $statusID){
													
													echo "selected>";
													
												} else {
												
													echo ">";
												
												}
											
											?>
											<?php echo $allStatuses ['resource_status']; ?><?php echo "</option>"; ?>
												<?php } ?>
										
										<?PHP
											echo "</select>";

										?>
									</td>
									<td>
										<label>Location:</label> 							
										<?PHP
											$id = $_GET['id'];
											
											
											echo "<select name='location'>";
											
												//GET DATA FROM RESOURCE LOCATIONS TABLE AND INSERT INTO A LIST
											$getLocations = mysql_query ("SELECT * FROM resource_locations order by resource_location asc");
	
												while ($allLocations = mysql_fetch_array($getLocations)) {
											?>
											
											<?php echo "<option id='". $allLocations ['resource_location_id'] ."'"?>
											<?php 
											
												$getLocationID = mysql_query ("SELECT RL.RESOURCE_LOCATION_ID FROM resource_locations RL WHERE RESOURCE_LOCATION = (select resource_location from resource_history where rh_id = (SELECT max(rh_id) from resource_history where resource_id = \"$id\"))");
												$locationID = mysql_result ($getLocationID,0);
	
												if ($allLocations ['resource_location_id'] == $locationID){
													
													echo "selected>";
													
												} else {
												
													echo ">";
												
												}
											
											?>
											<?php echo $allLocations ['resource_location']; ?><?php echo "</option>"; ?>
												<?php } ?>
										
										<?PHP
											echo "</select>";

										?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>Owner:</label> 							
										<?PHP
											$id = $_GET['id'];
											
											echo "<select name='owners'>";
											
											$getOwners = mysql_query ("SELECT * FROM owners order by owner_name asc");
	
												while ($allOwners = mysql_fetch_array($getOwners)) {
											?>
											
											<?php echo "<option id='". $allOwners ['owner_id'] ."'"?>
											<?php 
																								
												$getOwnerID = mysql_query ("SELECT OWNER_ID FROM OWNERS WHERE OWNER_NAME = (SELECT SUBSTRING_INDEX(RH.owner_description , ' ', 1) AS 'OWNER_NAME' FROM resource_history RH WHERE RH.rh_id = (SELECT max(rh_id) from resource_history where resource_id = \"$id\")) AND OWNER_TYPE = (SELECT SUBSTRING_INDEX(RH.owner_description , '- ', -1) AS 'OWNER_TYPE' FROM resource_history RH WHERE RH.rh_id = (SELECT max(rh_id) from resource_history where resource_id = \"$id\"))");
												$ownerID = mysql_result ($getOwnerID,0);
												
												if ($allOwners ['owner_id'] == $ownerID){
													
													echo "selected>";
													
												} else {
												
													echo ">";
												
												}
											
											?>
											<?php echo $allOwners ['owner_name']." ".$allOwners ['owner_surname']." - ".$allOwners['owner_type']; ?><?php echo "</option>"; ?>
												<?php } ?>
										
										<?PHP
											echo "</select>";

										?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="submit" value="UPDATE RESOURCE" />
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
								if (isset($_GET['nochanges'])) {
									echo "<div id='error'>You did not perform any changes!</div>";
								} else if (isset($_GET['notnew'])) {
									echo "<div id='error'>This is not a New resource, select the correct state!</div>";
								} else if (isset($_GET['notbrandnew'])) {
									echo "<div id='error'>This is not a Brand New resource, select the correct Condition!</div>";
								} else if (isset($_GET['notcombined'])) {
									echo "<div id='error'>Please use the correct combination, see Help for more info!</div>";
								} else if (isset($_GET['destroyed'])) {
									echo "<div id='error'>This resource is Destroyed and cannot be updated!</div>";
								}


							?>
						</div>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
