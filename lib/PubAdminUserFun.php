<?php
require_once("settings.php");
include_once(LIBPATH."lib.php");

class admin
{
	var		$strCookieSignInName;	//
	var		$strCookieSignInPwd;	//
	
	function admin()
	{
		$this->strCookieSignInName="ADMIN_SIGN_NAME";
		$this->strCookieSignInPwd="ADMIN_SIGN_PWD";
	}
	
	/**
	set admin's sign info
	*/
	function SetAdminSignInfo($adminName, $adminPwd)
	{
		setcookie($this->strCookieSignInName, $adminName, time()+24*3600, "/");
		setcookie($this->strCookieSignInPwd, $adminPwd, time()+24*3600, "/");
	}
	
	/**
	get admin's sign info
	*/
	function GetAdminSignInfo(&$adminMail, &$adminPwd)
	{
		$adminMail=$_COOKIE[$this->strCookieSignInName];
		$adminPwd=$_COOKIE[$this->strCookieSignInPwd];
		
		//echo "[ ".$adminMail.$adminPwd." ]";
		return true;
	}
	
	/**
	Get admin if have in sign
	*/
	function GetAdminIfSignIn()
	{
		$userName=$userPwd="";
		$this->GetAdminSignInfo($userName, $userPwd);
	
		$sSql="select * from admin where T_NAME='$userName' and T_PWD='$userPwd' ";
		if ($userName=="root")
			;
		else
			$sSql=$sSql." and T_URL='".GetCurrentWebHost()."'";
		//echo "[$sSql]";
		$SQL=new SQL;
		$result = $SQL->Query($sSql);
	
		if ($row=mysql_fetch_array($result))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	admin sign out
	*/
	function SetAdminSignOut()
	{
		setcookie($this->strCookieSignInPwd, "", time()-24*3600, "/");
		setcookie($this->strCookieSignInName, "", time()-24*3600, "/");
	}
	
	function GetAdminDetailInfo($webURL, & $detailInfo)
	{
		if (true==empty($webURL))
		{
			echo "参数不合法！";
			return false;
		}
		else
		{
			if ($webURL=="root")
				$sSql="select * from admin where T_NAME='".$webURL."'; ";
			else
				$sSql="select * from admin where T_URL='".$webURL."'; ";
			$SQL=new SQL;
			$result = $SQL->Query($sSql);
			
			if (mysql_num_rows($result)==1)
			{
				$detailInfo=mysql_fetch_array($result);
				return true;	//得到管理员等级
			}
			else
				return false; 
		}
	}
	
	function GetCurrentAdminDetailInfo()
	{
		$userName=$userPwd="";
		$this->GetAdminSignInfo($userName, $userPwd);
		
		$sSql="select * from admin where T_NAME='$userName' and T_PWD='$userPwd' ";
		if ($userName=="root")
			;
		else
			$sSql=$sSql." and T_URL='".GetCurrentWebHost()."'";
		//echo "[$sSql]";
		$SQL=new SQL;
		$result = $SQL->Query($sSql);
	
		return mysql_fetch_array($result);
	}
	
	function GetTotalNoReplyMsg()
	{
		$sSql="select * from customerleavemsg where T_IS_REPLY=false and T_URL='".GetCurrentWebHost()."';";
		$SQL=new SQL;
		$result = $SQL->Query($sSql);;
		return mysql_numrows($result);
	}

	/**
	修改管理员具体信息
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
			$SQL=new SQL;
			
			$sSql="update admin set T_PWD='$detailInfo[0]', T_DENG_JI=$detailInfo[1], T_MEMO='$detailInfo[2]', T_QIAN_MING='$detailInfo[3]', T_URL='$detailInfo[4]', T_USER_MAIL_ADD='$detailInfo[5]', T_USER_MAIL_PWD='$detailInfo[6]', T_USER_WEBSITE='$detailInfo[7]', T_USER_MENU='$detailInfo[8]', T_USER_NI_CHENG='$detailInfo[9]', T_YOUJU_IP_ADD='$detailInfo[11]', T_YOUJU_DUANKOU='$detailInfo[12]',T_NAME='$detailInfo[13]' where T_ID='".$userID."'; ";
			echo $sSql;
			$result = $SQL->Query($sSql);
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
		$SQL=new SQL;
		$sSql="INSERT INTO admin (T_NAME ,T_PWD ,T_DENG_JI ,T_MEMO ,T_QIAN_MING ,T_PIC ,T_USER_MAIL_ADD ,T_USER_MAIL_PWD ,T_USER_WEBSITE ,T_USER_MENU ,T_USER_NI_CHENG ,T_YOUJU_IP_ADD ,T_YOUJU_DUANKOU )
	VALUES ('$detailInfo[13]', '$detailInfo[0]', '$detailInfo[1]', '$detailInfo[2]', '$detailInfo[3]', '$detailInfo[4]', '$detailInfo[5]', '$detailInfo[6]', '$detailInfo[7]', '$detailInfo[8]', '$detailInfo[9]','$detailInfo[11]', '$detailInfo[12]');";
		$result = $SQL->Query($sSql);
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
			
			$SQL=new SQL;
			$result = $SQL->Query($sSql);
			$sSql="UPDATE customerleavemsg SET T_IS_REPLY=1,T_REPLIED_MSG_INDEX='".mysql_insert_id()."' WHERE T_INDEX='$msgID';";
			//echo $sSql."<br>";
			$SQL->Query($sSql);
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
				$SQL=new SQL;
				$sSql="delete from customerleavemsg where T_INDEX='$msgID' limit 1;";
				$SQL->Query($sSql);
			}
			elseif($doAction==2)
			{
				$SQL=new SQL;
				$sSql="UPDATE customerleavemsg SET T_IS_REPLY=1 WHERE T_INDEX='$msgID';";
				$SQL->Query($sSql);
			}
		}
	}
	
	/**
	delete admin
	*/
	function DeleteAdminByID($adminID)
	{
		$sSql="DELETE FROM admin WHERE T_ID = $adminID LIMIT 1;";
		$SQL=new SQL;
		$SQL->Query($sSql);
		return true;
	}
}
?>