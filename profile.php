<? session_start();
$page ="profile"?>
<!DOCTYPE html>
<html>
<head>
	<title>Your Profile</title>
	<link rel="stylesheet" href="css/profile.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
</head>
<body>

	<iframe src="Background Music/tokyo-drift-song.mp3" allow="autoplay" id="audio" style="display:none"></iframe>

	<!-- header w/ logo & login,checout & nav -->
	<? include_once('header.php') ?>


	<!-- galley -->
	<?php
	include_once('navTop.php');
	?>

	<div class="hero">

		<? if(isset($_SESSION['username'])){ ?>


		<?

			if($_GET['action'] == "delete"){
				
				$itemId =trim(($_GET['id']));
				$fp = fopen('ads.txt', 'r') or die("please try again");
				$tempArr = array();
				while(!feof($fp)){
					$line = trim(fgets($fp));
					$arr = explode(':',$line);
					$user = trim($arr[0]);
					$picName = trim($arr[1]);
					$prodType = trim($arr[2]);
					$price = trim($arr[3]);
					$info = trim($arr[4]);
					$sold = trim($arr[5]);

					//add items to temp array if they not the item to be deleted
					if($itemId != $picName)
						$tempArr[] = $line;
				}
				
				fclose($fp);

				//clear the textfile
				$fp = fopen('ads.txt', 'w+');
				fwrite($fp,'');
				fclose($fp);

				//add items to textfile that wasnt item to e deleted
				$fp = fopen('ads.txt','a');
				$size = sizeof($tempArr);

				for ($i=0; $i <= $size; $i++) { 
					fwrite($fp, $tempArr[$i]."\n");
				}

				fclose($fp);
				

		}

		?>

		<h1 class="h1" style="width:33%;"><?echo $_SESSION['fname'].'\'s Profile'?></h1>
		<br><br>
		<div class="pc-tab">
			<input type="radio" name="pct" id="tab1" checked="checked">
			<input type="radio" name="pct" id="tab2">
			<input type="radio" name="pct" id="tab3">
			<nav>
				<ul>
					<li class="tab1">
						<label for="tab1">Your Orders</label>
					</li>
					<li class="tab2">
						<label for="tab2">Your Ads</label>
					</li>
					<li class="tab3">
						<label for="tab3">Reset Password</label>
					</li>
				</ul>
			</nav>
			<section>
				<div class="tab1">
					<table border="5" bordercolor="red" class="table">
						<tr>
							<th class="date">Date Ordered</th>
							<th class="items">Items</th>
						</tr>

						<?
						include_once'connectDB.php';
						
						//get any prev orders
						function db_result_to_array($result){
							$res_array = array();

							for($count=0; $row= @mysql_fetch_array($result); $count++)
								$res_array[$count] = $row;
							return $res_array;
						}

						$user = $_SESSION['username'];

						$res =mysql_query("SELECT * FROM users where username='$user'");
						$res = db_result_to_array($res);
						$order = trim($res[0]["orders"]);

						$arrOrder = explode(":",$order);
						$sizeOrder = strlen($arrOrder);

						//loop through each order made and display
						for($i=1; $i<$sizeOrder; $i++){
							$str = $arrOrder[$i];
							$arrItems = explode("+",$str);
							$sizeItems = strlen($arrItems);
							$date = $arrItems[0];

							echo '<tr>
								<td class="tdDate">'.$date.'</td>
								<td class="tdItems">';
							for($j=1; $j < $sizeItems; $j++){
								echo $arrItems[$j].'<br>';
							}
							echo '</td>
							</tr>';
						}			

						?>			
					</table>

				</div>

				<div class="tab2">
					<table border="5" bordercolor="#ff0000" class="table">
						<tr>
							<th class="name">Name</th>	
							<th class="info">Info</th>
							<th class="price">Price</th>
							<th class="sold">Availablity</th>
							<th class="act">Remove</th>
						</tr>


						<tr>
							<? 
								$fp = fopen('ads.txt','r+');
								$user = $_SESSION['username'];

								while(!feof($fp)){
									$line = trim(fgets($fp));

									if($line != ""){
										$arr = explode(':',$line);
										$fileUser = trim($arr[0]);
										$picName = trim($arr[1]);
										$prodType = trim($arr[2]);
										$price = trim($arr[3]);
										$info = trim($arr[4]);
										$sold = trim($arr[5]);

										if($sold == "yes")
											$sold = "Sold";
										else
											$sold = "Not Sold";
										
										if($user === $fileUser){
											echo '
											<tr>
												<td class="tdType">'.$prodType.'</td>
												<td class="tdInfo">'.$info.'</td>
												<td class="tdPrice">R'.number_format($price,2).'</td>
												<td class="tdAva">'.$sold.'</td>
												<td class="tdAct"> <a href="profile.php?id='.$picName.'&&action=delete"><img style="width:55%; margin-top:10%" src="images/remove-white.jpg"> </a></td>
											</tr>';
										}

									}

								}
								

							?>
						</tr>

					</table>

				</div>

				<div class="tab3">

					<form action="resetPassword.php" method="POST">
					<labeL style="margin-left:60px;">Enter your Email:</labeL>                 
					<input type="text" placeholder="Email" name="email" style=" margin-top: 10px; margin-left: 180px" > <br>
				
					<labeL style="margin-left:60px;">Enter new password:                 
					<input type="password" placeholder="7+ Characters" name="newPassword" style=" margin-top: 10px; margin-left: 151px" > <br>
				
					<labeL style="margin-left:60px;">Confirm password:   
					<input type= "password" placeholder= "Confirm Password" name= "confirmPassword" style=" margin-top: 10px; margin-left: 169px" >
					<br><br><br>
				

					<input class="btnReset" type="submit" name="signUp-btn" value="Reset" style="margin-left:35%;color:black;width:25%; height: 40px;">
		  		
					
					</form>			



				</div>
			</section>

		<? }else {
			echo '<p style=" font-size:25px;margin-left:40px">You are not logged in! <a href="loginPage.php">Login Here</a></p>';	
		}
		?>

		</div>

		<?php
		include_once('navBottom.php');
		include_once('footer.php');
		?>

	</body>
	</html>