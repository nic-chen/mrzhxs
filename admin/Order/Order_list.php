<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");

function GetUserType()
{
	$cur_admin = new admin;
	$SQL = new SQL;
	
	if ($cur_admin->GetAdminIfSignIn())
		;
	else
		die ("Pls <a href='../../index.php'>login</a> in at first!");
	

	$row=$cur_admin->GetCurrentAdminDetailInfo();
	if ($row)
	{
		if ($row["T_DENG_JI"]==0)
			return "admin";
		else
			return "seller";
	}
	else
	{
		return "";
	}
}

function GetItemCount($itemList)
{
	$pruList=explode("\n", $itemList);
	return count($pruList);
}
			  
function GetItemInfoByIndex($itemList, $IndexNum, &$id, &$sizeInfo, &$otherInfo) //从0开始寻找
{
	$sizeInfo="";
	$otherInfo="";
	
	$pruList=explode("\r\n", $itemList);
	$nCount = count($pruList);
	if ($nCount<$IndexNum )
	{
		return false;
	}
	else
	{
		if (empty($pruList[$IndexNum]))
			return false;
			
		$itemInfoList=str_replace("\t", " ", $pruList[$IndexNum]);
		$itemInfoList=explode(" ",trim($itemInfoList));
		$nDetailInfoCount= count($itemInfoList);
		
		//$id=$itemInfoList[0];
		for ($j=0; $j<$nDetailInfoCount; $j++)
		{
			if (empty($id))
			{
				$id=$itemInfoList[$j];
				if ($id==" ")
					$id="";
			}
			else
			{
				if (empty($sizeInfo))
				{
					$sizeInfo=$itemInfoList[$j]." ";
					if ($sizeInfo==" ")
						$sizeInfo="";
				}
				else
					$otherInfo=$otherInfo." ".$itemInfoList[$j];
			}
		}
	}
	if (strlen($sizeInfo)==0)
		$sizeInfo="";
	$id=strtoupper($id);
	
	//echo "function GetItemInfoByIndex($itemList, $IndexNum, &$id, &$sizeInfo, &$otherInfo) ";
	
	if (empty($id))
		return false;
	else
		return true;
}

$strCreateDate=$_GET["DATE"];
$strCreateSer=$_GET["SER"];

$SQL = new SQL;
$cur_admin = new admin;

$result = $SQL->Query("select * from OFFER_ALL_USER where T_DATE='$strCreateDate' and T_SER='$strCreateSer';");
$rowOrder=mysqli_fetch_array($result);
if (!$rowOrder)
	$rowOrder=array();

$tttype=$_GET["type"]."";

$bPaymentInfo="".$_POST["Payment_Info"];
//echo $bPaymentInfo;

if (empty($tttype))
	$tttype="";
else
{
	if (empty($bPaymentInfo))
	{
		if ($tttype=="price_payment")
			$bPaymentInfo=true;
		else
			$bPaymentInfo=false;
	}
	elseif ($bPaymentInfo==true)
		$bPaymentInfo=true;
	else
		$bPaymentInfo=false;
}

$userType=$_POST["userType"];
if (empty($userType))
	;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
