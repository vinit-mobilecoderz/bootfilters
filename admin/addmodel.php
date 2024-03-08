<?php
	session_start();
     if(!isset($_SESSION['umail']))
     {
        header("location:login.php"); 
     }
	else if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		header("location:index.php");	
	}
	else
	{
		include("connect.php");
		$data = $_POST;
		$q = "Insert into models (brand_id,category,modelname) values('".$data['brand_id']."','".$data['category']."','".$data['modelname']."')";
		// echo $q;
		$res = mysqli_query($con, $q);
		if($res){
			$_SESSION['msg']="Model Added Successfully..!";
			$_SESSION['class']="alert-success";
			header("location:manage_model.php");
		} else{
			$_SESSION['msg']="Internal Error, try again..!";
			$_SESSION['class']="alert-danger";
			header("location:manage_model.php");
		}

	}

?>