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
	$getLevels = mysql_query ("SELECT * FROM help_levels order by help_level asc");
	
	while ($allLevels = mysql_fetch_array($getLevels)) {
?>
<option id="<?php echo $allLevels ['help_level_id']; ?>"><?php echo $allLevels ['help_level']; ?></option>
	<?php } ?>