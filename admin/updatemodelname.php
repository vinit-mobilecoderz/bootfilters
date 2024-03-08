<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		echo "3";
	}
	else
	{
		include("connect.php");
		$data = $_POST;
		//echo "<script>alert(".print_r($data).")</script>";die;
		$q = "UPDATE  `models` SET  `category`='".$data['catval']."',`modelname` =  '".$data['modelname']."' WHERE  id ='".$data['id']."'";
		// echo $q; die;
		$brandupdate = mysqli_query($con, $q);
		if($brandupdate)
			echo "1";
		else
			echo "0";

	}
?>