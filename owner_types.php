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
	$getOwnerTypes = mysql_query ("SELECT * FROM owner_types order by owner_type asc");
	
	while ($allOwnerTypes = mysql_fetch_array($getOwnerTypes)) {
?>
<option id="<?php echo $allOwnerTypes ['owner_type_id']; ?>"><?php echo $allOwnerTypes ['owner_type']; ?></option>
	<?php } ?>