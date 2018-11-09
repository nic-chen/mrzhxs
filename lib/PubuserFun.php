<?php
include_once("settings.php");
include_once(APPROOT."dbCfg.php");
include_once(LIBPATH."Sql.php");
include_once(LIBPATH."PubMail.php");
include_once(LIBPATH."PubAdminUserFun.php");

class Customer 
{
	var $strCookieVIPSIGNIN;
	var $strCookieCustomerSignMail;
	var $errorString;
	var $SQL;
	
	function Customer()
	{
		$this->strCookieVIPSIGNIN="VIPSIGNIN";
		$this->strCookieCustomerSignMail="CUSTOMER_SIGN_MAIL";
		$this->errorString="";
		$this->SQL=new SQL;
	}
	
	function GetIsVipSignIn()
	{
		if (empty($_COOKIE[$this->strCookieVIPSIGNIN]))
			return false;
		else
			return true;
	}
	
	function GetIsCustomerSignIn()
	{
		if (empty($_COOKIE[$this->strCookieCustomerSignMail]))
			return false;
		else
			return true;
	}
	
	function GetCustomerMail()
	{
		if (true==empty($_COOKIE[$this->strCookieCustomerSignMail]))
			return "";
		else
			return $_COOKIE[$this->strCookieCustomerSignMail];
	}
	
	function SetCustomerSignInMail($customerMail)
	{
		if (true==empty($customerMail))
			return "";
		else
			setcookie($this->strCookieCustomerSignMail,$customerMail, time()+24*60*60, "/");
	}
	
	function SetCustomerSignOut()
	{
		setcookie($this->strCookieCustomerSignMail, "", time() - 3600, "/");
	}
	
	
	
	/**
	ж GET the mail has been regiestered.
	*/
	function GetMailIsRegisted($customerMail)
	{
		$sSql="select * from registercustomer  where T_MAIL='".$customerMail."' and T_URL='".GetCurrentWebHost()."';";
		
		$result = $this->SQL->Query($sSql);
		
		if (mysql_num_rows($result)==0)
			return false;//dont been registered.
		else
			return true;//has been registered.
	}
	
	/**
	ж check mail and password if its all correct.
	*/
	function GetMailAndPwdIsCorrect($customerMail, $customerPwd)
	{
		$sSql="select * from registercustomer  where T_MAIL='$customerMail' and T_PWD='$customerPwd'  and T_URL='".GetCurrentWebHost()."'; ";
		
		$result = $this->SQL->Query($sSql);
		
		if (mysql_num_rows($result)==0)
		{
			$this->errorString="The mail and login password its not complete correct!";
			return false;
		}
		else
			return true;
	}
	
	/**
	* Register new customer info.
	*/
	function DoCustomerRegisted($customerMail, $customerPwd, $customerCountry, $customerName, $customerAdd, $customerDengJi, $customerMemo, $customerID, $customerJianJie, $allowMultiMail, $type)
	{
		if ($allowMultiMail || !$this->GetMailIsRegisted($customerMail))
		{
			$sSql="INSERT INTO registercustomer  (".
					"T_MAIL, T_PWD,	T_COUNTRY, T_CUSTOMER_NAME,	T_ADDRESS, T_VIP_DENGJI, T_DENGJI_TIME, T_MEMO, T_URL, T_ID, T_JIANJIE, T_CREATE_TIME, T_TYPE) ".
				  "VALUES (".
					"'$customerMail', '$customerPwd', '$customerCountry', '$customerName', '$customerAdd', $customerDengJi, NOW() , '$customerMemo', '".GetCurrentWebHost()."', '$customerID', '$customerJianJie', now(), '$type');";
			//die($sSql);
			
			if ($this->SQL->Query($sSql))
			{
				return true;
			}
			else
			{
				$this->errorString="Inset new customer register infomation failed!";
				return false;
			}
		}
		else
		{
			$this->errorString="The mail has been used, its not allow register again use same mail!";
			return false;
		}
	}
	
