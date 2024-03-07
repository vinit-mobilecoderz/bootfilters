<?php
	session_start();
	if(isset($_SESSION['umail']))
	{
		$email = $_SESSION['umail'];

	}
	else
	{
		header("location:index.php");
	}
?>