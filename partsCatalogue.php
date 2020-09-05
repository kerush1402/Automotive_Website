<?  session_start(); 
$page ="partsCatalogue"?>

<html>

<head>
	<title>dealership</title>
	<link rel="stylesheet" href="css/partsCatalogue.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
	<link rel="stylesheet" href="footer.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class = "body" >

	<iframe src="Background Music/tokyo-drift-song.mp3" allow="autoplay" id="audio" style="display:none"></iframe>
	
	<!-- header w/ logo & login,checout & nav -->
	<?php include_once('header.php') ?>
	

	<!-- galley -->

	<? include_once('navTop.php') ?>
	

	<div class="hero">
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
					$url = "partsDescription.php?partID=".$row["id"];
					print "<a href=".$url.">";
					print "<div class=\"box\">";
					print "<div class=\"imgBox\">";
					print "<img src=\"images/part-images/".$row["name"].".jpg\">";
					print "</div>";
					print "</div>";
					print "</a>";
				}
			}

			$result = mysql_query("SELECT * from partsCatalogue");
			$result = db_result_to_array($result);
			display($result);

			?>
			
		</div>
	</div>
	<div class="page-wrapper"></div>
	
	<? include_once('navBottom.php');
	include_once('footer.php'); 
	?>
	
	

</body>

</html>