<?php
// 2011.06.21 停用留言、下单 0010 0013交易

include_once("settings.php");
include_once(LIBPATH."lib.php");
/**
SUCCESS.PHP ??
*/
function SuccessPhpErrorPage($ErrorString)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<form name="form" id="form" action="<?php echo "http://".GetCurrentWebHost();?>?p=success" method="post">
<input name="TEXT_ERROR" type="hidden" value="<?php echo $ErrorString; ?>"/>
</form>

</body>
<script language="javascript">
document.form.submit();
</script> 
<?php
}

function SuccessPhpErrorPage2($ErrorString, $url)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<form name="form" id="form" action="<?php echo "index.php".$url;?>" method="post">
<input name="TEXT_ERROR" type="hidden" value="<?php echo $ErrorString; ?>"/>
</form>

</body>
<script language="javascript">
document.form.submit();
</script> 
<?php
}


/**
0001
*/
function AddItemToGouWuChe()
{
	$nSizeTotal=$_POST["totalInput"];
	$pruSizeList=array();
	$pruAmountList=array();
	
	$nLoop=0;
	for ($i=0; $i<=($nSizeTotal+0); $i++)
	{
		$strSizeInfo=$_POST["sizeInfo".$i];
		$strSizeMount=$_POST["sizeInfoSel".$i];
		if (empty($strSizeMount)==true or $strSizeMount=="0")
			;
		else
		{
			$pruSizeList[$i]=$strSizeInfo;
			$pruAmountList[$i]=$strSizeMount;
		}
	}
	$strItemCookie=$strItemCookie."_sum*".$sumOder;
			
	$cart = new cart;
	$cart->AddItemToGouWuChe($_POST["ItemID"], $nSizeTotal,  $_POST["Memo"], $pruSizeList, $pruAmountList);
	$url = "index.php".$_POST["url"];  
	echo "<script language=\"javascript\">"; 
	echo "location.href=\"$url\""; 
	echo "</script>"; 
}

/**
0002????ID??
*/
function RemoveItemFromList($ID)
{
	$cart = new cart;
	$strCookie=$cart->GetCustomerOrderList();
	$strItemList=explode("=====",$strCookie);
	$nCount = count($strItemList);
	$strNewCookie="";
	
	for ($i=0; $i<$nCount; $i++)
	{
	
		if (empty($strItemList[$i])==true)
			;
		else
		{
			$strID=explode(" ", $strItemList[$i]);
			if ($strID[0]!=$ID)
				$strNewCookie=$strNewCookie."=====".$strItemList[$i];
		}
	}

$cart->SetCustomerOrderList($strNewCookie);

$url = $_SERVER['HTTP_REFERER'] ;  
echo "<script language=\"javascript\">"; 
echo "location.href=\"$url\""; 
echo "</script>"; 
}

/**
0003??
*/
function CustomerRegiste($customerMail, $customerPwd, $customerCoutry, $customerName, $customerAddress)
{
	$isSuccess=false;
	if (empty($customerMail) || empty($customerPwd))
		$isSuccess=false;
	else
	{
		if (DoCustomerRegisted($customerMail, $customerPwd,$customerCoutry, $customerName, $customerAddress, ""))
			$isSuccess=true;
		else
			$isSuccess=false;
	}
	
	if ($isSuccess==false)
	{
		SuccessPhpErrorPage("The mail has been used. if you dont know the password, pls click <a href=\'account_info.php?type=4\'>Forget Password?</a> for get the sign in password. if not, you can reput the register info again. !<br> <a href=\'account_info.php?type=5\'>Register Free</a>.");
	}
	else
	{
		
		SetCustomerSignInMail($customerMail);
		SendUserRegisterSuccessInfoToCustomerMail($customerMail);
		SuccessPhpErrorPage("<a href=\'top.php\'>Register successful! you can go for shopping now</a>.");
	}
}

/**
0004??
*/
function updateUserProfileInfo($customerMail, $customerCountry, $customerName, $customerAdd, $customerMemo)
{
	$bRes=SetUserProfileInfo($customerMail, $customerCountry, $customerName, $customerAdd, $customerMemo);
	if ($bRes)
	{//???
		SuccessPhpErrorPage("<a href=\'top.php\'>Update your profile infomation successful! you can go for shopping now</a>.");
	}
	else
	{//??
		SuccessPhpErrorPage("<a href=\'account_info.php?type=1\'>Update your profile infomation Fail! pls retry again or contact with us directly.</a>");
	}
}

