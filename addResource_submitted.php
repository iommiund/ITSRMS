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
	/*$username=$_SESSION['username'];
	
	include_once ("dbc.php");	

	$get=mysql_query ("SELECT user_type_id FROM users WHERE USERNAME = \"$username\"");
	
	$result=mysql_result($get,0);
						
		if ($result != 1) {
			header ('location: main.php');
			die();
			exit();
	  					
		}*/
?>
			<div class="content">
				<div class="container">
					<div class="form-style">
						<?php
								if (empty($_POST['serialNumber'])){
								
									header ('location: addResource.php?emptyfield');
									die();
									exit();

								} else if (empty($_POST['value'])){
								
									header ('location: addResource.php?emptyfield');
									die();
									exit();

								} else if (!ctype_digit($_POST['value'])) {
								
    								header ('location: addResource.php?notnumeric');
    								die();
									exit();

								} else {
																
									include_once ("dbc.php");
									
									$username=$_SESSION['username'];
									$brand=$_POST['brands'];
									$resourceType=$_POST['resourceTypes'];
									$model=$_POST['models'];
									$serialNumber=$_POST['serialNumber'];
									$state=$_POST['states'];
									$condition=$_POST['conditions'];
									$status=$_POST['statuses'];
									$currentOwner=$_POST['currentOwner'];
									$location=$_POST['location'];
									$value=$_POST['value'];
																		
					    			//INSERT DATA INTO RESOURCES
									$newResource = mysql_query ("INSERT INTO resources (resource_brand, resource_type, resource_model, resource_serial_number, resource_creation_date, resource_initial_value) VALUES (\"$brand\", \"$resourceType\", \"$model\", \"$serialNumber\", NOW(), \"$value\")");
											
					    			if ($newResource) {
					    									    				
						    			//GET RESOURCE INFORMATION
						    			$getResourceID = mysql_query ("select resource_id from resources where resource_serial_number = \"$serialNumber\"");
						    			$resourceID = mysql_result($getResourceID,0);
						    			
						    			$resourceDescription = $brand." ".$resourceType." ".$model;
						    																			    			
						    			//RECORD RESOURCE HISTORY
						    			$updateHistory = mysql_query ("INSERT INTO resource_history (resource_id, username, resource_description, resource_serial_number, resource_state, resource_condition, resource_status, owner_description, resource_location) VALUES (\"$resourceID\", \"$username\", \"$resourceDescription\", \"$serialNumber\", \"$state\", \"$condition\", \"$status\", \"$currentOwner\", \"$location\")");

						    			if (!$updateHistory) {
						    			
						    				echo mysql_error();
						    				
						    			} else if ($updateHistory) {
						    			
							    			$getName = mysql_query ("select user_name from users where username = \"$username\"");
											$name = mysql_result($getName,0);
							    			
							    			echo "<h1>Hey <b>". $name ."</b>, Resource Added</h1>";
					    			
					    				}
					    				
					    			} else {
					    				echo "<h1>Something Went Wrong: " .mysql_error(); + "</h1>";
					    			}
					    		
					    		}
			    		?>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>