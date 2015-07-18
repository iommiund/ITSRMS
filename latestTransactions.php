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
	
	//MAIN LOGIC
	
	$getLatestTransactions = mysql_query ("SELECT resource_description, resource_serial_number, resource_state, resource_condition, resource_status, owner_description, resource_location, transaction_date, username FROM resource_history ORDER BY rh_id DESC LIMIT 10");
	
	//POPULATE TABLE ROWS WITH DATA FROM DATABASE
	while ($latestTransactions = mysql_fetch_array ($getLatestTransactions)) {
			
		//CREATING TABLE ROWS WITH RECIPE INFORMATION
		echo "<tr>";
			echo "<td>" . $latestTransactions['resource_description'] . "</td>";
			echo "<td>" . $latestTransactions['resource_serial_number'] . "</td>";
			echo "<td>" . $latestTransactions['resource_state'] . "</td>";			
			echo "<td>" . $latestTransactions['resource_condition'] . "</td>";
			echo "<td>" . $latestTransactions['resource_status'] . "</td>";
			echo "<td>" . $latestTransactions['owner_description'] . "</td>";
			echo "<td>" . $latestTransactions['resource_location'] . "</td>";
			echo "<td>" . $latestTransactions['transaction_date'] . "</td>";
			echo "<td>" . $latestTransactions['username'] . "</td>";					
		echo "</tr>";

	}
?>