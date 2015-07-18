<?php
	include_once ("topSection.php");
?>
<?php
	if (empty($_SESSION['username'])) {
	
		header ('location: index.php?nologin');
		die();
		exit();

	}	
?>
	<div class="content">		
									
		<div class="center-table">
			<p><b>Tip:</b> Click on the resource S/N to view full history or update the details of that resource.</p>
			<table>
				<tr>
					<th>Description</th>
					<th>S/N</th>
					<th>State</th>
					<th>Condition</th>
					<th>Status</th>
					<th>Owner</th>
					<th>location</th>
				</tr>
				<?php
				
					include_once ("searchLogic.php");
					
				?>
			</table>
			<script type="text/javascript">
				$(document).ready(function () {
				$('table tr:nth-child(odd)').addClass('alt');
				});
			</script>	
		</div>

	</div>
<?php
	include_once ("bottomSection.php");
?>
