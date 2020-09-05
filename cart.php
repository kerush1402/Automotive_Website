<?php
session_start();
$product_ids = array();
$page = "cart";

include_once 'array_column.php';


$id = $HTTP_GET_VARS["id"];
$action = $HTTP_GET_VARS["action"];
$name = $HTTP_GET_VARS["name"];
$price = $HTTP_GET_VARS["price"];
$quantity = 1;


// if(substr($id,0,1) == "C"){
// 	$make = $HTTP_GET_VARS["make"];
// 	$model = $HTTP_POST_VARS["$col1"];
// 	$name = $make." ".$model;
// }else
// {
// 	$brand = $HTTP_POST_VAR["brand"];
// 	$partID = substr($id, 1,1);
// 	$sql = "SELECT name from partCatalogue where id = $partID";
// 	$result = mysql_query($sql);
// 	$name = $result." ".$brand;
// }


	//check if add to cart is submitted
if(isset($_POST['checkoutButton'])){
		if(isset($_SESSION['cart'])){//session cart is an array
			//keep track of how many prod in cart
			$count = count($_SESSION['cart']);
			//create sequentional array 4 matching array keys to product ids
			$product_ids = array_column($_SESSION['cart'], 'id');

			//if adding new product
			if(!in_array($id,$product_ids)){
				$_SESSION['cart'][$count] = array(
					'id' => $id,
					'name' => $name,
					'price' => $price,
					'quantity' => $quantity
				);
			}
			else{//if product already exists
				for($i= 0; $i< count($product_ids);$i++){
					if($product_ids[$i] == $id && !strpos($_SESSION['cart'][$i]['name'],'Used')){
						$_SESSION['cart'][$i]['quantity'] += 1;
					}
				}
			}


		}else{
			//if cart dont exist, create 1st priduct with array key 0
			//create array using submitted data
			$_SESSION['cart'][0] = array(
				'id' => $id,
				'name' => $name,
				'price' => $price,
				'quantity' => $quantity
			);
		}
	}

	//print_r($_SESSION);



	if($action == 'delete'){
		//loop through cart until find with get id variable
		foreach ($_SESSION['cart'] as $key => $product) {
			if($product['id'] == $id){
				//remove product from cart when matches with id
				unset($_SESSION['cart'][$key]);
			}
		}
		//reset session array key so that they match product array
		$_SESSION['cart'] = array_values($_SESSION['cart']);//resorts the array
	}


	?>



	<!DOCTYPE html>
	<html>
	<head>
		<title>My Cart</title>
		<link rel="stylesheet" type="text/css" href="css/cart.css"> 
	</head>
	<body>

		
		<? include_once 'header.php'?>
		<? include_once('navTop.php') ?>

		

		<div class="container">
			<? if(isset($_SESSION['cart'])){ ?>
			<!--<?print_r($_SESSION['cart']) ?>  -->
			<table border="5" bordercolor="#ff0000" class="table">
				<tr>
					<th class="name">Name</th>	
					<th class="qty">Quantity</th>
					<th class="price">Price</th>
					<th class="tot">Total</th>
					<th class="act">Action</th>
				</tr>

				<?php 
				if(!empty($_SESSION['cart'])):
					$total = 0;
					foreach ($_SESSION['cart'] as $key => $product) :
						?>
						<tr>
							<? $prod_id = $product['id']; 
							?>
							<td class="tdName"><? echo $product['name'];?></td>
							<td class="tdQty"><? echo $product['quantity']?>x</td>		
							<td class="tdPrice">R<? echo number_format($product['price'],2)?></td>
							<td class="tdTot">R<? echo number_format($product['quantity']*$product['price'],2) ?></td>
							<?
							print "<td class=\"tdAct\"> <a href=\"cart.php?id=".$prod_id."&&action=delete\"><img style=\"width:15%;\" src=\"images/delete.jpg\"> </a>   </td>"

							?>
						</tr>
						<?
						$total += $product['quantity']*$product['price'];
					endforeach;
					?>
					<tr>
						<td><td><td><td><td>Grand total <?echo number_format($total,2)?>
							<?
							if(isset($_SESSION['cart'])):
								if(count($_SESSION['cart'])>0):
							?>
								<form action="checkout.php" method="POST">
								<br>
								<button  class= "checkout" type="submit" name="checkout">Checkout</button>
								<br>
							</form>
							<? endif;endif; ?>
						</td></td></td></td></td>
					</tr>

				

					
				<? endif;?>
			</table>

			<? }else echo 'Nothing added to cart..:( Please buy something' ?>

	</div>



	<?php
	include_once('navBottom.php');
	include_once('footer.php');
	?>
</body>
</html>