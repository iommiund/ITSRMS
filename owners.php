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
	
	$getOwners = mysql_query ("SELECT * FROM owners order by owner_name asc");
	
	while ($allOwners = mysql_fetch_array($getOwners)) {

?>
<option id="<?php echo $allOwners ['owner_id']; ?>"><?php echo $allOwners ['owner_name']." ".$allOwners ['owner_surname']." - ".$allOwners['owner_type']; ?></option>
	<?php } ?>