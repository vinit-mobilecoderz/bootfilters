<?php
 session_start();
  if(!isset($_SESSION['rmail']))
  {
    echo "0"; exit;
  }

 include("connect.php");
 	
 	
 	
 	$data = $_POST;
 	
 	$rev_id = $data['id'];
 	unset($data['id']);
 	for($i=1; $i<=count($data)/2; $i++)
 	{
 		$answer = $data["answer".$i];
 	  	$ques_id = $data["question_id".$i];
 	   	$query = "UPDATE `boot_reviews` SET `answer1` = '".$answer."' WHERE question_id='".$ques_id."' AND reviewId='".$rev_id."'";
           $result = mysqli_query($con,$query);

 	}
 	if($result)
      	 {
    
         echo 1;
   
        }else
        {
        echo "0";
       
        }


































?>