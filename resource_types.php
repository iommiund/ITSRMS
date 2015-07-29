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
	
	//GET DATA FROM RESOURCE TYPES TABLE AND INSERT INTO A LIST
	$getResourceTypes = mysql_query ("SELECT * FROM resource_types order by resource_type asc");
	
	while ($allResourceTypes = mysql_fetch_array($getResourceTypes)) {
?>
<option id="<?php echo $allResourceTypes ['resource_type_id']; ?>"><?php echo $allResourceTypes ['resource_type']; ?></option>
	<?php } ?>