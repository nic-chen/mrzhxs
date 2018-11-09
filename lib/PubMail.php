<?php
require_once('settings.php');
include_once(LIBPATH."lib.php");
include_once(APPROOT."phpmailer/class.phpmailer.php");

/**
发送MAIL函数
*/
function SendHtmlMail($to, $fromMail, $fromName, $subject, $body, $userName, $userPwd, $youjuIP, $youjuDuanKou, $AttachmentFilePath, $AttachmentFileName)
{
//die("function SendHtmlMail($to, $fromMail, $fromName, $subject, $body, $userName, $userPwd, $youjuIP, $youjuDuanKou, $AttachmentFilePath, $AttachmentFileName)");
	$mail = new PHPMailer();
	$mail->CharSet = "UTF-8"; // 设置编码
	
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
	
	$mail->Subject = stripslashes($subject);
	$mail->Body = stripslashes($body);
	if (strlen($AttachmentFilePath)>0 && strlen($AttachmentFileName)>0)
		$mail->AddAttachment($AttachmentFilePath,$AttachmentFileName); 
	//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	
	if(!$mail->Send())
	{
	 echo "Message could not be sent. <p>";
	 echo "Mailer Error: " . $mail->ErrorInfo;
	 exit;
	}
}

/**
发送邮件，均从管理员帐号发出。
*/
function SentHtmlMailByAdminMail($to, $subject, $body)
{
	
	$rootDetailInfo=array();
	$admin = new admin;
	if ($admin->GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
			;
	else
	{
			echo "cant find the administrator, pls check your website config.";
			return false;	//没有找到root帐号
	}
	//echo "SendHtmlMail($to, $rootDetailInfo[5], $rootDetailInfo[7], $subject, $body, $rootDetailInfo[5], $rootDetailInfo[6])";
	if (strlen($rootDetailInfo[11])>0)
		SendHtmlMail($to, $rootDetailInfo[5], $rootDetailInfo[7], $subject, $body, $rootDetailInfo[5], $rootDetailInfo[6], $rootDetailInfo[11], $rootDetailInfo[12], "", "");
	else
	{

		$webConDetailInfo=array();
		GetWebConfigDetailInfo($webConDetailInfo);
		SendHtmlMail($to, $rootDetailInfo[5], $rootDetailInfo[7], $subject, $body, $rootDetailInfo[5], $rootDetailInfo[6], $webConDetailInfo[3], $webConDetailInfo[4], "", "");
	}
}

/**
发送邮件，从管理员帐号发出。带有附件
*/
function SentHtmlMailByAdminMailWithAttachment($to, $subject, $body, $AttachmentFilePath, $AttachmentFileName)
{
	
	$rootDetailInfo=array();
	if (GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
			;
	else
	{
			echo "cant find the administar 'root', pls check your website config.";
			return false;	//没有找到root帐号
	}
	//echo "SendHtmlMail($to, $rootDetailInfo[5], $rootDetailInfo[7], $subject, $body, $rootDetailInfo[5], $rootDetailInfo[6])";
	if (strlen($rootDetailInfo[11])>0)
		SendHtmlMail($to, $rootDetailInfo[5], $rootDetailInfo[7], $subject, $body, $rootDetailInfo[5], $rootDetailInfo[6], $rootDetailInfo[11], $rootDetailInfo[12], $AttachmentFilePath, $AttachmentFileName);
	else
	{
		$webConDetailInfo=array();
		GetWebConfigDetailInfo($webConDetailInfo);
		SendHtmlMail($to, $rootDetailInfo[5], $rootDetailInfo[7], $subject, $body, $rootDetailInfo[5], $rootDetailInfo[6], $webConDetailInfo[3], $webConDetailInfo[4], $AttachmentFilePath, $AttachmentFileName);
	}
}
?>