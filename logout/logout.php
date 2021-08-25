<?php

session_start(); 

unset($_SESSION["id"]);
unset($_SESSION["name"]);

?>
<html>
	<head>
        <title>Logout Page</title>
        	<!--===============================================================================================-->	
                <link rel="icon" type="image/png" href="../images/logout.ico"/>
                <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
            <!--===============================================================================================-->
    </head>
		<body>
			<div class="container">
				<div class="wrap-full p-l-55 p-r-55 p-t-80 p-b-30">
					<div>
						<h2 class="rainbow rainbow_text_animated">Signed out</h2>
						<h3> Goodbye! </h3><br>
						<p> You have successfully logged out! <br> See you next time! </p><br><br>
					</div>
							
					<form class="form"  method='POST' action='logout.php'>
							<div class="container-form-btn">
								<input class="btn2" type="submit" id="login" name="signup" value="Back to login page"/>
							</div>   
					</form>
					<?php
						if (isset($_POST['signup'])) 
						{
							header("Location: ../login/login.php");
							exit();
						}
					?>
				</div>
				<div class="footer">
						<footer>
							<p style="position: fixed; bottom: 0; left:5; width:100%; text-align: left; color: black; font-size: 12;">&copy; Copyright 2021 by Web Dev Titans</p>
						</footer>
				</div>        
			</div>
		</body>
</html>

