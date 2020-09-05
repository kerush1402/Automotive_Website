<head>
	<style >
		.header{
			margin-top: 10px;
			margin-left:40px;
			border-bottom: 4px grey solid;
			overflow: hidden;
		}

		/*logo*/
		.logo{
			margin-left: 30px;
			width:200px;
			height:150px;
			margin-right: 70px;
		}

		/*login and checout*/


		.topright{
			margin-top: 25px;
			width: 500px;
			height: 75px;
			margin-right:35px;
			padding-left: 50px;
			padding-top:20px;
			padding-bottom:10px;
		}

		.tooltip{
			position: relative;
			z-index: 20;
			text-decoration: none;
			color: blue;
		}

		.tooltip span{
			display: none;
		}

		.tooltip:hover{
			z-index:25;
		}

		.tooltip:hover span{
			display: block;
			width:100px;
			text-align: center;
			height: 15px;
			padding: 5px;
			color: black;
			background-color: #33BBFF;
			font-size: 15px;
			text-decoration: none;
			position: absolute;
			border-radius: 4px;
			top:25px;
			left:-6px;
		}


		.tooltip-log{
			position: relative;
			z-index: 20;
			text-decoration: none;
			color: blue;
		}

		.tooltip-log span{
			display: none;
		}

		.tooltip-log:hover{
			z-index:25;
		}

		.tooltip-log:hover span{
			display: block;
			width:100px;
			text-align: center;
			height: 15px;
			padding: 5px;
			color: black;
			background-color: #33BBFF;
			font-size: 15px;
			text-decoration: none;
			position: absolute;
			border-radius: 4px;
			top:60px;
			left:3px;
		}

		.topright button{
			margin-right: 60px;
			border:none;
			background-color: black;
		}

		.topright button:hover{
			cursor:pointer;
		}


		.topright a{
			margin-right: 60px;
		}

		.user{
			padding-left: 25px;
			width:50px;
			height:50px;
		}

		.checkoutLink{
			margin-bottom: 7px;
			padding-left: 32px;
			width:30px;
			height:30px;
		}


		.form{
			float: right;
			
		}
	</style>
</head>

<header class="header">
	
	<img class="logo" src="images/logo.jpg">
	

	<?
	session_start();
	//add logout image
	if(isset($_SESSION['username'])){
		echo '<form class="form" action="logoutScript.php" methoud="POST">
		<div class="topright">';

		if($_SESSION['username'] == "steVSaY4JUIjc")
			echo '<a href="welcomePage.php" class="tooltip"><img src="images/home.png" class="user"><span>Home</span></a>';
		echo '
		<a href="advancedSearch.php" class="tooltip"><img src="images/search.jpg" class="user"><span>Search</span></a>

		<button name="logout-btn" class="tooltip-log"><img src="images/logout.png" class="user"><span>Logout</span></button>

		<a href="cart.php" class="tooltip"><img src="images/checkout.png" class="checkoutLink"><span>My Cart</span></a>

		</div>
		</form>';
		//print_r($_SESSION);
	}else{
		echo '<form class="form" action = "loginScript.php" method="POST">
		<div class="topright">

		<a href="advancedSearch.php" class="tooltip"><img src="images/search.jpg" class="user"><span>Search</span></a>

		<a href="loginPage.php" class="tooltip"><img src="images/user.png" class="user"><span>Login</span></a>
		<a href="cart.php" class="tooltip"><img src="images/checkout.png" class="checkoutLink"><span>My Cart</span></button>

		</div>
		</form>';
	}

	?>
</header>