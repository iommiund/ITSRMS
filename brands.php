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
	$getBrands = mysql_query ("SELECT * FROM resource_brands order by resource_brand asc");
	
	while ($allBrands = mysql_fetch_array($getBrands)) {
?>
<option id="<?php echo $allBrands ['resource_brand_id']; ?>"><?php echo $allBrands ['resource_brand']; ?></option>
	<?php } ?>