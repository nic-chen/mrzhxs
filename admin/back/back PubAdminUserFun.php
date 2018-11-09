<?php
require_once("settings.php");

include_once(APPROOT."admin/PubFun.php");

/**
得到管理员登录帐号
*/
function GetAdminSignInName()
{
	if (true==empty($_COOKIE["ADMIN_SIGN_NAME"]))
		return "";
	else
		return $_COOKIE["ADMIN_SIGN_NAME"];
}

/**
把管理员登录帐号写入到COOKIE
*/
function WriteAdminSignInNameToCookie($adminMail)
{
	if (true==empty($adminMail))
		return "";
	else
		setcookie("ADMIN_SIGN_NAME", $adminMail, time()+24*3600, "/");
}

/**
get admin's password
*/
function GetAdminSignInPwd()
{
	if (true==empty($_COOKIE["ADMIN_SIGN_PWD"]))
		return "";
	else
		return $_COOKIE["ADMIN_SIGN_PWD"];
}

/**
Set admin's password
*/
function SetAdminSignInPwd($adminPwd)
{
	if (true==empty($adminPwd))
		return "";
	else
		setcookie("ADMIN_SIGN_PWD", $adminPwd, time()+24*3600, "/");
}

/**
set admin's sign info
*/
function SetAdminSignInfo($adminMail, $adminPwd)
{
	SetAdminSignInPwd($adminPwd);
	WriteAdminSignInNameToCookie($adminMail);
}

/**
Get admin if have in sign
*/
function GetAdminIfSignIn()
{
	$userName=GetAdminSignInName();

	$userPwd=GetAdminSignInPwd();

	$sSql="select * from admin where T_NAME='$userName' and T_PWD='$userPwd' ";
	if ($userName=="root")
		;
	else
		$sSql=$sSql." and T_URL='".GetCurrentWebHost()."'";
	include(APPROOT."dbCfg.php");
	$result = mysql_query($sSql,$pingoDateBase);

	if ($row=mysql_fetch_array($result))
	{
		return true;
	}
	else
	{
		//die("$sSql<br>");
		return false;
	}
}

/**
admin sign out
*/
function SetAdminSignOut()
{
	setcookie("ADMIN_SIGN_PWD", "", time()-24*3600, "/");
	setcookie("ADMIN_SIGN_NAME", "", time()-24*3600, "/");
}

/**
根据管理员用户名，获取管理员具体信息,超级管理员为root
$detailInfo[12]
[0]: T_PWD
[1]: T_DENG_JI
[2]: T_MEMO
[3]: T_QIAN_MING
[4]: T_PIC
[5]: T_USER_MAIL_ADD
[6]: T_USER_MAIL_PWD
[7]: T_USER_WEBSITE
[8]: T_USER_MENU
[9]: T_USER_NI_CHENG
[10]: T_ID
[11]: T_YOUJU_IP_ADD 
[12]: T_YOUJU_DUANKOU
*/
function GetAdminDetailInfo($webURL, & $detailInfo)
{
	if (true==empty($webURL))
	{
		echo "参数不合法！";
		return false;
	}
	else
	{
		include(APPROOT."dbCfg.php");
		$sSql="select * from admin where T_URL='".$webURL."'; ";
		$result = mysql_query($sSql, $pingoDateBase);
		
		if (mysql_num_rows($result)==1)
		{
			$row=mysql_fetch_array($result);
			$detailInfo[0]=$row["T_PWD"];
			$detailInfo[1]=$row["T_DENG_JI"];
			$detailInfo[2]=$row["T_MEMO"];
			$detailInfo[3]=$row["T_QIAN_MING"];
			$detailInfo[4]=$row["T_PIC"];
			$detailInfo[5]=$row["T_USER_MAIL_ADD"];
			$detailInfo[6]=$row["T_USER_MAIL_PWD"];
			$detailInfo[7]=$row["T_USER_WEBSITE"];
			$detailInfo[8]=$row["T_USER_MENU"];
			$detailInfo[9]=$row["T_USER_NI_CHENG"];
			$detailInfo[10]=$row["T_ID"];
			$detailInfo[11]=$row["T_YOUJU_IP_ADD"];
			$detailInfo[12]=$row["T_YOUJU_DUANKOU"];
			return true;	//得到管理员等级
		}
		else
			return false; 
	}
}

