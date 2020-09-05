<? session_start() ;
$page ="sell"?>
<html>

<head>
	<title>Sell</title>
	<link rel="stylesheet" href="css/sell.css">
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


	<iframe src="Background Music/Six-Days.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

	<a href="welcomePage.php"><img src="images/back.png" style="width:43px;height:43px; margin-top:5px;margin-left:5px;"></a>

	<div class="box">

		<div class="heading">
			<h1>Enter Product Details</h1>
		</div>

		<form action="upload.php" method="POST" enctype="multipart/form-data">

			<div class="label">
				<label >Product: </label>
			</div>
			<div class="textbox" >
				<select name="product" style="width:160px; margin-right: 42px" >
					<option>Car</option>
					<option>Exhaust</option>
					<option>Headlight</option>
					<option>Gauge</option>
					<option>Tyre</option>
					<option>Rim</option>
					<option>Battery</option>
				</select>

			</div>
			<br><br><br>

			<div class="label">
				<label >Upload Image: </label>
			</div>
			<div class="textbox"  style="margin-right: -50px;">
				<input  type="File" name="file">
			</div>
			<br><br><br>

			<div class="label">
				<label >Price (R): </label>
			</div>
			<div class="textbox">
				<input  type="text" placeholder="Price" name="price" value="" size="28">
			</div>
			<br><br><br>

			<div class="label">
				<label >Additonal Information:</label>
			</div>
			<div class="textbox">
				<textarea cols="35" rows = "5" name="info" placeholder="20-40 Characters"></textarea>
			</div>
			<br><br><br><br><br><br>
			
			<? 
				if(isset($_SESSION['username'])){
					echo '<div class="btn">
							   <button type="submit" name="submit">Upload Ad</button>
						  </div>';
				}else{
					echo '<div class="btn">
							  <a style ="margin-left:35%;color:#33bbff; padding:10px; 2px;; border:2px #33bbff solid; border-radius:2px;" href="loginPage.php"> Login to Sell</a>
						  </div>';
				}
			?>
			

		</form>

	</div>

</body>

</html>