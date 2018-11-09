<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");
/**
SUCCESS.PHP 错误提交表单
*/
function SuccessPhpErrorPage($ErrorString, $IsSuccess, $directUrl)
{
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php
	echo $ErrorString;
	//echo  "update t_web_conn set T_URL='".$web_url."' and T_WEB_NAME='".$web_page_subject."' ";
	echo "<body></body><script language=\"javascript\">"; 
	if ($IsSuccess)
		echo "location.href=\"$directUrl\""; 
	echo "</script>"; 
}
/**
命令1001，更新网站主题配置信息
*/
function SetWangZhanZhuTiConn()
{
	$web_url=$_POST["web_url"];
	$web_page_subject=$_POST["web_subject"];
	$web_NikiName=$_POST["web_NikiName"];
	$web_ContactInfo=$_POST["web_ContactInfo"];
	$web_welcome_text=$_POST["web_welcome_text"];
	$web_home=$_POST["web_home"];
	$web_paypal=$_POST["web_paypal"];
	$web_show_sell_price=$_POST["ShowSellPrice"];
	
	$webConfig = new WebConfig;
	$bRet=$webConfig->SetWebConfigDetailInfo($web_url, $web_page_subject, $web_NikiName, $web_ContactInfo, $web_welcome_text, $web_home, $web_paypal, $web_show_sell_price);
	if ($bRet)
		SuccessPhpErrorPage("Update your profile infomation successful!", true, "web_conn.php");
	else
		SuccessPhpErrorPage("Update your profile infomation faild!", false, "web_conn.php");
}
/**
命令1002，更改用户个人信息
*/
function updateUserProfileInfo($customerMail, $customerCountry, $customerName, $customerAdd, $customerMemo)
{
	$bRes=SetUserProfileInfo($customerMail, $customerCountry, $customerName, $customerAdd, $customerMemo);
	if ($bRes)
	{//修改成功
		SuccessPhpErrorPage("Update your profile infomation successful! you can go for shopping now", true, "customerList.php");
	}
	else
	{//修改失败
		SuccessPhpErrorPage("Update your profile infomation Fail! pls retry again or contact with us directly.", true, "customerList.php");
	}
}
/**
命令1003，更改管理员个人信息
*/
function UpdateAdminProfileInfo()
{
}
/**
com 1004，InsertNewItem
*/
function InsertNewItem()
{
	$Product = new Product;
	$bIsSucess = $Product->BatchImportItem($_POST["ItemDetail"]);
	UpdateWebMenu();
	
	if ($bIsSucess==TRUE )
		SuccessPhpErrorPage("Update all items successful ^_^", false, "itemManage.php");
	else 
	SuccessPhpErrorPage("Successful partly, pls check and try again!", false, "itemManage.php");
}
/**
1005，admin login in.
*/
function AdminSingIn()
{
	$userName=$_POST["userName"];
	$userPwd=$_POST["userPwd"];
	$SQL=new SQL;
	$admin = new admin;

	$sSql="select * from admin where T_NAME='$userName' and T_PWD='$userPwd' ";
	if ($userName=="root")
		;
	else
		$sSql=$sSql." and T_URL='".GetCurrentWebHost()."'";
		
	$result =$SQL->Query($sSql);

	if ($row=mysql_fetch_array($result))
	{
		$admin->SetAdminSignInfo($userName, $userPwd);
		SuccessPhpErrorPage(ADMIN_LOGIN_SUCCESS, true, "indexx.php");
	}
	else
		SuccessPhpErrorPage(ADMIN_LOGIN_FAILED_WRONG_PASSWORD, false, "index.php");
}
/**
com: 1006，update item to avaliable to sell.
*/
function updateItemAvaliableSell()
{
	$nTotal=$_POST["nItemTotal"];
	for ( $i=0; $i<$nTotal; $i++)
	{
		if ($_POST["CBOX$i"]=="selected")
		{
			$product = new Product;
			$product->SetItemAvaliable($_POST["nItemID$i"]);
		}
	}
	SuccessPhpErrorPage("update item status successful!  ^_^", true, "itemManage.php");
}
/**
com: 1007，update item to unavaliable to sell.
*/
function updateItemUnavaliableSell()
{
	$nTotal=$_POST["nItemTotal"];
	//echo "nTotal=$nTotal<br>";
	for ( $i=0; $i<$nTotal; $i++)
	{
		//echo "[$i]".$_POST["CBOX$i"]." <br>";
		if ($_POST["CBOX$i"]=="selected")
		{
			$product = new Product;
			$product->SetItemUnavaliable($_POST["nItemID$i"]);
		}
	}
	SuccessPhpErrorPage("update item status successful!  ^_^", true, $_SERVER["HTTP_REFERER"]);
}
/**
com: 1008，delete item info from website.
*/
function DeleteItemFromWebSiteSell()
{
	$nTotal=$_POST["nItemTotal"];
	for ( $i=0; $i<$nTotal; $i++)
	{
		if ($_POST["CBOX$i"]=="selected")
		{
			$product = new Product;
			$product->DeleteItem($_POST["nItemID$i"]);
		}
	}
	SuccessPhpErrorPage("Delete item successful!  ^_^", true, $_SERVER["HTTP_REFERER"]);
}
/**
命令1009，产品具体信息更新
*/
function UpdateItemDetail($pru_id, $pru_size, $pru_child, $pru_class, $pru_sex, $pru_hot, $pru_color, $pru_cai_liao, $pru_is_have_large, $is_vip, $is_avaliable, $pru_payment, $pru_sell_price, $pru_detail_pic, $pru_mini_order, $pru_memo, $pru_buy_price, $userID, $pruSizeDanWei)
{
	$fileMainPath="../".GetItemPathInfo($pru_id);
	$pictureList="";
	$bIsNeedUpdateHeadPic=false;	//是否更新1_s  和 head 图片
	$bIsNeedUpdatePic=false;		//是否更新本张图片内容
	$bFirstPicProcessed=false;		//第一张图片是否已经处理
	for ( $i=1; $i<=20; $i++)
	{
		if ($_POST["ItemAvaliable$i"]==0 && strlen($_POST["ItemPicNumOriginal$i"])>0 )
		{
			$filePath=$fileMainPath.$_POST["ItemPicNumOriginal$i"];
			unlink($filePath);
			if ($bFirstPicProcessed==false)
				$bIsNeedUpdateHeadPic=true;
		}
		elseif ($_POST["ItemAvaliable$i"]!=0)
		{
			if ($_POST["PicUploadType$i"]==0)	//upload
			{
				if(isset( $_FILES ) && !empty( $_FILES [ "PicUploadLocalFile$i" ]) && $_FILES [ "PicUploadLocalFile$i" ][ "size" ]> 0 ) 
				{ 
					$uploadfilename=time(). "_" . $_FILES ["PicUploadLocalFile$i"]["name"]; 
					$uploadfile = $fileMainPath.$uploadfilename;
					if ( copy ( $_FILES["PicUploadLocalFile$i"]["tmp_name"], $uploadfile)) 
					{
						if ($bFirstPicProcessed==false)
							$bIsNeedUpdateHeadPic=true;
						$bIsNeedUpdatePic=true;
						$pictureList=$pictureList."?????$uploadfilename";
						if (strlen($_POST["ItemPicNumOriginal$i"])>0)
						{
							$filePath=$fileMainPath.$_POST["ItemPicNumOriginal$i"];
							if (file_exists($filePath))
								unlink($filePath);
						}
					}
				}
			}
			elseif ($_POST["PicUploadType$i"]==1)	//URL
			{
				if ($_POST["PicUploadURL$i"]==$_POST["ItemPicNumOriginal$i"])
				{
					if ($bFirstPicProcessed==false)
						$bFirstPicProcessed=true;
					$uploadfile = $fileMainPath.$_POST["PicUploadURL$i"];
					$pictureList=$pictureList."?????".$_POST["PicUploadURL$i"];
				}
				else
				{
					$urlList=explode("/" , $_POST["PicUploadURL$i"]);
					$uploadfilename=time(). "_".$urlList[count($urlList)-1]; 
					$uploadfile = $fileMainPath.$uploadfilename;
					echo "PicUploadURL$i=".$_POST["PicUploadURL$i"]."<br> uploadfile=".$uploadfilename;
					if (!$fp = @fopen($_POST["PicUploadURL$i"],"r")) 
					{
						if (copy ( $_POST["PicUploadURL$i"], $uploadfile ))
						{
							if ($bFirstPicProcessed==false)
								$bIsNeedUpdateHeadPic=true;
							$bIsNeedUpdatePic=true;
							$pictureList=$pictureList."?????$uploadfilename";
							if (strlen($_POST["ItemPicNumOriginal$i"])>0)
							{
								$filePath=$fileMainPath.$_POST["ItemPicNumOriginal$i"];
								unlink($filePath);
							}
						}
						echo "copy faild!";
					}
					else
						echo "the picture is not found!";
				}
			}
		}
		if ($bIsNeedUpdateHeadPic && strlen($uploadfile)>0)
		{
			if (file_exists($fileMainPath."head.jpg"))
				unlink($fileMainPath."head.jpg");
			createDstImage($uploadfile, 200, 133, $fileMainPath."head.jpg");
			if (file_exists($fileMainPath."1_s.jpg"))
				unlink($fileMainPath."1_s.jpg");
			createDstImage($uploadfile, 72, 76, $fileMainPath."1_s.jpg");
			$bIsNeedUpdateHeadPic=false;
			$bFirstPicProcessed=true;
		}
		if ($bIsNeedUpdatePic)
		{
			//添加图片水印 
			imageWaterMark ( $uploadfile , 7 , "images/left_down.png" ); 
			imageWaterMark ( $uploadfile , 1 , "images/left_up.png" ); 
			imageWaterMark ( $uploadfile , 3 , "images/right_up.png" ); 
			imageWaterMark ( $uploadfile , 9 , "images/right_down.png" ); 
			imageWaterMark ( $uploadfile , 9 , "images/logo.png" ); 
		}
		$bIsNeedUpdatePic=false;
		$uploadfile="";
	}
	$product = new Product;
	$product->SetItemPictureList($pru_id, $pictureList);	//把图片信息放到数据库！
	if ($product->SetItemDetailInfo($pru_id, $pru_size, $pru_child, $pru_class, $pru_sex, $pru_hot, $pru_color, $pru_cai_liao, $pru_is_have_large, $is_vip, $is_avaliable, $pru_payment, $pru_sell_price, $pru_detail_pic, $pru_mini_order, $pru_memo, $pru_buy_price, $userID, $pruSizeDanWei))
		SuccessPhpErrorPage("update item detail successful!  ^_^", true, "EditItem.php?ID=$pru_id");
	else	
		SuccessPhpErrorPage("update item detail Failed!  ^_^", false, "EditItem.php?ID=$pru_id");
}
/**
com: 1010，reply customer message
*/
function ReplyCustomerMsg()
{
	$admin = new admin;
	$admin->AddAdminLeaveMsg($_POST["MSG_ID"], $_POST["PRU_ID"], $_SERVER["REMOTE_ADDR"], $_POST["leaveMsg"], "", "");
	if ($_POST["sendMail"]==1)
	{
	$rootDetailInfo=array();
	if ($admin->GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo))
	;
	else
	{
	echo "没有找到root帐号";
	return false;	//没有找到root帐号
	}
	SentHtmlMailByAdminMail($_POST["CUSTOMER_MAIL"], "$rootDetailInfo[7] Reply your message on ".$_POST["PRU_ID"]."! ", "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td bgcolor=\"#C2DC71\"><br>&nbsp;hello ".$_POST["NIKI_NAME"].":<BR><BR>&nbsp;".str_replace("\r\n", "<br>&nbsp;", $_POST["leaveMsg"])."<br><BR></td></tr><tr><td bgcolor=\"#FFFF99\"><br>&nbsp;Your original question:<br>&nbsp;==================<br>&nbsp;".str_replace("\r\n", "<br>&nbsp;", $_POST["ORIGINAL_MSG"])."<br><BR></td></tr><tr><td bgcolor=\"#C2DC71\"><br>&nbsp;For more detail infomation, pls click the url as blow:<br>&nbsp;<a href=\"http://$rootDetailInfo[7]/detail_pic.php?ID=".$_POST["PRU_ID"]."\">http://$rootDetailInfo[7]/detail_pic.php?ID=".$_POST["PRU_ID"]."</a><br><BR></td></tr><tr><td>&nbsp;</td></tr></table>$rootDetailInfo[3]");
	}
	SuccessPhpErrorPage("Reply customer's message successful!  ^_^", true, "MsgList.php?type=buyer");
}
/**
com: 1011，set customer's message status.
*/
function SetCustomerMsgStatus()
{
	$admin = new admin;
	$admin->SetCustomerMessageStatus($_GET["MSG_ID"], $_GET["ACTION"]);
	SuccessPhpErrorPage("Reply customer's message successful!  ^_^", true, $_SERVER["HTTP_REFERER"]);
}

