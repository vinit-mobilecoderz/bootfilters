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
	
	$userid = $_POST['userid'];
	$review_id = $_POST['reviewid'];
	if(!empty($userid)&&!empty($review_id))
	{
	
	
		$chk = mysqli_query($con,"select id from boot_reviews where userid='".$userid."'");
		//$del= mysqli_query($con,"delete from sk_userreview where id='".$reviewid."'");
	if(mysqli_num_rows($chk)>0)
	{
		$del="delete from boot_reviews where userid='".$userid."' AND reviewId='".$review_id."' ";
		
		if($con->query($del) === TRUE)
		{
			$response = array("Response" => array("Status"=>"1","userdata"=>array("message"=>"Data Succesfully Deleted..!")));
		}
		else
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"sorry.! Internal Error, try again.")));
		}
	}
	else
	{
		$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Data not found..!")));
	}
		
	}else
	{
	
	   	$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"parameter missing..!")));
	
	}
	
	
	mysqli_close($con);
	
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
	}
?>