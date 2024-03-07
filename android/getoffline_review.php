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
                  $totalscore='';
        
        
        
        
        
        
        
        $review_q = mysqli_query($con,"select distinct reviewId from boot_reviews where userid='".$userid."'");
        
        if(mysqli_num_rows($review_q)>0)
        {
            while($rows = mysqli_fetch_assoc($review_q))
            {
                $allreview[] = $rows['reviewId'];
            }
        }

        if(!count($allreview))
        {
          
          $alldata = array("status"=>0, "response"=>"data not found");
           header('Content-type: application/json');
           print_r(json_encode($alldata,JSON_UNESCAPED_SLASHES));
           
           exit();
          
        }
        
        $all_q='';
        
        foreach($allreview as $allre)
        {
       // echo "select sum(answer1) as totalscore from boot_reviews where userid='".$userid."' and reviewId='".$allre."'"; die;
        $totq = mysqli_query($con,"select sum(answer1) as totalscore from boot_reviews where userid='".$userid."' and reviewId='".$allre."'");
        while($rows = mysqli_fetch_assoc($totq))
        {
            $totalscore = $rows['totalscore'];
        }
        
        
        
                $query = "SELECT DISTINCT sections,question_id,reviewId,questions,answer1 from boot_reviews where userid='".$userid."' and reviewId= '".$allre."' ";
        	
		$result = mysqli_query($con,$query) ;
 		
 		
		while($rows = mysqli_fetch_assoc($result))
		{      
		    
		         $rows['totalscore'] = $totalscore; 
			if($rows['sections'] == "Boot Data")
				$all_q['boot_data'][] = $rows;
			if($rows['sections'] == "First Impressions")
				$all_q['first_impressions'][] = $rows;
			if($rows['sections']== "Fit Impressions")
				$all_q['fit_impressions'][]=$rows;
			if($rows['sections'] == "Flex, Tongue, Cuff Height")
				$all_q['Flex'][] = $rows;
			if($rows['sections'] == "Stance Impressions")
				$all_q['Stance_Impressions'][] = $rows;
			if($rows['sections'] == "DRY-TEST SUMMARY")
				$all_q['Dry_test_summary'][] = $rows;
			if($rows['sections'] == "Other Fit Stuff & Gizmos")
				$all_q['other_fit'][] = $rows;
			if($rows['sections'] == "Summary on-snow test")
				$all_q['Summary_on_show'][] = $rows;
			if($rows['sections'] == "Custom Technology/Fitting (Ignore if not relevant to boot model)")
				$all_q['Custom_Technology'][] = $rows;
			if($rows['sections'] == "Hike Mode Boot Scores (ignore if not relevant to boot model)")
				$all_q['hike_boot'][] = $rows;
			if($rows['sections'] == "RATINGS SELECTIONS")
				$all_q['Ratings_selections'][] = $rows;
			if($rows['sections'] == "Final Thoughts")
				$all_q['Final_Thoughts'][] = $rows;
			
			
			
			
			
		}
		
			$data[] = $all_q;
			unset($all_q);
		

	}
 		// while ($rows = mysqli_fetch_assoc($query)):

   //        	$qdata = array("status"=>1, "Response"=>$rows);

   //       	 endwhile;
               
			$alldata = array("status"=>1, "response"=>$data);

           header('Content-type: application/json');
           print_r(json_encode($alldata,JSON_UNESCAPED_SLASHES));
           
           exit();
	
	
	
	}
	?>