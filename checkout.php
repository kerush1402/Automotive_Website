<?

session_start();
if(isset($_POST['checkout'])){
	include_once'connectDB.php';
	include_once 'array_column.php';
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
	$order = $res[0]["orders"];


	//add the items to db, after the prev order if any
	$product_ids = array_column($_SESSION['cart'], 'id');
	$date = date('Y-m-d');
	$order .= $date."+ ";

	for($i= 0; $i< count($product_ids);$i++){
					//create the order string with the items
		$order  .=$_SESSION['cart'][$i]['quantity']."x ".
		$_SESSION['cart'][$i]['name']. " R". number_format(
		($_SESSION['cart'][$i]['quantity']*$_SESSION['cart'][$i]['price']),2)." +";
	}
	$order .= ":";
	
	//insert into dB
	$sql = "UPDATE users SET orders = '$order' where username='$user'";
	mysql_query($sql);
	mysql_close($link);
	

	//update savailbility field (sold or not)in ads file for used items from cart when matches with id
	foreach ($_SESSION['cart'] as $key => $product) {

		$id = $product['id'];

		$fp = fopen('ads.txt','r+');
		$array = array();

		while(!feof($fp)){
			$line = trim(fgets($fp));
			$arr = explode(':',$line);
			$user = trim($arr[0]);
			$picName = trim($arr[1]);
			$prodType = trim($arr[2]);
			$price = trim($arr[3]);
			$info = trim($arr[4]);
			$sold = trim($arr[5]);


					// if( $picName !== $id){
					// 	$array[] = $line;
					// }

			//fine the product bought and chnge the avail to yes(sold)
			if($picName === $id){
				$line = $user.":".$picName.":".$prodType.":".$price.":".$info.":yes";
			}

			$array[] = $line;

		}
		fclose($fp);

		$fp = fopen('ads.txt', 'w+');
		fwrite($fp,'');
		fclose($fp);


		$fp = fopen('ads.txt','a');
		$size = sizeof($array);

		for ($i=0; $i <= $size; $i++) { 
			fwrite($fp, $array[$i]."\n");
		}

		fclose($fp);
	}


		//unset variables in shopping car because user checkedout
		// $count = count($_SESSION['cart']);
		// foreach ($_SESSION['cart'] as $key => $product) {
		// 		unset($_SESSION['cart'][$key]);
		// }

	header("Location: welcomePage.php?checkout=true");

}else
header("welcomePage.php");