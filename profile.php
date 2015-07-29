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
		
			include_once ("dbc.php");
			
			$username=$_SESSION['username'];
			
			$getInfo = mysql_query ("select concat(u.user_name, ' ', u.user_surname) as FullName, u.email, ut.user_type as 'Type' from users u left join user_types ut on u.user_type_id = ut.user_type_id where u.username = \"$username\"");
			$allInfo = mysql_fetch_array ($getInfo);
		
			echo "<h1>".$allInfo['FullName']."</h1>";
			echo "<b>Profile Type:</b> ".$allInfo['Type']."<br>";
			echo "<b>Email:</b> ".$allInfo['email']."<br><br>";
			
		?>
		<div class="admin">
			<ul class="admin">
				<li><a href="resetPassword.php">Reset Password</a></li>
			</ul>
		</div>
	</div>
</div>
<?php
	include_once ("bottomSection.php");
?>
