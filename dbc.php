<?php
		
	//INCLUDING CONFIG.PHP
	include_once ('/Setup/Config/config.php');
		
	//selecting database					
	mysql_select_db(DB_NAME) or die ("Error connecting to database on mysql server: ".mysql_error());

?>