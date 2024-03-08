<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		header("location:login.php");	
	}
	else
	{
		session_start();
		include("connect.php");		
		
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		
		$response="";

		$chkquery = mysqli_query($con,"select id,email,role from boot_reguser where email='".$email."' and password='".$pass."'");
		$fetchchkdata = mysqli_fetch_array($chkquery);
		$chkdata = mysqli_num_rows($chkquery);
		if($chkdata>0)
		{
			$response = array( "Response" => array("Status"=>"1","userdata"=>
        array("email"=>$email)));
			$_SESSION["role"] = $fetchchkdata['role'];
			$_SESSION["user_id"] = $fetchchkdata['id'];
			$_SESSION["umail"]=$email;
			header("location:index.php");
		}
		else
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"userid or emailid already exits.")));
			$_SESSION["error"]="wrong userid or password..!";
			$_SESSION["class"]="alert-danger";
			header("location:login.php");
		}

		//$jsondata = json_encode($response);
		//print_r($jsondata);
		
		//header("location:index.php");
	}
	
?>