/**
根据管理员用户名，获取管理员具体信息,超级管理员为root
$detailInfo[12]
[0]: T_PWD
[1]: T_DENG_JI
[2]: T_MEMO
[3]: T_QIAN_MING
[4]: T_PIC
[5]: T_USER_MAIL_ADD
[6]: T_USER_MAIL_PWD
[7]: T_USER_WEBSITE
[8]: T_USER_MENU
[9]: T_USER_NI_CHENG
[10]: T_ID
[11]: T_YOUJU_IP_ADD 
[12]: T_YOUJU_DUANKOU
*/
function SetAdminDetailInfo($userID, &$detailInfo)
{
	if (strlen($userID."")==0)
	{
		echo "参数不合法！";
		return false;
	}
	else
	{
		include(APPROOT."dbCfg.php");
		$sSql="update admin set T_PWD='$detailInfo[0]', T_DENG_JI=$detailInfo[1], T_MEMO='$detailInfo[2]', T_QIAN_MING='$detailInfo[3]', T_URL='$detailInfo[4]', T_USER_MAIL_ADD='$detailInfo[5]', T_USER_MAIL_PWD='$detailInfo[6]', T_USER_WEBSITE='$detailInfo[7]', T_USER_MENU='$detailInfo[8]', T_USER_NI_CHENG='$detailInfo[9]', T_YOUJU_IP_ADD='$detailInfo[11]', T_YOUJU_DUANKOU='$detailInfo[12]',T_NAME='$detailInfo[13]' where T_ID='".$userID."'; ";
		$result = mysql_query($sSql, $pingoDateBase);
		return true;
	}
}

/**
根据管理员用户名，获取管理员具体信息,超级管理员为root
$detailInfo[12]
[0]: T_PWD
[1]: T_DENG_JI
[2]: T_MEMO
[3]: T_QIAN_MING
[4]: T_PIC
[5]: T_USER_MAIL_ADD
[6]: T_USER_MAIL_PWD
[7]: T_USER_WEBSITE
[8]: T_USER_MENU
[9]: T_USER_NI_CHENG
[10]: T_ID
[11]: T_YOUJU_IP_ADD 
[12]: T_YOUJU_DUANKOU
*/
function AddAdminDetailInfo(&$detailInfo)
{
	include(APPROOT."dbCfg.php");
	$sSql="INSERT INTO admin (T_NAME ,T_PWD ,T_DENG_JI ,T_MEMO ,T_QIAN_MING ,T_URL ,T_USER_MAIL_ADD ,T_USER_MAIL_PWD ,T_USER_WEBSITE ,T_USER_MENU ,T_USER_NI_CHENG ,T_YOUJU_IP_ADD ,T_YOUJU_DUANKOU)
VALUES ('$detailInfo[13]', '$detailInfo[0]', '$detailInfo[1]', '$detailInfo[2]', '$detailInfo[3]', '$detailInfo[4]', '$detailInfo[5]', '$detailInfo[6]', '$detailInfo[7]', '$detailInfo[8]', '$detailInfo[9]','$detailInfo[11]', '$detailInfo[12]');";
	$result = mysql_query($sSql, $pingoDateBase);
	return true;
}

/**
客户留言
*/
function AddAdminLeaveMsg($msgID, $pru_ID, $customerIP, $customerMsg, $customerMail, $Nickname, $role=0)
{
	if (empty($pru_ID) || empty($customerIP) || empty($customerMsg))
	{
		echo "wrong canshu pubuserfun->4";
		return false;	//参数检查失败
	}
	else
	{
		if (strlen($Nickname."")==0)
		{
			if ($role==1)
				$Nickname="Customer";
			else 
				$Nickname="Admin";
		}
		$sSql="INSERT INTO customerleavemsg (".
				"T_PRU_ID, T_TIME,	T_MSG, T_IP_ADD, T_CUSTOMER_MAIL, T_CUSTOMER_NIKI_NAME, T_ROLE, T_IS_REPLY, T_URL) ".
			  "VALUES (".
				"'$pru_ID', now(), '$customerMsg', '$customerIP', '$customerMail', '$Nickname', $role, 1, '".GetCurrentWebHost()."');";
		//echo $sSql."<br>";
		include(APPROOT."dbCfg.php");
		mysql_query($sSql, $pingoDateBase);
		//die (mysql_insert_id()."<br><br>");
		$sSql="UPDATE customerleavemsg SET T_IS_REPLY=1, T_REPLIED_MSG_INDEX='".mysql_insert_id()."' WHERE T_INDEX=$msgID;";
		//die( $sSql."<br>");
		mysql_query($sSql, $pingoDateBase);
		return true;//成功，客户留言
	}
}

/**
客户留言状态修改
$msgID: 消息ID编号
$doAction: 1-delete 2-set to replied
*/
function SetCustomerMessageStatus($msgID, $doAction)
{
	if (empty($msgID) || empty($doAction))
	{
		echo "wrong canshu pubuserfun->4";
		return false;	//参数检查失败
	}
	else
	{
		if ($doAction==1)
		{
			include(APPROOT."dbCfg.php");
			$sSql="delete from customerleavemsg where T_INDEX='$msgID' limit 1;";
			mysql_query($sSql, $pingoDateBase);
		}
		elseif($doAction==2)
		{
			include(APPROOT."dbCfg.php");
			$sSql="UPDATE customerleavemsg SET T_IS_REPLY=1 WHERE T_INDEX='$msgID';";
			mysql_query($sSql, $pingoDateBase);
		}
	}
}
?>