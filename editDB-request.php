<? session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>

	<link rel="stylesheet" href="css/editDB-request.css">
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
	include_once 'cryptionFunctions.php';

	if(isset($_SESSION['username']) && $_SESSION['username']==encrypt("autoplicityAdmin")){ ?>


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


		if($_GET['action']=="addCar"){

			include_once 'connectDB.php';

			$sql = "SELECT * from dealership order by brand";
			$result = mysql_query($sql);
			$result = db_result_to_array($result);

			echo '
			<div style="margin-top:200%">
			<div class="heading" style="margin-top:50%">
				<h1>Enter Product Details</h1>
			</div>

			<form action="confirmDB-edit.php" method="POST" enctype="multipart/form-data">

				<div class="label">
					<label >Dealership: </label>
				</div>
				<div class="textbox" >
					<select name="dealership" style="width:160px; margin-right: 42px" >';
							foreach($result as $row){
								echo '<option value="'.$row["id"].'">'.$row["brand"].'</option>';
							}
					echo '</select>

				</div>
				<br><br><br>

				<div class="label">
					<label >Model: </label>
				</div>
				<div class="textbox">
					<input  type="text" placeholder="Model" name="model" size="28">
				</div>
				<br><br><br>

				<div class="label">
					<label >Upload front view image: </label>
				</div>
				<div class="textbox"  style="margin-right: -50px;">
					<input  type="File" name="frontImg">
				</div>

				<br><br><br>

				<div class="label">
					<label >Upload vack view image: </label>
				</div>
				<div class="textbox"  style="margin-right: -50px;">
					<input  type="File" name="backImg">
				</div>
				<br><br><br>

				<div class="label">
					<label >Price: </label>
				</div>
				<div class="textbox">
					<input  type="text" placeholder="Price" name="price"  size="28">
				</div>
				<br><br><br>

				<div class="label">
					<label >Production Year: </label>
				</div>
				<div class="textbox">
					<input  type="text" placeholder="Year" name="year" value="" size="28">
				</div>
				<br><br><br>

				<div class="label">
					<label >Horsepower: </label>
				</div>
				<div class="textbox">
					<input  type="text" placeholder="Horsepower" name="hp" value="" size="28">
				</div>
				<br><br><br>

				<div class="label">
					<label >Engine (Litres): </label>
				</div>
				<div class="textbox">
					<select name="engine" style="width:160px; margin-right: 42px" >';
						for($i=1; $i<=6; $i++){
							for($j=1; $j<10; $j++){
								echo '<option value="'.$i.'.'.$j.'">'.$i.'.'.$j.'</option>';
							}
						}
						
					echo '</select>
				</div>
				<br><br><br>

				<div class="label">
					<label >Doors: </label>
				</div>
				<div class="textbox">
					<select name="doors" style="width:160px; margin-right: 42px" >
						<option value="3">3 Door</option>
						<option value="4">4 Door</option>
						<option value="5">5 Door</option>
					</select>
				</div>
				<br><br><br>

				<div class="label">
					<label >Fuel: </label>
				</div>
				<div class="textbox">
					<select name="fuel" style="width:160px; margin-right: 42px" >
						<option value="Petrol">Petrol</option>
						<option value="Disel">Disel</option>
					</select>
				</div>
				<br><br><br>				

				<div class="label">
					<label >Transmission: </label>
				</div>
				<div class="textbox">
					<select name="trans" style="width:160px; margin-right: 42px" >
						<option value="Automatic">Automatic</option>
						<option value="Manual">Manual</option>
						<option value="Tiptroic">Tiptronic</option>
					</select>
				</div>
				<br><br><br>

				<div class="label">
					<label >A/C: </label>
				</div>
				<div class="textbox" style="width:160px; margin-right: 28px">
					<input  type="checkbox" name="ac" value="Yes">Yes</input>
				</div>
				<br><br><br>

				<div class="label">
					<label >GPS: </label>
				</div>
				<div class="textbox"  style="width:160px; margin-right: 28px">
					<input  type="checkbox" name="gps" value="Yes">Yes</input>
				</div>
				<br><br><br>

				<div class="label">
					<label >Central Locking: </label>
				</div>
				<div class="textbox"  style="width:160px; margin-right: 28px">
					<input  type="checkbox" name="locking" value="Yes">Yes</input>
				</div>
				<br><br><br><br>
				
				<div class="btn">
					<button type="submit" name="addCar">Add Car</button>
				</div>

			</form>
			</div>';

			mysql_close($link);



		}elseif($_GET["action"]=="addPart"){

			include_once 'connectDB.php';

			$sql = "select * from partsCatalogue order by name";
			$result = mysql_query($sql);
			$result = db_result_to_array($result);

			echo '
			<div class="heading" style="margin-top:50%">
				<h1>Enter Product Details</h1>
			</div>

			<form action="confirmDB-edit.php" method="POST" enctype="multipart/form-data">

				<div class="label">
					<label >Part Type: </label>
				</div>
				<div class="textbox" >
					<select name="part" style="width:160px; margin-right: 42px" >';
							foreach($result as $row)
							echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
					echo '</select>

				</div>
				<br><br><br>

				<div class="label">
					<label >Upload image: </label>
				</div>
				<div class="textbox"  style="margin-right: -50px;">
					<input  type="File" name="file">
				</div>

				<br><br><br>

				<div class="label">
					<label >Brand: </label>
				</div>
				<div class="textbox">
					<input  type="text" placeholder="Brand" name="brand" value="" size="28">
				</div>
				<br><br><br>

				<div class="label">
					<label >Price: </label>
				</div>
				<div class="textbox">
					<input  type="text" placeholder="Price" name="price" value="" size="28">
				</div>
				<br><br><br>

				<div class="label">
					<label >Additional Info: </label>
				</div>
				<div class="textbox"  style="width:160px; margin-right: 28px">
					<textarea cols="35" rows = "5" name="info" placeholder="Enter Here"></textarea>
				</div>
				<br><br><br><br>
				
				<div class="btn">
					<button type="submit" name="addPart">Add Part</button>
				</div>

			</form>';

			mysql_close($link);


		}elseif($_GET["action"]=="remCar") {

			include_once 'connectDB.php';
			$sql = "SELECT * FROM dealership order by brand";
			$result = mysql_query($sql);
			$result = db_result_to_array($result);

			echo '
			<div class="heading" style="margin-top:50%">
				<h1>Select a Dealership</h1>
			</div>

			<form action="selectProdToRemove.php" method="POST" enctype="multipart/form-data">

				<div class="label">
					<label >What is the car\'s brand? </label>
				</div>
				<div class="textbox" >
					<select name="dealership" style="width:160px; margin-right: 42px" >';
							foreach($result as $row)
							echo '<option value="'.$row["id"].'">'.$row["brand"].'</option>';
					echo '</select>
				</div>

				<br><br><br><br>
				
				<div class="btn">
					<button type="submit" name="nextCar">Next</button>
				</div>

			</form>';

			mysql_close($link);


		}elseif($_GET["action"]=="remPart"){

			include_once 'connectDB.php';
			$sql = "SELECT * FROM partsCatalogue ORDER BY name";
			$result = mysql_query($sql) or die("No items available");
			$result = db_result_to_array($result);

			echo '
			<div class="heading" style="margin-top:50%">
				<h1>Select Part Type</h1>
			</div>

			<form action="selectProdToRemove.php" method="POST" enctype="multipart/form-data">

				<div class="label">
					<label >What type of product? </label>
				</div>
				<div class="textbox" >
					<select name="part" style="width:160px; margin-right: 42px" >';
							foreach($result as $row)
							echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
					echo '</select>
				</div>

				<br><br><br><br>
				
				<div class="btn">
					<button type="submit" name="nextPart">Next</button>
				</div>

			</form>';

			mysql_close($link);



		}
		

	echo '</div>';

	}else{ echo '<p style="text-align:center;font-size:30px;color:red">You are not authrized to access this page! >_<</p>
		<p style="text-align:center;font-size:30px;color:#33bbff"><a href="welcomePage.php">Back to Home</a></p>';
	}

	?>

</body>
</html>';