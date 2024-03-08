<?php
session_start();
include("connect.php");
if(!isset($_SESSION['umail'])){
	header("location:login.php"); 
}
$userid = $_SESSION['user_id'];
$totalscore='';
$review_q = mysqli_query($con,"select distinct reviewId from boot_reviews where userid='".$userid."'");
if(mysqli_num_rows($review_q)>0){
	while($rows = mysqli_fetch_assoc($review_q))
	{
		$allreview[] = $rows['reviewId'];
	}
}
if(!count($allreview)){
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
foreach($allreview as $allre){	
$totq = mysqli_query($con,"select sum(answer1) as totalscore from boot_reviews where userid='".$userid."' and reviewId='".$allre."' and sections ='on-snowTest'");
while($rows = mysqli_fetch_assoc($totq)){
		$totalscore = $rows['totalscore'];
}
$query = "SELECT DISTINCT sections,question_id,reviewId,questions,answer1 from boot_reviews where userid='".$userid."' and reviewId= '".$allre."' ";
$result = mysqli_query($con,$query) ;
while($rows = mysqli_fetch_assoc($result)){
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
$alldata = array("status"=>1, "response"=>$data);
?>
<html>
	<head>
		<title>Manage Review</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
  		<link href="css/jquery.dataTables.min.css" rel="stylesheet">
  		<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  		<link rel="shortcut icon" href="http://www.bootfitters.com/themes/boots/favicon.ico" type="image/vnd.microsoft.icon" />
	</head>
	<body>
		<?php
			include("header.php");
		?>
	<div class="container">
		<div class="row">
			
			<div class="col-md-10">
				<div class="panel panel-primary">
					<div class="panel-heading">Review's </div>
						<div class="panel-body">
						<table id="example"  style="width:100%" class="table table-striped table-hover dataTable">
							<thead>
								<tr>
									<th>Brand</th>
									<th>Model</th>
									<th>Review Score</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								foreach($alldata["response"] as $value){
							?>
							<tr>
									<td><?php echo $value['boot_data'][0]['answer1'] ?></td>
									<td><?php echo $value['boot_data'][1]['answer1'] ?></td>
									<td><?php echo $value['boot_data'][0]['totalscore'] ?></td>
									<td><a class="btn btn-info btn-sm" href="<?php echo site_url.'admin/editReview.php?review_id='.$value['boot_data'][0]['reviewId'] ;?>">Edit</a></td>
							</tr>
							<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Brand</th>
									<th>Model</th>
									<th>Review Score</th>
									<th>Edit</th>
								</tr>
							</tfoot>							
						</table>
						</div>
					</div>
			</div>
			<div class="col-md-2">
				<a href="<?php echo site_url.'admin/addReview.php'; ?>" class="btn btn-success pull-right" >Add Review</a>
			</div>
		  </div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script>
	/*
	$(document).ready(function() {
		$('#example').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo $site_url;?>reviewsPagination.php"
		} );
	} ); */
	$(document).ready(function () {
		$('#example').DataTable({
		"paging": true // false to disable pagination (or any other option)
		});
		$('.dataTables_length').addClass('bs-select');
	});
	</script>
	</body>
</html>