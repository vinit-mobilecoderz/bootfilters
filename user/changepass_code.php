<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		header("location:login.php");	
	}
	else
	{
	include("connect.php");
	include("session.php");

	$oldpass = $_POST['oldpass'];
	$nwpass = $_POST['nwpass'];
	
	$chkpass = mysqli_query($con,"select username from boot_reguser where password = '".$oldpass."' and email='".$email."'");
	$num = mysqli_num_rows($chkpass);
	if($num>0)
	{
		$upd = mysqli_query($con,"UPDATE  `boot_reguser` SET  `password` =  '".$nwpass."' WHERE  email ='".$email."'");
		if($upd)
		{
			echo "1";
		}
		
	}
		else
		{
			echo "0";
		}
		
	
	mysqli_close($con);
	}
?>