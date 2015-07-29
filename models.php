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
	
	//GET DATA FROM RESOURCE MODELS TABLE AND INSERT INTO A LIST
	$getModels = mysql_query ("SELECT * FROM resource_models order by resource_model asc");
	
	while ($allModels = mysql_fetch_array($getModels)) {
?>
<option id="<?php echo $allModels ['resource_model_id']; ?>"><?php echo $allModels ['resource_model']; ?></option>
	<?php } ?>