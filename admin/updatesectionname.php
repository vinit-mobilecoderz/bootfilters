<?php
	if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		echo "3";
	}
	else
	{
		include("connect.php");
		$data = $_POST;
		$q = "UPDATE  `boot_sections` SET  `sections` =  '".$data['section']."' WHERE  id ='".$data['id']."'";
		// echo $q; die;
		$sectionupdate = mysqli_query($con, $q);
		if($sectionupdate)
			echo "1";
		else
			echo "0";

	}
?>