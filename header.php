<?php
	if (empty($_SESSION['username'])) {
	
		header ('location: index.php?nologin');
		die();
		exit();

	}	
?>
<?php
	$username=$_SESSION['username'];
	
	include_once ("dbc.php");	

	$get=mysql_query ("SELECT user_type_id FROM users WHERE USERNAME = \"$username\"");
	
	$result=mysql_result($get,0);
						
		if ($result == 1) {
			include_once ("header1.php");	  					
		} else if ($result == 0) {
			header ('location: index.php');
		} 
		else if ($result == 2) {
			include_once ("header2.php");
  		}
?>