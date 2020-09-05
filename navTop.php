<style >


html {
  font-family: 'Roboto Condensed', sans-serif;
}

#mainnav {
  position: absolute;
  font-family: 'Roboto Condensed', sans-serif;
  z-index: 1;
}

#mainnav li {
  margin: 15px 0;
  left: -550px;
  position: relative;
  display: none;
}

#mainnav a {
  color: #fff;   
  text-decoration: none;
  font-size: 1.4em;
} 

ul li{
  list-style: none;
  margin-top: -50px;          
}

.gap{
	margin-top: -5px;
}

.hamb {
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 2.5em;
  z-index: 1;
}

.hamb a {
  color: #fff;
  text-decoration: none;
}

.hero {
  width: 100%;
  min-height: 600px;
}

#bubble {
  width: 100%;
  height: 100%;
  opacity: 0.9;
  position: fixed;
  display: none;
  z-index: 1;
  background: rgba(0, 0, 0, .5);
}


</style>

<nav role='navigation' id="mainnav">
	<br><br><br>
	<ul class="gap">
		<li><a href="welcomePage.php?">Home</a></li>
		<li ><a <?if($page=="dealership") {echo 'style="color:#33bbff"';} ?>href="dealership.php?">Dealership</a></li>
		<li><a <?if($page=="partsCatalogue") {echo 'style="color:#33bbff"';} ?>href="partsCatalogue.php?">Parts</a></li>
		<li><a <?if($page=="used") {echo 'style="color:#33bbff"';} ?>href="used.php?">Used</a></li>
		<li><a <?if($page=="sell") {echo 'style="color:#33bbff"';} ?>href="sell.php?">Sell</a></li>
		<li><a <?if($page=="cart") {echo 'style="color:#33bbff"';} ?>href="cart.php">My Cart</a></li>
    <br>
    <?
      if(isset($_SESSION['username'])){
        echo '<li><a';
          if($page=="profile") {echo ' style="color:#33bbff"';}
        echo' href="profile.php">My Profile</a></li>';
      }
       if(isset($_SESSION['username']) && $_SESSION['username']=="steVSaY4JUIjc"){
        echo '<li><a';
          if($page=="admin") {echo ' style="color:#33bbff"';}
        echo' href="admin.php">Admin</a></li>';
      }
    ?>
	</ul>
</nav>  

<div class="hamb">
	<a href="#"><i class="fa fa-bars"></i></a>
</div>