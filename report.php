<?php
session_start();
include 'db.php';
include_once 'like.php';
$rpid = $_POST['postid'];
$rpuid = getIdOfUser($_SESSION['username'],$db);
$postowner= getNameOfUser(whoPostedThis($rpid,$db),$db);
$reportreason = $_POST['repres'];
if($_POST['repres'] == "Other"){
	$reportreason .= " ({$_POST['reason']})";
}
$reptxt = "Received new report about post $rpid.<br><b>Reason: </b>$reportreason<br><br><b>Report request IP: </b>{$_SERVER['REMOTE_ADDR']}<br><b>Owner of post: </b>$postowner<br><b>Reporter: </b>{$_SESSION['username']}<br><b>Post description: </b>".getDataRaw("description","posts","postid = $rpid",$db)."<br><b>Report date: </b>".date("Y.m.d-H:i:s")."<br><br><br><b>Direct link to the post: </b><a href=\"http://returnnull.xyz#$rpid\">Click Here</a><br>If the post is deleted, click <a href=\"http://returnnull.xyz/uploads/uploads/".getDataRaw("imagename","posts","postid = $rpid",$db)."\">here</a> to access the picture.";
//echo $reptxt;


require "PHPMailer/PHPMailerAutoload.php";

function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = 'smtp.zoho.com';
        $mail->Port = 587;  
        $mail->Username = 'no-reply@returnnull.xyz';
        $mail->Password = '1K@r@koc2';   
   
   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From="no-reply@returnnull.xyz";
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $error ="Please try again later. Error occured while processing. Contact support@returnnull.xyz for more info.";
            return $error; 
        }
        else 
        {
            $error = "Thank You! Your report is sent.";  
            return $error;
        }
    }
    
    $to   = 'moderators@returnnull.xyz';
    $from = 'no-reply@returnnull.xyz';
    $name = 'No-Reply';
    $subj = 'Received new report';
    $msg = $reptxt;
    
    
    if(isset($_SESSION['username'])){
    $error=smtpmailer($to,$from, $name ,$subj, $msg);
}else{
$error ="You need to log in to do that.";
}   
    
?>


<html>
    <head>
        <title>Report Post - ReturnNull.xyz</title>
        
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="background: black;">
        <center><h2 style="padding-top:70px;color: white;"><?php echo $error; ?></h2></center>
        <center><a href="/#<?php echo $rpid; ?>">Return to the main page</a></center>
    </body>
    
</html>
