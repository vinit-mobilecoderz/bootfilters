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
				    <li class=""><a class="btn btn-default btn-block"data-toggle="pill"  href="#other_fit">Other Fit Stuff & Gizmos</a></li>
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
				       <form action="#" method="post" id="form1"  class="form-group">
				      		<?php  
				      		if(isset($_GET['id']))
				      		  {
				      		  $id = $_GET['id'];
				      		 
		$boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Boot Data' AND reviewId='".$id."'";
						
								
							$boot_ques = mysqli_query($con,$boot_data);
							
							if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){
						         
                                                        ?>
                                                       
				      	
				      	
				      		<div class="row">
				      			<label class="control-label"><?=$row['questions']?></label>
				      			
				      <div class="input-group">
				      
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      </div>
	 
				      </div>
				      	
				         
				      		  <?php $count++;  } ?>
				      		  <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		   <div class="help-box" id="boot1"></div>
				      		   
				      		   <br>
				<input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form1','boot1')" >
         
         

				    
				      	</form>
				      		  
				      		</div>	
				      		
				      		
				      		<div id="first_impress" class="tab-pane fade">
				      		<h3>FIRST IMPRESSIONS</h3>
				         <form action="#" method="post" id="form2"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='First Impressions' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
						          
				       
				      
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				      
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot2"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form2','boot2')" >
				      		
				      		</form>
				      		</div>	
				    
				    <div id="fit_impress" class="tab-pane fade">
				      <h3>FIT IMPRESSIONS</h3>
				      
				      <form action="#" method="post" id="form3"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Fit Impressions' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
						          
				       
				      
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot3"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form3','boot3')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="flex" class="tab-pane fade">
				      <h3>Flex, Tongue, Cuff Height</h3>
				     
				      			<form action="#" method="post" id="form4"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Flex, Tongue, Cuff Height' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
						          
				       
				      
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot4"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form4','boot4')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="Stance_impress" class="tab-pane fade">
				      <h3>Stance Impressions</h3>
				      
				      			<form action="#" method="post" id="form5"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Stance Impressions' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot5"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form5','boot5')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="dry_test" class="tab-pane fade">
				      <h3>DRY-TEST SUMMARY</h3>
				      
				      			<form action="#" method="post" id="form6"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='DRY-TEST SUMMARY' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot6"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form6','boot6')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="other_fit" class="tab-pane fade">
				      <h3>Other Fit Stuff & Gizmos</h3>
				       
				      			<form action="#" method="post" id="form7"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Other Fit Stuff & Gizmos' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot7"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form7','boot7')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="on_show" class="tab-pane fade">
				      <h3>Summary on-snow test</h3>
				      
				      			<form action="#" method="post" id="form8"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Summary on-snow test' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot8"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form8','boot8')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="custom_tech" class="tab-pane fade">
				      <h3>Custom Technology/Fitting</h3>
				     
				      			<form action="#" method="post" id="form9"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Custom Technology/Fitting (Ignore if not relevant to boot model)' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot9"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form9','boot9')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="hike_mode" class="tab-pane fade">
				      <h3>Hike Mode Boot Scores</h3>
				     
				      			<form action="#" method="post" id="form10"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Hike Mode Boot Scores (ignore if not relevant to boot model)' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot10"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form10','boot10')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="rating" class="tab-pane fade">
				      <h3>RATINGS SELECTIONS</h3>
				      
				      			<form action="#" method="post" id="form11"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='RATINGS SELECTIONS' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot11"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form11','boot11')" >
				      		
				      		</form>
				      		
				    </div>
				    <div id="final_thought" class="tab-pane fade">
				      <h3>FINAL THOUGHTS</h3>
				      
				      			<form action="#" method="post" id="form12"  class="form-group">
				      		 
	 
				      <?php 
				        
				        $boot_data = "SELECT DISTINCT `question_id`,`questions`,`answer1` FROM `boot_reviews` WHERE sections='Final Thoughts' AND reviewId='".$id."'";
				       
				        $boot_ques = mysqli_query($con,$boot_data);
				       
							
						if($boot_ques->num_rows > 0)
							     $count=1;
							  while($row = mysqli_fetch_array($boot_ques)){	
	
				       ?>
				       <label class="control-label"><?=$row['questions']?></label>
				       <div class="input-group">
				        
				     <input type="text" id="answer<?=$count?>" name="answer<?=$count?>" value="<?=$row['answer1']?>" class="form-control">
				     <input type="hidden" id="question_id<?=$count?>" name="question_id<?=$count?>" value="<?=$row['question_id']?>" class="form-control">
				      
				      </div>
				      
				      <?php $count++;  } ?>
				      		
				      		 <input type="hidden" id="reviewid" name="id" value="<?=$id?>" class="form-control">
				      		  
				      		   <div class="help-box" id="boot12"></div>
				      		   <br>
 <input type="button" name="submit" value="Update" class="btn btn-primary" onclick="getquestion('form12','boot12')" >
				      		
				      		</form>
				      		  <?php } ?>
				      		
				    </div>
				</div>

			</div>
		</div><!--row closed..-->
		









		
		
		<?php include("footer.php");?>
			
		</div><!--container closed-->
		
		
		<script>
		
			function getquestion(form,bootid)
			{
				var data = $('#'+form).serialize();
				 $.ajax({
				 
			           type:'post',
			            url:'update_answer.php',
			            data:data,
			            beforeSend:function(){
					
					  $('#'+bootid).fadeIn();
					
					},
			            success:function(res)
			            {
			               	if(res == 1)
					{
						
					$('#'+bootid).html('Answer updated successfully');
						
					}
			            },
					complete:function()
					{
					   
					   
					  $('#'+bootid).fadeOut("slow");
					   
					}
			            
        			});
				
					
				
				
				
				
			}
			
			
		</script>
		
		
	</body>
</html>
