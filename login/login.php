<?php 
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'accounts';

	function error($msg) {
		echo $msg;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		
	<!--===============================================================================================-->	
		<link rel="icon" type="image/png" href="../images/login.ico"/>
		<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
		<link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>"> <!-- This will force the css to load beacuse of some browser cache issues that the upper line won't work properly -->
	<!--===============================================================================================-->
	</head>
	<body>
		
		<div class="container">
			<div class="wrap-full p-l-55 p-r-55 p-t-80 p-b-30">
				<!-- Rainbow Text --> 
				<div>
					<h3 class="rainbow rainbow_text_animated">Guesser Game Login</h3>
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
			
					if($check_table_exists === FALSE) {
						$sql_create_table = "CREATE TABLE users
						( 
							ID INT(5) PRIMARY KEY AUTO_INCREMENT,
							USERNAME VARCHAR(35) NOT NULL,
							PASSWORD VARCHAR(35) NOT NULL
						) CHARACTER SET utf8 COLLATE utf8_general_ci";
						$create_table = $connection->query($sql_create_table);
									
						if($create_table === FALSE) {
							die("Fatal error! Table users cannot be created." .mysqli_connect_error());
						}
					}
				?>
				
				<form class="form"  method='post' action='login.php' enctype='multipart/form-data'>
					<span class="form-title p-b-37">Have an account?</span>

					<div class="wrap-input m-b-20">
						<input id="username" class="input" type="text" name="username" placeholder="username" value="">
						<span class="focus-input"></span>
					</div>

					<div class="wrap-input m-b-25">
						<input id="password" class="input" type="password" name="password" placeholder="password" value="" >
						<span class="focus-input"></span>
					</div>

					<span onclick="window.location.href='../changePassword/changePassword.php'" class="form-text m-b-20">Forgot your password?</span>
					
					<div class="container-form-btn">
						<input class="btn1" type="submit" id="login" name="login" value="login"/>
						<br>
						<br>
						<br>
						<span class="form-title p-b-37">Don't have an account?</span>
						<input class="btn2" type="submit" id="signup" name="signup" value="Sign up"/>
					</div>
				</form>
				<?php
					if (isset($_POST['login'])) 
					{
						echo "<div class=\"container-error m-t-20\">";
						$connection = new mysqli($hostname, $username, $password, $database);
		
						if ($connection == false) {
							die(mysqli_connect_error());
							error("ERROR: Could Not Connect To Database!");

						} else {
							if (empty($_POST["username"]) || empty($_POST["password"])) {
								error("Both fields are required!");

							} else {
								// Define $username and $password
								$username = $_POST['username'];
								$password = $_POST['password'];
								$query = "SELECT * FROM users WHERE USERNAME='$username' and PASSWORD='$password'";
								$result = $connection->query($query);
								$count = mysqli_num_rows($result);
								if ($count == 0) {	
									error("No Account With The Credentials You Entered Was Found!");
			
								} elseif ($count == 1) {
									header("Location: redirect.php? varname= $username");
									exit();

								} else {
									error("Something Is Wrong! Contact The Adminstration.");
								}
							}
						}
						echo "</div>";
					}
					if (isset($_POST['signup'])) 
						{
							header("Location: ../registration/registration.php");
							exit();
					}
				?>
				</div>	 
				<div class="footer">
					<footer>
						<p style="position: fixed; bottom: 0; left:5; width:100%; text-align: left; color: black; font-size: 10;">&copy; Copyright 2021 by Web Dev Titans</p>
					</footer>
				</div>
				
			</div>
		</div>
	</body>
</html>