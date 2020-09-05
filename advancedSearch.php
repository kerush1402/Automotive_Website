<? session_start(); ?>

<html>

<head>
	<title>dealership</title>
	<link rel="stylesheet" href="css/advancedSearch.css">

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

		<?

	include_once 'connectDB.php';

	$sql = "Select * from dealership order by brand";
	$result = mysql_query($sql);
	$result = db_result_to_array($result);

	function db_result_to_array($result){
		$res_array = array();

		for($count=0; $row= @mysql_fetch_array($result); $count++)
			$res_array[$count] = $row;
		return $res_array;
	}

	function display_dealersip_cbx($result){

		print "<select name = \"dealership\" style=\"float:right;margin-right: 16.7%\">";
		print "<option value=\"\"><--Select Dealership--></option>";
		foreach($result as $row){
			print "<option value=".$row["brand"].">".$row["brand"]."</option>";
		}
		print "</select>";


		

	}

	?>

	<h1 class="h1" style="width:33%;">Advanced Search</h1>
	<br><br>
	<div class="pc-tab">
		<input type="radio" name="pct" id="tab1" checked="checked">
		<input type="radio" name="pct" id="tab2">
		<input type="radio" name="pct" id="tab3">
		<nav>
			<ul>
				<li class="tab1">
					<label for="tab1">New Cars</label>
				</li>
				<li class="tab2">
					<label for="tab2">New Parts</label>
				</li>
				<li class="tab3">
					<label for="tab3">Used</label>
				</li>
			</ul>
		</nav>
		<section>
			<div class="tab1">
				<h2>What is your dream car?</h2>
				<br>
				<form action="searchResults.php" method="POST">
					
					<label style="float:left;margin:5px;">Dealership:* </label>
					<? display_dealersip_cbx($result) ?>
					<br><br><br>

					<label style="float:left;margin:5px;">Year: </label>

					<!-- find max and min year to loop through to populate year combobox. -->
					<?$sql = "select max(prodYear) from cars";
					$result = mysql_query($sql);
					$result = db_result_to_array($result);
					foreach($result as $row){
						$max = $row[0];
					}

					$sql = "select min(prodYear) from cars";
					$result = mysql_query($sql);
					$result = db_result_to_array($result);
					foreach($result as $row){
						$min = $row[0];
					}

					print "<select name =\"prodYear\" style=\"float:right;margin-right: 12%\">";
						print "<option value =\"\"><--Select Production Year--></option>";
					for ($i=$min; $i <= $max ; $i++) { 
						print "<option value =".$i." >".$i."</option>";
					}
					print "</select>";
					?>
					<br><br><br>

					<label style="float:left;margin:5px;">Transmission:* </label>
					<select  name ="transmission" style="float:right;margin-right: 15%">
						<option value=""><--Select Transmission--></option>
						<option value="manual">Manual</option>
						<option value="automatic">Automatic</option>
						<option value="tiptronic">Tiptronic</option>
					</select>
					<br><br><br>

					<label style="float:left;margin:5px;">Price Limit: </label>
					<input  style="float:right;margin-right: 8%" type="text" placeholder="Price" name="price-car" value="" size="30">
					<br><br><br>

					
					<input class="btn" type="submit" name="search-car" value="Search" >
					
					
				</form>
			</div>

			<div class="tab2">
				<h2>What part are you looking for?</h2>
				<br>
				<form action="searchResults.php" method="POST">
					<?
					$sql = "Select name from partsCatalogue order by name";
					$result = mysql_query($sql);
					$result = db_result_to_array($result);

						print "<label style=\"float:left;margin:5px;\">Part:* </label>";
						print "<select name=\"part\" style=\"float:right;margin-right: 29.5%\">";
						print "<option value=\"\"><--Select Part--></option>";
						
						foreach($result as $row){
							print "<option value=".$row["name"].">".$row["name"]."</option>";
						}
						print "</select>";


					?>
					
					<br><br><br>

					<label style="float:left;margin:5px;">Price Limit:* </label>
					<input  style="float:right;margin-right: 13%" type="text" placeholder="Price" name="price-part" value="" size="30">
					<br><br><br>

					
					<input class="btn" type="submit" name="search-part" value="Search" >
					
					
				</form>
			</div>

			<div class="tab3">
				<h2>Nothing but used</h2>
				<br>
				<form action="searchResults.php" method="POST">
					
					<label style="float:left;margin:5px;">Item:* </label>
					<?
						
					$sql = "Select name from partsCatalogue order by name";
					$result = mysql_query($sql);
					$result = db_result_to_array($result);

						print "<select name=\"item\" style=\"float:right;margin-right: 28.5%\">";
						print "<option value=\"\"><--Select Item--></option>";
						print "<option value=\"Car\">Car</option>";
						foreach($result as $row){
							print "<option value=".$row["name"].">".$row["name"]."</option>";
						}
						print "</select>";
					?>				
					<br><br><br>


					<label style="float:left;margin:5px;">Price Limit:* </label>
					<input  style="float:right;margin-right: 13%" type="text" placeholder="Price" name="price-used" value="" size="30">
					<br><br><br>

					
					<input class="btn" type="submit" name="search-used" value="Search" >
					
					
				</form>
			</div>
		</section>
	</div>


	</div>
		


<?php
include_once('navBottom.php');
include_once('footer.php');
?>

</body>

</html>