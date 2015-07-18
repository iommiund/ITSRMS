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
	
	//VALIDATION
	if (empty($_GET['value'])){
	
		header ('location: searchResource.php?emptyfield');
		die();
		exit();

	} else {
	
		$where =$_GET['where']; 
		$condition =$_GET['condition'];
		$value =$_GET['value'];

	}
	
	//MAIN LOGIC
	
	//SEARCH BY DESCRIPTION	
	if (($where == 'Description') && ($condition == 'Is')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_description like \"%$value%\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Description') && ($condition == 'Is Not')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_description not like \"%$value%\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Description') && ($condition == 'Contains')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_description like \"%$value%\" group by rh_id order by rh_id asc");
	
	}
	
	//SEARCH BY SERIAL NUMBER
	else if (($where == 'Serial Number') && ($condition == 'Is')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_serial_number = \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Serial Number') && ($condition == 'Is Not')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_serial_number != \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Serial Number') && ($condition == 'Contains')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_serial_number like \"%$value%\" group by rh_id order by rh_id asc");
	
	}

	//SEARCH BY STATE
	else if (($where == 'State') && ($condition == 'Is')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_state = \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'State') && ($condition == 'Is Not')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_state != \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'State') && ($condition == 'Contains')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_state like \"%$value%\" group by rh_id order by rh_id asc");
	
	}

	//SEARCH BY CONDITION
	else if (($where == 'Condition') && ($condition == 'Is')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_condition = \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Condition') && ($condition == 'Is Not')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_condition != \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Condition') && ($condition == 'Contains')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_condition like \"%$value%\" group by rh_id order by rh_id asc");
	
	}

	//SEARCH BY STATUS
	else if (($where == 'Status') && ($condition == 'Is')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_status = \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Status') && ($condition == 'Is Not')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_status != \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Status') && ($condition == 'Contains')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_status like \"%$value%\" group by rh_id order by rh_id asc");
	
	}

	//SEARCH BY OWNER
	else if (($where == 'Owner') && ($condition == 'Is')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where owner_description like \"%$value%\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Owner') && ($condition == 'Is Not')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where owner_description not like \"%$value%\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Owner') && ($condition == 'Contains')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where owner_description like \"%$value%\" group by rh_id order by rh_id asc");
	
	}

	//SEARCH BY LOCATION
	else if (($where == 'Location') && ($condition == 'Is')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_location = \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Location') && ($condition == 'Is Not')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_location != \"$value\" group by rh_id order by rh_id asc");
	
	} else if (($where == 'Location') && ($condition == 'Contains')) {
		
		$getResource = mysql_query ("select rh2.* from (select resource_serial_number rsn, MAX(rh_id) mtd from resource_history rh1 group by rsn) maxid left join resource_history rh2 on rh2.rh_id = maxid.mtd where resource_location like \"%$value%\" group by rh_id order by rh_id asc");
	
	}

	
	//POPULATE TABLE ROWS WITH DATA FROM DATABASE
	while ($allRows = mysql_fetch_array ($getResource)) {
			
		//CREATING TABLE ROWS WITH RECIPE INFORMATION
		echo "<tr>";
			echo "<td>" . $allRows['resource_description'] . "</td>";
			echo "<td><a href='viewResource.php?id=" . $allRows['resource_id'] . "'>" . $allRows['resource_serial_number'] . "<a></td>";			
			echo "<td>" . $allRows['resource_state'] . "</td>";
			echo "<td>" . $allRows['resource_condition'] . "</td>";
			echo "<td>" . $allRows['resource_status'] . "</td>";
			echo "<td>" . $allRows['owner_description'] . "</td>";
			echo "<td>" . $allRows['resource_location'] . "</td>";						
		echo "</tr>";

	}
?>