/**
com:1012 delete the account
*/
function DeleteAdminAccount()
{
	$adminID=$_GET["ID"];
	$admin = new admin;
	if (strlen($adminID)>0)
		if ($admin->DeleteAdminByID($adminID))
		{
			SuccessPhpErrorPage("Delete admin successful!  ^_^", true, $_SERVER["HTTP_REFERER"]);
			return true;
		}
	
	SuccessPhpErrorPage("Delete admin successful!  @_@", false, $_SERVER["HTTP_REFERER"]);
}

/**
com: 1013，change admin detail info.
*/
function AdminDetailInfoChange()
{
	$detailInfo=array();
	$detailInfo[0]=trim($_POST["T_PWD"]);
	$detailInfo[1]=trim($_POST["T_DENG_JI"]);
	$detailInfo[2]=trim($_POST["T_MEMO"]);
	$detailInfo[3]=str_replace("\r\n", "<br>", trim($_POST["T_QIAN_MING"]) );
	$detailInfo[4]=trim($_POST["T_DOMAIN"]);
	$detailInfo[5]=trim($_POST["T_USER_MAIL_ADD"]);
	$detailInfo[6]=trim($_POST["T_USER_MAIL_PWD"]);
	$detailInfo[7]=trim($_POST["T_USER_WEBSITE"]);
	$detailInfo[8]=trim($_POST["T_USER_MENU"]);
	$detailInfo[9]=trim($_POST["T_USER_NI_CHENG"]);
	$detailInfo[11]=trim($_POST["T_YOUJU_IP_ADD"]);
	$detailInfo[12]=trim($_POST["T_YOUJU_DUANKOU"]);
	$detailInfo[13]=trim($_POST["T_NAME"]);
	if (strlen($detailInfo[0])==0 || strlen($detailInfo[13])==0)
	{
		SuccessPhpErrorPage("update admin's detail information failed!  ^_^<br><a href=\"adminDetail.php?ID=".trim($_GET["ID"])."\">click this check your input info.</a>", false, "adminList.php");
		return false;
	}
	$cur_admin = new admin;
	$cur_admin->SetAdminDetailInfo(trim($_GET["ID"]), $detailInfo);
	SuccessPhpErrorPage("update admin's detail information successful!  ^_^", true, "adminList.php");
}
/**
com: 1015，add admin detail info.
*/
function AddAdmin()
{
	$detailInfo=array();
	$detailInfo[0]=trim($_POST["T_PWD"]);
	$detailInfo[1]=trim($_POST["T_DENG_JI"]);
	$detailInfo[2]=trim($_POST["T_MEMO"]);
	$detailInfo[3]=trim($_POST["T_QIAN_MING"]);
	$detailInfo[4]=trim($_POST["T_DOMAIN"]);
	$detailInfo[5]=trim($_POST["T_USER_MAIL_ADD"]);
	$detailInfo[6]=trim($_POST["T_USER_MAIL_PWD"]);
	$detailInfo[7]=trim($_POST["T_USER_WEBSITE"]);
	$detailInfo[8]=trim($_POST["T_USER_MENU"]);
	$detailInfo[9]=trim($_POST["T_USER_NI_CHENG"]);
	$detailInfo[11]=trim($_POST["T_YOUJU_IP_ADD"]);
	$detailInfo[12]=trim($_POST["T_YOUJU_DUANKOU"]);
	$detailInfo[13]=trim($_POST["T_NAME"]);
	if (strlen($detailInfo[0])==0 || strlen($detailInfo[13])==0)
	{
		SuccessPhpErrorPage("add admin failed!  ^_^<br><a href=\"adminAdd.php?ID=".trim($_GET["ID"])."\">click this check your input info.</a>", false, "adminAdd.php");
		return false;
	}
	$cur_admin = new admin;
	$cur_admin->AddAdminDetailInfo($detailInfo);
	SuccessPhpErrorPage("add admin successful!  ^_^", true, "adminList.php");
}
/**
1016 admin sign out
*/
function AdminSignOut()
{
SetAdminSignOut();
SuccessPhpErrorPage("admin sign out successful!  ^_^", true, "index.php");
}
/**
1017 AddSubDomain
*/
function AddSubDomain()
{
	$SQL=new SQL;
	if (strlen($_POST["WEB_URL"])==0)
		;
	else
	{
		$sSql="select * from t_web_conn where T_URL='".$_POST["WEB_URL"]."';";
		$result = $SQL->Query($sSql);
		$nItemTotal = mysql_numrows($result);
		if ($nItemTotal==0)
		{	
			$sSql="insert INTO t_web_conn (T_URL) VALUES ('".$_POST["WEB_URL"]."');";
			$result = $SQL->Query($sSql);
		}
		$fileMainPath="../".$_POST["WEB_URL"];
		if (!is_readable($fileMainPath))
		mkdir ($fileMainPath,0777);
	}
	//die($fileMainPath);
	SuccessPhpErrorPage("Add sub domain successful!  ^_^", true,  $_SERVER["HTTP_REFERER"]);
}
/**
1018 DeleteSubDomain
*/
function DeleteSubDomain()
{
	$SQL=new SQL;
	if (strlen($_GET["T_URL"])==0)
		;
	else
	{
		$sSql="delete from t_web_conn where T_URL='".$_GET["T_URL"]."';";
		$result = $SQL->Query($sSql);
	}
	//die($fileMainPath);
	SuccessPhpErrorPage("Delete sub domain successful!  ^_^", true,  $_SERVER["HTTP_REFERER"]);
}

