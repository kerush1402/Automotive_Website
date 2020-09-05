<? session_start(); 
$page ="used"?>

<html>

<head>
	<title>Used</title>
	<link rel="stylesheet" href="css/used.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
</head>

<body class = "body" >

	<iframe src="Background Music/tokyo-drift-song.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

	<!-- header w/ logo & login,checout & nav -->
	<? include_once('header.php') ?>


	<!-- galley -->
	<?php
	include_once('navTop.php');
	?>
	<div class="hero">
		<div class="container">



			<?php



				$fp = fopen('ads.txt', 'r');

				//count number of items in the file
				$count = 0;

				while(!feof($fp)){

					$ad = trim(fgets($fp));

					if($ad != ""){

					$arr = explode(':',$ad);
					$user = trim($arr[0]);
					$picName = trim($arr[1]);
					$prodType = trim($arr[2]);
					$price = trim($arr[3]);
					$info = trim($arr[4]);
					$availablity = trim($arr[5]);

					//if the proudct is still avaiable(not sold), display
						if($availablity === "no"){
							$count = $count+1;
							print "<div class=\"box\">";
							//print "\"images/uploads/".$picName."\">";

								print "<div class=\"imgBox\">";
									print "<img src=\"images/uploads/".$picName."\" alt=\"No images available\">";
								print "</div>";
								
								print "<div>";
									
									print "<h2 class=\"brand\">".$prodType."</h2>";
									print "<h2 class=\"price\">R".number_format($price,2)."</h2>";
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
					

				

				}

				if($count == 0)
					echo 'Sorry.. No Items Currently :(..';
				
				fclose($fp);

			?>
	</div><!--box-->
 


<?php
include_once('navBottom.php');
//include_once('footer.php');
?>

</body>

</html>