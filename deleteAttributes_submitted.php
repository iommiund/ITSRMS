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
						<?php 
						
							if (empty($_POST['value'])) {
							
								header ('location: deleteAttributes.php?emptyfield');
								die();
								exit();
							
							} else if (isset($_POST['select'], $_POST['value'])) {
							
								$select=$_POST['select'];
								$value=$_POST['value'];
								
								include_once ("dbc.php");
								
								if ($select == 'Brand') {
									
									//VALIDATE THAT VALUE DOES NOT ALREADY EXIST
									$getValueCount = mysql_query ("select count(*) from resource_brands where resource_brand = \"$value\"");
									$valueCount = mysql_result ($getValueCount,0);
									
									if ($valueCount == 0) {
									
										header ('location: deleteAttributes.php?notexist');
										die();
										exit();
									
									} else if ($valueCount > 0) {
									
										//INSERT DATA INTO TABLE        					
						    			$delete = "DELETE FROM resource_brands WHERE resource_brand= \"$value\"";
						    			$ret = mysql_query ($delete, $conn);
						    			
						    			if ($ret) {
						    				echo "<h1><b>". $value."</b> deleted</h1>";
						    			}
						    			else {
						    				echo "<h1>Something Went Wrong: " .mysql_error(); + "</h1>";
						    			}
									
									}	
										
								} else if ($select == 'Resource Type') {
								
									//VALIDATE THAT VALUE DOES NOT ALREADY EXIST
									$getValueCount = mysql_query ("select count(*) from resource_types where resource_type = \"$value\"");
									$valueCount = mysql_result ($getValueCount,0);
									
									if ($valueCount == 0) {
									
										header ('location: deleteAttributes.php?notexist');
										die();
										exit();
									
									} else if ($valueCount > 0) {
									
						    			//INSERT DATA INTO TABLE        					
						    			$delete = "DELETE FROM resource_types WHERE resource_type= \"$value\"";
						    			$ret = mysql_query ($delete, $conn);
						    			
						    			if ($ret) {
						    				echo "<h1><b>". $value."</b> deleted</h1>";
						    			}
						    			else {
						    				echo "<h1>Something Went Wrong: " .mysql_error(); + "</h1>";
						    			}
									
									}	

								} else if ($select == 'Model') {
								
									//VALIDATE THAT VALUE DOES NOT ALREADY EXIST
									$getValueCount = mysql_query ("select count(*) from resource_models where resource_model = \"$value\"");
									$valueCount = mysql_result ($getValueCount,0);
									
									if ($valueCount == 0) {
									
										header ('location: deleteAttributes.php?notexist');
										die();
										exit();
									
									} else if ($valueCount > 0) {
									
						    			//INSERT DATA INTO TABLE        					
						    			$delete = "DELETE FROM resource_models WHERE resource_model= \"$value\"";
						    			$ret = mysql_query ($delete, $conn);
						    			
						    			if ($ret) {
						    				echo "<h1><b>". $value."</b> deleted</h1>";
						    			}
						    			else {
						    				echo "<h1>Something Went Wrong: " .mysql_error(); + "</h1>";
						    			}
									
									}	
								
								} else if ($select == 'Location') {
								
									//VALIDATE THAT VALUE DOES NOT ALREADY EXIST
									$getValueCount = mysql_query ("select count(*) from resource_locations where resource_location = \"$value\"");
									$valueCount = mysql_result ($getValueCount,0);
									
									if ($valueCount == 0) {
									
										header ('location: deleteAttributes.php?notexist');
										die();
										exit();
									
									} else if ($valueCount > 0) {
									
						    			//INSERT DATA INTO TABLE        					
						    			$delete = "DELETE FROM resource_locations WHERE resource_location= \"$value\"";
						    			$ret = mysql_query ($delete, $conn);
						    			
						    			if ($ret) {
						    				echo "<h1><b>". $value."</b> deleted</h1>";
						    			}
						    			else {
						    				echo "<h1>Something Went Wrong: " .mysql_error(); + "</h1>";
						    			}
									
									}	
								
								}
							
							}
						
						?>
					</div>		
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
