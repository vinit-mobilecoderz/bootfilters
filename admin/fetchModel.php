<?php
include('connect.php');
if(isset($_GET['brand_id'])){
	$brand_data = '<option cat_data_value="" value="Select Model">Select Model</option>';
	$brand_id =  $_GET['brand_id'];
	$brand_qry = "select * from models where brand_id = $brand_id";
	$boot_ques = mysqli_query($con,$brand_qry);
	while($boot_quesrow = mysqli_fetch_array($boot_ques)){
		$brand_data .= '<option cat_data_value="'.$boot_quesrow['category'].'" value="'.$boot_quesrow['modelname'].'">'.$boot_quesrow['modelname'].'</option>';
	}
	echo $brand_data;
}