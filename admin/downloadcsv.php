<?php
include("connect.php");
$q = "SELECT ANY_VALUE(br.userid) as userid, ANY_VALUE(br.reviewId) as reviewId, ANY_VALUE(bu.email) as email,ANY_VALUE(bu.username) as username, ANY_VALUE(bu.shop) as shop  FROM boot_reviews as br JOIN boot_reguser as bu ON bu.id = br.userid group by br.reviewId";




//echo $q; die;

$ALL = mysqli_query($con, $q);
$email = "";
$shop = "";
$userid = "";
$reviewId = "";
$userdata = [];
$data = [];
while ($alldata = mysqli_fetch_assoc($ALL)) {

    $email = $alldata['email'];
    $shop = $alldata['shop'];
    $reviewId = $alldata['reviewId'];
    $userid = $alldata['userid'];
    $username = $alldata['username'];



    $q2 = "select sections, questions, answer1 ,created_on from boot_reviews where userid ='" . $userid . "' and reviewId = '" . $reviewId . "'";
    // echo $q2;

    $userdata['Userid'] = $email;
    $userdata['ShopName'] = $shop;
    $userdata['TesterName'] = $username;
    $cnt = 1;
    $total_score = 0;

    if ($ALL2 = mysqli_query($con, $q2)) {
        while ($reviewData = mysqli_fetch_assoc($ALL2)) {

            if ($reviewData['sections'] === "Boot Data" && $reviewData['questions'] === "BRAND") {
                $userdata['BrandName'] =  $reviewData['answer1'];
            } else if ($reviewData['sections'] === "Boot Data" && $reviewData['questions'] === "MODEL") {
                $userdata['ModelName'] =  $reviewData['answer1'];
            } else if ($reviewData['sections'] === "Boot Data" && $reviewData['questions'] === "CATEGORY") {
                $userdata['CategoryName'] =  $reviewData['answer1'];
            } else if ($reviewData['sections'] === "Boot Data" && $reviewData['questions'] === "GENDER") {
                $userdata['GenderName'] =  $reviewData['answer1'];
            } else if ($reviewData['sections'] === "Boot Data" && $reviewData['questions'] === "TEST TYPE") {
                $userdata['TestType'] =  $reviewData['answer1'];
            } else if ($reviewData['sections'] === "Other fit") {
                $total_score += $reviewData['answer1'];
            } else {
                $userdata['TotalScore'] = $total_score / 5;
                $userdata['question' . $cnt] = $reviewData['questions'];
                $userdata['answer' . $cnt] = $reviewData['answer1'];

                $cnt++;
            }
        }

        $data[] = $userdata;
    }
}

//echo "<pre>";
//print_r($data); die;


function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// file name for download
$fileName = "Bootfitter_score_report" . date('Ymd') . ".xls";

// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");

$flag = false;
foreach ($data as $row) {
    if (!$flag) {
        // display column names as first row
        echo implode("\t", array_keys($row)) . "\n";
        $flag = true;
    }
    // filter data
    array_walk($row, 'filterData');
    echo implode("\t", array_values($row)) . "\n";
}

exit;
