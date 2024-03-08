<?php
	include("connect.php");
	session_start();
	
	
		$id = $_GET['id'];
		
		$q = mysqli_query($con,"delete from `boot_reviews` where reviewId='".$id."'");
		
		if($q)
		{
			$_SESSION['msg']="Data Deleted Successfully..!";
			$_SESSION['class']="alert-success";
			header("location:index.php");
		}
		else
		{
			$_SESSION['msg']="Internal Error, try again..!";
			$_SESSION['class']="alert-danger";
			header("location:index.php");	
		}
		
	
		
	
	
?>