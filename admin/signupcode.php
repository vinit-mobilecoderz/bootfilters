<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		header("location:index.php");	
	}
	else
	{
		session_start();
		$con = mysql_connect("localhost","root","") or die(mysql_error());
			   mysql_select_db("userdata",$con) or die(mysql_error());
		
		$target_dir = "image/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$image = $_FILES["image"]["name"];
		$name = $_POST['name'];
		$userid = $_POST['userid'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$age = $_POST['age'];
		$state = $_POST['state'];
		
		$chkquery = mysql_query("select name from userdetails where userid='".$userid."' or email='".$email."'");
		$chkdata = mysql_num_rows($chkquery);
		if($chkdata>0)
		{
			$response = array("Response" => array("Status"=>"failed","userdata"=>array("message"=>"userid or emailid already exits.")));
			$_SESSION["response"]="<b>Failed!</b> User already Exists.";
			$_SESSION["data"]=$response;
		}
		else
		{
			$insertquery = mysql_query("INSERT INTO `userdetails` (`id`, `name`, `userid`, `email`, `gender`, `age`, `state`, `image`, `date`) VALUES (NULL, '".$name."', '".$userid."', '".$email."', '".$gender."', '".$age."', '".$state."', '".$image."', CURRENT_TIMESTAMP)");

			if($insertquery)
			{
				move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
				$response = array(
    "Response" => array("Status"=>"success","userdata"=>
        array("name"=>$name,"userid"=>$userid,"email"=>$email,"gender"=>$gender,"age"=>$age,"state"=>$state,"state"=>$image)));

			$_SESSION["response"]="<b>SUCCESS!</b> User registration seccessfully.";
			$_SESSION["data"]=$response;

			}
		
			

		}

		$jsondata = json_encode($response);
		print_r($jsondata);

		header("location:index.php");
	}
	
?>