	function DeleteCustomer($id)
	{
		return $this->SQL->Query("DELETE FROM `registercustomer` WHERE `T_ID` = '$id'");
	}
	
	/**
	޸û Update costomer's information
	*/
	function SetUserProfileInfo($customerMail, $customerCountry, $customerName, $customerAdd, $customerMemo, $customerDengJi, $customerJianJie, $id)
	{
		$sSql="update registercustomer  set T_MAIL='$customerMail', T_COUNTRY='$customerCountry', T_CUSTOMER_NAME='$customerName', T_ADDRESS='$customerAdd', T_MEMO='$customerMemo', T_VIP_DENGJI=$customerDengJi, T_JIANJIE='$customerJianJie'".
					"where T_ID='$id'  and T_URL='".GetCurrentWebHost()."';";
		if ($this->SQL->Query($sSql))
			return true;
		else
		{
			$this->errorString="Its failed when update the customer's information!";
			return true;
		}
	}
	
	/**
	޸* update customomer's login password
	*/
	function SetUserNewName($customerMail, $oldPwd, $newPwd)
	{
		if (GetMailIsRegisted($customerMail))
		{
			$sSql="select * from registercustomer  where T_MAIL='$customerMail' and T_PWD='$oldPwd'  and T_URL='".GetCurrentWebHost()."';";
			
			if (!GetMailAndPwdIsCorrect($customerMail, $oldPwd, $this->errorString))
			{
				return false;
			}
			
			$sSql="update registercustomer  set T_PWD='$newPwd' where T_MAIL='$customerMail'  and T_URL='".GetCurrentWebHost()."';";
			$result = mysql_query($sSql, $pingoDateBase);
			
			if ($this->SQL->Query($sSql))
				return true;
			else
			{
				$this->errorString="Its failed when update the password!";
				return false;
			}
		}
		else
		{
			$this->errorString="This mail has not been registered at first!";
			return false;
		}
	}
	
