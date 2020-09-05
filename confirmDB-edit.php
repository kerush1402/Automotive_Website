<?

function db_result_to_array($result){
				$res_array = array();

				for($count=0; $row= @mysql_fetch_array($result); $count++)
					$res_array[$count] = $row;
					
				return $res_array;
			}

include_once('connectDB.php');

if(isset($_POST["remCar"])){
	
	$carID = $_POST['car'];
	
	mysql_query("DELETE FROM cars WHERE id='$carID'") or die("Could not delete. Please try again");

	header("Location: admin.php?message=delete");

}elseif(isset($_POST["remPart"])){
	
	$partID = $_POST['part'];
		
		mysql_query("DELETE FROM parts WHERE id='$partID'") or die("Could not delete. Please try again");

		header("Location: admin.php?message=delete");
	

}elseif(isset($_POST["addCar"])){
	
	$dealership = $_POST['dealership'];
	$model = $_POST['model'];
	$price = $_POST['price'];
	$trans = $_POST['trans'];
	$year = $_POST['year'];
	$engine = $_POST['engine'];
	$fuel = $_POST['fuel'];
	$doors = $_POST['doors'];
	$hp = $_POST['hp'];
	$ac = $_POST['ac'];
	$gps = $_POST['gps'];
	$locking = $_POST['locking'];
	$frontImg = $_FILES['frontImg'];
	$backImg = $_FILES['backImg'];


	if(empty($frontImg) || empty($backImg)){
		echo 'Please upload a front and back image' ;
	}else{

		$fileName = $_FILES['frontImg']['name'];
		$fileTmpName = $_FILES['frontImg']['tmp_name'];
		$filSize = $_FILES['frontImg']['size'];
		$fileError= $_FILES['frontImg']['error'];
		$fileType = $_FILES['frontImg']['type'];
		
		$backFileName = $_FILES['backImg']['name'];
		$backFileTmpName = $_FILES['backImg']['tmp_name'];
		$backFilSize = $_FILES['backImg']['size'];
		$backFileError= $_FILES['backImg']['error'];
		$backFileType = $_FILES['backImg']['type'];


		$fileExt = explode('.',$fileName);
		$fileActualExt = strtolower(end($fileExt));

		$backFileExt = explode('.',$backFileName);
		$backFileActualExt = strtolower(end($backFileExt));
	
		$allowed = array('jpg','jpeg','png');

		if(in_array($fileActualExt,$allowed) && in_array($backFileActualExt, $allowed)){

			if($fileError ==0 && $backFileError ==0){

				if($filSize <= 200000 && $backFileSize <= 200000){

					$sql = "SELECT * from dealership where id='$dealership'";
					$res= mysql_query($sql);
					$res = db_result_to_array($res);
					$dalershipID = $res[0][0];

					$sql = "SELECT MAX(id) from cars WHERE id LIKE 'C$dealership%'";
					$res = mysql_query($sql);
					$res =db_result_to_array($res);
					$res = $res[0][0];//get the last car for that dealership that is in db and then add 1 to last digit

					$arr = explode('-', $res);
					$lastDigit = $arr[1] +1;

					$newCarId = "C".$dealership."-".$lastDigit;
					$frontImgName = $newCarId."-1.".$fileActualExt;
					$backImgName = $newCarId."-2.".$backFileActualExt;

					$fileDestFront = 'images/car-images/'.$frontImgName;
					$fileDestBack = 'images/car-images/'.$backImgName;

					move_uploaded_file($fileTmpName, $fileDestFront);
					move_uploaded_file($backFileTmpName, $fileDestBack);

					//get remaining info
					$sql = "SELECT * FROM dealership WHERE id=$dealership";
					$res = mysql_query($sql);
					$res = db_result_to_array($res);
					$make = $res[0][1];

					if($model =="" || $price=""){
						echo 'Please enter the model name and a price';
					}else{

						if($year =="" || $hp==""){
							echo 'Please enter the production year and the horsepower!';
						}else{

							//if checkboxes werent selected, answer is No
							if($ac=="")
								$ac = "No";
							if($gps=="")
								$gps = "No";
							if($locking=="")
								$locking = "No";

							// echo $newCarId;echo $make; echo $model; echo $year ; echo $engine; echo $trans;echo $doors;echo$fuel;echo $ac;echo $locking; echo $gps; echo $_POST['price'];exit;

							//insert everything into DB
							$sql = "INSERT INTO cars(id,make,model,prodYear,hp,engine,trans,doors,fuel,ac,remLock,gps,price) VALUES( '$newCarId','$make','$model',$year,$hp,$engine,'$trans',$doors,'$fuel','$ac','$locking','$gps',".$_POST['price']." )";
							
							mysql_query($sql) or die("Couldnt add car to database. Please try agin");
							header("Location: admin.php?message=add");

						}

					}


				}else{
					echo 'File size is to big, Less tha 2mb only!';
				}


			}else{
				echo 'File is corrupt!';
			}


		}else{
			echo 'Cannot uplod image of this type, Only jpg,jpeg or png!';
		}

	}


}elseif(isset($_POST["addPart"])){
	$type = $_POST['part'];
		$brand = strtoupper($_POST['brand']);
		$price = $_POST['price'];
		$info = $_POST['info'];	
		$file = $_FILES['file'];

		if(empty($file) ){
			echo 'Please upload an image' ;
		}else{

			$fileName = $_FILES['file']['name'];
			$fileTmpName = $_FILES['file']['tmp_name'];
			$filSize = $_FILES['file']['size'];
			$fileError= $_FILES['file']['error'];
			$fileType = $_FILES['file']['type'];


			$fileExt = explode('.',$fileName);
			$fileActualExt = strtolower(end($fileExt));

			$allowed = array('jpg','jpeg','png');

			if(in_array($fileActualExt,$allowed)){
				if($fileError == 0 ){ //no problem with file
					if($fileSize < 20000){//1mb

						$sql = "SELECT * from partsCatalogue where name='$type'";
						$res= mysql_query($sql);
						$res = db_result_to_array($res);
						$partID = $res[0][0];


						$sql = "SELECT MAX(id) from parts WHERE id LIKE 'P$partID%'";
						$res = mysql_query($sql);
						$res =db_result_to_array($res);
						$res = $res[0][0];//get the last part for that type that is in db and then add 1 to last digit

						$arr = explode('-', $res);
						$lastDigit = $arr[1] +1;

						$newPartId = "P".$partID."-".$lastDigit;
						$newFileName = $newPartId.".".$fileActualExt;

						$fileDest = 'images/part-images/'.$newFileName;

						move_uploaded_file($fileTmpName, $fileDest);
						
						//check remaining info
						if($brand==""){
							echo 'Please enter the brand name';
						}else{
							if($price == ""){
								echo 'Please enter a price';
							}else{

								if($info =="" || strlen($info)<10 || strlen($info)>40){
									echo 'Please enter some information about the part. 10-40 characters';					
								}else{
									
									$sql= "INSERT INTO parts (id,price,make,info) VALUES('$newPartId',".$_POST['price'].",'$brand','$info')";
									mysql_query($sql) or die ("Could not add part. Please try again");
									header("Location: admin.php?message=add");
								}

							}




						}
						
					}else{
						echo ("File size is too big!");
					}
				}else{
					echo ("File is corrupted!");
				}
			}else{
				echo ("You cannot upload this type of file!");
			}

		}


}else{
	header("Location: loginPage.php");
}

mysql_close($link);

