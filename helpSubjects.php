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
	
	//GET DATA FROM HELP TABLE AND INSERT INTO A LIST
	$getSubjects = mysql_query ("SELECT help_id, help_subject FROM help ORDER BY help_subject ASC");
	
	while ($allSubjects = mysql_fetch_array($getSubjects)) {
?>
<option id="<?php echo $allSubjects ['help_id']; ?>"><?php echo $allSubjects ['help_subject']; ?></option>
	<?php } ?>