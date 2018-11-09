<?php
require_once('settings.php');

/**
õԱ¼ʺ
*/
function GetUserSignInName()
{
//echo "cookie name=[".$_COOKIE["USER_SIGN_NAME"]."]";
	if (true==empty($_COOKIE["USER_SIGN_NAME"]))
		return "";
	else
		return $_COOKIE["USER_SIGN_NAME"];
}

/**
ѹԱ¼ʺд뵽COOKIE
*/
function WriteUserSignInNameToCookie($UserMail)
{
	if (true==empty($UserMail))
		return "";
	else
		setcookie("USER_SIGN_NAME", $UserMail, time()+24*3600, "/");
}

/**
ݹԱûȡԱϢ,ԱΪroot
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
function GetUserDetailInfo($userName, & $detailInfo)
{
	if (true==empty($userName))
	{
		echo "error";
		return false;
	}
	else
	{
		include(APPROOT."dbCfg.php");
		if ($webURL=="root")
			$sSql="select * from admin where T_NAME='".$webURL."'; ";
		else
			$sSql="select * from admin where T_URL='".$webURL."'; ";
		$result = mysqli_query($sSql, $pingoDateBase);
		
		if (mysqli_num_rows($result)==1)
		{
			$row=mysqli_fetch_array($result);
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
			return true;	//õԱȼ
		}
		else
			return false; 
	}
}

/**
ݹԱûȡԱϢ,ԱΪroot
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
function SetUserDetailInfo($userID, &$detailInfo)
{
	if (strlen($userID."")==0)
	{
		echo "Ϸ";
		return false;
	}
	else
	{
		include(APPROOT."dbCfg.php");
		$sSql="update admin set T_PWD='$detailInfo[0]', T_DENG_JI=$detailInfo[1], T_MEMO='$detailInfo[2]', T_QIAN_MING='$detailInfo[3]', T_PIC='$detailInfo[4]', T_USER_MAIL_ADD='$detailInfo[5]', T_USER_MAIL_PWD='$detailInfo[6]', T_USER_WEBSITE='$detailInfo[7]', T_USER_MENU='$detailInfo[8]', T_USER_NI_CHENG='$detailInfo[9]', T_YOUJU_IP_ADD='$detailInfo[11]', T_YOUJU_DUANKOU='$detailInfo[12]',T_NAME='$detailInfo[13]' where T_ID='".$userID."'; ";
		$result = mysqli_query($sSql, $pingoDateBase);
		return true;
	}
}
?>
