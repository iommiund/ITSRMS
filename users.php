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
	$getUsers = mysql_query ("SELECT user_id, username FROM users ORDER BY user_id ASC");
	
	while ($allUsers = mysql_fetch_array($getUsers)) {
?>
<option id="<?php echo $allUsers ['user_id']; ?>"><?php echo $allUsers ['username']; ?></option>
	<?php } ?>