/**
0005??
*/
function updateUserPwd($customerMail, $oldPwd, $newPwd)
{
	$iRes=SetUserNewName($customerMail, $oldPwd, $newPwd);
	if ($iRes==0)
	{
		SuccessPhpErrorPage("<a href=\'top.php\'>Update your password successful. thanks!!! </a>");
	}
	elseif ($iRes==-1)
	{
		SuccessPhpErrorPage("<a href=\'account_info.php?type=2\'>Update your password Fail. Please login in first!!! </a>");
	}
	elseif ($iRes==-2)
	{
		SuccessPhpErrorPage("<a href=\'account_info.php?type=2\'>Update your password Fail. The original password is incorrect, Please try again.!!! </a>");
	}
	else
	{
		SuccessPhpErrorPage("<a href=\'account_info.php?type=2\'>Update your password Fail. Please try again.!!! </a>");
	}
}

/**
0006??
*/
function SetUserSingnOut()
{
	SetCustomerSignOut();
	//die ("<br>".GetCustomerMail()."<br>askf");
	SuccessPhpErrorPage("<a href=\'top.php\'>Sign out successful!!! thanks ^_^</a>");
}

/**
0007??
*/
function SetUserSingnIn($customerMail, $customerPwd)
{
	if ( GetMailAndPwdIsCorrect($customerMail, $customerPwd) )
	{
		SetCustomerSignInMail($customerMail);
		SuccessPhpErrorPage("<a href=\'top.php\'>Sign in successful!!! you can go for shopping now! ^_^</a>");
	}
	else
		SuccessPhpErrorPage("Sign in fail!!! we dont find the mail $customerMail in our system, if you not, pls <a href=\'account_info.php?type=5\'>click here</a> for registing first or you can <a href=\'account_info.php?type=3\'>relogin in</a> again. ^_^");
}

/**
0008?????
*/
function SendSignInPwdToCustomer($customerMail)
{
	if (SendUserPwdToCustomerMail($customerMail))
		SuccessPhpErrorPage("<a href=\'top.php\'>The password has sent to your mail. please check if you got the password. ^_^</a>");
	else	
		SuccessPhpErrorPage("<a href=\'top.php\'>We dont find your mail on our register system! Please register at first. ^_^</a>");
	
}

/**
0009clear§ѿ§Ѝ
*/
function ClearAllOrderItemList()
{
	SetCustomerOrderList("");
	$url = $_SERVER['HTTP_REFERER'] ;  
	echo "<script language=\"javascript\">"; 
	echo "location.href=\"$url\""; 
	echo "</script>"; 
}

/**
0010 customer leave message
*/
function customerleavemsg ($pru_ID, $customerIP, $customerMsg, $customerMail, $returnURL, $Nickname)
{
	$Customer = new Customer;
	if (strpos($customerMsg, "<") === false && strpos($customerMsg, ".com") === false && 
			$Customer->AddCuctomerLeaveMsg($pru_ID, $customerIP, $customerMsg, $customerMail, $Nickname, 1))
		SuccessPhpErrorPage("<a href=\'".$_SERVER["HTTP_REFERER"]."\'>我们收到了您的留言，会尽快给您回复！ 谢谢！</a>");
	else	
		SuccessPhpErrorPage("<a href=\'".$_SERVER["HTTP_REFERER"]."\'>留言失败，请重试或联系管理员。<br>".$Customer->errorString." ^_^</a>");
}

/**
0011??
*/
function UpdateItemDetail($pru_id, $pru_size, $pru_child, $pru_class, $pru_sex, $pru_hot, $pru_color, $pru_cai_liao, $pru_is_have_large, $is_vip, $is_avaliable, $pru_payment, $pru_sell_price, $pru_detail_pic, $pru_mini_order, $pru_memo, $pru_buy_price, $pru_temp_size)
{
	if (SetItemDetailInfo($pru_id, $pru_size, $pru_child, $pru_class, $pru_sex, $pru_hot, $pru_color, $pru_cai_liao, $pru_is_have_large, $is_vip, $is_avaliable, $pru_payment, $pru_sell_price, $pru_detail_pic, $pru_mini_order, $pru_memo, $pru_buy_price, $pru_temp_size))
		SuccessPhpErrorPage("修改成功！");
	else	
		SuccessPhpErrorPage("修改失败，请重试一遍！");
}

/**
0012???
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
		$timeStr=date("Y-m-d",$timeInfo);
		
		$seedarray =microtime(); 
		$seedstr =split(" ",$seedarray,5); 
		$seed =$seedstr[0]*10000; 
		
		//?:??? 
		srand($seed); 
		
		//:?¦¶? 
		$random =rand(1,999); 
		$recordNum=sprintf("%s%03d", $timeStr, $seed);
		
		include("dbCfg.php");
		$result = mysql_query("select * from t_order_record_his where T_ID='$recordNum'; ",$pingoDateBase);
		
		$nPruNum = mysql_numrows($result);
		if ($nPruNum==0)
		{
			$sSql="INSERT INTO t_order_record_his (T_ID, T_ITEM_LIST, T_MEMO, T_SHOW_PAYMENT, T_ADD_PRICE_INFO) VALUES('$recordNum', '$itemList', '$memo', $IsNShowPayment, $IsNShowPriceInfo)";
			mysql_query($sSql, $pingoDateBase);
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
0013 customer submit new order
*/

