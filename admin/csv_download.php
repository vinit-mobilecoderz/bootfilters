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
$my_data  =[];
while ($alldata = mysqli_fetch_assoc($ALL)) {
    $my_data[] = $alldata; 
    
    $email = $alldata['email'];
    $shop = $alldata['shop'];
    $reviewId = $alldata['reviewId'];
    $userid = $alldata['userid'];
    $username = $alldata['username'];



    $q2 = "SELECT sections, questions, answer1 ,created_on from boot_reviews where userid ='" . $userid . "' and reviewId = '" . $reviewId . "'";
    // echo $q2;

    $userdata['Userid'] = $email;
    $userdata['ShopName'] = $shop;
    $userdata['TesterName'] = $username;
    $cnt = 1;
    $total_score = 0;

    if ($ALL2 = mysqli_query($con, $q2)) {
        while ($reviewData = mysqli_fetch_assoc($ALL2)) {

            $userdata['section']  = $reviewData['sections'];
            $userdata[$reviewData['questions']] = $reviewData['answer1'];
            // $userdata['answer']   = $reviewData['answer1'];

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
            }
        }
        $data[] = $userdata;
    }
}
var_dump ($my_data);
die("Testing csv");

// for ($i = 0; $i < count($data); $i++) {
//     if (array_key_exists('question1', $data[$i])) {
//         unset($array[$i]['question1']);
//     }
//     if (array_key_exists('question2', $data[$i])) {
//         unset($array[$i]['question2']);
//     }
//     if (array_key_exists('question3', $data[$i])) {
//         unset($array[$i]['question3']);
//     }
//     if (array_key_exists('question4', $data[$i])) {
//         unset($array[$i]['question4']);
//     }
//     if (array_key_exists('question5', $data[$i])) {
//         unset($array[$i]['question5']);
//     }
//     if (array_key_exists('question6', $data[$i])) {
//         unset($array[$i]['question6']);
//     }
//     if (array_key_exists('question7', $data[$i])) {
//         unset($array[$i]['question7']);
//     }
//     if (array_key_exists('question8', $data[$i])) {
//         unset($array[$i]['question8']);
//     }
//     if (array_key_exists('question9', $data[$i])) {
//         unset($array[$i]['question9']);
//     }
//     if (array_key_exists('question10', $data[$i])) {
//         unset($array[$i]['question10']);
//     }
// }
//echo "<pre>";
// $data = array_slice($data, 0, 5);
// echo json_encode($data);
// die;


function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}


// Set the filename for the CSV file
$filename = 'data' . date('Y-m-d') . '.csv';

// Set the HTTP headers to force a file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Open a PHP output stream to the browser
$fp = fopen('php://output', 'w');

$header = array_keys($data[0]);
fputcsv($fp, $header);

// Loop through the array and write each row to the CSV file
foreach ($data as $row) {
    fputcsv($fp, $row);
}
// Close the output stream
fclose($fp);
