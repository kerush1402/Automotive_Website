<? session_start(); ?>

<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="css/loginPage.css">
	<link rel="stylesheet" href="css/dealership.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">

	<style>
		body{
			background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/P1.jpg)  no-repeat center center fixed ;
			-webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
		}
	</style>

</head>

<body>

	<iframe src="Background Music/Hush.mp3" allow="autoplay" id="audio" style="display:none"></iframe>


	<?php
	include_once('navTop.php');

	
	?>
	<form action="loginScript.php" method="POST">
		<div class="hero" style="margin-top: 75px;">

			<div class="login-box">
				<h1 style="margin-left:26%">Login</h1>
				
				<?
					if($_GET["signUp"] == "sucess"){
						echo '<p style="color:#04FF00; margin-left:5%;font-size:20px;"> Sucessfully Signed Up</p>';
					}
				?>

				<div class="textbox">
					<i class="fa fa-user" aria-hidden="true"></i>
					<input class="btn" type="text" placeholder="Username" name="username" value="">
				</div>

				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input type="password" placeholder="Password" name="password" value="">
				</div>

				<input class="btn" type="submit" name="login-btn" value="Sign In">
				
				
				<a style="margin-left:18%" href="signUp.php" class="signUp">New User? Sign Up</a>
			</div>


		</div>
	</form>


	<?php
	include_once('navBottom.php');
	?>



</body>

</html>