	<?php
		if($_SERVER['REQUEST_METHOD']=== 'POST')
		{
			$response = array("Response" => array("Status"=>"0","userdata"=>array("message"=>"Request method not 

	accepted..!.")));
			header('Content-type: application/json');
			$jsondata = json_encode($response);
			print_r($jsondata);	
		}
		else
		{
		include("../connect.php");
		
		    $brands = []; $sections = []; $models = [];
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

			// $q_section = mysqli_query($con, "select DISTINCT `sections` from boot_questions");
			// while($section = mysqli_fetch_assoc($q_section)){
			// 	$sections[] = $section;
			// }		

			// print_r($models); die;

			//$query =mysqli_query($con,"SELECT t1.id as sectionid,t1.sections as sections,t2.id as question_id,t2.questions, t2.options,t2.type from boot_sections t1 inner JOIN boot_questions t2 on t1.id = t2.sections") ;

			$query =mysqli_query($con,"SELECT id as question_id,sections,questions from boot_questions_demo") ;


	 		
			while($rows = mysqli_fetch_assoc($query))
			{


				     $rows['totalscore'] = $totalscore/5; 
				if($rows['sections'] == "Boot Data"){
				    $all_q['boot_data'][] = $rows;
				   
				    	$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'boot_data'];
				    

				}
				if($rows['sections'] == "First Impressions"){
					$all_q['first_impressions'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'first_impressions'];
				}
				if($rows['sections']== "Fit Impressions"){
					$all_q['fit_impressions'][]=$rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'fit_impressions'];
				}
				if($rows['sections'] == "Flex, Tongue, Cuff Height"){
					$all_q['Flex'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Flex'];
				}
				if($rows['sections'] == "Stance Impressions"){
					$all_q['Stance_Impressions'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Stance_Impressions'];
				}
				if($rows['sections'] == "DRY-TEST SUMMARY"){
					$all_q['Dry_test_summary'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Dry_test_summary'];
				}
				
				if($rows['sections'] == "on-snowTest"){
					$all_q['other_fit'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'other_fit'];
				}
				if($rows['sections'] == "Summary on-snow test"){
					$all_q['Summary_on_show'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Summary_on_show'];
				}
				
				if($rows['sections'] == "RATINGS SELECTIONS"){
					$all_q['Ratings_selections'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Ratings_selections'];
				}
				if($rows['sections'] == "Final Thoughts"){
					$all_q['Final_Thoughts'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Final_Thoughts'];
				}
				if($rows['sections'] == "Cool Features & New Technology"){
					$all_q['cool_features'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'cool_features'];
				}
				if($rows['sections'] == "Custom Technology/Fitting (Ignore if not relevant to boot model)"){
					$all_q['Custom_Technology'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'Custom_Technology'];
				}
				if($rows['sections'] == "Hike Mode Boot Scores (ignore if not relevant to boot model)"){
					$all_q['hike_boot'][] = $rows;
					$sections[] = ['section'=> $rows['sections'], 'section_title'=> 'hike_boot'];
				}
					

			}



			$sec = [];
			foreach(array_unique($sections, SORT_REGULAR) as $sect){
				$sec[] = $sect;
			}
			
			$all_q['sections'] = $sec;
			$all_q['brands'] = $brands;
			// $all_q['models'] = $models;
	 		  
			$alldata = array("status"=>1, "response"=>$all_q);

	        header('Content-type: application/json');
	        print_r(json_encode($alldata,JSON_UNESCAPED_SLASHES));
	        exit();
		
		}
		?>

		