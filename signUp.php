<? session_start(); ?>

<html>

	<head>
		<title>Sign up</title>
		<link rel="stylesheet" href="css/signUp.css">

		<style>
		body{
			background: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url(images/P1.jpg);
			background-size: cover;
			-webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
		}
	</style>
	</head>

	<body>

		<iframe src="Background Music/Six-Days.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

		<a href="loginPage.php"><img src="images/back.png" style="width:43px;height:43px; margin-top:5px;margin-left:5px;"></a>

		<div class="sign-up-box">
			
		<form action="signUpScript2.php" method="POST">
			<div class="heading">
				<h1>Registration</h1>
			</div>

			<label  style="color:#33BBFF;font-size:20px;padding:2px;border-bottom:2px #33BBFF solid; font-family: Magneto">Personal Details</label>
			<br><br>

			<div class="label">
				<label >First Name: </label>
			</div>
			<div class="textbox">
				
				<input  type="text" placeholder="First name" name="fname" value="" size="30">
			</div>
			<br><br><br>

			<div class="label">
				<label >Last Name: </label>
			</div>
			<div class="textbox">
				
				<input  type="text" placeholder="Last name" name="lname" value="" size="30">
			</div>
			<br><br><br>

			

			<div class="label">
				<label >ID Number: </label>
			</div>
			<div class="textbox">
				<input  type="text" placeholder="ID Number" name="id" value="" size="30" >
			</div>
			<br><br><br>
			
		
			
			<div class="label">
				<label >Email: </label>
			</div>
			<div class="textbox">
				
				<input  type="text" placeholder="Email" name="email" value="" size="30" >
			</div>
			
		


			<br><br><br><br><br>

			<label  style="color:#33BBFF;font-size:20px;padding:2px;border-bottom:2px #33BBFF solid; font-family: Magneto">Login Details</label>
			<br><br>

			<div class="label">
				<label >Username: </label>
			</div>
			<div class="textbox">
				
				<input  type="text" placeholder="(7+ Characters)" name="username" value="" size="30" >
			</div>
			<br><br><br>
			<div class="label">
				<label >Password: </label>
			</div>
			<div class="textbox">
				
				<input  type="password" placeholder="(7+ Characters)" name="pass" value="" size="30" >
			</div>
			<br><br><br>

			<div class="label" >
				<label >Confirm Password : </label>
			</div>
			<div class="textbox">
				
				<input  type="password" placeholder="Confirm Password" name="checkPass" value="" size="30" >
			</div>

			<br><br><br><br><br><br>

			<div class="btn">
				<input class="btn" type="submit" name="signUp-btn" value="Submit" style="width:100%; height: 40px;">
		    </div>

		 </form>

		</div>

	</body>

</html>