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
	
	//GET DATA FROM RESOURCE STATE TABLE AND INSERT INTO A LIST
	$getStates = mysql_query ("SELECT * FROM resource_states order by resource_state_id asc");
	
	while ($allStates = mysql_fetch_array($getStates)) {
?>
<option id="<?php echo $allStates ['resource_state_id']; ?>"><?php echo $allStates ['resource_state']; ?></option>
	<?php } ?>