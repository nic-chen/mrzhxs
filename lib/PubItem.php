<?php
function GetStyleInfo($styleNum)
{
	if ($styleNum==0)
		return "unsex";
	elseif ($styleNum==1)
		return "Men";
	elseif ($styleNum==2)
		return "Women";
}

class Cart
{
	var $strCookieCardList;
	var $strCartList;
	
	function Cart()
	{
		$strCookieCardList="ORDER_LIST";
		$strCartList=$_COOKIE[$strCookieCardList];
	}
	
	function SetCustomerOrderList($itemList)
	{
		setcookie($strCookieCardList, $itemList, time()+24*3600);
		return true;
	}
	
	function GetCurrectOrderInfo($pru_id)
	{
		$strCookie=$strCookieCardList;
		$strItemList=explode("=====", $strCookie);
		$nCount = count($strItemList);
		
		for ($i=0; $i<$nCount; $i++)
		{
			if (empty($strItemList[$i]))
				;
			else
			{
				$strID=explode(" ",$strItemList[$i]);
				if ($strID[0]==$pru_id)
					return substr($strItemList[$i], strlen($strID[0])+1,strlen($strItemList[$i]));
			}
		}
	}
}

?>