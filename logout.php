<?php
	session_start();
	session_destroy();
	session_start();
	$_SESSION["class"]="alert-success";
	$_SESSION["error"]="You are successfully logout.";
	header("location:login.php");
?>