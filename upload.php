<?php
	session_start();
	$prodType = $HTTP_POST_VARS['product'];
	$price = $HTTP_POST_VARS['price'];
	$info = $HTTP_POST_VARS['info'];
	/*return array w/ file info ie.name,type,tmp_location,error,size*/
	$file = $_FILES['file'];

	//if clicked the submit button
	if(isset($_POST['submit'])){

		if(($price=="") || $price >10000000 || !preg_match("/^[0-9]+$/", $price)){
			echo "Please enter a price not more than R10,000,000!";
			//header("Location: sell.html");
		}else{

			if(empty($info) || strlen($info)<=20 ||  strlen($info)>=50 ){
				echo "Additionl info field must have atleast 20 characters and not more than 50
				 characters!";
				
			}else{
		 		if(empty($file)){
		 			echo "Please upload an image of the product!";
		 		}else{

					$fileName = $_FILES['file']['name'];
					$fileTmpName = $_FILES['file']['tmp_name'];
					$filSize = $_FILES['file']['size'];
					$fileError= $_FILES['file']['error'];
					$fileType = $_FILES['file']['type'];

					/*gets last string in the array when exploed and convert to lowercase*/
					
					// $fileExt = strtolower($fileType);
					// $fileExt = end(explode('/', $fileType)); 
					$fileExt = explode('.',$fileName);
					$fileActualExt = strtolower(end($fileExt));
				
					$allowed = array('jpg','jpeg','png');

					if(in_array($fileActualExt,$allowed)){
						if($fileError == 0 ){ //no problem with file
							if($fileSize < 20000){//1mb
								/*Code when all fields are filled*/
								/*create unique file name using current time because might upload same file*/
								//when session runs for login,can use $username
								$fileNameNew = uniqid('',true).".".$fileActualExt;
								/*create destination for where to upload to*/

								$fileDest = 'images/uploads/'.$fileNameNew;
								move_uploaded_file($fileTmpName, $fileDest);


								$username = $_SESSION['username'];
								$line = $username.": ".$fileNameNew.": ".$prodType.": ".$price.": ".$info." : no \n";
								$fp = fopen('ads.txt', 'a');
								fwrite($fp,$line);
								fclose($fp);


								header("Location: used.php");
								//aleart("Upload was sucessful");
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
			}
		}

	}else {//they uused url to access instead of the button
		header("Location: welcomePage.php");
	}

?>