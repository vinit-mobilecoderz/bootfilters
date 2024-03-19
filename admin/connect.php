<?php
define('site_url','http://localhost:8000/');
	$con = mysqli_connect("localhost","root","password") or die("Error in connection");
			   mysqli_select_db($con,"042017_testapp") or die(mysqli_error($con));
	// $con = mysqli_connect("localhost","bootsm628db","bb6ZGFJ3S2") or die("Error in connection");
	// 		mysqli_select_db($con,"042017_testapp") or die(mysqli_error($con));
	
?>