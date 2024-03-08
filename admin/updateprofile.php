<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		header("location:login.php");	
	}
	else
	{
	include("connect.php");
	include("session.php");
	
	
	$spname = $_POST['spname'];
	$username = $_POST['username'];
	
	
		$upd = mysqli_query($con,"UPDATE  `boot_reguser` SET  `shop` =  '".$spname ."',`username`='".$username."' WHERE  email ='".$email."'");
		if($upd)
		{
			echo "1";
		}
		
	
		else
		{
			echo "0";
		}
		
	
	mysqli_close($con);
	}
?>