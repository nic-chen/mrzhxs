<?php
require_once('settings.php');

/**
使产品上架
*/
function SetItemAvaliable($pru_id)
{
	include(APPROOT."dbCfg.php");
	$result = mysqli_query("update pru set T_STATUS=0 where T_ID='$pru_id'",$allDateBase);
	return true;
}

/**
使产品下架
*/
function SetItemUnavaliable($pru_id)
{
	include(APPROOT."dbCfg.php");
	$result = mysqli_query("update pru set T_STATUS=2 where T_ID='$pru_id'",$allDateBase);
	echo "update $pru_id dont avlialbe<br>";
	//echo "update pru set T_STATUS=1 where T_ID='$pru_id'";
	return true;
}

/**
删除产品
*/
function DeleteItem($pru_id)
{
	include(APPROOT."dbCfg.php");
	$result = mysqli_query("select * from pru where T_ID='$pru_id'",$allDateBase);
	if ($row=mysqli_fetch_array($result))
	{
		deldir(GetItemPathInfo($row["T_ID"], $row["Version"]));
		//die(GetItemPathInfo($row["T_ID"], $row["Version"]));
		mysqli_query("delete from pru where T_ID='$pru_id'",$allDateBase);
		echo "Delete item [$pru_id] successful!<br>";
	}
	else
		return true;
}

/**
set sell item detail.
*/
function SetItemDetailInfo($pru_id, $pru_size, $pru_child, $pru_class, $pru_sex, $pru_hot, $pru_color, $pru_cai_liao, $pru_is_have_large, $is_vip, $is_avaliable, $pru_payment, $pru_sell_price, $pru_detail_pic, $pru_mini_order, $pru_memo, $pru_buy_price)
{
	
	
	include(APPROOT."dbCfg.php");
	$sSql="UPDATE pru SET T_COLOR = '$pru_color',T_CAI_LIAO = '$pru_cai_liao',
	T_PAYMENT = '$pru_payment',
	T_STATUS = $is_avaliable,
	IS_VIP  = $is_vip,
	T_STYLE_MEN = $pru_sex,
	T_CHILD = '$pru_child',
	T_CLASS = '$pru_class',
	T_SIZE = '$pru_size',
	T_BEIZHU = '$pru_memo',
	T_HOT = $pru_hot,
	T_PRICE = '$pru_sell_price',
	T_MIMI_OLDER = '$pru_mini_order',
	T_XIJIE_PIC = '$pru_detail_pic',
	T_JINHUO_PRICE = $pru_buy_price,
	T_DETAIL_HAVE = '$pru_is_have_large' WHERE T_ID = '$pru_id' LIMIT 1 ;";
	$result = mysqli_query($sSql,$allDateBase);
	
	//echo $sSql;
	return true;
}

/**
get item file path
return /images/pru/AF/001/
*/
function GetItemPathInfo($pru_id, $pru_version=NULL)
{
	$itemPath="../images/pru/";
	
	if (strlen($pru_version."")>0)
	{
		 if ($pru_version==1)
		 {
			$strTemppp=Split("-", $pru_id);
			$itemPath=$itemPath.trim($strTemppp[0])."/".trim($strTemppp[1])."/";
		 }
		 else 
		 	$itemPath=$itemPath.Trim($pru_id)."/";
	}
	else
	{
		include(APPROOT."dbCfg.php");
		$sSql="select * from pru where T_ID='$pru_id'";
		$result = mysqli_query($sSql,$allDateBase);
		if ($row=mysqli_fetch_array($result))
		{
			if ($row["Version"]==1)
			{
				$strTemppp=Split("-", $pru_id);
				$itemPath=$itemPath.trim($strTemppp[0])."/".trim($strTemppp[1])."/";
			}
			else 
				$itemPath=$itemPath.Trim($pru_id)."/";
		}
		else
			return "false";
	}
	
	return $itemPath;
}

/**
set sell item picture list
*/
function SetItemPictureList($pru_id, $pru_picture_list)
{
	
	
	include(APPROOT."dbCfg.php");
	$sSql="UPDATE pru SET T_DETAIL_PICTURE = '$pru_picture_list' WHERE T_ID = '$pru_id' ;";
	$result = mysqli_query($sSql,$allDateBase);
	
	//echo $sSql;
	return true;
}
?>