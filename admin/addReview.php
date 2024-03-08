<?php
session_start();
include("connect.php");
if(!isset($_SESSION['umail'])){
	header("location:login.php"); 
}
if(isset($_POST['add_review'])){
	/*echo '<pre>';
	print_r($_POST);
	exit;*/
	if( isset($_POST['reviewid']) && !empty( $_POST['reviewid'])){
		$reviewid = $_POST['reviewid'];
    }else{
		$reviewid = uniqid();
	}
	$userid = $_SESSION['user_id'];
	
	$query = "select userid from boot_reviews where userid = '".$userid."' and 	reviewId = '".$reviewid."'";
	$q = mysqli_query($con,$query);
	$rowcount=mysqli_num_rows($q);
	
	if($rowcount==0){
		$loops = count($_POST['answer']);
		$sqllong = array();
		for($ik=0; $ik<$loops; $ik++ ){
			if($ik != 4){
			$sqllong[] = "(".$userid.",'".$reviewid."',".$_POST['quesids'][$ik].",'".mysqli_real_escape_string($con,$_POST['sections'][$ik])."','".mysqli_real_escape_string($con,$_POST['questions'][$ik])."','".mysqli_real_escape_string($con,$_POST['answer'][$ik])."')";
			}else{
			$sqljugar = "(".$userid.",'".$reviewid."',".$_POST['quesids'][$ik].",'".mysqli_real_escape_string($con,$_POST['sections'][$ik])."','".mysqli_real_escape_string($con,$_POST['questions'][$ik])."','".mysqli_real_escape_string($con,$_POST['answer'][$ik])."')";	
			}
		}
		array_push($sqllong,$sqljugar);
		/*echo '<pre>';
		print_r($sqllong);exit;*/
		$query2 = 'INSERT INTO boot_reviews (userid,reviewId,question_id,sections,questions,answer1) values '.implode(',', $sqllong);
		$insert_q = mysqli_query($con, $query2);
	}
}
?>
<html>
	<head>
		<title>Manage Review</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
  		<link href="css/jquery.dataTables.min.css" rel="stylesheet">
  		<link rel="shortcut icon" href="http://www.bootfitters.com/themes/boots/favicon.ico" type="image/vnd.microsoft.icon" />
	</head>
	<body>
		<?php
			include("header.php");
		?>
	<div class="container">
		<form action="" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Boot Data</div>
						<div class="panel-body">
						<?php
						$boot_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Boot Data'";
						$brand_qry = "select * from brands order by brandname ASC";
						$boot_ques = mysqli_query($con,$boot_data);
						if($boot_ques->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($boot_ques)){
						?>
							<div class="form-group">
								
								<?php
								if($boot_quesrow['questions'] == 'BRAND'){
									$brand_qrys = mysqli_query($con,$brand_qry);
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label>
									<select required class="form-control" id="brand_id_codrz"  name="answer[]"
									><option value="">Select Brand</option>';
										while($boot_quess_row = mysqli_fetch_array($brand_qrys)){
											echo "<option data_value='$boot_quess_row[id]' value=".$boot_quess_row['brandname'].">".$boot_quess_row['brandname']."</option>";
										}
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								}
								?>
								<?php
								if($boot_quesrow['questions'] == 'MODEL'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" name="answer[]" id="model_id_codrz" required>';
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'cat'){	
									
									echo "<input type='hidden' id='catsd_id' name='answer[]' value=''/><input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Dropdown' && $boot_quesrow['options']!= ''){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]"  required>';
									echo '<option value="">Select</option>';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control"  name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">First Impression</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='First Impressions'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]">';
									echo '<option value="" required>Select</option>';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Fit Impression</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Fit Impressions'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select name="answer[]" class="form-control" id="">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>				
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Flex,Tounge,Cuff Height</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Flex, Tongue, Cuff Height'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name ="answer[]">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Stance Impressions</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Stance Impressions'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select name="answer[]" class="form-control" id="">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">DRY-TEST SUMMARY</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='DRY-TEST SUMMARY'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">On-Snow Test</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='on-snowTest'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Summary on-snow test</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Summary on-snow test'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row" style="display:none;">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Custom Technology/Fitting (Ignore if not relevant to boot model)</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Custom Technology/Fitting (Ignore if not relevant to boot model)'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group" >
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row" style="display:none;" id="hike_mode">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Hike Mode Boot Scores (ignore if not relevant to boot model)Hike Mode Boot Scores (ignore if not relevant to boot model)</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Hike Mode Boot Scores (ignore if not relevant to boot model)'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group" >
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]">';
									echo "<option value=''>Select</option>";
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Rating Sections</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='RATINGS SELECTIONS'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Final Thoughts</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Final Thoughts'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Dropdown'){
									echo '<label for="sel1">'.$boot_quesrow['questions'].'</label><select class="form-control" id="" name="answer[]">';
									$gender = explode(',',$boot_quesrow['options']);
									foreach($gender as $val)
											echo "<option value='$val'>".$val."</option>";
									echo '</select>';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Cool Features & New Technology</div>
						<div class="panel-body">
						<?php
						$first_impres_data = "SELECT * FROM `boot_questions_demo` WHERE sections='Cool Features & New Technology'";
						$first_impres = mysqli_query($con,$first_impres_data);
						if($first_impres->num_rows > 0)
							$count=1;
							while($boot_quesrow = mysqli_fetch_array($first_impres)){
						?>
							<div class="form-group">
								<?php
								if($boot_quesrow['type'] == 'Text'){
									echo '<input type="text" placeholder="COMMENTS" class="form-control" name="answer[]">';
									echo "<input type='hidden' name='quesids[]' value='$boot_quesrow[id]'><input type='hidden' name='sections[]' value='$boot_quesrow[sections]'><input type='hidden' name='questions[]' value='$boot_quesrow[questions]'>";
								} ?>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
				<input type="submit" class="btn btn-primary" name="add_review">
			</div>
		  </div>
		  </form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$('#brand_id_codrz').change(function(){
			var brand_id = $('option:selected', this).attr('data_value');
			$.ajax({
				url: '<?php echo $site_url;?>fetchModel.php?brand_id='+brand_id,
				type: 'GET',
				//data: { field1: "hello", field2 : "hello2"} ,
				success: function (response) {
					$('#model_id_codrz').html(response);
					
					
					/*var myJSON = JSON.parse(response);
					$.each( myJSON, function( index, value ){
					
					});*/
					
				},
				error: function () {
					alert("error");
				}
			});
		});
		$('#model_id_codrz').change(function(){
			var cat_val = $('option:selected', this).attr('cat_data_value');
			$("#catsd_id").val(cat_val);
		});
	});
	</script>
	</body>
</html>