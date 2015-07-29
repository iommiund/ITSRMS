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
	
	//GET DATA FROM USER STATUSES TABLE AND INSERT INTO A LIST
	$getUserStatuses = mysql_query ("SELECT * FROM user_statuses;");
	
	while ($allUserStatuses = mysql_fetch_array($getUserStatuses)) {
?>
<option id="<?php echo $allUserStatuses ['user_status_id']; ?>"><?php echo $allUserStatuses ['user_status']; ?></option>
	<?php } ?>