<?php
	include_once ("topSection.php");
?>
<?php
	//IF THE SESSION USERNAME IS EMPTY, REDIRECT TO LOGIN SCREEN
	if (empty($_SESSION['username'])) {
	
		header ('location: index.php?nologin');
		die();
		exit();

	}	
?>
			<div class="content">
				<div class="container">
					<?php
					 
						$id=$_GET['id'];
						
						$getHeader = mysql_query ("select resource_description, resource_serial_number from resource_history where resource_id = \"$id\" order by transaction_date desc");
						$allHeader = mysql_fetch_array ($getHeader);
						
						echo "<h1>".$allHeader['resource_description']."</h1>";
						echo "<h2>S/N: ".$allHeader['resource_serial_number']."</h2>";
											
						echo "<div class='form-link'>";
							echo "<a href='update.php?id=".$id."'>Update Resource</a>";
						echo "</div>";
								
						echo "<div class='center-table'>";
							echo "<table>";
								echo "<tr>";
									echo "<th>State</th>";
									echo "<th>Condition</th>";
									echo "<th>Status</th>";
									echo "<th>Owner</th>";
									echo "<th>Location</th>";
									echo "<th>Transaction Date</th>";
									echo "<th>Updated By</th>";
								echo "</tr>";
						
						$getInfo = mysql_query ("select * from resource_history where resource_id = \"$id\" order by transaction_date desc");		
						
						while ($allInfo = mysql_fetch_array ($getInfo)) {

							echo "<tr>";
								echo "<td>" . $allInfo['resource_state'] . "</td>";			
								echo "<td>" . $allInfo['resource_condition'] . "</td>";
								echo "<td>" . $allInfo['resource_status'] . "</td>";
								echo "<td>" . $allInfo['owner_description'] . "</td>";
								echo "<td>" . $allInfo['resource_location'] . "</td>";
								echo "<td>" . $allInfo['transaction_date'] . "</td>";
								echo "<td>" . $allInfo['username'] . "</td>";								
							echo "</tr>";
					
						}									
							echo "</table>";
					?>
								<script type="text/javascript">
									$(document).ready(function () {
									$('table tr:nth-child(odd)').addClass('alt');
									});
								</script>	
					<?php
						echo "</div>";
					?>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
