<?php
	//header('Content-type: text/xml');
	$response="";
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
		$pass = $_POST['pass'];
		
		

		$chkquery = mysqli_query($con,"select id,email,username,shop,role from boot_reguser where email='".$email."' and password='".$pass."' and role='user'");
		$chkdata = mysqli_num_rows($chkquery);
		if($chkdata>0)
		{
			if($row = mysqli_fetch_assoc($chkquery))
			{
				$userid = $row['id'];
				$username = $row['username'];
				$shopname = $row['shop'];
				$role = $row['role'];	
			}
			$response = array( "Response" => array("Status"=>"1","userdata"=>
        array('userid'=>$userid,"username"=>$username,"email"=>$email,"shopname"=>$shopname,"role"=>$role)));
		}
		else
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Wrong userid or password.")));
		}
		mysqli_close($con);
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
		
		//header("location:index.php");
	}
	
?>