<?php
   session_start();
  if(!isset($_SESSION['umail']))
  {
    header("location:login.php"); 
  }

  include("connect.php");
  
  
 
  $id = $_POST['id'];
  $question = $_POST['question'];

  if(!empty($question)&& !empty($id))
  {
   
   $query = "UPDATE `boot_questions` SET questions='".$question."' WHERE id='".$id."'";
     
   if(mysqli_query($con,$query))
    {
  
 echo 1;
   
  
  
  }else
  {
  
     echo "0";
  
  }
  }
  
  


  









?>