<? session_start(); ?>

<html>

<head>
	<title>dealership</title>
	<link rel="stylesheet" href="css/searchResults.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
</head>

<body class = "body" >



	<a href="advancedSearch.php">
		<img src="images/back.png" style="width:43px;height:43px; margin-top:5px;margin-left:5px;float:left;">
	</a>


	<? include_once('header.php') ?>


	<div class="container">

		<?php

		
		function db_result_to_array($result){
			$res_array = array();

			for($count=0; $row= @mysql_fetch_array($result); $count++)
				$res_array[$count] = $row;
			return $res_array;
		}



		if(isset($_POST['search-car'])){

			if(!isset($_POST['dealership']) || $_POST['dealership']==""){
				echo 'You did not select a dealership!';
			}else{
				
				if($_POST['transmission']==""){
					echo 'Select a transmission!';
				}else{


					$dealership = trim($_POST['dealership']);
					$prodYear = trim($_POST['prodYear']);
					$trans = trim($_POST['transmission']);
					$priceLimit = trim($HTTP_POST_VARS['price-car']);
					// print $dealership;
					// print $prodYear;
					// print $trans;
					// print $priceLimit;

					if($_POST['price-car'] == ""){
						$priceLimit = 500000000;
					}


							// print $dealership;
							// print $prodYear;
							// print $trans;
							// print $priceLimit;
							// print "<br>";
					include_once 'connectDB.php';

					$result = mysql_query("SELECT * from dealership where brand like '%$dealership%'");


					$result = db_result_to_array($result);
					$dealershipID = $result[0][0]; 
							//print $dealershipID;

					$searchCar = "C".$dealershipID."%";

					$result = mysql_query("SELECT * from cars where id like '$searchCar%' and price <= $priceLimit and trans like '%$trans%' and prodYear like '%$prodYear%'");

					if(mysql_num_rows($result)>0){
						$result = db_result_to_array($result);
						foreach($result as $row){

							print "<div class=\"box\">";

							print "<div class=\"imgBox\">";
							$picID = $row["id"]."-1";
							print "<img src=\"images/car-images/".$picID.".jpg\">";
							print "</div>";

							print "<div>";


							print "<h2 class=\"brand\">".$row["model"]."</h2>";
							print "<br><br><br>";
							print "<h2 style=\"color:red;float:left\" class=\"price\">R".number_format($row["price"],2)."</h2><br><br>";
							print "</div>";
							print "<br><br>";

							print "<div class=\"check\" style=\"float:right;margin-top:10%;margin-right:15px;\">";
							$url = "carDescription.php?carID=".$row["id"]."&&dealershipID=".$dealershipID."";

							print "<a href=".$url."><button style=\"background:none; height:40px;color:white;width:100px;border-radius:3px;border:2px solid #33BBFF\" name =\"checkoutButton\" type=\"submit\" >View More</button></a>";
							print "</div>";

							print "</div>";
						}

						mysql_close($link);
					}else
					echo 'Sorry :(.. No results found';


			}//trans is selected

	}//dealership is selected

}elseif(isset($_POST['search-part'])){	

	if(!isset($_POST['part']) || $_POST['part']==""){
		echo 'You did not select a part!';
	}else{
		if(empty($_POST['price-part'])){
			echo 'Enter a price limit';
		}else{


			$part = $_POST['part'];
			$priceLimit = $HTTP_POST_VARS['price-part'];

			include_once 'connectDB.php';

			$result = mysql_query("SELECT * from partsCatalogue where name='$part'");

			$result = db_result_to_array($result);
			$partID = $result[0][0];

			$name = $part;

			$search = "P".$partID;
			$result = mysql_query("SELECT * from parts where id like '$search%' and price <= $priceLimit");

			if(mysql_num_rows($result)>0){
				$result = db_result_to_array($result);

				foreach($result as $row){
					$name .= " - ".$row["make"];
					print "<div class=\"box\">";
					print "<div class=\"imgBox\">";
					print "<img src=\"images/part-images/".$row["id"].".jpg\">";
					print "</div>";

					print "<div>";
					print "<h2 class=\"brand\">".$row["make"]."</h2>";
					print "<h2 class=\"price\">R".number_format($row["price"],2)."</h2>";
					print "</div>";

					print "<div class=\"details\">";
					print "<p>".$row["info"]."</p>";
					print "</div>";

					print "<div class=\"check\">";
					print "<form class=\"checkout\" action=\"cart.php?id=".$row["id"]."&&name=".$name."&&price=
					".$row["price"]."\" method=\"POST\">";

					print "<button name =\"checkoutButton\" type=\"submit\" ><img name=\"checkout\" src=\"images/
					checkout.png\"><span>Add to cart</span></button>";
					print "</form>";
					print "</div>";
					print "</div>";
				}

				mysql_close($link);
			}else
			echo 'Sorry :(.. No results found';


		}//everything entered

	}//part selected


}elseif(isset($_POST['search-used'])){

	
	if(!isset($_POST['item']) || $_POST['item']==""){
		echo 'You did not select an item!';
	}else{

		if(empty($_POST['price-used'])){
			echo 'Enter a price limit!';
		}else{
			$item = trim($_POST['item']);
			$priceLimit = trim($HTTP_POST_VARS['price-used']);

			$fp = fopen("ads.txt","r");

			if(!$fp){
				echo "No Used Items!";
				exit();
			}

			while (!feof($fp) ) {
				$ad = trim(fgets($fp));

				if($ad != ""){
					$arr = explode(':',$ad);
					$user = trim($arr[0]);
					$picName = trim($arr[1]);
					$prodType =trim($arr[2]);
					$price = trim($arr[3]);
					$info = trim($arr[4]);
					
		

					if($item === $prodType && $price <= $priceLimit){

					print "<div class=\"box\">";
					//print "\"images/uploads/".$picName."\">";

						print "<div class=\"imgBox\">";
							print "<img src=\"images/uploads/".$picName."\" alt=\"No images available\">";
						print "</div>";
						
						print "<div>";
							
							print "<h2 class=\"brand\">".$prodType."</h2>";
							print "<h2 class=\"price\">".number_format($price,2)."</h2>";
						print "</div>";
						print"<div class=\"details\">";
						print "<p>".$info."
							  </p>
						      </div>";
						$prodType .= " (Used)";
						print "<div class=\"checkoutItem\">";
							print "<form class\"checkoutItem\" method=\"POST\" action=\"cart.php?id=".$picName."&&name=".$prodType."&&price=".$price."\">";
							print "<div class=\"cl\">";	

								if(isset($_SESSION['username'])){
								print "<button name =\"checkoutButton\" type=\"submit\" ><img name=\"checkout\" src=\"images/
								checkout.png\"><span>Add to cart</span></button>";
							}else{
								print "<a href=\"loginPage.php\"><img src=\"images/checkout.png\"><span>Login To Buy</span></a>";
							}
							print "</div>";
							print "</form>";
						print "</div>

					</div>";
					}
				}

				
		}//while not eof
		fclose($fp);

	}//everything entered
}//item selected



}else{
	//header("Location: advancedSearch.php");
}

?>


</div><!--container-->



<?php

//include_once('footer.php');
?>

</body>

</html>