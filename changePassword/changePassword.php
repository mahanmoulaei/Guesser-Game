<?php 
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'accounts';

	function error($msg) {
		echo $msg;
	}

	function message($msg) {
		echo $msg;
	}
?>
	<!DOCTYPE html>
<html>
		<head>
				<title>Password Modification Page</title>
				<!--===============================================================================================-->	
					<link rel="icon" type="image/png" href="../images/info.ico"/>
					<link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
				<!--===============================================================================================-->
		</head>
	<body>
		<div class="container">
			<div class="wrap-full p-l-55 p-r-55 p-t-80 p-b-30">
				<div>
					<h2 class="rainbow rainbow_text_animated">Change Password</h2>
					<!--<h3>Change password</h3>-->
					<p style="text-align:center;"> Update the password for your account</p><br>
				</div>
				<?php

				$connection=new mysqli($hostname, $username, $password);

				if ($connection->connect_error) {
					die("Fatal Error! Unable to connect to MySQL" .mysqli_connect_error());
				} else {
					$check_connect_to_db = mysqli_select_db($connection, $database);
					if ($check_connect_to_db === FALSE) {
						$sql_create_db = "CREATE DATABASE $database";
						$create_db = $connection->query($sql_create_db);
						if ($create_db === FALSE) {
							die("Fatal error! Database cannot be created." . mysqli_connect_error());
						} else {
							$check_connect_to_db = mysqli_select_db($connection, $database);
							if ($check_connect_to_db === FALSE) {
								die("Fatal error! Attempt to create Database. Connection unavailable.");
							}
						}                        
					}
				}		
							
				$sql_desc_table = "DESC users";
					$check_table_exists = $connection->query($sql_desc_table);
						
						if($check_table_exists === FALSE) 
						{
							$sql_create_table = "CREATE TABLE users
							( 
								ID INT(5) PRIMARY KEY AUTO_INCREMENT,
								USERNAME VARCHAR(35) NOT NULL,
								PASSWORD VARCHAR(35) NOT NULL
							) CHARACTER SET utf8 COLLATE utf8_general_ci";
							$create_table = $connection->query($sql_create_table);
										
							if($create_table === FALSE) 
							{
								die("Fatal error! Table users cannot be created." .mysqli_connect_error());
							}
						}
				?>

				<form class="form"  method='post' action='changePassword.php' enctype='multipart/form-data'>
					<!-- <div class="text-danger"></div> -->
					
					<div class="wrap-input m-b-20">
								<input for="inputEmail3" type="text" name="username" id="inputPassword3" placeholder="Existing username" class="input" required="required">
								<span class="focus-input"></span>
					</div>

					<div class="wrap-input m-b-20">
								<input for="inputPassword3" type="text" name="password" id="inputPassword3" placeholder="New Password" class="input" required="required">
								<span class="focus-input"></span>
					</div>

					<div class="wrap-input m-b-20">
								<input for="inputPassword3" type="text" name="password_confirmation" id="inputPassword3" placeholder="Re-enter New Password" class="input" required="required">
								<span class="focus-input"></span>
					</div>
				
					<div class="container-form-btn">
						<button class='btn1' type="submit" name="modify">Modify</button>
							<span class="form-title p-b-37">Login to your account</span>
						<button onclick="window.location.href='../login/login.php'" class='btn2'>Sign-In</button>
					</div>
				</form>

				<?php
					// $message = "";
					if(isset($_POST['modify']))
					{
						$formUsername = $_POST["username"];
						$formPassword = $_POST["password"];
						$formConfirm = $_POST["password_confirmation"];

						if( empty($formUsername) || empty($formPassword) || empty($formConfirm)){
							echo "<div class=\"container-error m-t-20\">";
								error("Fields must contain data.");
							echo "</div>";
						}else if($formPassword != $formConfirm){
							echo "<div class=\"container-error m-t-20\">";
								error("Passwords do not match");
							echo "</div>";
						}else{
							// check if username exists
							$query = "SELECT * FROM users WHERE USERNAME='{$formUsername}'";
							$data = $connection->query($query);
							$count = mysqli_num_rows($data);
							if ($count == 0) {	
								echo "<div class=\"container-error m-t-20\">";
									message("No Account With The Username You Entered Was Found!");
								echo "</div>";
								
							} else {
							
								$connection->query("UPDATE users SET PASSWORD = '{$formPassword}' WHERE USERNAME = '{$formUsername}'");
								// $message = "Success";
								echo "<div class=\"container-msg m-t-20\">";
									message ("Success!");
								echo "</div>";
							}
						}
					}
				?>
						</div>        
						<div class="footer">
							<footer>
								<p style="position: fixed; bottom: 0; left:5; width:100%; text-align: left; color: black; font-size: 12;">&copy; Copyright 2021 by Web Dev Titans</p>
							</footer>
        				</div>          
			</div>
		</div>	
	</body>
</html>
