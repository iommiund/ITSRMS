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
	
	$getLocations = mysql_query ("SELECT * FROM resource_locations order by resource_location asc");
	
	while ($allLocations = mysql_fetch_array($getLocations)) {

?>
<option id="<?php echo $allLocations ['resource_location_id']; ?>"><?php echo $allLocations ['resource_location']; ?></option>
	<?php } ?>