<?php
	function error($msg) {
		echo $msg;
	}

	function message($msg) {
		echo $msg;
	}
?>

<html>	
		<head>
			<title>Registration Page</title>
			<!--===============================================================================================-->	
				<link rel="icon" type="image/png" href="../images/form.ico"/>
				<link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
			<!--===============================================================================================-->
		</head>			
	<body>
		<div class='container'>
			<div class="wrap-full p-l-55 p-r-55 p-t-80 p-b-30">
				<div>
					<h2 class="rainbow rainbow_text_animated">Registration page</h2>
					<!--<h3> Welcome! </h3>-->
					<p style="text-align:center;"> Fill up your information and become a new member! </p><br>
				</div>
						
				<form action="registration.php" method="POST">
							<div class="wrap-input m-b-20">
								<input type="text" name="name" placeholder="Enter username" class="input" required="required">
								<span class="focus-input"></span>
							</div>
							
							<div class="wrap-input m-b-20">
								<input type="password" name="psw" placeholder="Enter password" class="input" required="required">
								<span class="focus-input"></span>
							</div>

							<div class="wrap-input m-b-20">
								<input type="password" name="cpsw" placeholder="Re-enter password" class="input" required="required">
								<span class="focus-input"></span>
							</div>
							
							<div class="container-form-btn">
								<button class='btn1' type="submit" name="submit">Create</button>
								<span class="form-title p-b-37">Access your new account</span>
								<button onclick="window.location.href='../login/login.php'" class='btn2'>Sign-In</button>
							
					<?php
					
					if (isset($_POST['submit']))
					{
						echo "<div >";
						$hostname = 'localhost';
						$username = 'root';
						$password = '';
						$database = 'accounts';

						$connection = new mysqli($hostname, $username, $password, $database);
						$psw = "";
						$cpsw = "";
						$name = "";
						$valid = true;
						$sql = "";
						$sqlps = "PASSWORD";
						
						if ($connection->connect_error) 
						{
							die("Fatal Error Connection");
						}
						else
						{
							$query = "SELECT * FROM users";
							$result = $connection->query($query);
							if (!$result) 
							{
								die("Fatal Error Query");
							}
							
							else
							{
								$rows = $result->num_rows;
								$name = $_POST['name'];
								$psw = $_POST['psw'];
								$cpsw = $_POST['cpsw']; 

								for($i = 0; $i<$rows; ++$i)
								{
									$result -> data_seek($i);
									if($result -> fetch_assoc()['USERNAME'] == $name)
									{
										echo "<div class=\"container-error m-t-20\">";
											error("This username already exists!");
										echo "</div>";
										$valid = false;
									}
								}
								
								if ($psw != $cpsw) 
								{
									echo "<div class=\"container-error m-t-20\">";
										error("You entered 2 different passwords!");
									echo "</div>";
									$valid = false;
								}

								if($valid != false)
								{
									$sql = "INSERT INTO users (USERNAME," . $sqlps . ") 
									VALUES ('" . $name . "', '" . $psw . "')";
									if($connection->query($sql) === TRUE)
									{
										echo "<div class=\"container-msg m-t-20\">";
											message("Created!");
										echo "</div>";
									}

									$connection ->close();
								}
							}
							echo "</div>";
						}
					echo "</div>";
				}
				?>		
				</form>
				
				<div class="footer">
					<footer>
						<p style="position: fixed; bottom: 0; left:5; width:100%; text-align: left; color: black; font-size: 12;">&copy; Copyright 2021 by Web Dev Titans</p>
					</footer>
				</div>
			</div>
		</div>
	</body>
</html>