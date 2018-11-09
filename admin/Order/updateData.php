<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");

/**
SUCCESS.PHP 错误提交表单
*/
function SuccessPhpErrorPage($ErrorString, $IsSuccess, $errorInfo, $directUrl)
{
//echo  "update t_web_conn set T_URL='".$web_url."' and T_WEB_NAME='".$web_page_subject."' ";
if ($IsSuccess)
{
?>
<meta http-equiv="refresh" content="0;url=<?php echo $directUrl;?>; text/html; charset=utf-8"">
<?php
}
?>
<body><?php echo $ErrorString."<br>".$errorInfo; ?></body><?php

}

function random($leng){
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        return substr(str_shuffle($chars),0,($leng));
}
/**
COM 2001, create new order
*/
function CreateNewOder()
{
	$errorInfo="";
	$timeInfo=time()+14*60*60;
	$timeStr=date("ymd",$timeInfo);
	$rodemStr;
	
	do
	{
		$rodemStr=random(3);
		$SQL = new SQL;
		$result = $SQL->Query("select * from OFFER_ALL_USER where T_DATE='$timeStr' and T_SER='$rodemStr';");
	}
	while((mysqli_fetch_array($result)));
	
	$orderSub=trim($_POST["cSubID"]);
	$userName=$_POST["cName"];
	$userMail=$_POST["cMail"];
	$userPayType=$_POST["select2"];
	$userPayMoney=$_POST["cMoney"];
	$userPayDanWei=$_POST["select"];
	$userAddress=$_POST["cAddress"];
	$userItemList=$_POST["orderList"];
	$userMemo=$_POST["cOtherInfo"];
	
	$SQL = new SQL;
	
	$sSql="INSERT INTO OFFER_ALL_USER (T_DATE, T_MAIL, T_SER, T_USER_NAME, T_PAY_TYPEC, T_JIAOYI_MONEY, T_JIAOYI_DANWEI, T_CUS_ADDRESS, T_DINGDAN_MINGXI, T_CREATE_BEIZHU, T_STEP, T_URL, T_CREATE_TIME, T_SUB_ORDER_ID)
		   VALUES('$timeStr', '$userMail','$rodemStr', '$userName', '$userPayType', '$userPayMoney', '$userPayDanWei', '$userAddress', '$userItemList', '$userMemo', 1, '".GetCurrentWebHost()."', now(), '$orderSub')";
	$errorInfo=$sSql;
	$SQL->Query($sSql);
	
	SuccessPhpErrorPage("Create order successful!", true, "", "view_change.php?DATE=$timeStr&SER=$rodemStr&STEP=1");
}

/**
COM 2002, change
*/
function ChangeOderMainInfo()
{
	$errorInfo="";
	$timeStr=$_GET["DATE"];
	$rodemStr=$_GET["SER"];
	$userSubID=trim($_POST["cSubID"]);
	
	$userName=$_POST["cName"];
	$userMail=$_POST["cMail"];
	$userPayType=$_POST["select2"];
	$userPayMoney=$_POST["cMoney"];
	$userPayDanWei=$_POST["select"];
	$userAddress=$_POST["cAddress"];
	$userItemList=$_POST["orderList"];
	$userMemo=$_POST["cOtherInfo"];
	
	$SQL = new SQL;
	$sSql="update OFFER_ALL_USER set T_MAIL='$userMail', T_USER_NAME='$userName', T_PAY_TYPEC='$userPayType', T_JIAOYI_MONEY='$userPayMoney', T_JIAOYI_DANWEI='$userPayDanWei', T_CUS_ADDRESS='$userAddress', T_DINGDAN_MINGXI='$userItemList', T_CREATE_BEIZHU='$userMemo', T_STEP=1, T_SUB_ORDER_ID='$userSubID' WHERE T_DATE='$timeStr' and T_SER='$rodemStr' and T_URL='".GetCurrentWebHost()."'";
	$errorInfo=$sSql;
	$SQL->Query($sSql);
	
	SuccessPhpErrorPage("Update offer successful!", true, "", "view_change.php?DATE=$timeStr&SER=$rodemStr&STEP=1");
}

