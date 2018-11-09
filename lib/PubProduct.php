<?php
include_once("settings.php");

function GetStyleInfo($styleNum)
{
	if ($styleNum==0)
		return "unsex";
	elseif ($styleNum==1)
		return "Men";
	elseif ($styleNum==2)
		return "Women";
}

class Product
{
	function BatchImportItem($itemList)
	{
		$bIsSucess=TRUE;
		$pru_ItemDetail=$itemList;
		$pru_ItemDetail=trim($pru_ItemDetail);
		if (empty($pru_ItemDetail))
			$need_update=false;
		else
			$need_update=true;
		if ($need_update==true )
		{
			$pru_allInfo=explode("\n", $pru_ItemDetail);
			$nTotal = count($pru_allInfo);
			for ($j=0; $j<$nTotal; $j++)
			{
				if (strlen($pru_allInfo[$j])>5 )
				{
					$pruItemDetail=explode(chr(9),$pru_allInfo[$j]);
					$nItemDetailTotal=count($pruItemDetail);
					$SQL=new SQL;
					$sSql="select * from pru where T_ID='$pruItemDetail[0]';";
					$result = $SQL->Query($sSql);
					if (($row=mysqli_fetch_array($result)))
					{
						echo $pruItemDetail[0]." The ID has been used. pls check this.<br>";
						$bIsSucess=FALSE;
					}
					else
					{
						if ($nItemDetailTotal>=17)
							$pru_KEY_WORD=$pruItemDetail[17];
						else
							$pru_KEY_WORD="";
						$sSql="INSERT INTO pru (T_ID, T_XIJIE_PIC, T_COLOR, T_CAI_LIAO, T_CHILD, T_CLASS, T_SIZE, T_BEIZHU, T_PRICE, T_MIMI_OLDER, T_PAYMENT, T_HOT, T_SIZE_INFO, T_DETAIL_HAVE, T_STYLE_MEN, T_STATUS, IS_VIP, KEY_WORD, T_DENG_JI_TIME, T_JINHUO_PRICE) VALUES('$pruItemDetail[0]', $pruItemDetail[1], '$pruItemDetail[2]', '$pruItemDetail[3]', '$pruItemDetail[4]', '$pruItemDetail[5]', '$pruItemDetail[6]', '$pruItemDetail[7]', '$pruItemDetail[8]', $pruItemDetail[9], '$pruItemDetail[10]', $pruItemDetail[11], '$pruItemDetail[12]', $pruItemDetail[13], $pruItemDetail[14], $pruItemDetail[15], $pruItemDetail[16], '$pru_KEY_WORD', now(), ".(0+(int)$pruItemDetail[18]).");"; 
						$SQL->Query($sSql);
						//echo "$sSql<br>";
					}
				}
			}
		}
		
		return $bIsSucess;
	}
	
