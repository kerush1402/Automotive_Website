<?php
session_start();
	//put in header so it starts a session on all pages

if(isset($_POST['login-btn'])){

	include_once 'connectDB.php';
	include_once 'cryptionFunctions.php';


	$username = encrypt(mysql_real_escape_string( $_POST['username']));
	$pwd = encrypt(mysql_real_escape_string( $_POST['password']));

	function db_result_to_array($result){
		$res_array = array();

		for($count=0; $row= @mysql_fetch_array($result); $count++)
			$res_array[$count] = $row;
		return $res_array;
	}

	//error habdlers
	if(empty($username) || empty($pwd)){
		echo 'Enter a username and password!';
	}else{

		$result = mysql_query("SELECT * FROM users WHERE username='$username'");
			// $result = db_result_to_array($result);
			// print $result.length();

		if(mysql_num_rows($result) < 1){
			echo 'Error! User not found!';
			exit();
		}else{

			if($row = mysql_fetch_array($result)){
					///dehash password and validate with password user entered
					// $hashedPwdCHeck = password_verify($pwd, $row['password']);

					// if($hashedPwdCHeck == false){
					// 	echo 'Password Incorect!';
					// }elseif($hashedPwdCHeck == true){
				if($pwd == $row["pwd"]){
					//login user
					$dbPassword = $row['pwd'];

					if($username=="steVSaY4JUIjc" && $pwd==$dbPassword){
						$_SESSION['username'] = $row['username'];
						$_SESSION['pwd'] = $row['pwd'];
						$_SESSION['email'] = $row['email'];
						header("Location: admin.php");
						exit;
					}else{
						$_SESSION['username'] = $row['username'];
						$_SESSION['pwd'] = $row['pwd'];
						$_SESSION['orders'] = $row['orders'];
						$_SESSION['fname'] = $row['fname'];
						$_SESSION['lname'] = $row['lname'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['id'] = $row['id'];
						$_SESSION['cell'] = $row['cell'];
						$_SESSION['street'] = $row['street'];
						$_SESSION['city'] = $row['city'];
						$_SESSION['suburb'] = $row['suburb'];
						$_SESSION['aCode'] = $row['aCode'];
						header("Location: welcomePage.php");
						exit();
					}
				}
				else{
					echo 'Incorrect Password!';	
				}
			}
		}	
	
	}
}else{
	header("Location: welcomePage.php");
}