<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		echo "3";
	}
	else
	{
		include("connect.php");
		$data = $_POST;
		$q = "UPDATE  `brands` SET  `brandname` =  '".$data['brandname']."' WHERE  id ='".$data['id']."'";
		// echo $q; die;
		$brandupdate = mysqli_query($con, $q);
		if($brandupdate)
			echo "1";
		else
			echo "0";

	}
?>