/**
1019 UpdateNewArriavals
*/
function UpdateNewArriavals()
{
	$SQL=new SQL;
	$sSql="delete from T_HOT_ITEM where  T_HOT_TYPE='index_new_arraivals' and  T_URL='".GetCurrentWebHost()."';";
	$result = $SQL->Query($sSql);
	
	$nTotal=$_POST["nTotal"]+0;
	for ($i=0; $i<$nTotal; $i++)
	{
		if (strlen($_POST["ID".$i])>0)
		{
			$sSql="INSERT INTO T_HOT_ITEM (T_ID, T_URL, T_HOT_TYPE, T_ORDER) VALUES ('".$_POST["ID".$i]."', '".GetCurrentWebHost()."', 'index_new_arraivals', ".($_POST["ORDER".$i]+0).") ;";
			$SQL->Query($sSql);
		}
	}
	//die($fileMainPath);
	SuccessPhpErrorPage("Update new arriavals items succesfual!  ^_^", true,  $_SERVER["HTTP_REFERER"]);
}

/**
com:1020 Add New Nav Menu 
*/
function AddNewNavMenu()
{
	$name=$_POST["Name"];
	$orderIndex=$_POST["Order"];
	$text=$_POST["Text"];
	$url=GetCurrentWebHost();
	$type=$_POST["Type"];
	
	if (strlen($name)>0)
	{
		$SQL=new SQL;
		
		$sSql="INSERT INTO `t_top_nav` (`T_NAME` ,`T_URL` ,`T_INDEX` ,`T_TEXT` ,`T_TYPE` ,`T_ID` )VALUES ('$name', '$url', '$orderIndex', '$text', '$type', NULL );";
		 $SQL->Query($sSql);
		
		SuccessPhpErrorPage("Add New Nav Menu  ^_^", true, $_SERVER["HTTP_REFERER"]);
	}
	else
	{
		SuccessPhpErrorPage("Add New Nav Menu  failed! @_@ pls input the name!", true, $_SERVER["HTTP_REFERER"]);
	}
}

