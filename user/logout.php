<?php
	session_start();
	unset($_SESSION['rmail']);

	// print_r($_SESSION); die;


	// session_start();
	// $_SESSION["class"]="alert-success";
	// $_SESSION["error"]="You are successfully logout.";
	header("location:login.php");

?>
