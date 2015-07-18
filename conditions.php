<?php
	if (empty($_SESSION['username'])) {
	
		header ('location: index.php?nologin');
		die();
		exit();

	}	
?>
<?php
	
	//CONNECT TO DATABASE
	include_once ("dbc.php");
	
	//GET DATA FROM INGREDIENTS TABLE AND INSERT INTO A LIST
	$getConditions = mysql_query ("SELECT * FROM resource_conditions order by resource_condition asc");
	
	while ($allConditions = mysql_fetch_array($getConditions)) {
?>
<option id="<?php echo $allConditions ['resource_condition_id']; ?>"><?php echo $allConditions ['resource_condition']; ?></option>
	<?php } ?>