<?php
class cart
{
	var $strCookieOrderList;
	var $errorString;
	function cart()
	{
		$this->strCookieOrderList="ORDER_LIST";
	}
	
	function SetCustomerOrderList($itemList)
	{
		setcookie($this->strCookieOrderList, $itemList, time()+24*3600);
		return true;
	}
	
	function GetCustomerOrderList()
	{
		return $_COOKIE[$this->strCookieOrderList];
	}
	
	function GetCurrectOrderInfo($pru_id)
	{
		$strCookie=$this->GetCustomerOrderList();
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
	
	function GetOderAmoutBySize($sizeInfoCookie, $sizeInfo)
	{
	//echo "sizeInfoCookie=".$sizeInfoCookie." sizeInfo=".$sizeInfo."<br>";
		if (empty($sizeInfoCookie) || empty($sizeInfo))
			return ;
		
		
		$sizeDetailList=explode("_", $sizeInfoCookie);
		for ($ii=0; $ii<count($sizeDetailList); $ii++)
		{
			$detailInfo=explode("*",$sizeDetailList[$ii]);
			if ($detailInfo[0]==$sizeInfo)
				return $detailInfo[1];
		}
		return "0";
	}
	
	function AddItemToGouWuChe($pru_id, $nTotal, $sMemoInfo, $pruSizeList, $pruAmountList)
	{
		if (empty($nTotal)==true || $nTotal=="0")
		{
			$this->errorString="The total is zero. exit directly!";
			die( $this->errorString);
			return true;
		}
		else
		{
			$nSizeTotal=$_POST["total"];
			if (empty($nSizeTotal)==true or $nSizeTotal=="0")
				;
			else
			{
				$strItemCookie=$pru_id." ";
		
				$nLoop=0;
				for ($i=0; $i<=($nSizeTotal+0); $i++)
				{
					$strSizeInfo=$pruSizeList[$i];
					$strSizeMount=$pruAmountList[$i];
					if (empty($strSizeMount)==true or $strSizeMount=="0")
						;
					else
					{
						if ($nLoop==0)
							$strItemCookie=$strItemCookie.$strSizeInfo."*".$strSizeMount;
						else
							$strItemCookie=$strItemCookie."_".$strSizeInfo."*".$strSizeMount;
						$nLoop++;
						$sumOder=$sumOder+0+$strSizeMount;
					}
				}
				if (strlen($sMemoInfo)>0)
					$strItemCookie=$strItemCookie."_sum*".$sumOder."_memo*".$sMemoInfo;
				else
					$strItemCookie=$strItemCookie."_sum*".$sumOder;
				
				$strCookieStr=$this->GetCustomerOrderList();
				if (empty($strCookieStr)==true)
				{
					$strCookieStr=$strCookieStr."=====".$strItemCookie;
					$this->SetCustomerOrderList($strCookieStr);
				}
				else
				{
					//echo "<br>ԭcookieǷҪ ")
					$strItemList=explode("=====",$strCookieStr);
					$nCount = count($strItemList);
					
					for ($i=0; $i<=$nCount; $i++)
					{
						if (empty($strItemList[$i])==true)
							;
						else
						{
							$strIIDD=explode(" ",$strItemList[$i]);
							if ($strIIDD[0]==$pru_id)
							{
								$strItemList[$i]=$strItemCookie;
								$isFind="TRUE";
								break;
							}
						}
					}
					if ($isFind=="TRUE")
					{
						$strCookieStr="";
						for ($i=0; $i<$nCount;$i++)
						{
							if (empty($strItemList[$i])==true)
								;
							else
								$strCookieStr=$strCookieStr."=====".$strItemList[$i];
						}
					}
					else
						$strCookieStr=$strCookieStr."=====".$strItemCookie;
				}
				$this->SetCustomerOrderList($strCookieStr);
				//die($strCookieStr);
			}
		}
	}
}
?>