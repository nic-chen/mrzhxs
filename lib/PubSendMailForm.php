<?php
include_once("phpmailer/class.phpmailer.php");

/**
·¢ËÍMAILº¯Êý
*/
function SendHtmlMail($to, $fromMail, $fromName, $subject, $body, $userName, $userPwd, $youjuIP, $youjuDuanKou)
{
//die(stripslashes("get the info=$to, $fromMail, $fromName, $subject, $body, $userName, $userPwd, $youjuIP, $youjuDuanKou <br>"));

	$mail = new PHPMailer();
	$address = $to;
	$mail->IsSMTP(); // set mailer to use SMTP
	$mail->Host = $youjuIP; // specify main and backup server
	$mail->Port = $youjuDuanKou;					  //default is 25, gmail is 465 or 587
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->Username = $userName; // SMTP username
	$mail->Password = $userPwd; // SMTP password
	
	$mail->From = $fromMail;
	$mail->FromName = $fromName;
	$mail->AddAddress("$address", "");

	$mail->IsHTML(true); // set email format to HTML
	
	$mail->Subject = $subject;
	$mail->Body = $body;
	//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	
	if(!$mail->Send())
	{
	 echo "Message could not be sent. <p>";
	 echo "Mailer Error: " . $mail->ErrorInfo;
	 exit;
	}
}

SendHtmlMail(stripslashes($_GET["to"]), stripslashes($_GET["fromMail"]), stripslashes($_GET["fromName"]), stripslashes($_GET["subject"]),
	stripslashes($_GET["body"]), stripslashes($_GET["userName"]), stripslashes($_GET["userPwd"]), stripslashes($_GET["youjuIP"]), stripslashes($_GET["youjuDuanKou"]));
?>
