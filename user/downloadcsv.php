<?php
session_start();
    include("connect.php");
    $user_id = $_SESSION['user_id'];
    $q = "select `sections`,`questions`,`answer1`,`created_on`,`updated_on` from boot_reviews where userid = '".$user_id."'";
    
    $ALL = mysqli_query($con,$q);
	
	while($alldata = mysqli_fetch_row($ALL))
	{
	
	     
		$data[]=$alldata ;
	}
    
    
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    
    // file name for download
    $fileName = "Bootfitter_export_data" . date('Ymd') . ".xls";
    
    // headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");
    
    $flag = false;
    foreach($data as $row) {
        if(!$flag) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }
    
    exit;
?>