function CustomerSubOrder($cMail, $cCountry, $mMsg, $OrderInfo, $subject)
{
	$OrderInfo = $_POST["itemList"];
	$OnlineOrder = new OnlineOrder;
	
	$OnlineOrder->AddNewOnlineOrder($_POST["name"], $_POST["mobilePhone"], "", "", $_POST["mail"], $_POST["qq"], "", "", $_POST["msg"], $OrderInfo);

	$rootDetailInfo[]=array();
	$admin = new admin;
	$admin->GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo);

	if (strlen($subject)==0)
		$clientInfo="<br>contact mail: $cMail<br>Country: $cCountry<br>msg: <br>-----------------------<br>".str_replace("\r\n", "<br>", $mMsg)."<br>-----------------------<br>Item List: <br>-----------------------".str_replace("=====", "<br>", $OrderInfo)."<br>-----------------------<br>";
	else
		$clientInfo="<br>contact mail: $cMail<br>Subject: $subject<br>msg: <br>-----------------------<br>".str_replace("\r\n", "<br>", $mMsg)."<br>-----------------------<br>";
	
	//SentHtmlMailByAdminMail($cMail, "$rootDetailInfo[7] thanks for your order or message!!!","<br>thanks for you order from us.<br> we'll reply you within 12hour, tell you the best price we can do it for you.<br> and if you have any question, pls let me know. we'll reply you asap.<br>The items you would like this time:<br>---------------".str_replace("=====", "<br>", $OrderInfo)."<br>---------------<br><br>$rootDetailInfo[3]");
	
	SentHtmlMailByAdminMail($rootDetailInfo[5], "$rootDetailInfo[7] new order!!!",$clientInfo."<br><br>$rootDetailInfo[3]");
	
	$BuyLog = new BuyLog;
	$customer = new Customer;
	$result = $customer->GetCustomerByHeadURL($subWebName);
	
	if ($rowCustomer=mysql_fetch_array($result))
	{
		$strItemList=explode("=====",$OrderInfo);
		$nCount = count($strItemList);
		for ($i=0; $i<$nCount; $i++)
		{
			if (empty($strItemList[$i])==true)
				;
			else
			{
				$strIDItem=explode(" ",$strItemList[$i]);
				$BuyLog->AddBuyLog($strIDItem[0], 1, "");
			}
		}
	}
	
	SuccessPhpErrorPage2(SUBMIT_ORDER_SUCCESS, $_POST["url"]);
}

/**
0014 customer submit new message
*/

function CustomerSubMessage($cMail, $cCountry, $mMsg, $OrderInfo, $subject)
{

	$rootDetailInfo[]=array();
	$admin = new admin;
	$admin->GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo);
	if (strlen($subject)==0)
		$clientInfo="<br>contact mail: $cMail<br>Country: $cCountry<br>msg: <br>-----------------------<br>".str_replace("\r\n", "<br>", $mMsg)."<br>-----------------------<br>Item List: <br>-----------------------".str_replace("=====", "<br>", $OrderInfo)."<br>-----------------------<br>";
	else
		$clientInfo="<br>contact mail: $cMail<br>Subject: $subject<br>msg: <br>-----------------------<br>".str_replace("\r\n", "<br>", $mMsg)."<br>-----------------------<br>";
	
	SentHtmlMailByAdminMail($cMail, "$rootDetailInfo[7] thanks for your order or message!!!","<br>thanks for you order from us.<br> we'll reply you within 12hour, tell you the best price we can do it for you.<br> and if you have any question, pls let me know. we'll reply you asap.<br>The items you would like this time:<br>---------------".str_replace("=====", "<br>", $OrderInfo)."<br>---------------<br><br>$rootDetailInfo[3]");
	
	SentHtmlMailByAdminMail($rootDetailInfo[5], "$rootDetailInfo[7] new message!!!",$clientInfo."<br><br>$rootDetailInfo[3]");

	$customer = new Customer;
	$customer->AddCuctomerLeaveMsgtoWeb($_SERVER["REMOTE_ADDR"], $mMsg, $cMail, $subject);
	SuccessPhpErrorPage("我们已经收到您的留言.我们会在尽快给您回复! <br> 谢谢您的留言！^_^");
}

/**
?
*/
$COM_ID=$_GET["COM_ID"];