/**
com:1021 Update Nav Menu 
*/
function UpdateNavMenu()
{
	$name=$_POST["Name"];
	$orderIndex=$_POST["Order"];
	$text=$_POST["Text"];
	$url=GetCurrentWebHost();
	$type=$_POST["Type"];
	$ID=$_POST["ID"];
	$action=$_POST["action"];

	if (strlen($ID)>0 && $action=="Update")
	{
		$SQL=new SQL;
		$sSql="update `t_top_nav` set `T_NAME`='$name' ,`T_URL`='$url' ,`T_INDEX`='$orderIndex',`T_TEXT`='$text' ,`T_TYPE`='$type' where T_ID='$ID';";
		//die($sSql."<br>");
		$SQL->Query($sSql);
		
		SuccessPhpErrorPage("Update Nav Menu  ^_^", true, $_SERVER["HTTP_REFERER"]);
	}
	else if (strlen($ID)>0 && $action=="Delete")
	{
		$SQL=new SQL;
		$sSql="delete from t_top_nav where T_ID='$ID';";
		$SQL->Query($sSql);
		
		SuccessPhpErrorPage("Delete Nav Menu  ^_^", true, $_SERVER["HTTP_REFERER"]);
	}
	else
	{
		SuccessPhpErrorPage("Update Menu  failed! @_@ pls input the name!", true, $_SERVER["HTTP_REFERER"]);
	}
}

