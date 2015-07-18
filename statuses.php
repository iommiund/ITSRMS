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
	$getStatuses = mysql_query ("SELECT * FROM resource_statuses order by resource_status_id asc");
	
	while ($allStatuses = mysql_fetch_array($getStatuses)) {
?>
<option id="<?php echo $allStatuses ['resource_status_id']; ?>"><?php echo $allStatuses ['resource_status']; ?></option>
	<?php } ?>