<?php
if($_SERVER['REQUEST_METHOD']=== 'GET')
	{
		header("location:index.php");	
	}
	else
	{
	include("connect.php");
	include("session.php");
	
	
	if(isset($_POST['qid']))
	{
		$id = $_POST['qid'];
		$question1 = $_POST['question1'];
		$question2 = $_POST['question2'];
		$question3 = $_POST['question3'];
		$question4 = $_POST['question4'];
		$question5 = $_POST['question5'];
		$question6 = $_POST['question6'];
		$question7 = $_POST['question7'];
		$question8 = $_POST['question8'];
		$question9 = $_POST['question9'];
		$question10 = $_POST['question10'];
		
		
		$upd = mysqli_query($con,"UPDATE `mobiltoi_skireview`.`reviewquestion` SET `question1` = '".$question1."',`question2` = '".$question2."',`question3` = '".$question3."',`question4` = '".$question4."',`question5` = '".$question5."',`question6` = '".$question6."',`question7` = '".$question7."',`question8` = '".$question8."',`question9` = '".$question9."',`question10` = '".$question10."' WHERE `reviewquestion`.`id` = '".$id."'");
		
		if($upd)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
		
		
	}
	
	
	
	
	
	
		
	
	mysqli_close($con);
	}
	
	
	?>