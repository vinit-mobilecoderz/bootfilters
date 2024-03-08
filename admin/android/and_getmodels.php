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
		
		
		

		if(isset($_POST['id'])){
			$id = $_POST['id'];
		} else{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Require parameter missing.")));
			header('Content-type: application/json');
			$jsondata = json_encode($response);
			print_r($jsondata);
			die;
		}

		$all_q = [];
		$q = "SELECT modelname,category, brand_id from models where brand_id = '".$id."'";
		// echo $q; die;
		$res = mysqli_query($con, $q);
		if(mysqli_num_rows($res)>0){
			while($rows = mysqli_fetch_assoc($res))
			{
				$all_q[] = $rows;

			}
			$response = array("status"=>"1", "message"=>"models list","response"=>$all_q);
		} else{
			$response = array("status"=>"1", "message"=>"data not found.","response"=>$all_q);
		}


		
		
		
		//print_r($response);
		
		
		
		mysqli_close($con);
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);
		
		
	}
	
?>