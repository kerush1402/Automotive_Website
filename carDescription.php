<? session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Description</title>
	<link rel="stylesheet" href="css/carDescription.css">

	<style>
		body{
			background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/wallpaper.jpg)  no-repeat center center fixed ;
			-webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
		}
	</style>
</head>
<body>

	<a href="carsCatalogue.php?dealershipID=<?php echo $_GET['dealershipID'] ?> ">
		<img src="images/back.png" style="width:43px;height:43px; margin-top:5px;margin-left:5px;float:left;">
	</a>

	<div class="main" style="margin-left:20%;margin-top:1%;">

		<div class="slide-container">
			<span id="slider-image-1"></span>
			<span id="slider-image-2"></span>
			<div class="image-container">
				<?php
				print "<img src=\"images/car-images/".$carID."-2.jpg\" class=\"slider-image\">";
				print "<img src=\"images/car-images/".$carID."-1.jpg\" class=\"slider-image\">";
				?>
			</div>
			<div class="button-container">
				<a href="#slider-image-1" class="slider-button"></a>
				<a href="#slider-image-2" class="slider-button"></a>
			</div>
		</div>

		<div class="specs">
			<?php 

			include_once('connectDB.php');

			$carID = $HTTP_GET_VARS["carID"];
			$dealershipID = $HTTP_GET_VARS["dealershipID"];
			$result = mysql_query("SELECT * from cars WHERE id like '%$carID%'");
			$result = db_result_to_array($result);
			display_cars($result);

			foreach ($result as $row ){
				$model = $row["model"];
				$make = $row["make"];
				$price = $row["price"];
			}
			$name = $make." ".$model;
					// print $name;
					// print $price;
			print "<form class=\"checkout\" action=\"cart.php?action=add&&id=".$carID."&&name=".$name."&&
			price=".$price."\" method=\"POST\">";

			if(isset($_SESSION['username'])){
				print "<button name =\"checkoutButton\" type=\"submit\" ><img name=\"checkout\" src=\"images/
				checkout.png\" style = height = 10px><span>Add to cart</span></button>";
			}else{
				print "<a href=\"loginPage.php\"><img src=\"images/checkout.png\"><span>Login To Buy</span></a>";
			}


			// print "<button name =\"checkoutButton\" type=\"submit\" ><img name=\"checkout\" src=\"images/
			// checkout.png\"><span>Add to cart</span></button>";
			// 		//print "<input type=\"image\" name=\"checkoutButton\" src=\"images/checkout.png\"><span>Add to cart</span>";
			print "</form";


			function db_result_to_array($result){
				$res_array = array();

				for($count=0; $row= mysql_fetch_array($result); $count++)
					$res_array[$count] = $row;
				return $res_array;
			}

			function display_cars($result){


				foreach($result as $row){
					print " <div class=\"description\">";
					print	"<div class=\"name\">".$row["model"]."</div>";
					print	"<div class=\"price\" >R".number_format($row["price"],2)."</div>";
					print "</div>";

					print "<div class=\"th\">Specs</div><br>";
					print "<table class=\"table\" width=\"100%\" >";
					print "<tr>";
					print	"<td style=\"width:60px\">Make:</td><td style=\"width:20px\">".$row["make"]."</td>";
					print "</tr>";
					print "<tr>";
					print "<td style=\"width:60px\">Model:</td><td style=\"width:20px\">".$row["model"]."</td>";
					print "</tr>";
					print "<tr>";
					print "<td style=\"width:60px\">Year:</td><td style=\"width:20px\">".$row["prodYear"]."</td>";
					print "</tr>";
					print "<tr>";
					print "<td style=\"width:60px\">Engine(litre):</td><td style=\"width:20px\">".$row["engine"]."</td>";
					print "</tr>";
					print "<td style=\"width:60px\">Transmission:</td><td style=\"width:20px\">".$row["trans"]."</td>";
					print "</tr>";
					print "<tr>";
					print "<td style=\"width:60px\">Horse Power</td><td style=\"width:20px\">".$row["hp"]."</td>";
					print "</tr>";
					print "<tr>";
					print "<td style=\"width:60px\">Fuel:</td><td style=\"width:20px\">".$row["fuel"]."</td>";
					print "</tr>";
					print "<tr>";
					print "<td style=\"width:60px\">Number of doors:</td><td style=\"width:20px\">".$row["doors"]."</td>";
					print "</tr>";
					print "	<tr>";
					print "<td style=\"width:60px\">A/C:</td><td style=\"width:20px\">".$row["ac"]."</td>";
					print "</tr>";
					print "	<tr>";
					print "<td style=\"width:60px\">Remote Locking:</td><td style=\"width:20px\">".$row["remLock"]."</td>";
					print "</tr>";
					print "	<tr>";
					print "<td style=\"width:60px\">GPS:</td><td style=\"width:20px\">".$row["gps"]."</td>";
					print "</tr>";

					print "</table>";

					print "<br><br>";

				}
			}


			?>
			



		</div>

	</div>


</body>
</html>