/**
COM 2003, change
*/
function ChangePaymentInfo()
{
	$errorInfo="";
	$timeStr=$_GET["DATE"];
	$rodemStr=$_GET["SER"];
	
	$cPaymentID=$_POST["cJianKongNum"];
	$cPaymentDate=$_POST["cHuiKuanDate"];
	$cMoneyActual=$_POST["cMoneyActual"];
	$cMemo=$_POST["cBeiZhuInfo"];
	
	$SQL = new SQL;
	$sSql="update OFFER_ALL_USER set T_PAY_CODE='$cPaymentID', T_PAY_DATE='$cPaymentDate', T_PAY_RECIEVE='$cMoneyActual', T_PAY_BEIZHU='$cMemo', T_STEP=2 WHERE T_DATE='$timeStr' and T_SER='$rodemStr' and T_URL='".GetCurrentWebHost()."'";
	$errorInfo=$sSql;
	$SQL->Query($sSql);
	
	SuccessPhpErrorPage("Update offer successful!", true, "", "view_change.php?DATE=$timeStr&SER=$rodemStr&STEP=2");
}

/**
COM 2004, ChangePrepareItemMemo
*/
function ChangePrepareItemMemo()
{
	$errorInfo="";
	$timeStr=$_GET["DATE"];
	$rodemStr=$_GET["SER"];
	$cIsSendMail=$_POST["IsSendConfirmMail"];
	$orderSubID=$_POST["SUB_ID"];
	
	
	
	$cPrepareMemo=$_POST["cKuaiJiBeiZhu"];
		
	$SQL = new SQL;
	$sSql="update OFFER_ALL_USER set T_KUAIJI_BEIZHU='$cPrepareMemo', T_STEP=3 WHERE T_DATE='$timeStr' and T_SER='$rodemStr' and T_URL='".GetCurrentWebHost()."'";
	//$errorInfo=$sSql;
	$SQL->Query($sSql);
	
	if ($cIsSendMail=="true")
	{
	$rootDetailInfo=array();
		if (GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
			;
		else
		{
			echo "Dont find the admin config info";
			return false;	//没有找到root帐号
		}
		
		$bodyHtml="<table width=\"100%\" border=\"0\"  cellpadding=\"10\" ><tr><td bgcolor=\"#D7EB9A\">"."Order ID: [<font color=\"#336600\"><b>".$timeStr.$rodemStr."</b></font>]<br>";
		if (strlen($orderSubID)>0)
			$bodyHtml=$bodyHtml."Sub ID: [<font color=\"#336600\"><b>".$orderSubID."</b></font>]<br>";
		$bodyHtml=$bodyHtml."<br>Shipping address: <br>---------------<br>".str_replace("\r\n", "<br>", $_POST["address"])."<br>---------------<br><br>Item Detail: <br>---------------<br>".str_replace("\r\n", "<br>", $_POST["itemList"])."<br>---------------<br><br>We have arrange your item now. after we prepared them, send them to you asap and provide you the tracking number. <br>If you have any questions, pls let me know. i'll reply you asap. <br><br>Thanks and greeting from ".GetWebNikiName()."<br><br>View the detail info online, please click the URL blow:<br><a href='http://".GetCurrentWebHost()."/view_order.php?T_ID=$timeStr$rodemStr&SEARCH_BY=SER' target='_blank'>http://".GetCurrentWebHost()."/view_order.php?T_ID=$timeStr$rodemStr&SEARCH_BY=SER</a><br><br>".str_replace("\r\n", "<br>", $rootDetailInfo[3]."\r\nOur website: ".$rootDetailInfo[7])."</td></tr></table>";
		
		SentHtmlMailByAdminMail($_POST["mail"], "$rootDetailInfo[7] Pls confirm the order detail. Order ID--[".$timeStr.$rodemStr."]! ", $bodyHtml);
		
		$errorInfo=$errorInfo."Confirm Mail has been sent to: ".$_POST["mail"]." <br>";
	}
	$errorInfo=$errorInfo." Update offer successful! <br>";
	
	SuccessPhpErrorPage($errorInfo, true, "", "view_change.php?DATE=$timeStr&SER=$rodemStr&STEP=3");
}

/**
COM 2005, add track info.
*/
function AddTrackInfomation()
{
	$errorInfo="";
	$timeStr=$_GET["DATE"];
	$rodemStr=$_GET["SER"];
	$orderSubID=$_POST["SUB_ID"];
	
	
	
	$cShppingCom=$_POST["ShippingCom"];	
	$cSendDingDate=$_POST["cFaHuoDate"];
	$cMemo=strtoupper($_POST["cFaHuoBeiZhu"]);
	$cIsSendMail=$_POST["IsSendMail"];
		
	$SQL = new SQL;
	$sSql="update OFFER_ALL_USER set T_YUNDAN_COM='$cShppingCom', T_YUNDAN_DATE='$cSendDingDate', T_YUNDAN_BEIZHU='$cMemo', T_STEP=4 WHERE T_DATE='$timeStr' and T_SER='$rodemStr' and T_URL='".GetCurrentWebHost()."'";
	//$errorInfo=$sSql;
	$SQL->Query($sSql);
	
	if ($cIsSendMail=="true")
	{
		$rootDetailInfo=array();
		if (GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
			;
		else
		{
			echo "Dont find the admin config info";
			return false;	//没有找到root帐号
		}

		if (strlen($cShppingCom)==0 || $cShppingCom=="EMS")
			$cShppingCom="http://www.ems.com.cn/english-main.jsp";
		else if ($cShppingCom=="DHL")
			$cShppingCom="http://www.dhl.com";
		else if ($cShppingCom=="TNT")
			$cShppingCom="http://www.tnt.com/country/en_cn.html";
		else if ($cShppingCom=="UPS")
			$cShppingCom="http://www.ups.com/";
		else
			$cShppingCom="";
		
		$bodyHtml="<table width=\"100%\" border=\"0\"  cellpadding=\"10\" ><tr><td bgcolor=\"#D7EB9A\">"."Order ID: [<font color=\"#336600\"><b>".$timeStr.$rodemStr."</b></font>]<br>";
		if (strlen($orderSubID)>0)
			$bodyHtml=$bodyHtml."Sub ID: [<font color=\"#336600\"><b>".$orderSubID."</b></font>]<br>";
		$bodyHtml=$bodyHtml."The tracking number: <br>--------------------<br>".str_replace("\r\n", "<br>", strtoupper($_POST["cFaHuoBeiZhu"]))."</b></font><br>--------------------<br><a href=\"".$cShppingCom."\" target=\"_blank\">".$cShppingCom."</a><br><br>Pls track tomorrow, and then it will have record. <br>if you have any questions, pls E-mail me. reply to you asap. ^_^<br><br>Shipping address: <br>---------------<br>".str_replace("\r\n", "<br>", $_POST["address"])."<br>---------------<br><br>Item Detail: <br>---------------<br>".str_replace("\r\n", "<br>", $_POST["itemList"])."<br>---------------<br><br>View the detail info online, please click the URL blow:<br><a href='http://".GetCurrentWebHost()."/view_order.php?T_ID=$timeStr$rodemStr&SEARCH_BY=SER' target='_blank'>http://".GetCurrentWebHost()."/view_order.php?T_ID=$timeStr$rodemStr&SEARCH_BY=SER</a><br><br>".str_replace("\r\n", "<br>", $rootDetailInfo[3]."\r\nOur website: ".$rootDetailInfo[7])."</td></tr></table>";
		
		SentHtmlMailByAdminMail($_POST["mail"], "$rootDetailInfo[7] The tracking number! ".date("Y-m-d H:i:s", time()+14*60*60), $bodyHtml);
		
		$errorInfo=$errorInfo." Mail sent: ".$_POST["mail"]." <br>";
	}
	$errorInfo=$errorInfo." Update offer successful! <br>";
	SuccessPhpErrorPage($errorInfo, true, "", "view_change.php?DATE=$timeStr&SER=$rodemStr&STEP=4");
}

/**
COM 2006, FinishOrder
*/
function FinishOrder()
{
	$errorInfo="";
	$timeStr=$_GET["DATE"];
	$rodemStr=$_GET["SER"];
	
	$timeInfo=time()+14*60*60;
	$timeInfo=date("Y-m-d",$timeInfo);
	
	
	$cPrepareMemo=$_POST["cKuaiJiBeiZhu"];
	$cPrepareMemo=$_POST["cKuaiJiBeiZhu"];
		
	$SQL = new SQL;
	$sSql="update OFFER_ALL_USER set T_SHOUHUO_DATA='$timeInfo', T_C_RECIEVE='Customer got all packages!', T_STEP=5 WHERE T_DATE='$timeStr' and T_SER='$rodemStr' and T_URL='".GetCurrentWebHost()."'";
	$errorInfo=$sSql;
	$SQL->Query($sSql);
	
	SuccessPhpErrorPage("Update offer successful!", true, "", "view_change.php?DATE=$timeStr&SER=$rodemStr&STEP=5");
}

/**
COM 2007, UserSignIn
*/
function UserSignIn()
{
	$errorInfo="";
	$UserName=$_POST["userName"];
	$UserPwd=$_POST["userPwd"];
		
	$SQL = new SQL;
	$sSql="select * from admin where T_NAME='$UserName' and T_PWD='$UserPwd'";
	$errorInfo=$sSql;
	$result = $SQL->Query($sSql);
	if ($row=mysqli_fetch_array($result))
	{
		WriteUserSignInNameToCookie($UserName);
		SuccessPhpErrorPage("Login in sucessful. its redirect now. hold on please. ^_^", true, "","http://www.paiple.com/admin/Order/index.php");
	}
	else
		SuccessPhpErrorPage("Login in failed. its redirect now. hold on please. @_@", false, "","http://www.paiple.com/admin/Order/index.php");
	echo $errorInfo;
}

/**
COM 2008, OtherUserSignIn
*/
function OtherUserSignIn()
{
	$UserName=$_POST["userName"];
	$UserPwd=$_POST["userPwd"];
	
	//echo "UserName=$UserName, UserPwd=$UserPwd<br>";
	
	include("../HttpClient.class.php");
	
	$pageContents = HttpClient::quickPost('http://www.paiple.com/admin/Order/updateData.php?COM_ID=2007', array(
    'userName' => $UserName,
    'userPwd' => $UserPwd,
	'COM_ID' => "2007"
	));

//
echo $pageContents;
}

/**
com: 2009，add ExcelDocumentToOrder.
*/
function AddShippingListDocument()
{
	set_time_limit(0);
	
	$bIsSuccess=true;
	$Memo=$_POST["Memo"];
	if(isset( $_FILES ) && !empty( $_FILES [ "ShppingListFile" ]) && $_FILES [ "ShppingListFile" ][ "size" ]> 0 ) 
	{
		 
		$fileMainPath="../../".GetCurrentWebHostPath();
		$fileMainPath=$fileMainPath."/order_list";
		if (!is_readable($fileMainPath))
			mkdir ($fileMainPath,0777);
		$timeInfo=time()+14*60*60;
	    $strTime=date("Y-m-d_His",$timeInfo);
		$fileMainPath=$fileMainPath."/".$strTime;
		//echo $fileMainPath;
		if (!is_readable($fileMainPath))
			mkdir ($fileMainPath,0777);
		
		$fileName=str_replace(" ", "_", $_FILES["ShppingListFile"]["name"]);
		$uploadfile=$fileMainPath."/".$fileName;
		if (is_readable($uploadfile))
			unlink($uploadfile);
		if ( copy ($_FILES["ShppingListFile"]["tmp_name"], $uploadfile) ) 
		{
			$bIsSuccess=true;
			$SQL = new SQL;
			$sSql="INSERT INTO shipping_list (T_CREATE_TIME ,T_FILE_NAME ,T_MOEO ,T_FILE_PATH ,T_URL, T_UPDATE_TIME)VALUES (now(), '$fileName', '$Memo', '$fileMainPath', '".GetCurrentWebHost()."', now());";
			//echo $sSql."<br>";
			$SQL->Query($sSql);
		}
		else
			$bIsSuccess=false;
	}
	SuccessPhpErrorPage("Add shipping list successful!  ^_^", $bIsSuccess, "", $_SERVER["HTTP_REFERER"]);
}

/**
0012ȡˮϢ
*/
function GetOrderRecordHistoryNumber($itemList, $memo, $IsShowPayment, $IsShowPriceInfo)
{
	if (!$IsShowPayment)
		$IsNShowPayment="false";
	else	
		$IsNShowPayment="true";
	if (!$IsShowPriceInfo)
		$IsNShowPriceInfo="false";
	else
		$IsNShowPriceInfo="true";
		
	while(true)
	{
		$timeInfo=time()+14*60*60;
		$timeStr=date("Ymd",$timeInfo);
		
		$seedarray =microtime(); 
		$seedstr =split(" ",$seedarray,5); 
		$seed =$seedstr[0]*10000; 
		
		//ڶ:ʹӳʼ 
		srand($seed); 
		
		//:ָΧڵ 
		$random =rand(1,99999); 
		$recordNum=sprintf("%s%05d", $timeStr, $seed);
		
		$SQL = new SQL;
		$result = $SQL->Query("select * from t_order_record_his where T_ID='$recordNum'; ",$pingoDateBase);
		
		$nPruNum = mysqli_num_rows($result);
		if ($nPruNum==0)
		{
			$sSql="INSERT INTO t_order_record_his (T_ID, T_ITEM_LIST, T_MEMO, T_SHOW_PAYMENT, T_ADD_PRICE_INFO) VALUES('$recordNum', '$itemList', '$memo', $IsNShowPayment, $IsNShowPriceInfo)";
			$SQL->Query($sSql, $pingoDateBase);
			//echo $sSql."<br>";
			break;
		}
		else
			continue;
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<div style="display:none"><form action="item_list.php" method="post" name="form" id="form"><textarea name="itemListF"><?php  echo stripslashes($itemList);?></textarea><textarea name="cOtherInfo"><?php  echo stripslashes($memo);?></textarea><input name="Payment_Info" type="text" value="<?php echo $IsShowPayment;?>"><input name="Add_Price" type="text" value="<?php echo $IsShowPriceInfo; ?>"><input name="Buy_Price" type="text" value="<?php echo $_POST["Buy_Price"];?>"><input name="CanChange" type="text" value="<?php echo $_POST["CanChange"];?>"><input name="Sell_Price" type="text" value="<?php echo $_POST["Sell_Price"];?>"><input name="recordNum" type="text" value="<?php echo $recordNum;?>"></form></div>
</body>
<script language="javascript">
document.form.submit();
</script> 
<?php
}

/**
com: 2011，change shipping list detail.
*/
function ChangeShppingListDetail()
{
	set_time_limit(600);
	
	$bIsSuccess=true;
	$Memo=$_POST["Memo"];
	$FilePath=$_POST["FilePath"];
	$FileName=$_POST["FileName"];
	$newFileName;
	if(isset( $_FILES ) && !empty( $_FILES [ "ShppingListFile" ]) && $_FILES [ "ShppingListFile" ][ "size" ]> 0 ) 
	{
		 
		$fileMainPath=$FilePath;
		
		$newFileName=str_replace(" ", "_", $_FILES["ShppingListFile"]["name"]);
		$uploadfile=$fileMainPath."/".$newFileName;
		if (is_readable($uploadfile))
			unlink($uploadfile);
		if ( copy ($_FILES["ShppingListFile"]["tmp_name"], $uploadfile) ) 
			$bIsSuccess=true;
		else
		{
			die( "upload file failed. Press F5 reload or back try again!!<br>");
		}
	}
	else
		$newFileName=$FileName;
	
	$SQL = new SQL;
	$sSql="update shipping_list set T_FILE_NAME='$newFileName' ,T_MOEO='$Memo',T_UPDATE_TIME=now() where T_FILE_NAME='$FileName' and T_FILE_PATH='$FilePath' and T_URL='".GetCurrentWebHost()."';";
	//die($sSql."<br>");
	$SQL->Query($sSql);
	
	$errorInfo="Change shipping list detail info successful!  ^_^";
	
	if ($_POST["IsSendMailToPingo"]=="true")
	{
		$rootDetailInfo=array();
		if (GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
			;
		else
		{
			echo "Dont find the admin config info";
			return false;	//没有找到root帐号
		}
		
		$bodyHtml="<a href=\"http://".GetCurrentWebHost()."/".str_replace("../../", "", $FilePath)."/".$FileName."\" target=\"_blank\">".$FileName."</a><br><br>Sent time: ".date("Y-m-d H:i:s", time()+14*60*60)."<br><br>".str_replace("\r\n", "<br>", $_POST["MemoMail"]);
		
		$adminDetailInfo=array();
		GetAdminDetailInfo( "root", $adminDetailInfo);
		SentHtmlMailByAdminMailWithAttachment($adminDetailInfo[5], "$rootDetailInfo[7] $Memo! ", $bodyHtml, $FilePath."/".$FileName,$FileName);
		$errorInfo="Send shipping list by mail successful!!<br>".$errorInfo;
	}
	SuccessPhpErrorPage($errorInfo, $bIsSuccess, "", $_SERVER["HTTP_REFERER"]);
}

/**
com: 2011，add money detail.
*/
function AddMoneyEarnDetail()
{
	$SQL = new SQL;
	$sSql="update shipping_list set T_FILE_NAME='$newFileName' ,T_MOEO='$Memo',T_UPDATE_TIME=now() where T_FILE_NAME='$FileName' and T_FILE_PATH='$FilePath' and T_URL='".GetCurrentWebHost()."';";
	//die($sSql."<br>");
	$SQL->Query($sSql);
	
	SuccessPhpErrorPage("Change shipping list detail info successful!  ^_^", true, "", $_SERVER["HTTP_REFERER"]);
}

/**
开始命令解析
*/
$COM_ID=$_GET["COM_ID"].$_POST["COM_ID"];
if ($COM_ID=="2001")	//
{
	//echo $_POST["COM_ID"];
	CreateNewOder();
}
elseif ($COM_ID=="2002")	//
{
	//echo $_POST["COM_ID"];
	ChangeOderMainInfo();
}
elseif ($COM_ID=="2003")	//
{
	//echo $_POST["COM_ID"];
	ChangePaymentInfo();
}
elseif ($COM_ID=="2004")	//
{
	//echo $_POST["COM_ID"];
	ChangePrepareItemMemo();
}
elseif ($COM_ID=="2005")	//
{
	//echo $_POST["COM_ID"];
	AddTrackInfomation();
}
elseif ($COM_ID=="2006")	//
{
	//echo $_POST["COM_ID"];
	FinishOrder();
}
elseif ($COM_ID=="2007")	//UserSignIn
{
	//echo $_POST["COM_ID"];
	UserSignIn();
}
elseif ($COM_ID=="2008")	//UserSignIn
{
	//echo $_POST["COM_ID"];
	OtherUserSignIn();
}
elseif ($COM_ID=="2009")	//add ExcelDocumentToOrder
{
	//echo $_POST["COM_ID"];
	AddShippingListDocument();
}
elseif ($COM_ID=="2010")	//add ExcelDocumentToOrder
{
	//echo $_POST["COM_ID"];
	GetOrderRecordHistoryNumber($_POST["itemListF"], $_POST["cOtherInfo"], $_POST["Payment_Info"], $_POST["Add_Price"]);
}
elseif ($COM_ID=="2011")	//change shipping list detail.
{
	//echo $_POST["COM_ID"];
	ChangeShppingListDetail();
}
elseif ($COM_ID=="2012")	//add money earn detail.
{
	//echo $_POST["COM_ID"];
	AddMoneyEarnDetail();
}
?>