if ($COM_ID=="0001")//???
{
	//echo $_POST["COM_ID"];
	AddItemToGouWuChe();
}
elseif ($COM_ID=="0002")//????
{
	RemoveItemFromList($_GET["ID"]);
}
elseif ($COM_ID=="0003")//??
{
	CustomerRegiste($_POST["UserMail"], $_POST["userPwd"], $_POST["country"], $_POST["UserName"], $_POST["address"]);
}
elseif ($COM_ID=="0004")//???
{
	updateUserProfileInfo(GetCustomerMail(),$_POST["country"], $_POST["UserName"], $_POST["address"], "");
}
elseif ($COM_ID=="0005")//?¦ʿ
{
	updateUserPwd(GetCustomerMail(), $_POST["userPwd"], $_POST["newPwd"]);
}
elseif ($COM_ID=="0006")//??
{
	SetUserSingnOut();
}
elseif ($COM_ID=="0007")//??
{
	SetUserSingnIn($_POST["UserMail"], $_POST["userPwd"]);
}
elseif ($COM_ID=="0008")//?
{
	SendSignInPwdToCustomer($_POST["UserMail"]);
}
elseif ($COM_ID=="0009")//?§ҧѿ
{
	ClearAllOrderItemList();
}
elseif ($COM_ID=="0010")//??
{ 
	$randcode = $_POST['randcode'];
	session_start();
	
	if (strlen($randcode) > 0 && strcasecmp($randcode, $_SESSION['randcode']) == 0 
			&& strpos($_POST["leaveMsg"], "<") === false && strpos($customerMsg, ".com") === false )
	{
		$BuyLog = new BuyLog;
		$BuyLog->AddBuyLog($_POST["PRU_ID"], 0, "");
	
		$_SESSION['randcode'] = "";
		customerleavemsg ($_POST["PRU_ID"], $_SERVER["REMOTE_ADDR"], $_POST["leaveMsg"], $_POST["C_MAIL"], $_POST["OriginalURL"], $_POST["Nickname"]);
	}
	else
	{
		SuccessPhpErrorPage("验证码输入错误！请重新输入正确的验证码<br>");
	}
}
elseif ($COM_ID=="0011")//??
{
	UpdateItemDetail($_POST["T_ID"], $_POST["T_SIZE"], $_POST["T_CHILD"], $_POST["T_CLASS"], $_POST["T_STYLE_MEN"], $_POST["T_HOT"], $_POST["T_COLOR"], $_POST["T_CAI_LIAO"], $_POST["T_DETAIL_HAVE"], $_POST["IS_VIP"], $_POST["T_STATUS"], $_POST["T_PAYMENT"], $_POST["T_PRICE"], $_POST["T_XIJIE_PIC"], $_POST["T_MIMI_OLDER"],$_POST["T_BEIZHU"],$_POST["T_JINHUO_PRICE"],$_POST["T_TEMP_SIZE"]);
}
elseif ($COM_ID=="0012")//???
{
	GetOrderRecordHistoryNumber($_POST["itemListF"], $_POST["cOtherInfo"], $_POST["Payment_Info"], $_POST["Add_Price"]);
}
elseif ($COM_ID=="0013")//customer make order!
{
	$randcode = $_POST['randcode'];
	session_start();
	if (strlen($randcode) > 0 && strcasecmp($randcode, $_SESSION['randcode']) == 0
			&& strpos($_POST["msg"], "<") === false && strpos($customerMsg, ".com") === false )
		CustomerSubOrder($_POST["mail"], $_POST["country"], $_POST["msg"], $_POST["OrderInfo"], "");
	else
		SuccessPhpErrorPage("验证码输入错误！请重新输入正确的验证码<br>");
	
	$_SESSION['randcode']="";
	session_destroy();
}
elseif ($COM_ID=="0014")//customer leave message!
{
	$BuyLog = new BuyLog;
	$subWebName = GetCurrentSubWebName();
	$randcode = $_POST['randcode'];
	session_start();
	if (strlen($randcode) > 0 && strcasecmp($randcode, $_SESSION['randcode']) == 0)
	{	
		$_SESSION['randcode'] = "";
		if (strlen($subWebName)>0)
		{
			$customer = new Customer;
			$result = $customer->GetCustomerByHeadURL($subWebName);
			
			if ($rowCustomer=mysql_fetch_array($result) && strpos($_POST["msg"], "<") === false &&  strpos($customerMsg, ".com") === false)
			{
				$BuyLog->AddBuyLog($pruID, 0, $rowCustomer["T_ID"]);
			}
		}
		
		CustomerSubMessage($_POST["mail"], "", $_POST["msg"], "", $_POST["subject"]);
	}
	else
	{
		SuccessPhpErrorPage("验证码输入错误！请重新输入正确的验证码<br>");
	}
	
	$_SESSION['randcode']="";
	session_destroy();
}

?>