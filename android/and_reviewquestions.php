<?php
	if($_SERVER['REQUEST_METHOD']=== 'POST')
	{
		$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Request method not accepted..!.")));
		header('Content-type: application/json');
		$jsondata = json_encode($response);
		print_r($jsondata);	
	}
	else
	{
	include("../connect.php");
	
	
		$query =mysqli_query($con,"SELECT id as question_id,sections,questions from boot_questions ") ;
 		
		while($rows = mysqli_fetch_assoc($query))
		{
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

 		// while ($rows = mysqli_fetch_assoc($query)):

   //        	$qdata = array("status"=>1, "Response"=>$rows);

   //       	 endwhile;
          
			$alldata = array("status"=>1, "response"=>$all_q);

           header('Content-type: application/json');
           print_r(json_encode($alldata,JSON_UNESCAPED_SLASHES));
           
           exit();
	
	
	
	}
	?>