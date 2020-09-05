<?php 

	$user = "autoplicity";
	$pass = "auto";
	$db = "autoplicity";

	$link = mysql_connect("Mars",$user,$pass);

	if (! $link)
			die("Couldn't connect to my server");


	mysql_select_db($db)
			or die("Coudln't open $db". mysql_error());



?>