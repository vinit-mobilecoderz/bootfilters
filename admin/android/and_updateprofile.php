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
	
	
	$email = $_POST['email'];
	$spname = $_POST['spname'];
	$username = $_POST['username'];
	
		
		$chkq = mysqli_query($con,"select email,username,shop,role from boot_reguser where email = '".$email."'");
		if(mysqli_num_rows($chkq))
		{
			
		
			$upd = mysqli_query($con,"UPDATE  `boot_reguser` SET  `shop` =  '".$spname ."',`username`='".$username."' WHERE  email ='".$email."'");
			if($upd)
			{
				$chkq2 = mysqli_query($con,"select email,username,shop,role from boot_reguser where email = '".$email."'");
				if($row = mysqli_fetch_assoc($chkq2))
				{
				$username = $row['username'];
				$shopname = $row['shop'];
				$role = $row['role'];	
				}
				$response = array( "Response" => array("Status"=>"1","userdata"=> array("username"=>$username,"email"=>$email,"shopname"=>$shopname,"role"=>$role)));
			}
			
		
			else
			{
				$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Internal error, try again.!")));
			}
		}
		else
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Incorrect userid id")));
		}
		
	
	mysqli_close($con);
	header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
	}
?>