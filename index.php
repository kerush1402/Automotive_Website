<?php

// Include database connection
require_once('connectDB.php');
// Include functions
require_once('functions.inc.php');
// Start the session
session_start();
?>
<!DOCTYPE html >
	
<html>
<head>
	<title>shopping cart; Autoplicity</title>
	<link rel="stylesheet" href="css/css/styles.css" />
</head>

<body>

<div id="shoppingcart">

<h1>Your Shopping Cart</h1>

<?php
echo writeShoppingCart();
?>

</div>

<div id="booklist">

<h1>Cars In Our Store</h1>

<?php
$sql = 'SELECT * FROM cars ORDER BY id';
$result = mysql_query($link,$sql);
$output[] = '<ul>';
while ($row = $result->fetch()) {
	$output[] = '<li>"'.$row['model'].'" by '.$row['make'].': &pound;'.$row['price'].'<br /><a href="cart.php?action=add&id='.$row['id'].'">Add to cart</a></li>';
}
$output[] = '</ul>';
echo join('',$output);
?>

</div>

</body>
</html>