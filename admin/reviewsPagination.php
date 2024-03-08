<?php
session_start();
include("connect.php");

// ----------------------------
		$userid = $_SESSION['user_id'];
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
        
        $all_q=''; $brands = []; $sections = []; $models = [];

        $query_brand = mysqli_query($con,"SELECT id, brandname from brands") ;
		while($brand = mysqli_fetch_assoc($query_brand)){

			$q = "SELECT modelname,category from models where brand_id = '".$brand['id']."'";
			$qres = mysqli_query($con, $q);
			if(mysqli_num_rows($qres)>0){
				while($rows = mysqli_fetch_assoc($qres))
				{
					$models[] = $rows;
				}
			}
			$brand['model'] = $models;
			$models = [];
			$brands[] = $brand;
		}



        foreach($allreview as $allre)
        {
       
        	
         $totq = mysqli_query($con,"select sum(answer1) as totalscore from boot_reviews where userid='".$userid."' and reviewId='".$allre."' and sections ='on-snowTest'");

	        while($rows = mysqli_fetch_assoc($totq))
	        {
	            $totalscore = $rows['totalscore'];
	        }

        $query = "SELECT DISTINCT sections,question_id,reviewId,questions,answer1 from boot_reviews where userid='".$userid."' and reviewId= '".$allre."' ";
        	
		$result = mysqli_query($con,$query) ;
 		while($rows = mysqli_fetch_assoc($result))
		{      
		   

		         $rows['totalscore'] = $totalscore/5; 
			if($rows['sections'] == "Boot Data"){
				$all_q['boot_data'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'boot_data'];
			}
			if($rows['sections'] == "First Impressions") {
				$all_q['first_impressions'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'first_impressions'];
			}
			if($rows['sections']== "Fit Impressions") {
				$all_q['fit_impressions'][]=$rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'fit_impressions'];
			}
			if($rows['sections'] == "Flex, Tongue, Cuff Height") {
				$all_q['Flex'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Flex'];
			}
			if($rows['sections'] == "Stance Impressions") {
				$all_q['Stance_Impressions'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Stance_Impressions'];
			}
			if($rows['sections'] == "DRY-TEST SUMMARY") {
				$all_q['Dry_test_summary'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Dry_test_summary'];
			}
			if($rows['sections'] == "Cool Features & New Technology") {
				$all_q['cool_features'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'cool_features'];
			}
			if($rows['sections'] == "on-snowTest") {
				$all_q['other_fit'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'other_fit'];
			}
			if($rows['sections'] == "Summary on-snow test"){
				$all_q['Summary_on_show'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Summary_on_show'];
			}
			if($rows['sections'] == "Custom Technology/Fitting (Ignore if not relevant to boot model)") {
				$all_q['Custom_Technology'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Custom_Technology'];
			}
			if($rows['sections'] == "Hike Mode Boot Scores (ignore if not relevant to boot model)") {
				$all_q['hike_boot'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'hike_boot'];
			}
			if($rows['sections'] == "RATINGS SELECTIONS") {
				$all_q['Ratings_selections'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Ratings_selections'];
			}
			if($rows['sections'] == "Final Thoughts"){
				$all_q['Final_Thoughts'][] = $rows;
				$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Final_Thoughts'];
			}
			
			
			
			
			
		}

			$sec = [];
		foreach(array_unique($sections, SORT_REGULAR) as $sect){
			$sec[] = $sect;
		}

		//print_r($sec); die;
		
		$all_q['sections'] = $sec;


		$all_q['brands'] = $brands;
		$data[] = $all_q;
		unset($all_q);
		

	}
 		// while ($rows = mysqli_fetch_assoc($query)):

   //        	$qdata = array("status"=>1, "Response"=>$rows);

   //       	 endwhile;
              
			

			$alldata = array("status"=>1, "response"=>$data);
		/*	foreach($alldata["response"] as $value){
				$data[] = array($value['boot_data'][0]['answer1'],$value['boot_data'][1]['answer1'],$value['boot_data'][0]['totalscore'],'<a class="btn btn-info btn-sm" href="'.site_url.'admin/editReview.php?review_id='.$value['boot_data'][0]['reviewId'].'">Edit</a>');
			}
			echo count($data);
			//echo '<pre>';print_r($alldata);
			exit;*/
// ----------------------------
$data=[];
foreach($alldata["response"] as $value){
	$data[] = array($value['boot_data'][0]['answer1'],$value['boot_data'][1]['answer1'],$value['boot_data'][0]['totalscore'],'<a class="btn btn-info btn-sm" href="'.site_url.'admin/editReview.php?review_id='.$value['boot_data'][0]['reviewId'].'">Edit</a>');
}
$select_column = array("Brand","Model","Review Score");
$totalData = count($data);

/*echo '<pre>';
print_r($data);exit;*/
$json_data = array(
				"draw" => intval($_REQUEST['draw']),
				"recordsTotal"=>intval($totalData),
				"recordsFiltered"=>intval($totalData),
				"data" => $data
			);
echo json_encode($json_data);