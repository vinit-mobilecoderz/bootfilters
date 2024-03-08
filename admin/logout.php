<?php
	session_start();
	unset($_SESSION['umail']);
	
	header("location:login.php");
?>