<? session_start()?>

<html>


<head>
	<title>Autoplicity</title>
	<link rel="stylesheet" type="text/css" href="css/welcomePage.css"> 
</head>
<style>
	*{
		text-decoration: none;
		color:black;
	}
</style>

<body class="body" >

	<iframe src="Background Music/Riders-on-the-storm.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

	<!-- or <embed src="Background Music/Riders-on-the-storm.mp3" autostart="true" loop="true" hidden="true" ></embed> -->

	<?php
	session_start();
	include_once('header.php'); 

	?>
	<style >
		.header{
			overflow:hidden;
			margin-top:5px;
		} 
		.topright{
			padding: 4px;
		}
	</style>

	<?
	if($_GET["checkout"] == "true"){
		echo '<p style="margin-left:17%; color:#33bbff; font-size:20px"> Thank you for shopping with us '.$_SESSION['username'].'. Your order has been placed. Your items will be delivered in 9-12 weeks.<a style="color:#33bbff; border-bottom:2px #33bbff solid;"href="profile.php">View Details</a></p>';
		
	

		//unset variables in shopping car because user checkedout
		$count = count($_SESSION['cart']);
		foreach ($_SESSION['cart'] as $key => $product) {
			unset($_SESSION['cart'][$key]);
		}

	}
		?>


		<div class="container">

			<a href="dealership.php">
				<div class="box">
					<div class="imgBox">
						<img src="images/welcome page images/ferrari.jpg">
					</div>
					<div class="Content">
						<h2>Dealership</h2>
					</div>
				</div>
			</a>

			<a href="partsCatalogue.php">
				<div class="box">
					<div class="imgBox">
						
						<img src="images/welcome page images/turbo.jpg">
						
					</div>
					<div class="Content">
						<h2>Parts</h2>
					</div>
				</div>
			</a>

			<a href="used.php">
				<div class="box">
					<div class="imgBox">
						
						<img src="images/welcome page images/golf.jpg">
						
					</div>
					<div class="Content">
						<h2>Used</h2>
					</div>
				</div>
			</a>

			<a href="sell.php">
				<div class="box">
					<div class="imgBox">
						
						<img src="images/welcome page images/dollar.jpg">
						
					</div>
					<div class="Content">
						<h2>Sell</h2>
					</div>
				</div>
			</a>
		</div> 


		<?php include_once('footer.php') ?>
		

	</body>

	</html>