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
		
		
		$username= $_POST['username'];
		$email = $_POST['email'];
		$shop = $_POST['shop'];
		$pwd = $_POST['pass'];

		// print_r($_POST); die;

		
		if(empty($email) || empty($pwd))
		{
		$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Emailid or Password cannot be blank.")));
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
		exit();	
			
		}
		
		
		$chkquery = mysqli_query($con,"select username from boot_reguser where username='".$username."' or email='".$email."'");
		$chkdata = mysqli_num_rows($chkquery);
		if($chkdata>0)
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Emailid or Username already exist.")));
		}
		else
		{
			$insertquery = mysqli_query($con,"INSERT INTO `boot_reguser` (`id`, `username`, `email`, `password`,`shop`,`datetime`,`role`) VALUES (NULL, '".$username."', '".$email ."', '".$pwd ."', '".$shop ."', CURRENT_TIMESTAMP,'user')") or die(mysqli_error());

			if($insertquery)
			{
				$id = mysqli_insert_id($con);
				$response = array(
    "Response" => array("Status"=>"1","userdata"=>
        array('userid'=>$id,"username"=>$username,"email"=>$email,"shop"=>$shop)));


			}
		
			

		}
		mysqli_close($con);
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
	}
	
?>