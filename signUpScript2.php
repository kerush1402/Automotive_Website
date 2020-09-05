<?

if(isset($_POST['signUp-btn'])){

	include_once 'connectDB.php';
	include_once 'cryptionFunctions.php';
	

	$fname = trim(mysql_real_escape_string( $_POST["fname"]));
	$lname =trim(mysql_real_escape_string($_POST["lname"]));

	$id =trim(mysql_real_escape_string($_POST["id"]));
	$email =trim(mysql_real_escape_string( $_POST["email"]));

	$username = trim(mysql_real_escape_string($_POST["username"]));
	$pass = trim(mysql_real_escape_string($_POST["pass"]));
	$checkPass =trim(mysql_real_escape_string( $_POST["checkPass"]));


	if(empty($fname) || empty($lname)){
		echo '<p style="color:red; font-size:30px;"  >Information missing! Please ensure you fill all fields</p>';
		exit();
	}else{

		if(!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)){
			echo '< style="color:red; font-size:30px;" >Invalid Name! Only non-numeric characters</p>';
			exit();
		}else{

			$num_length = strlen((string)$id);
			if(!preg_match("/^[0-9]+$/", $id) || $num_length>13 || $num_length<13 ){
				echo '<p style="color:red; font-size:30px;" >Invalid ID Number! Must be exactly 13 characters long</p>';
				exit();
			}else{
				$encryptEmail = encrypt($email);
				$sql= "SELECT * FROM users where email='$encryptEmail'";
				$result = mysql_query($sql);
				$resultCheck = mysql_num_rows($result);
				if($resultCheck > 0 ){
					echo('<p style="color:red; font-size:30px;" >Email already in use. Please use aother email</p>');
					exit;
				}

				$at = '@';
				$ext = '.com';
				if (! strpos($email, $at) || !strpos($email, $ext)) {
					echo('<p style="color:red; font-size:30px;" >Your email is not a valid email address</p>');
				} else {

					$sql= "SELECT * FROM users where username='$username'";
					$result = mysql_query($sql);
					$resultCheck = mysql_num_rows($result);

					$numLenUser = strlen($username);
					$numLenPass = strlen($pass);

					if($numLenUser <7 || $numLenPass <7){
						echo '<p style="color:red; font-size:30px;" >Username and password must not be less than 7 characters long!';
						exit();
					}else{

						if($resultCheck>0 || $results[0][0]=="admin"){
							print '<p style="color:red; font-size:30px" Username already taken!</p>';
						}else{

							if($pass !== $checkPass){
								print '<p style="color:red; font-size:30px" Password did not match!</p>';
							}else{
								//encrypt info
								$username = encrypt($username);
								$fname = ($fname);
								$lname = ($lname);
								$id = encrypt($id);
								$email = encrypt($email);
								$pass = encrypt($pass);
							
								$sql = "INSERT INTO users (username,pwd,fname,lname,id,email) VALUES ('$username','$pass','$fname','$lname','$id','$email')";
								$result = mysql_query($sql) or die("Could not add user. Please try again");
								header("Location: loginPage.php?signUp=sucess");



							}
						}
					}
				}
			}

		}


	}
}else{
	header("Location: signUp.php");
}
