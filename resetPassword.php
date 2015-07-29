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
					<div class="form-style">
						<h1>Reset Password</h1>
	
						<form action="resetPassword_submitted.php" method="post">
							<input type="text" name="formUsername" value="<?php $username=$_SESSION['username']; echo $username; ?>" disabled/>
							<input type="password" name="oldPassword" placeholder="Old Password" required="required"/>
							<input type="password" name="newPassword" placeholder="New Password" required="required"/>
							<input type="submit" value="SUBMIT" />
						</form>
						
						<br>
						<!--ERROR MESSAGES-->
						<div class="form-link">
							<?php
								if (isset($_GET['emptyfield'])) {
									echo "<div id='error'>One or more fields were empty, try again!</div>";
								} else if (isset($_GET['error'])) {
									echo "<div id='error'>Incorrect Password!!!!</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
<?php
	include_once ("bottomSection.php");
?>
