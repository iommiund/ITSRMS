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
	
	//GET DATA FROM user types TABLE AND INSERT INTO A LIST
	$getUserTypes = mysql_query ("SELECT * FROM user_types");
	
	while ($allUserTypes = mysql_fetch_array($getUserTypes)) {
?>
<option id="<?php echo $allUserTypes ['user_type_id']; ?>"><?php echo $allUserTypes ['user_type']; ?></option>
	<?php } ?>