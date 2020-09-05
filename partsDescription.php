<? session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Description Parts</title>
	<link rel="stylesheet" type="text/css" href="css/partsDescription.css">

</head>
<body>

	<iframe src="Background Music/tokyo-drift-song.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

	<a href="partsCatalogue.php">
		<img src="images/back.png" style="margin-left:20px;width:43px;height:43px; margin-top:5px;margin-left:5px;float:left">
	</a>

	<!-- header w/ logo & login,checout & nav -->
	<?php include_once('header.php') ?>



	<div class="container">

		<?php 

		include_once('connectDB.php');


		function db_result_to_array($result){
			$res_array = array();

			for($count=0; $row= mysql_fetch_array($result); $count++)
				$res_array[$count] = $row;
			return $res_array;
		}

		


		
		

		$partID = $HTTP_GET_VARS["partID"];
		
		$resultsPerPage = 6;


		$result = mysql_query("SELECT * from parts WHERE id LIKE '%P$partID%'");
		$numOfResults = mysql_num_rows($result);
		// print $numOfResults;
		// print "<br>";

		$numOfPages =ceil($numOfResults/$resultsPerPage);
		// print $numOfPages;
		// print "<br>";

		//determin page num currently on
		if(isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = 1;

		//determine the sql limit starting number for results in displaying page
		$thisPageStartLimitNum = ($page-1)*$resultsPerPage;


		//create query to retireve from tb
		$result = mysql_query("SELECT * from parts WHERE id LIKE '%P$partID%' LIMIT $thisPageStartLimitNum,$resultsPerPage");

		

		

		while( $row = mysql_fetch_array($result)){

			print "<div class=\"box\">";
			print "<div class=\"imgBox\">";
			print "<img src=\"images/part-images/".$row["id"].".jpg\">";
			print "</div>";
			if($partID==1)
				$name= "Exhaust -";
			elseif($partID==2)
				$name = "Rims -";
			elseif($partID==3)
				$name = "Shock -";
			elseif($partID==4)
				$name = "Headlight -";
			elseif($partID==5)
				$name = "Batteriy -";
			elseif($partID==6)
				$name = "Boost Guage -";
			else{
				$name = "false";
			}
			
			$name = $name." ".$row["make"];

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

			if(isset($_SESSION['username'])){
				print "<button name =\"checkoutButton\" type=\"submit\" ><img name=\"checkout\" src=\"images/
				checkout.png\"><span>Add to cart</span></button>";
			}else{
				print "<a href=\"loginPage.php\"><img src=\"images/checkout.png\"><span>Login To Buy</span></a>";
			}


			
			
			print "</form>";
			print "</div>";
			print "</div>";


		}

		
		mysql_close($link);

		?>

		
		

	</div>

	<style>
		.pageLink{
			margin-left:8px;
			color:white;
			border-radius: 2px;
			padding:8px ;
			border : 2px solid white;
		}
	</style>

	<div class="navPages" style="width:auto;margin-left: 48%;">
		<?php
			//display links to page
		for ($i=1; $i <= $numOfPages ; $i++) { 
			echo '<font size="5px"><a class="pageLink"';
			if($page==$i)
				echo ' style="color:#33bbff" ';
			echo '  href="partsDescription.php?page='.$i.'&partID='.$partID.'"> '. $i. '</a></font> ';
		}


		?>

	</div>


</body>
</html>