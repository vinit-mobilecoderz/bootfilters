<?php
	 session_start();
  if(!isset($_SESSION['umail']))
  {
    header("location:login.php"); 
  }
  
?>

<html>
	<head>
		
		<title>Edit Question</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
  		<link href="css/jquery.dataTables.min.css" rel="stylesheet">
  		<link rel="shortcut icon" href="http://www.bootfitters.com/themes/boots/favicon.ico" type="image/vnd.microsoft.icon" />
	</head>
	<body>
		<?php
			include("header.php");
			include("connect.php");
			
			

			
                        
			
		?>
		
		<div class="container">
		
		<div class="row">
			<div class="col-sm-3">
				<ul class="nav nav-pills nav-stacked">
				    <li class="active"><a class="btn btn-default btn-block"  data-toggle="pill" href="#bootdata">Boot Data</a></li>
				    <li class=""><a class="btn btn-default btn-block" data-toggle="pill"  href="#first_impress">First Impressions</a></li>
				    <li class=""><a class="btn btn-default btn-block"data-toggle="pill"  href="#fit_impress">Fit Impressions</a></li>
				    <li class=""><a class="btn btn-default btn-block" data-toggle="pill"  href="#flex">Flex, Tongue, Cuff Height</a></li>
				    <li class=""><a class="btn btn-default btn-block"data-toggle="pill"  href="#Stance_impress">Stance Impressions</a></li>
				    <li class=""><a class="btn btn-default btn-block" data-toggle="pill"  href="#dry_test">DRY-TEST SUMMARY</a></li>
				    <li class=""><a class="btn btn-default btn-block"data-toggle="pill"  href="#other_fit">Cool Features & New Technology</a></li>
				    <li class=""><a class="btn btn-default btn-block"data-toggle="pill"  href="#onsnowtest">On Snow Test</a></li>
				    <li class=""><a class="btn btn-default btn-block" data-toggle="pill"  href="#on_show">Summary on-snow test</a></li>
				    <li class=""><a class="btn btn-default btn-block"data-toggle="pill"  href="#custom_tech">Custom Technology/Fitting</a></li>
				    <li class=""><a class="btn btn-default btn-block" data-toggle="pill"  href="#hike_mode">Hike Mode Boot Scores</a></li>
				    <li class=""><a class="btn btn-default btn-block"data-toggle="pill"  href="#rating">RATINGS SELECTIONS</a></li>
				    <li class=""><a class="btn btn-default btn-block" data-toggle="pill"  href="#final_thought">Final Thoughts</a></li>
				</ul>

			</div>
			<div class="col-sm-9" style="margin-top: -2%">
				<div class="tab-content">
				 <div id="bootdata" class="tab-pane fade in active">
				      <h3>Boot Data</h3>
				       
				      		<?php   $boot_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Boot Data'";
									
							$boot_ques = mysqli_query($con,$boot_data);
							if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){
						          
                                                        ?>
                                                       
				      	<form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="boot_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','boot_data<?=$count?>','boot<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="boot<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				    
				      		  <?php $count++;  } ?>
				      		</div>	
				      		
				    <div id="first_impress" class="tab-pane fade">
				      <h3>First Impressions</h3>
				     
				      			<?php  
				      			 $first_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='First Impressions'";
									
							$first_ques = mysqli_query($con, $first_data);
							
							if($first_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($first_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="first_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','first_data<?=$count?>','first<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="first<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="fit_impress" class="tab-pane fade">
				      <h3>Fit Impressions</h3>
				      
				      			<?php  
				      			 $fit_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Fit Impressions'";
									
							$fit_ques = mysqli_query($con, $fit_data);
							
							if($first_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($fit_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" name="questions" id="fit_data<?=$count?>" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','fit_data<?=$count?>','fit<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="fit<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="flex" class="tab-pane fade">
				      <h3>Flex, Tongue, Cuff Height</h3>
				     
				      			<?php  
				      			 $flex_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Flex, Tongue, Cuff Height'";
									
							$flex_ques = mysqli_query($con, $flex_data);
							
							if($flex_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($flex_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" name="questions" id="flex_data<?=$count?>" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','flex_data<?=$count?>','flex<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="flex<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="Stance_impress" class="tab-pane fade">
				      <h3>Stance Impressions</h3>
				      
				      			<?php  
				      			 $Stance_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Stance Impressions'";
									
							$Stance_ques = mysqli_query($con, $Stance_data);
							
							if($Stance_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($Stance_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="Stance_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','Stance_data<?=$count?>','Stance<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="Stance<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="dry_test" class="tab-pane fade">
				      <h3>DRY-TEST SUMMARY</h3>
				      
				      			<?php  
				      			 $dry_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='DRY-TEST SUMMARY'";
									
							$dry_ques = mysqli_query($con, $dry_data);
							
							if($dry_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($dry_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="dry_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','dry_data<?=$count?>','dry<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="dry<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="other_fit" class="tab-pane fade">
				      <h3>Cool Features & New Technology</h3>
				       
				      			<?php  
				      			 $Other_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Cool Features & New Technology'";
									
							$Other_ques = mysqli_query($con, $Other_data);
							
							if($Other_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($Other_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="dry_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','dry_data<?=$count?>','other<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="other<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>


					

<div id="onsnowtest" class="tab-pane fade">
				      <h3>On Snow Test</h3>
				      
				      			<?php  
				      			 $Summary_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='on-snowTest'";
									
							$Summary_ques = mysqli_query($con, $Summary_data);
							
							if($Summary_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($Summary_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="show_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','show_data<?=$count?>','show<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="show<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="custom_tech" class="tab-pane fade">
				      <h3>Custom Technology/Fitting</h3>
				     
				      			<?php  
				      			 $custom_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Custom Technology/Fitting (Ignore if not relevant to boot model)'";
									
							$custom_ques = mysqli_query($con, $custom_data);
							
							if($custom_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($custom_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="custom_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','custom_data<?=$count?>','custom<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="custom<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>




				    <div id="on_show" class="tab-pane fade">
				      <h3>Summary on-snow test</h3>
				      
				      			<?php  
				      			 $Summary_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Summary on-snow test'";
									
							$Summary_ques = mysqli_query($con, $Summary_data);
							
							if($Summary_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($Summary_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="show_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','show_data<?=$count?>','show<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="show<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="custom_tech" class="tab-pane fade">
				      <h3>Custom Technology/Fitting</h3>
				     
				      			<?php  
				      			 $custom_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Custom Technology/Fitting (Ignore if not relevant to boot model)'";
									
							$custom_ques = mysqli_query($con, $custom_data);
							
							if($custom_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($custom_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="custom_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','custom_data<?=$count?>','custom<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="custom<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="hike_mode" class="tab-pane fade">
				      <h3>Hike Mode Boot Scores</h3>
				     
				      			<?php  
				      			 $hike_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Hike Mode Boot Scores (ignore if not relevant to boot model)'";
									
							$hike_ques = mysqli_query($con, $hike_data);
							
							if($hike_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($hike_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="hike_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','hike_data<?=$count?>','hike<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="hike<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="rating" class="tab-pane fade">
				      <h3>RATINGS SELECTIONS</h3>
				      
				      			<?php  
				      			 $rating_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='RATINGS SELECTIONS'";
									
							$rating_ques = mysqli_query($con, $rating_data);
							
							if($rating_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($rating_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="rating_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','rating_data<?=$count?>','rating<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="rating<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				    <div id="final_thought" class="tab-pane fade">
				      <h3>Final Thoughts</h3>
				      
				      			<?php  
				      			 $final_data = "SELECT `questions`,`id` FROM `boot_questions_demo` WHERE sections='Final Thoughts'";
									
							$final_ques = mysqli_query($con, $final_data);
							
							if($final_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_assoc($final_ques)){
						              
                                                        ?>
                                                        <form action="#" id="contactForm"  class="form-group">
				      	
				      		<div class="row">
				      			<label class="control-label">Question <?=$count?></label>
				      			<input type="hidden" name="id" value="<?=$row['id']?>" class="form-control">
				      <div class="input-group">	
				     <input type="text" id="final_data<?=$count?>" name="questions" value="<?=$row['questions']?>" class="form-control">
				    <span class="input-group-btn">
<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('<?=$row['id']?>','final_data<?=$count?>','final<?=$count?>')" >
				     </span>
				      </div>
	 <div class="help-box" id="final<?=$count?>"></div>
				      </div><!--row div closed.-->
				      	
				      	</form>
				      		  <?php $count++;  }	?>
				      		
				    </div>
				</div>

			</div>
		</div><!--row closed..-->
		









		
		
		<?php include("footer.php");?>
			
		</div><!--container closed-->
		
		
		<script>
			
			function getquestion(id,questions,bootid)
			{
			
				var value = $("#"+questions).val();
				var dataString = "id="+id+"&question="+value+"&bootid="+bootid;
				
				$.ajax({
				   
					type:'post',
					url:'update_question.php',
					data:dataString,
					beforeSend:function(){
					
					  $('#'+bootid).fadeIn();
					
					},
					success:function(res){
						
						if(res == 1)
						{
						
						 $('#'+bootid).html('you have updated successfully');
						
						}
					},
					complete:function()
					{
					   
					   
					  $('#'+bootid).fadeOut("slow");
					   
					}
				});
			}
			
			$("#contactForm").submit(function(e){
		e.preventDefault();
	    var data = $("#contactForm").serialize();
	    
	    $.ajax({
	    	type:'post',
	    	url:'update_question.php',
	    	data:data,
	    	success:function(res)
	    	{
	    	    alert(res);
	    		if(res == 1)
	    		{
	    	    
	    			
	    		}
	    		else
	    		{
	    		
	    	   
                    
	    		}
	    	}
	    });
	});
			
		</script>
		
		
	</body>
</html>
