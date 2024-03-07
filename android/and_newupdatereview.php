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
	
		
		$jsondata = $jdata = json_decode(file_get_contents('php://input'), TRUE);

		$request_fields = array('userid','questions','reviewId');
		$request_form_success = true;
        
		foreach ($request_fields as $request_field){		
			if (!isset($jsondata[$request_field])) {
                $request_form_success = false;
                break;
			}
		}
	        if (!$request_form_success) {
	            $response['status'] = 0;
	            $response['msg'] = "require parameter missing.";
	        } else {  
	           
	           $userid = $jsondata['userid'];
	           $reviewid = $jsondata['reviewId'];

		   if(empty($reviewid) || $reviewid=='')
		   {
		   	$reviewid = uniqid();
		   }

		   $question = array_values($jsondata['questions']);
	           
	           $query = "select userid from boot_reviews where userid = '".$userid."' and 	reviewId = '".$reviewid."'";
	           
	          // echo $query; die;
	           $q = mysqli_query($con,$query);
	           
	           $rowcount=mysqli_num_rows($q);
  		
	           
	           if($rowcount==0)
	           {
	           	foreach($question as $questions)
			{
				$query2 = "INSERT INTO boot_reviews (`userid`,`reviewId`,`question_id`,`sections`,`questions`,`answer1`) VALUES('".$userid."','".$reviewid."','".$questions['question_id']."','".mysqli_real_escape_string($con,$questions['section'])."','".mysqli_real_escape_string($con,$questions['question'])."','".mysqli_real_escape_string($con,$questions['answer'])."')" or die(mysqli_err());
	
			$insert_q = mysqli_query($con, $query2);
			
			
	
			}
			if($insert_q)
				$response = array("status"=>1,"msg"=>"review added successfully.");
			else
				$response = array("status"=>0,"msg"=>"Something went wrong.");
			
			
	           }
	           else
	           {
	           
	           	//print_r($question); die;
	           
	           	foreach($question as $questions)
			{
				$query3 = "UPDATE `boot_reviews` SET  `answer1` =  '".mysqli_real_escape_string($con,$questions['answer'])."' WHERE  `question_id` ='".$questions['question_id']."' and reviewId= '".$reviewid."'";
				$update = mysqli_query($con,$query3);
				
			
			}
			
			if($update)
				$response = array("status"=>1,"msg"=>"review updated successfully.");
			else
				$response = array("status"=>0,"msg"=>"Something went wrong.");
	           	
	           	
	           	
	           }
	           
	      } 
		
	        header('Content-type: application/json');
		echo json_encode($response);

		mysqli_close($con);
		die;






		

	
		 
		// header('Content-type: application/json');
		// $jsondata = json_encode($response);
		// print_r($jsondata);
	}
?>