function FormatList() {	
    var str="";

	str=str+document.itemListForm.itemListF.value;
	if (str.length>0)
	{
		return true;
	}
	else
	{
		alert("请输入要查询的产品列表！");
		return false;
	}
}
</script>
<title>item list detail</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	font-family:Arial, Helvetica, sans-serif;
}
a:link {
	text-decoration: none;
	color: #0000FF;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #669B31;
}
a:active {
	text-decoration: none;
	color: #669B31;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr>
    <td height="58" align="center" valign="top"><form action="" method="post" enctype="multipart/form-data" name="itemListForm" style="margin:0px;padding:0px" onSubmit="return(FormatList());">
          <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
            <?php
	if ( GetUserType()!="FALSE" )
	{
			  ?><tr bgcolor="#C2DC71">
              <td width="20%" height="20" align="left" bgcolor="#C2DC71">Order list :</td>
              <td colspan="2" align="left" valign="bottom" bgcolor="#C2DC71"><textarea name="itemListF" cols="60" rows="10" wrap="VIRTUAL" id="itemListF"><?php echo $_POST["itemListF"].$rowOrder["T_DINGDAN_MINGXI"];?></textarea></td>
          </tr>
            <tr bgcolor="#C2DC71">
              <td width="20%" height="20" align="left" bgcolor="#C2DC71">Option</td>
              <td colspan="2" align="left" valign="bottom" bgcolor="#C2DC71"><input name="KEY_WORD" type="text" size="60">
                搜索条件&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="search" type="submit" id="search4" value="Get Detail"></td>
            </tr>
			<?php
	}
			?>
			<tr bgcolor="#C2DC71">
			  <td height="10" colspan="3" align="left" bgcolor="#ddebaf"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="12%" align="center" bgcolor="#99CC00">海通</td>
                  <td width="12%" align="center" bgcolor="#CC99FF">静斐</td>
                  <td width="12%" align="center" bgcolor="#FFFF99">高伟</td>
                  <td width="12%" align="center" bgcolor="#FFCC99">小波</td>
                  <td width="12%" align="center" bgcolor="#CCFFFF">自己</td>
                  <td width="12%" align="center" bgcolor="#DDEBAF">？</td>
                  <td width="12%" align="center" bgcolor="#DDEBAF">？</td>
                  <td width="12%" align="center" bgcolor="#DDEBAF"><p>？</p>                  </td>
                </tr>

              </table></td>
		    </tr>
		    <tr bgcolor="#C2DC71">
              <td width="20%" height="20" align="left" bgcolor="#C2DC71">Memo</td>
              <td width="50%" bgcolor="#C2DC71">Main Info </td>
              <td width="30%" align="center" bgcolor="#C2DC71">&nbsp;</td>
		    </tr>

            <?php
				$itemList=$_POST["itemListF"];
			    $itemList=str_replace("\t", " ", $itemList);
				$pru_key_fenge = explode(' ', $_POST["KEY_WORD"]);  /* split into parts*/
				$sKeySql="";
				foreach ($pru_key_fenge as $word)
				{
					$sKeySql=$sKeySql." (CONCAT_WS('',T_DATE, T_SER, ' ', T_USER_NAME, ' ', T_MAIL, ' ', T_JIAOYI_MONEY, ' ', T_CUS_ADDRESS, ' ', T_DINGDAN_MINGXI, ' ', T_CREATE_BEIZHU, ' ', T_PAY_CODE, ' ', T_YUNDAN_NUM, ' ', T_YUNDAN_COM, ' ', T_YUNDAN_BEIZHU, ' ', T_SUB_ORDER_ID, ' ') like '%".$word."%')";
				}
			  
				for ($i=0; $i<GetItemCount($itemList); $i++)
				{
					
					$color=$address=$mail=$trackNO=$paymentID=$sellMoney=$subOrderID=$mainOrderID=$memo_1=$id=$memo_2="";
					$date=$ser="";
					$step=0;
					
					$color="#000000";

					$bRes=GetItemInfoByIndex($itemList, $i, $id, $memo_1, $memo_2);
					if ($bRes==false or substr($id, 0, 1)=="-")
						;
					else
					{
						$sSql="select * from OFFER_ALL_USER where (CONCAT_WS('',T_DATE, T_SER, ' ', T_USER_NAME, ' ', T_MAIL, ' ', T_JIAOYI_MONEY, ' ', T_CUS_ADDRESS, ' ', T_DINGDAN_MINGXI, ' ', T_CREATE_BEIZHU, ' ', T_PAY_CODE, ' ', T_YUNDAN_NUM, ' ', T_YUNDAN_COM, ' ', T_YUNDAN_BEIZHU, ' ', T_SUB_ORDER_ID, ' ') like '%".$id."%') AND T_URL='".GetCurrentWebHost()."' AND ".$sKeySql;
						include(APPROOT."dbCfg.php");
						$result = $SQL->Query($sSql);
						$row=mysqli_fetch_array($result);
						
						if (!$row || 1!=mysqli_num_rows($result))
						{//dont find the correct order
							continue;
						}
						else
						{//find the order.
							$memoInfo=$memo_1;
							if (strlen($memo_1)>0)
								$memoInfo=$memoInfo." ";
							$memoInfo=$memoInfo.$memo_2;
							if (strlen($memoInfo)>0)
								$memoInfo=$memoInfo."\r\n";
							$memoInfo=$memoInfo.$row["T_CREATE_BEIZHU"];
							$mainOrderID=$row["T_DATE"].$row["T_SER"];
							$date=$row["T_DATE"];
							$ser=$row["T_SER"];
							$step=$row["T_STEP"];
							$subOrderID=$row["T_SUB_ORDER_ID"];
							$sellMoney=$row["T_JIAOYI_MONEY"];
							$paymentID=$row["T_PAY_CODE"];
							$trackNO=$row["T_YUNDAN_BEIZHU"];
							if (strlen($row["T_YUNDAN_COM"])>0)
								$trackNO=$row["T_YUNDAN_COM"]."\r\n".$trackNO;
							$mail=$row["T_MAIL"];
							$address=$row["T_CUS_ADDRESS"];
							
							if ($mail=="pumulu@gmail.com")
								$color="#99CC00";
							else if ($mail=="apple.rhiannon@gmail.com")
								$color="#CC99FF";
							else if ($mail=="safariv@gmail.com")
								$color="#FFFF99";
							else if ($mail=="selanter@gmail.com")
								$color="#FFCC99";
							else 
								$color="#CCFFFF";
						}
			?>
            <tr bgcolor="#C2DC71">
              <td width="20%" rowspan="3" bgcolor="<?php echo $color;?>"><?php echo str_replace("\r\n", "<br>", $memoInfo);?>&nbsp;</td>
              <td width="50%" align="left" bgcolor="<?php echo $color;?>"><a href="view_change.php?DATE=<?php echo $date;?>&SER=<?php echo $ser;?>&STEP=<?php echo $step;?>">Order ID: [<?php echo $mainOrderID;?>] <?php if (strlen($subOrderID)>0) echo "Sub ID: [$subOrderID]";?></a></td>
              <td width="30%" height="9" align="left" valign="bottom" bgcolor="<?php echo $color;?>">Mail: <?php echo $mail;?></td>
            </tr>
            <tr bgcolor="#C2DC71">
              <td width="50%" height="10" align="left" bgcolor="<?php echo $color;?>">Money: <b><?php echo $sellMoney;?></b></td>
              <td width="30%" height="10" align="left" bgcolor="<?php echo $color;?>">Payment ID: <?php echo $paymentID;?></td>
            </tr>
            <tr bgcolor="#C2DC71">
              <td width="50%" align="left" bgcolor="<?php echo $color;?>">--------------------<br>
                <?php echo str_replace("\r\n", "<br>",$address);?><br>
              --------------------</td>
              <td width="30%" height="10" align="left" valign="bottom" bgcolor="<?php echo $color;?>">TRACKING NO<BR>--------------------<br>
                <?php if (strlen($trackNO)>0)
						echo str_replace("\r\n", "<br>",$trackNO);
					  else
					  	echo "NO TRACKING NUMBER!";?><br>
--------------------</td>
            </tr>
            
            <?php
					}
			}
			?>
        </table>
        </form>        </td>
  </tr>
</table>
</body>
</html>
