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

		$chkquery = mysqli_query($con,"select id, email from boot_reguser where email='".$email."' and password='".$pass."' and role='user'");
		$chkdata = mysqli_num_rows($chkquery);
		if($chkdata>0)
		{
			while($row = mysqli_fetch_assoc($chkquery)){
				$user_id = $row['id'];
			}
			$_SESSION["rmail"] = $email;
			$_SESSION['user_id'] = $user_id;
			header("location:index.php");
		}
		else
		{
		
			$_SESSION["error"]="wrong userid or password..!";
			$_SESSION["class"]="alert-danger";
			header("location:login.php");
		}

		//$jsondata = json_encode($response);
		//print_r($jsondata);
		
		//header("location:index.php");
	}
	
?>