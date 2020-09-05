<? session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" href="css/admin.css">
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

	<?	
		$page = "admin";
		include_once 'header.php';
		include_once 'navTop.php';
		include_once 'cryptionFunctions.php';

		if(isset($_SESSION['username']) && $_SESSION['username']==encrypt("autoplicityAdmin")){
			include_once('navTop.php');
	

		if($_GET["message"] == "delete")
			echo '<p style="text-align:center;font-size:20px;color:red">Delete was succesful! </p>';
		elseif($_GET["message"]=="add")
			echo '<p style="text-align:center;font-size:20px;color:#04FF00">Succesfully added!! </p>';
		

	?>

	
	<div class="container">
		<? if(isset($_SESSION['username'])){ ?>
		
		<div class="car" style="padding:2px;margin-bottom:40px;">

			<p class="heading" >Edit Cars Database</p>

			<div class="box" style="border:5px #04FF00 solid">
				<div class="imgBox">
					<form action="editDB-request.php" action="GET">
					<input name="action" type="hidden" value="addCar">
					<button type="submit"><img src="images/addCar2.jpg"></button>
				</form>
				</div>
			</div>

			<div class="box"  style="border:5px red solid">
				<div class="imgBox">
					<form action="editDB-request.php" action="GET">
					<input name="action" type="hidden" value="remCar">
					<button type="submit"><img src="images/remCar2.jpg"></button>
				</form>
				</div>
			</div>
		</div>
		
		<br><br><br><br><br>

		<div class="part" style="padding:2px;">

			<p class="heading">Edit Parts Datbase</p>

			<div class="box"  style="border:5px #04FF00 solid">
				<div class="imgBox">
					<form action="editDB-request.php" action="GET">
					<input name="action"type="hidden" value="addPart">
					<button type="submit"><img src="images/addPart2.jpg"></button>
				</form>
				</div>
			</div>


			<div class="box"  style="border:5px red solid">
				<div class="imgBox">
					<form action="editDB-request.php" action="GET">
						<input name="action"type="hidden" value="remPart">
					<button type="submit"><img src="images/remPart2.jpg"></button>
				</form>
				</div>
			</div>
		</div>

	<? }else echo '<p style="text-align:center;font-size:30px;color:red">You are not authrized to access this page! >_<</p>'; ?>

	</div>

	<? } else{
		echo '<p style="text-align:center;font-size:30px;color:red">You are not authrized to access this page! >_<</p>
			<p style="text-align:center;font-size:30px;color:#33bbff"><a style="border-bottom:2px solid purple"href="welcomePage.php">Back to Home</a></p>
		'; 
	}

 include_once 'navBottom.php' ?>

</body>
</html>