/**
开始命令解析
*/
$COM_ID=$_GET["COM_ID"];
if ($COM_ID=="1001")	//更新网站主题配置信息
{
//echo $_POST["COM_ID"];
SetWangZhanZhuTiConn();
}
elseif ($COM_ID=="1002")	//更改客户个人信息
{
updateUserProfileInfo();
}
elseif ($COM_ID=="1003")	//更改管理员个人信息
{
UpdateAdminProfileInfo();
}
elseif ($COM_ID=="1004")	//添加新产品
{
InsertNewItem();
}
elseif ($COM_ID=="1005")	//管理员登录
{
AdminSingIn();
}
elseif ($COM_ID=="1006")	//set item avaliable
{
updateItemAvaliableSell();
}
elseif ($COM_ID=="1007")	//set item unavaliable
{	
	updateItemUnavaliableSell();
}
elseif ($COM_ID=="1008")	//delete item
{
	DeleteItemFromWebSiteSell();
}
elseif ($COM_ID=="1009")	//update item detail
{
UpdateItemDetail($_POST["T_ID"], $_POST["T_SIZE"], $_POST["T_CHILD"], $_POST["T_CLASS"], $_POST["T_STYLE_MEN"], $_POST["T_HOT"], $_POST["T_COLOR"], $_POST["T_CAI_LIAO"], $_POST["T_DETAIL_HAVE"], $_POST["IS_VIP"], $_POST["T_STATUS"], $_POST["T_PAYMENT"], $_POST["T_PRICE"], $_POST["T_XIJIE_PIC"], $_POST["T_MIMI_OLDER"],$_POST["T_BEIZHU"],$_POST["T_JINHUO_PRICE"], $_POST["T_USER_ID"], $_POST["T_SIZE_DANWEI"]);
}
elseif ($COM_ID=="1010")	//reply customer's message on website.
{
ReplyCustomerMsg();
}
elseif ($COM_ID=="1011")	//set customer's message status.
{
SetCustomerMsgStatus();
}
elseif ($COM_ID=="1012")	//delete admin
{
	echo DeleteAdminAccount();
}
elseif ($COM_ID=="1013")	//change admin detail info.
{
echo AdminDetailInfoChange();
}
elseif ($COM_ID=="1014")	//do avalialbe the account
{
	echo "delete admin";
}
elseif ($COM_ID=="1015")	//add admin
{
echo AddAdmin();
}
elseif ($COM_ID=="1016")	//add admin
{
	echo AdminSignOut();
}
elseif ($COM_ID=="1017")	//add sub domain
{
	echo AddSubDomain();
}
elseif ($COM_ID=="1018")	//add sub domain
{
	echo DeleteSubDomain();
}
elseif ($COM_ID=="1019")	//update new arriavals items.
{
	echo UpdateNewArriavals();
}
elseif ($COM_ID=="1020")	//add money earn detail.
{
	//echo $_POST["COM_ID"];
	echo AddNewNavMenu();
}
elseif ($COM_ID=="1021")	//add money earn detail.
{
	//echo $_POST["COM_ID"];
	echo UpdateNavMenu();
}
elseif ($COM_ID=="1022")	//add money earn detail.
{
	//echo $_POST["COM_ID"];
	$Product = new Product;
	$Product->AddSingleItem(trim($_POST["T_ID"]), trim($_POST["T_SIZE"]), $_POST["T_CHILD"], $_POST["T_CLASS"], $_POST["T_STYLE_MEN"], $_POST["T_HOT"], $_POST["T_COLOR"], $_POST["T_CAILIAO"], $_POST["T_DETAIL_HAVE"], $_POST["IS_VIP"], $_POST["T_STATUS"], $_POST["T_PAYMENT"], $_POST["T_PRICE"], 0, 0, $_POST["T_MEMO"], 0, trim($_POST["T_USER_ID"]));
	SuccessPhpErrorPage("add single item successful!!  ^_^", true, $_SERVER["HTTP_REFERER"]);
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
margin-left: 0px;
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
background-color: #FAFAFA;
font-family:Arial, Helvetica, sans-serif;
font-size:12px;
}</style>