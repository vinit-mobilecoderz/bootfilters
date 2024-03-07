<?php
	include("../connect.php");
	$review_id = mysqli_query($con,"select DISTINCT reviewId from boot_reviews ");
	
	while($rev_id = mysqli_fetch_assoc($review_id))
	{
		$rows[]=$rev_id;
		
		
		
	}
	foreach($rows as $reviews_id)
	{
	   $revs_id[] = $reviews_id;
	}
	foreach( $revs_id as $id)
	{
	  $ids = $id['reviewId'];
	 
       $query = mysqli_query($con,"select DISTINCT reviewId,question_id,questions,answer1 from boot_reviews WHERE reviewId = '".$ids."' AND question_id IN (1,2,3) ");
       
       while($row = mysqli_fetch_assoc($query))
	{
		
		$data[]  = $row;
		
		
	}
       
       }//die;
      //print_r($data);
      //die;
      $cnt=0;
       foreach($data as $datas)
	{
	
	 $cnt++; 
	  
	  $answer = $datas['answer1'];
	  $review = $datas['reviewId'];
	  if($datas['question_id'] == 1)
	  {
	  	$alldata['first_name'] = $answer;
	  	
	   }
	   else if($datas['question_id'] == 2)
	   {
	   
	   $alldata['last_name'] = $answer;
	   
	   }else if($datas['question_id'] == 3)
	   {
	   
	     $alldata['hobby'] = $answer;
	   
	   }
	   
	   
	   $alldata['reviewId'] = $review;
	  
	  if($cnt == 4)
	  {
	       
	  	 $ques_data[] = $alldata;
	  	 
	  	 
	  	 $cnt=0;
	  }else if($cnt == 3)
	  {
	  
	   $ques_data[] = $alldata;
	  
	  	 $cnt=0;
	  
	  
	  }
	
	
	
	
	}
	
      
      
	
	print_r(json_encode($ques_data));
?>