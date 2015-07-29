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
	
	//MAIN LOGIC
	
	$getLowStock = mysql_query ("SELECT rh1.resource_description AS 'description', rh1.resource_location AS 'location', COUNT(*) qty FROM (SELECT resource_serial_number rsn, MAX(rh_id) mid FROM resource_history rh GROUP BY rsn) max LEFT JOIN resource_history rh1 ON max.mid = rh1.rh_id WHERE rh1.resource_location IN ('Technology - IT Support - Store A' , 'Technology - IT Support - Store B') GROUP BY description , location HAVING qty < 10 ORDER BY qty DESC");
	
	//POPULATE TABLE ROWS WITH DATA FROM DATABASE
	while ($lowStock = mysql_fetch_array ($getLowStock)) {
			
		//CREATING TABLE ROWS WITH STOCK INFORMATION
		echo "<tr>";
			echo "<td>" . $lowStock['description'] . "</td>";
			echo "<td>" . $lowStock['location'] . "</td>";			
			echo "<td>" . $lowStock['qty'] . "</td>";					
		echo "</tr>";

	}
?>

