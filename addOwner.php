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
								if (empty($_POST['addOwnerName'])){
									header ('location: addAttributes.php?emptyOwner');
								} else if (empty($_POST['addOwnerSurname'])){
									header ('location: addAttributes.php?emptyOwner');
								} else {
																
									//SETTING VARIABLES
									$newOwnerName=$_POST['addOwnerName'];
									$newOwnerSurname=$_POST['addOwnerSurname'];
									$ownerType=$_POST['ownerType'];
									//CONNECT TO DATABASE
									include_once ("dbc.php");
									
					    			//INSERT DATA INTO TABLE        					
					    			$insert = "insert into owners (owner_name, owner_surname, owner_type) values 
					    						( \"$newOwnerName\", \"$newOwnerSurname\", \"$ownerType\")";
					    			$ret = mysql_query ($insert, $conn);
					    			
					    			if ($ret) {
					    				echo "<h1><b>".$newOwnerName." ".$newOwnerSurname." - ".$ownerType."</b> has been aded as an <b>Owner</b></h1>";
					    			}
					    			else {
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