	/**
	单独登录新产品
	*/
	function AddSingleItem($pru_id, $pru_size, $pru_child, $pru_class, $pru_sex, $pru_hot, $pru_color, $pru_cai_liao, $pru_is_have_large, $is_vip, $is_avaliable, $pru_payment, $pru_sell_price, $pru_detail_pic, $pru_mini_order, $pru_memo, $pru_buy_price, $userID)
	{
		$fileMainPath = "../".$this->MakeDefaultItemPath($pru_id);
		$pictureList="";
		$bIsNeedUpdateHeadPic=true;	//是否更新1_s  和 head 图片
		$bIsNeedUpdatePic=false;		//是否更新本张图片内容
		$bFirstPicProcessed=true;		//第一张图片是否已经处理
		for ( $i=1; $i<=20; $i++)
		{
			if(isset( $_FILES ) && !empty( $_FILES [ "PicUploadLocalFile$i" ]) && $_FILES [ "PicUploadLocalFile$i" ][ "size" ]> 0 ) 
			{
				$uploadfile = $fileMainPath.$i."_o.jpg";
				if ( copy ( $_FILES["PicUploadLocalFile$i"]["tmp_name"], $uploadfile)) 
					;
				else
					die("上传失败");
			}
			else
				break;
				
			if ($bIsNeedUpdateHeadPic)
			{
				if (file_exists($fileMainPath."head.jpg"))
					unlink($fileMainPath."head.jpg");
				createDstImage($uploadfile, 126, 126, $fileMainPath."head.jpg");
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
		
		$SQL=new SQL;
		$sSql="select * from pru where T_ID='$pru_id';";
		$result = $SQL->Query($sSql);
		if (($row=mysqli_fetch_array($result)))
		{
			die ( $pruItemDetail[0]." The ID has been used. pls check this.<br>" );
			$bIsSucess=FALSE;
		}
		$sSql="INSERT INTO pru (T_ID, T_XIJIE_PIC, T_CHILD, T_CLASS, T_SIZE, T_BEIZHU, T_PRICE, T_HOT, T_STATUS,  T_DENG_JI_TIME, T_USER_ID) VALUES('$pru_id', ".($i-1).", '$pru_child', '$pru_class','$pru_size', '$T_BEIZHU', '$pru_sell_price', ".($pru_hot+0).", ".($is_avaliable+0).", now(), '$userID');"; 
		$SQL->Query($sSql);

		return true;
	}
	
	/**
	使产品上架
	*/
	function SetItemAvaliable($pru_id)
	{
		$SQL=new SQL;
		$result = $SQL->Query("update pru set T_STATUS=0 where T_ID='$pru_id'");
		return true;
	}
	
	/**
	使产品下架
	*/
	function SetItemUnavaliable($pru_id)
	{
		$SQL=new SQL;
		$result = $SQL->Query("update pru set T_STATUS=2 where T_ID='$pru_id'");
		//echo "update $pru_id dont avlialbe<br>";
		//echo "update pru set T_STATUS=1 where T_ID='$pru_id'";
		return true;
	}
	
	/**
	删除产品
	*/
	function DeleteItem($pru_id)
	{
		$SQL=new SQL;
		$result = $SQL->Query("select * from pru where T_ID='$pru_id'");
		if ($row=mysqli_fetch_array($result))
		{
			deldir(GetItemPathInfo($row["T_ID"], $row["Version"]));
			//die(GetItemPathInfo($row["T_ID"], $row["Version"]));
			$SQL->Query("delete from pru where T_ID='$pru_id'");
			echo "Delete item [$pru_id] successful!<br>";
		}
		else
			return true;
	}
	
	/**
	set sell item detail.
	*/
	function SetItemDetailInfo($pru_id, $pru_size, $pru_child, $pru_class, $pru_sex, $pru_hot, $pru_color, $pru_cai_liao, $pru_is_have_large, $is_vip, $is_avaliable, $pru_payment, $pru_sell_price, $pru_detail_pic, $pru_mini_order, $pru_memo, $pru_buy_price, $userID, $pruSizeDanWei)
	{
		
		
		$SQL=new SQL;
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
		T_DETAIL_HAVE = '$pru_is_have_large',
		T_SIZE_DANWEI = '$pruSizeDanWei',
		T_USER_ID = '$userID' WHERE T_ID = '$pru_id' LIMIT 1 ;";
		$result = $SQL->Query($sSql);
		
		//echo $sSql;
		return true;
	}
	
	/**
	make default item path
	*/
	function MakeDefaultItemPath($id)
	{
		$idList = split("-", $id);
		if (!file_exists(APPROOT."images/pru/".$idList[0]))
			mkdir(APPROOT."images/pru/".$idList[0]);
		if (!file_exists(APPROOT."images/pru/".$idList[0]."/".$idList[1]))
			mkdir(APPROOT."images/pru/".$idList[0]."/".$idList[1]);
		return "images/pru/".$idList[0]."/".$idList[1]."/";
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
			$SQL=new SQL;
			$sSql="select * from pru where T_ID='$pru_id'";
			$result = $SQL->Query($sSql);
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
		
		
		$SQL=new SQL;
		$sSql="UPDATE pru SET T_DETAIL_PICTURE = '$pru_picture_list' WHERE T_ID = '$pru_id' ;";
		$result = $SQL->Query($sSql);
		
		//echo $sSql;
		return true;
	}
	
	/**
	select the item
	$userID
	$isAvaliable 0-avaliable 
	$orderBy 0-create time 1-hot
	*/
	function SelectProductList($userID, $isAvaliable, $orderBy)
	{
		
		
		$SQL=new SQL;
		$sSql="select * from pru WHERE T_STATUS=$isAvaliable ";
		if ($userID!="all")
			$sSql=$sSql." and T_USER_ID = '$userID'   ";
		if ($orderBy==0)
			$sSql=$sSql." order by T_DENG_JI_TIME DESC ";
		else
			$sSql=$sSql." order by T_HOT DESC ";
		return $SQL->Query($sSql);
	}
}
?>