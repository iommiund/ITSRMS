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
	
	$getHelpTopics = mysql_query ("SELECT h.help_id, h.help_subject, hl.help_level FROM help h LEFT JOIN help_levels hl ON h.help_level_id = hl.help_level_id");
	
	//POPULATE TABLE ROWS WITH DATA FROM DATABASE
	while ($allTopics = mysql_fetch_array ($getHelpTopics)) {
			
		//CREATING TABLE ROWS WITH HELP TOPIC INFORMATION
		echo "<tr>";
			echo "<td><a href='modifyHelpTopic.php?id=" . $allTopics['help_id'] . "'>" . $allTopics['help_subject'] . "</a></td>";
			echo "<td>" . $allTopics['help_level'] . "</td>";					
		echo "</tr>";

	}
?>

