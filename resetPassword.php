<?
	session_start();
	include_once 'connectDB.php';
	include_once 'cryptionFunctions.php';

	$email = encrypt(rtrim(mysql_real_escape_string($_POST['email'])));
	$password = encrypt(rtrim(mysql_real_escape_string($_POST['newPassword'])));
	$confirmPassword = encrypt(rtrim(mysql_real_escape_string($_POST['confirmPassword'])));

	function db_result_to_array($result){
		$res_array = array();

		for($count=0; $row= @mysql_fetch_array($result); $count++)
			$res_array[$count] = $row;
		return $res_array;
	}


	if(empty($email)){
		echo 'Please enter your email address';
		exit;
	}else{

		if(empty($password) || empty($confirmPassword) || $password!= $confirmPassword){
			echo 'Passwords do not match!';
			exit;
		}else{
			$sql = "SELECT * FROM users WHERE email='$email'";
			$res = mysql_query($sql) or die("Email does not exist. Please try again");
			$resultCheck = mysql_num_rows($res);
			
			if($resultCheck<=0){
				echo 'Email does not exist. Please try again';
				exit;
			}
			
			$sql = "UPDATE users SET pwd='$password' WHERE email='$email'";
			mysql_query($sql) or die("Couldnt no change password.Please try again.");
			session_destroy();
			header("location: loginPage.php");
		}
		
	}

	


?>