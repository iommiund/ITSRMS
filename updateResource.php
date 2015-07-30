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
								if (empty($_GET['id'])){
								
									header ('location: main.php?noresourceid');
									die();
									exit();	

								} else {
																
									include_once ("dbc.php");
									
									$username=$_SESSION['username'];
									$resourceID=$_GET['id'];
									$state=$_POST['states'];
									$condition=$_POST['conditions'];
									$status=$_POST['statuses'];
									$location=$_POST['location'];
									$owner=$_POST['owners'];
									
									//CHECK IF RESOURCE IS DESTROYED AND DISABLE/ENABLE UPDATE RESOURCE BUTTON
									$checkDstatus = mysql_query ("SELECT COUNT(*) FROM (SELECT resource_state FROM resource_history WHERE rh_id = (SELECT MAX(rh_id) FROM resource_history WHERE resource_id = \"$resourceID\")) tmp where tmp.resource_state = 'Destroyed'");
									$dStatus = mysql_result ($checkDstatus,0);
									
										if ($dStatus > 0) {
										
											header ('location: viewResource.php?id='.$resourceID.'&destroyed');
						    				die();
						    				exit();

										}									
								
									//VALIDATE IF ANY CHANGES WERE MADE
						    		$getRhId = mysql_query ("SELECT rh_id FROM resource_history WHERE resource_id = \"$resourceID\" AND resource_state = \"$state\" AND resource_condition = \"$condition\" AND resource_status = \"$status\" AND owner_description = \"$owner\" AND resource_location = \"$location\"");
						    		$num_rows = mysql_num_rows($getRhId);
						    								    		
						    		if ($num_rows > 0) {
						    			
						    			$rhId = mysql_result($getRhId,0);
						    			
						    			//GET THE MAXIMUM ID OF THE LAST UPDATE
							    		$getMaxRhId = mysql_query ("SELECT MAX(rh_id) FROM resource_history WHERE resource_id = \"$resourceID\"");
							    		$maxRhId = mysql_result($getMaxRhId,0);
							    		
							    		//IF THE MAXIMUM ID RETURNS THE SAME NUMBER REDIRECT WITH AN ERROR
							    		if ($rhId == $maxRhId) {
						    		
						    				header ('location: update.php?id='.$resourceID.'&nochanges');
						    				die();
						    				exit();
						    				
						    			}
						    		
						    		}
						    		
						    		//VALIDATE THAT RESOURCE STATE IS NOT BEING CHANGED BACK TO NEW
						    		if ($state == 'New') {
						    		
							    		$getCountNotNew = mysql_query ("SELECT COUNT(*) FROM resource_history WHERE resource_id = \"$resourceID\" AND resource_state != 'New'");
						    			$countNotNew = mysql_result ($getCountNotNew,0);
						    			
						    			if ($countNotNew !== 0) {
						    			
							    				header ('location: update.php?id='.$resourceID.'&notnew');
							    				die();
							    				exit();
						    			
						    			}

						    		}
					    			
			    					//VALIDATE THAT RESOURCE CONDITION IS NOT BEING CHANGED BACK TO BRAND NEW
			    					if ($condition == 'Brand New') {
			    					
				    					$getCountNotBrandNew = mysql_query ("SELECT COUNT(*) FROM resource_history WHERE resource_id = \"$resourceID\" AND resource_condition != 'Brand New'");
					    				$countNotBrandNew = mysql_result ($getCountNotNew,0);
										
										if ($countNotBrandNew !== 0) {
					    			
						    					header ('location: update.php?id='.$resourceID.'&notbrandnew');
							    				die();
							    				exit();
						    			
						    			}
			    					
			    					}
			    					
			    					//VALIDATE CORRECT COMBINATION FOR DESTROYED RESOURCE
			    					if (($state == 'Destroyed') or ($condition == 'Damaged - Beyond Repair') or ($status == 'Destroyed') or ($location == 'Destroyed') or ($owner == 'Recycling Plant - External Entity')) {
			    						
			    						//VALIDATE THAT THE RESOURCE IS NOT BEING CHANGED BACK TO ANOTHER STATUS FROM DESTROYED
			    						$getCountDestroyed = mysql_query ("SELECT COUNT(*) FROM resource_history WHERE resource_id = \"$resourceID\" AND resource_state = 'Destroyed'");
					    				$countDestroyed = mysql_result ($getCountDestroyed,0);
										
										if ($countDestroyed == 1) {
					    			
						    					header ('location: update.php?id='.$resourceID.'&destroyed');
							    				die();
							    				exit();
						    			
						    			} else if (($state == 'Destroyed') && ($condition == 'Damaged - Beyond Repair') && ($status == 'Destroyed') && ($location == 'Destroyed') && ($owner == 'Recycling Plant - External Entity')) {
			    						
						    				//GET DESCRIPTION AND SN
						    				$getDesNsn = mysql_query ("SELECT MAX(rh_id), resource_description, resource_serial_number FROM resource_history WHERE resource_id = \"$resourceID\" GROUP BY rh_id , resource_description , resource_serial_number");
						    				$desNsn = mysql_fetch_array ($getDesNsn);
						    				
						    				$resourceDescription = $desNsn ['resource_description'];
						    				$serialNumber = $desNsn ['resource_serial_number'];
						    				
											//RECORD RESOURCE HISTORY
											$updateHistory = mysql_query ("INSERT INTO resource_history (resource_id, username, resource_description, resource_serial_number, resource_state, resource_condition, resource_status, owner_description, resource_location) VALUES (\"$resourceID\", \"$username\", \"$resourceDescription\", \"$serialNumber\", \"$state\", \"$condition\", \"$status\", \"$owner\", \"$location\")");
	
							    			if (!$updateHistory) {
							    			
							    				echo mysql_error();
							    				
							    			} else if ($updateHistory) {
							    			
								    			$getName = mysql_query ("select user_name from users where username = \"$username\"");
												$name = mysql_result($getName,0);
								    			
								    			echo "<h1>Hey <b>". $name ."</b>, Resource Updated</h1>";
								    			die();
						    			
						    				}

			    						
			    						} else {
			    						
			    							header ('location: update.php?id='.$resourceID.'&notcombined');
							    			die();
							    			exit();

			    						}
			    					
			    					}
					    			
					    			//UPDATE RESOURCE IN RESOURCE HISTORY TABLE
					    			
					    				//GET DESCRIPTION AND SN
					    				$getDesNsn = mysql_query ("SELECT MAX(rh_id), resource_description, resource_serial_number FROM resource_history WHERE resource_id = \"$resourceID\" GROUP BY rh_id , resource_description , resource_serial_number");
					    				$desNsn = mysql_fetch_array ($getDesNsn);
					    				
					    				$resourceDescription = $desNsn ['resource_description'];
					    				$serialNumber = $desNsn ['resource_serial_number'];
					    				
										//RECORD RESOURCE HISTORY
										$updateHistory = mysql_query ("INSERT INTO resource_history (resource_id, username, resource_description, resource_serial_number, resource_state, resource_condition, resource_status, owner_description, resource_location) VALUES (\"$resourceID\", \"$username\", \"$resourceDescription\", \"$serialNumber\", \"$state\", \"$condition\", \"$status\", \"$owner\", \"$location\")");

						    			if (!$updateHistory) {
						    			
						    				echo mysql_error();
						    				
						    			} else if ($updateHistory) {
						    			
							    			$getName = mysql_query ("select user_name from users where username = \"$username\"");
											$name = mysql_result($getName,0);
							    			
							    			echo "<h1>Hey <b>". $name ."</b>, Resource Updated</h1>";
					    			
					    				}
										
								}									
				    		
			    		?>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>