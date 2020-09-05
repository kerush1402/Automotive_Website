<? session_start() ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>

	<link rel="stylesheet" href="editDB.css">
	<link rel="stylesheet" href="css/selectProdToRemove.css">
	<style >
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

	<?
	
	include_once 'header.php';
	include_once 'navTop.php';
	if(isset($_SESSION['username'])){ ?>
	<iframe src="Background Music/Six-Days.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

	<a href="admin.php"><img src="images/back.png" style="width:43px;height:43px; margin-top:5px;margin-left:5px;"></a>

	<div class="box">


		<?

			function db_result_to_array($result){
				$res_array = array();

				for($count=0; $row= @mysql_fetch_array($result); $count++)
					$res_array[$count] = $row;
					
				return $res_array;
			}

			if(isset($_POST["nextCar"])){

				include_once('connectDB.php');

				$dealershipID = $HTTP_POST_VARS["dealership"];
			
				$result = mysql_query("SELECT * from cars WHERE id like 'C$dealershipID%'");
				$result = db_result_to_array($result);


					echo '

				<div class="box">
				<div class="heading" style="margin-top:50%">
					<h1>Select Car to Delete</h1>
				</div>	
				<br><br>

				<form action="confirmDB-edit.php" method="POST" enctype="multipart/form-data">

					<div class="label" style="text-align:center">
						<label >Select Car to Remove:</label>
					</div>
					<br>
					<div class="textbox" style="text-align:center">
						<select name="car" style="width:160px; margin-right: 0px" >';
								foreach($result as $row)
								echo '<option value="'.$row["id"].'">'.$row["model"].'</option>';
						echo '</select>
					</div>

					<br><br><br>
					
					<div class="btn">
						<button type="submit" name="remCar">Next</button>
					</div>

				</form>
				<div>';

				mysql_close($link);



			}elseif (isset($_POST["nextPart"])){
				include_once('connectDB.php');

				$part = $HTTP_POST_VARS["part"];
				$result = mysql_query("SELECT * from parts WHERE id like 'P".$part."%'");
				$result = db_result_to_array($result);


					echo '
				<div class="box">
				<div class="heading" style="margin-top:50%">
					<h1>Select Part to Delete</h1>
				</div>
				<br><br>

				<form action="confirmDB-edit.php" method="POST" enctype="multipart/form-data">

					<div class="label" style="text-align:center">
						<label >Select Product to Remove:</label>
					</div>
					<br>
					<div class="textbox" style="text-align:center">
						<select name="part" style="width:385px; margin-right: 42px" >';
								foreach($result as $row)
								echo '<option value="'.$row["id"].'">'.$row["make"].'-'.$row["price"].'-'.$row["info"].'</option>';
						echo '</select>
					</div>

					<br><br><br>
					
					<div class="btn">
						<button type="submit" name="remPart">Next</button>
					</div>

				</form>
				</div>';

				mysql_close($link);


			}


		?>


	</div>

	<? }else echo '<p style="text-align:center;font-size:30px;color:red">You are not authrized to access this page! >_<</p>
	<p style="text-align:center;font-size:30px;color:#33bbff"><a href="welcomePage.php">Back to Home</a></p>'; ?>

</body>

</html>