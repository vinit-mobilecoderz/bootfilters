<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		header("location:login.php");	
	}
	else
	{
	include("connect.php");
	include("session.php");
	
	$id = $_POST['id']; 
	$reviewid= $_POST['reviewid'];
	$userid = $_POST['userid'];
	$q = mysqli_query($con,"select id from sk_newuserreview where id='".$id."' and userid='".$userid."'");
	
	if(mysqli_num_rows($q)>0)
	{
		$brandname= $_POST['brandname'];
		$modelname= $_POST['modelname'];
		$length= $_POST['length'];
		$shopname = $_POST['shopname'];
		$tester= $_POST['tester'];
		$early_edge= $_POST['early_edge'];
		$continuous_carve_accurate= $_POST['continuous_carve_accurate'];
		$rebound_turn_finish= $_POST['rebound_turn_finish'];
		
		$stability_accuracy_speed= $_POST['stability_accuracy_speed'];
		$short_radius_turns= $_POST['short_radius_turns'];
		$off_piste_performance = $_POST['off_piste_performance'];
		$low_speed_turning= $_POST['low_speed_turning'];
		$forgiveness_ease= $_POST['forgiveness_ease'];
		$drift_scrub= $_POST['drift_scrub'];
		$power_balance= $_POST['power_balance'];
		$distinguishing= mysqli_real_escape_string($con,$_POST['distinguishing']);
		
		$total_review = $early_edge+$continuous_carve_accurate+$rebound_turn_finish+$stability_accuracy_speed+$short_radius_turns+$low_speed_turning+$forgiveness_ease+$drift_scrub+$power_balance+off_piste_performance;
		
		$updquery = mysqli_query($con,"UPDATE `sk_newuserreview` SET `brand`='".$brandname."',`model`='".$modelname."',`length`='".$length."',`shop`='".$shopname."',`tester`='".$tester."',`earlyedge`='".$early_edge."',`continiouscurve`='".$continuous_carve_accurate."',`reboundfinish`='".$rebound_turn_finish."', `stability`='".$stability_accuracy_speed."',`radius_turns`='".$short_radius_turns."',`off_piste`='".$off_piste_performance."',`lowspeed`='".$low_speed_turning."',`faqiveness`='".$forgiveness_ease."',`finesse`='".$power_balance."',`drift`='".$drift_scrub."',`totalreview`='".$total_review."',`distinguishing`='".$distinguishing."' where id='".$id."' ");
		
		
		
		if($updquery)
		{
			$_SESSION['msg']="Data Updated Successfully..!";
			$_SESSION['class']="alert-success";
			header("location:index.php");
		}
		else
		{
			$_SESSION['msg']="Internal Error, try again..!";
			$_SESSION['class']="alert-danger";
			header("location:index.php");
		}
		
		
		
		
		
	}
	else
	{
		$_SESSION['msg']="Internal Error, try again..!";
			$_SESSION['class']="alert-danger";
			header("location:index.php");
	}
	
	
		
		
	
	mysqli_close($con);
	}
?>