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
	$oldpass = $_POST['oldpass'];
	$nwpass = $_POST['nwpass'];
	
	$chkpass = mysqli_query($con,"select username from boot_reguser where password = '".$oldpass."' and email='".$email."'");
	$num = mysqli_num_rows($chkpass);
	if($num>0)
	{
		$upd = mysqli_query($con,"UPDATE  `boot_reguser` SET  `password` =  '".$nwpass."' WHERE  email ='".$email."'");
		if($upd)
		{
			$response = array("Response" => array("Status"=>"1","userdata"=>array("message"=>"Password successfully changed..!")));
		}
		else
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"sorry.! Internal Error, try again.")));
		}
		
	}
		else
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Incorrect your old password.")));
			//$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>$email)));
		}
		
	
	mysqli_close($con);
	
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
	}
?>