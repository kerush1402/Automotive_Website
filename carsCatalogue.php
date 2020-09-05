<? session_start(); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		Cars
	</title>

	<style>
		body{
			background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/wallpaper.jpg)  no-repeat center center fixed ;
			-webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
		}
	</style>

	<iframe src="Background Music/I-DO.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="css/carsCatalogue.css">


</head>
<body>

	
		<a href="dealership.php">
		<img src="images/back.png" style="width:43px;height:43px; margin-top:5px;margin-left:5px;float:left">
		</a>



		<div class="swiper-container">
			<div class="swiper-wrapper">

				

				<?php 

				include_once('connectDB.php');


				function db_result_to_array($result){
					$res_array = array();

					for($count=0; $row= mysql_fetch_array($result); $count++)
						$res_array[$count] = $row;
					return $res_array;
				}

				function display_cars($result,$dealershipID){

					
					foreach($result as $row){

						print "<div class=\"swiper-slide\">";
						print "<div class =\"imgBx\">";
						$url = "carDescription.php?carID=".$row["id"]."&&dealershipID=".$dealershipID."";
						print "<a href= ".$url." > <img src=\"images/car-images/".$row[0]."-1.jpg\"> </a>";
						print "</div>";
						print "<div class=\"details\">";
						
						                                                         //[] can use a number for the corresponding 
						                                                         //column instead of the column name
						print "<h3> ".$row["model"]." <br><span> R".number_format($row["price"],2)."</span></h3>";
						print "</div>";
						print "</div>";

					}
				}
				
				$dealershipID = $HTTP_GET_VARS["dealershipID"];
				$result = mysql_query("SELECT * from cars WHERE id LIKE '%C$dealershipID%'");
				$result = db_result_to_array($result);
				display_cars($result,$dealershipID);


				mysql_close($link);

				?>
				
			</div> 
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>


		</div>

	<?php
				include_once('footer.php'); 
		?>	


	<script type="text/javascript" src="swiper.min.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			effect: 'coverflow',
			grabCursor: true,
			centeredSlides: true,
			slidesPerView: 'auto',
			coverflowEffect: {
				rotate: 0,
				stretch: 0,
				depth: 300,
				modifier: 3,
				slideShadows : true,
			},
			pagination: {
				el: '.swiper-pagination',
			},
		});
	</script> 

	

</body>
</html>