<? session_start(); 
$page ="dealership"?>
<html>

<head>
	<title>dealership</title>
	<link rel="stylesheet" href="css/dealership.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
</head>

<body class = "body" >

	<iframe src="Background Music/tokyo-drift-song.mp3" allow="autoplay" id="audio" style="display:none"></iframe>
	<?php
	include_once('navTop.php');
	?>

	<? include_once('header.php') ?>
	<style >
		.gap{
	margin-top: 120px;
}

	</style>

	

		<div class="container">

			<?php

			include_once('connectDB.php');

			function db_result_to_array($result){
				$res_array = array();

				for($count=0; $row= @mysql_fetch_array($result); $count++)
					$res_array[$count] = $row;
				return $res_array;
			}

			function display($result){


				foreach($result as $row){

					print "<div class=\"box\">";
					print "<div class=\"imgBox\">";
					$url = "carsCatalogue.php?dealershipID=".$row["id"];
					print "<a href=".$url."><img src=\"images/dealership images/".$row["brand"].".jpg\"></a>";
					print "</div>";
					print "</div>";
				}
			}

			$result = mysql_query("SELECT * from dealership ORDER BY brand");
			$result = db_result_to_array($result);
			display($result);



			?>


		</div>



	<?php
	include_once('navBottom.php');
	include_once('footer.php');
	?>

</body>

</html>