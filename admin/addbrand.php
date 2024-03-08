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
		$q = "Insert into brands (`brandname`) values('".$data['brandname']."')";
		// echo $q;
		$res = mysqli_query($con, $q);
		if($res){
			$_SESSION['msg']="Brand Added Successfully..!";
			$_SESSION['class']="alert-success";
			header("location:manage_brand.php");
		} else{
			$_SESSION['msg']="Internal Error, try again..!";
			$_SESSION['class']="alert-danger";
			header("location:manage_brand.php");
		}

	}

?>