	/**
	* send the login password to customer
	*/
	function SendUserPwdToCustomerMail($customerMail)
	{
		$sSql="select * from registercustomer  where T_MAIL='".$customerMail."'  and T_URL='".GetCurrentWebHost()."'; ";
		
		$result = $this->SQL->Query($sSql);
		
		if (mysql_num_rows($result)==1)
		{
			$row=mysql_fetch_array($result);
			$userPwd=$row["T_PWD"];	//û
			
			$rootDetailInfo=array();
			if (GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
				;
			else
			{
				$this->errorString="Cant get the admin's detail infomation!";
				return false;
			}
			SentHtmlMailByAdminMail($customerMail, "$rootDetailInfo[7] Your password!!!", "hello:<br><br>Your sign In account infomation:<br>------------------<br><b>Sign In mail: $customerMail<br>Sign In password: $userPwd</b><br>------------------<br><br>$rootDetailInfo[3]");
		}
		return true;
	}
	
	/**
	* sent the costomer register successfual infortion
	*/
	function SendUserRegisterSuccessInfoToCustomerMail($customerMail)
	{
		$sSql="select * from registercustomer  where T_MAIL='".$customerMail."'  and T_URL='".GetCurrentWebHost()."'; ";
		
		$result = $this->SQL->Query($sSql);
		
		if (mysql_num_rows($result)==1)
		{
			$row=mysql_fetch_array($result);
			$userPwd=$row["T_PWD"];
			
			$rootDetailInfo[]=array();
			if (GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
				;
			else
			{
				$this->errorString="The mail is not registerd at fist!";
				return false;
			}
			SentHtmlMailByAdminMail($customerMail, "Welcome to $rootDetailInfo[7]!!!", "hello:<br><br>you have registered on $rootDetailInfo[7], if you have any questions, pls let us know. do the best we can do for our every customer. thanks and hope you'll get a good shopping.<br><br>$rootDetailInfo[3]");
			SentHtmlMailByAdminMail($rootDetailInfo[5], "An new customer registered on $rootDetailInfo[7]!!!", "hello:<br><br>Congratulations for a new customer register on $rootDetailInfo[7]!<br> her sign in mail is:<br>------------------<br>$customerMail<br>------------------<br>");
		}
		return true;
	}
	
	/**
	* customer leave message
	*/
	function AddCuctomerLeaveMsg($pru_ID, $customerIP, $customerMsg, $customerMail, $Nickname, $role)
	{
		if (empty($pru_ID) || empty($customerIP) || empty($customerMsg))
		{
			$this->errorString="wrong canshu pubuserfun->4";
			return false;	
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
					"T_PRU_ID, T_TIME,	T_MSG, T_IP_ADD, T_CUSTOMER_MAIL, T_CUSTOMER_NIKI_NAME, T_ROLE, T_URL, T_TYPE) ".
				  "VALUES (".
					"'$pru_ID', now(), '$customerMsg', '$customerIP', '$customerMail', '$Nickname', $role, '".GetCurrentWebHost()."', 0);";
			
			if ($this->SQL->Query($sSql))
				return true;
			else
			{
				$this->errorString="Tts failed when insert new message!";
				return false;
			}
		}
	}
	
	/**
	* customer leave message
	*/
	function AddCuctomerLeaveMsgtoWeb($customerIP, $customerMsg, $customerMail, $Nickname)
	{
		if (empty($customerIP))
		{
			$this->errorString="wrong canshu pubuserfun->4";
			return false;	
		}
		else
		{
			$sSql="INSERT INTO customerleavemsg (".
					"T_TIME,	T_MSG, T_IP_ADD, T_CUSTOMER_MAIL, T_CUSTOMER_NIKI_NAME, T_TYPE, T_URL) ".
				  "VALUES (".
					"now(), '$customerMsg', '$customerIP', '$customerMail', '$Nickname', 1, '".GetCurrentWebHost()."');";
			
			if ($this->SQL->Query($sSql))
				return true;
			else
			{
				$this->errorString="Tts failed when insert new message!";
				return false;
			}
		}
	}
	
	function GetCustomerList($nStart, $nEnd, $type)
	{
		if ($nStart<0 || $nEnd<0)
		{
			//echo "select * from registercustomer where T_TYPE='$type' order by T_DENGJI_TIME DESC, T_ISFIRSTAD ASC";
			return $this->SQL->Query("select * from registercustomer where T_TYPE='$type' order by T_ISFIRSTAD ASC, T_DENGJI_TIME DESC ");
		}
		else
			return $this->SQL->Query("select * from registercustomer where T_TYPE='$type' order by T_ISFIRSTAD ASC, T_DENGJI_TIME DESC limit $nStart, $nEnd");
	}
	
	function GetCustomerAmount($type)
	{
		$result = $this->SQL->Query("select count(*) as nTotal from registercustomer where T_TYPE='$type'");
		if ($row=mysql_fetch_array($result))
			return $row["nTotal"];
		else
			return 0;
	}
	
	function GetCustomerByID($id)
	{
		return $this->SQL->Query("select * from registercustomer  where T_ID='$id';");
	}
	
	function GetCustomerByHeadURL($headURL)
	{
		return $this->SQL->Query("select * from registercustomer  where T_HEAD_URL='$headURL';");
	}
	
	function GetCustomerModelList($type)
	{
		return $this->SQL->Query("select * from customermodel where T_TYPE='$type';");
	}
	
	function AddCustomerModel($name, $memo, $status, $type, $isHeadSubArticle)
	{
		return $this->SQL->Query("INSERT INTO `customermodel` ( `T_NAME` , `T_MEMO` , `T_STATUS`, T_TYPE, T_HAVE_SUB_ARTICLE ) VALUES ('$name', '$memo', $status, '$type', '$isHeadSubArticle');");
	}
	
	function GetCustomerModel($id)
	{
		return $this->SQL->Query("select * from customermodel where T_ID=$id;");
	}
	
	function DelCustomerModel($id)
	{
		return $this->SQL->Query("delete from customermodel where T_ID=$id;");
	}
	
	function UpdateCustomerModel($id, $name, $memo, $status, $type, $isHaveSubArticle)
	{
		return $this->SQL->Query("update customermodel set T_NAME='$name', T_MEMO='$memo', T_STATUS=$status, T_TYPE='$type', T_HAVE_SUB_ARTICLE=$isHaveSubArticle where T_ID=$id;");
	}
	
	function GetCustomerDetail($id, $mail)
	{
		return $this->SQL->Query("select * from registercustomer  where T_ID='$id' and T_MAIL='$mail';");
	}
	
	function UpdateCustomerDetail($id, $mail, $name, $country, $address, $dengji, $jieshao, $memo, $oldMail, $headURL, 
				$province, $telPhone, $mobilPhone, $rungePrice, $meixieType, $shuxieType, $status, $endTime, $adFirst, $pruType)
	{
		$result = $this->SQL->Query("select * from registercustomer  where T_ID<>'$id' and T_HEAD_URL='$headURL'");
		if (mysql_numrows($result) > 0)
		{
			$this->errorString=CUSTOMER_DETAIL_UPDATE;
			return false;
		}
		
		$this->SQL->Query("update registercustomer  set T_CUSTOMER_NAME='$name', T_MAIL='$mail', T_COUNTRY='$country', T_ADDRESS='$address', T_VIP_DENGJI='$dengji', T_JIANJIE='$jieshao', T_MEMO='$memo', T_HEAD_URL='$headURL', T_PRIVINCE='$province', T_TEL_PHONE = '$telPhone', T_MOBIL_PHONE = '$mobilPhone', T_RUNGE_PRICE = $rungePrice , T_MEIXIE_TYPE = $meixieType, T_SHUXIE_TYPE = $shuxieType, T_STATUS = $status, T_END_TIME = '$endTime', T_ISFIRSTAD = '$adFirst', pruTypeList='$pruType' where T_ID='$id' and T_MAIL='$oldMail';");
		return true;
	}
	
	function GetModelContect($customerID, $modelID)
	{
		return $this->SQL->Query("select * from customermodeltext where T_MODEL_ID=$modelID and T_CUSTOMER_ID='$customerID' order by T_CREATE_TIME DESC;");
	}
	
	function GetModelContectByID($id)
	{
		return $this->SQL->Query("select * from customermodeltext where T_ID=$id;");
	}
	
	function SetModelContect($customerID, $modelID, $text)
	{
		$result = $this->GetModelContect($customerID, $modelID);
		$nPruNum=mysql_numrows($result);
		//die( "$nPruNum<br>" );
		if ($nPruNum==0)
			return $this->SQL->Query("INSERT INTO `customermodeltext` ( `T_MODEL_ID` , `T_CUSTOMER_ID` , `T_TEXT`, T_CREATE_TIME ) VALUES ($modelID, '$customerID', '$text', now());");
		else
			return $this->SQL->Query("update customermodeltext set T_TEXT='$text' where T_MODEL_ID=$modelID and T_CUSTOMER_ID='$customerID';");;
	}
	
	function SetModelContectByID($id, $title, $text)
	{
		return $this->SQL->Query("update customermodeltext set T_TEXT='$text', T_TITLE='$title' where T_ID=$id;");
	}
	
	function AddModelContect($title, $text, $customerID, $modelID)
	{
		return $this->SQL->Query("INSERT INTO customermodeltext (T_TEXT, T_TITLE, T_CUSTOMER_ID, T_MODEL_ID) values ('$text', '$title', $customerID, $modelID)");
	}
	
	function DelModelContect($id)
	{
		return $this->SQL->Query("DELETE FROM `customermodeltext` WHERE `T_ID` = $id;");
	}
	
	function GetProvinceList()
	{
		return $this->SQL->Query("select distinct T_PRIVINCE FROM `registercustomer` where T_PRIVINCE<>'' order by T_PRIVINCE ASC;");
	}
}
?>