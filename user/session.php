<?php
	session_start();
	if(isset($_SESSION['rmail']))
	{
		$email = $_SESSION['rmail'];

	}
	else
	{
		header("location:index.php");
	}
?>