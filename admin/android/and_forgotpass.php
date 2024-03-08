<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Request method not accepted..!.")));
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);	
	}
	else
	{
	include("../connect.php");
	
	$email=$_POST['email'];
	
	$chkpass = mysqli_query($con,"select password from boot_reguser where email='".$email."'");
	$num = mysqli_num_rows($chkpass);
	$newpass = rand(100000,999999);
	
	if($num>0)
	{
		$upd = mysqli_query($con,"UPDATE  `boot_reguser` SET  `password` =  '".$newpass."' WHERE  email ='".$email."'");
		if($upd)
		{
			$response = array("Response" => array("Status"=>"1","userdata"=>array("message"=>"Your new password sent your registered email id ")));
			
			
			
		}
		else
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"sorry.! Internal Error, try again.")));
		}
		
	}
	else
	{
		$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Sorry, Doesn't recognize that email.")));
	}
		
	
	mysqli_close($con);
	
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
	}
?>