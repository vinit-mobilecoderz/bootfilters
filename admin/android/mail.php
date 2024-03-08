<?php
// ini_set("max_execution_time", 0);
    require_once('PHPMailer_v5.1/class.phpmailer.php'); //library added in download source.
    $msg  = 'Hello World';
    $subj = 'test mail message';
   // $to   = 'abhishek@mobilecoderz.com';
      $to = 'jitendra.091@gmail.com';
    $from = 'jitendra';
    $name = 'jitendra';




    echo smtpmailer($to,$from, $name ,$subj, $msg);
    
    function smtpmailer($to, $from, $from_name, $subject, $body, $is_gmail = true)
    {
        global $error;
        $mail = new PHPMailer();
        $mail->SMTPDebug  = 1;
        $mail->IsSMTP();
       
        $mail->From = $from;
        $mail->FromName=$from_name;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port=465;
        $mail->SMTPAuth = true;
        $mail->Username="miguel.hennry@gmail.com";
        $mail->Password='Qwerty@12345678';
        $mail->WordWrap=50;
        $mail->IsHTML(true);
        $mail->Subject = 'App User Feedback Details';

        $mail->AddAddress($to);
        $mail->AddReplyTo("no-reply@mobilecoderz.com");
      

        if($mail->Send()){echo "send mail successfully";}
        else {echo "sending mail fialed.";}
        }
     
?>