<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");

$cur_admin = new admin;
$SQL = new SQL;

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

$strCreateDate=$_GET["DATE"];
$strCreateSer=$_GET["SER"];

$result = $SQL->Query("select * from OFFER_ALL_USER where T_DATE='$strCreateDate' and T_SER='$strCreateSer';");
$rowOrder=mysql_fetch_array($result);
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
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
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
<table width="774" border="0" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr>
    <td width="12" background="../../<?php echo GetCurrentWebHost(); ?>/pub/board_left.bmp"></td>
    <td height="58" align="center" valign="top"><form name="itemListForm" method="post" onSubmit="return(FormatList());" style="margin:0px;padding:0px" action="updateData.php?COM_ID=2010">
          <table width="750" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
            <?php
	if ( GetUserType()!="FALSE" )
	{
			  ?><tr bgcolor="#C2DC71">
              <td height="20" align="left" bgcolor="#C2DC71">Item list :</td>
              <td colspan="4" align="left" valign="bottom" bgcolor="#C2DC71"><textarea name="itemListF" cols="60" rows="10" wrap="VIRTUAL" id="itemListF"><?php echo $_POST["itemListF"].$rowOrder["T_DINGDAN_MINGXI"];?></textarea></td>
          </tr>
            <tr bgcolor="#C2DC71">
              <td height="20" align="left" bgcolor="#C2DC71">Opetion</td>
              <td colspan="4" align="left" valign="bottom" bgcolor="#C2DC71"><?php
			  if (GetUserType()!="FALSE")
			  {
			  ?>
			  <input name="Payment_Info" type="checkbox" id="Payment_Info" value=true <?php
				  if ($bPaymentInfo==true)
					echo "checked";
			  ?>>Payment Info
			  <?php
				  if ( GetUserType()=="admin" )
				  {
				  ?>
					<input name="Buy_Price" type="checkbox" id="Buy_Price" value=true <?php
				  if ($_POST["Buy_Price"]==true || $tttype=="price" || $tttype=="price_payment")
					echo "checked";
				  ?>>Buy_Price <input name="CanChange" type="checkbox" id="CanChange" value=true <?php
				  if ($_POST["CanChange"]==true || $tttype=="price" || $tttype=="price_payment")
					echo "checked";
				  ?>>Allow Change 
				  <?php
				  }
			  ?>
					<input name="Sell_Price" type="checkbox" id="Sell_Price" value=true <?php
				  if ($_POST["Sell_Price"]==true || $tttype=="price" || $tttype=="price_payment" )
					echo "checked";
				  ?>>Sell_Price
			  <input name="Add_Price" type="checkbox" id="Add_Price" value=true <?php
			  if ($_POST["Add_Price"]==true || $tttype=="price" || $tttype=="price_payment")
			  	echo "checked";
			  ?>>
			  Add_Price 
			  <?php
			  }
			  ?></td>
            </tr>
            <tr bgcolor="#C2DC71">
              <td width="140" height="20" align="left" bgcolor="#C2DC71">Other importance info: </td>
              <td colspan="4" align="left" valign="bottom" bgcolor="#C2DC71">
              <textarea name="cOtherInfo" cols="60" rows="5" wrap="VIRTUAL" id="cOtherInfo"><?php 
			  if ($tttype=="price")
			  	;
			  else if ($tttype=="price_payment")
			  {
			  	echo stripslashes("total: *** usd shipped.
total for paypal: *** usd shipped.

for the paypal, pls add the shipping address in your payment and pls dont write any brand name in your payment. if you need invoice, tell us your paypal address, we'll send you the invoice. many thanks. 

if you have any questions, pls let me know. reply to you asap. 
thanks and greeting from ".GetWebNikiName().".");
			  }
			  else if ($tttype=="user_confirm")
			  {
				echo stripslashes("ORDER ID --- [<b>".$rowOrder["T_DATE"].$rowOrder["T_SER"]."</b>]\n\nwe got your payment and have arranged to prepare the items for you. \nPls confirm the shipping address we'll send to:\n--------------------\n".$rowOrder["T_CUS_ADDRESS"]."\n--------------------\n\nFor any questions, pls let me know. reply you soon.\n\nThanks and greeting from ".GetWebNikiName()."");
			  }
			  else if ($tttype=="Out_of_stock")
			  {
			  	$strInfo="Order ID --- [<b>".$rowOrder["T_DATE"].$rowOrder["T_SER"]."</b>]\r\n";
				if (strlen($rowOrder["T_SUB_ORDER_ID"])>0)
					$strInfo=$strInfo."Sub order ID --- [<b>".$rowOrder["T_SUB_ORDER_ID"]."</b>]\r\n";
				$strInfo=$strInfo."Payment ID: ".$rowOrder["T_PAY_CODE"]."\r\n\r\n";
				$strInfo=$strInfo."the shipping address:\r\n--------------------\r\n".$rowOrder["T_CUS_ADDRESS"]."\r\n--------------------\r\n\r\n";
				$strInfo=$strInfo."We cant get all of items on this order.\r\nPls change the item to other size or style. \r\n\r\nFor any questions, pls let me know. reply you soon.\n\nThanks and greeting from ".GetWebNikiName()."";
				echo stripslashes($strInfo);
			  }
			  else
			  	echo stripslashes($_POST["cOtherInfo"]);
			  ?></textarea>
			  <input name="search" type="submit" id="search4" value="Get Detail"></td>
            </tr>
			<?php
	}
			if ($bPaymentInfo==true)
			{
			?>
			<tr bgcolor="#C2DC71">
			  <td height="80" align="left" bgcolor="#C2DC71">Payment_Info</td>
			  <td height="80" align="left" valign="middle" bgcolor="#C2DC71">&nbsp;Western union || moneygram: <br>
  &nbsp;First name:<strong>YuanSheng</strong><br>
  &nbsp;Last name: <b>Wang</b><br>
  &nbsp;City: <b>HeBei province</b><br>
  &nbsp;Country: <b>China</b></td>
			  <td height="80" colspan="3" align="left" valign="middle" bgcolor="#C2DC71">&nbsp;Paypal info: <br>
  &nbsp;<b><?php
  	
	
	$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentWebHost()."'",$pingoDateBase);
	if ($row=mysql_fetch_array($result))
	{
		echo $row["T_PAYPAL_ACCOUNT"];
	}
  ?></b><br>
  &nbsp;HaiTao Liu (add 5% paypal fee) </td>
		    </tr>
			<?php
			}
			?>
			<tr bgcolor="#C2DC71">
			  <td height="10" colspan="5" align="left" bgcolor="#ddebaf"><?php
			  if ($tttype=="3" || $tttype=="4" )
			  	echo stripslashes("ORDER ID --- [<b>".$_POST["orderID"]."</b>]<br><br>We got your payment. Pls confirm the shipping address we'll send to:<br>--------------------<br>".str_replace("\n", "<br>", $_POST["userAddress"])."<br>--------------------<br><br>For any questions, pls let me know. reply you soon.<br><br>Thanks and greeting from pingo.");
				
			  else
			  {
				  $itemOtherImportandInfo=$_POST["otherInfo"].$_POST["cOtherInfo"];
				  $itemOtherImportandInfo=str_replace("\n", "<br>",$itemOtherImportandInfo);
				  echo stripslashes("<br>".$itemOtherImportandInfo."<br>&nbsp;");
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
		$sizeInfo="_";
	$id=strtoupper($id);
	if (empty($id))
		return false;
	else
		return true;
}
			  
			  $info="";
			  $itemList=$_POST["itemListF"];
			  $itemList=str_replace("\t", " ", $itemList);
			  for ($i=0; $i<GetItemCount($itemList); $i++)
			  {
				$sizeInfo=$id=$otherInfo="";
			  	$bRes=GetItemInfoByIndex ($itemList, $i, $id, $sizeInfo, $otherInfo);
				if ($bRes==true && strlen(trim($id))>0)
				{
					$sizeInfo=str_replace("_", "<font color=\"#005CB9\">_</font>", $sizeInfo );
					
					$sSql="select * from pru where T_ID='".$id."';";
				    
				    $result = $SQL->Query($sSql);
				    $row=mysql_fetch_array($result);
					
					if (!$row)
						$pruSellPrice="";
					else
					{
						if ($row["T_STATUS"]==0)
							$pruSellPrice=$row["T_PRICE"]."usd/pc shipped. ";
						else
							$pruSellPrice=" Cant get it. ";
					}
					if ("-"==substr($id, 0, 1))
						$info=$info."<br> <font color=\"#FFFFFF\">".$id." ".$sizeInfo."  ".$otherInfo." </font>";
					elseif ( $_POST["Add_Price"]==true )
						$info=$info."<br> ".$id." <font color=\"#005CB9\">".$sizeInfo."</font> <font color=\"#663333\"><b>".$pruSellPrice.$otherInfo."</b></font>";
					else
						$info=$info."<br> ".$id." <font color=\"#005CB9\">".$sizeInfo."</font> <font color=\"#663333\"><b>".$otherInfo."</b></font>";
				}
			  }

			  echo "<br><font color=\"#000000\">------------------<BR>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIZE*NUM&nbsp;&nbsp; PRICE AND OTHER ".$info."<br>------------------</font>";
			  ?>
			  <br><br>View the detail info online, please click the URL blow:<br><a href="http://<?php echo GetCurrentWebHost(); 
			  //echo substr($_SERVER["PHP_SELF"], 0, strrpos($_SERVER["PHP_SELF"], "/")+1 );  
			  echo "/";?>?p=viewOrder&T_ID=<?php echo $_POST["recordNum"];?>" target="_blank">http://<?php echo GetCurrentWebHost(); 
			  //echo substr($_SERVER["PHP_SELF"], 0, strrpos($_SERVER["PHP_SELF"], "/")+1 );  
			  echo "/";?>?p=viewOrder&T_ID=<?php echo $_POST["recordNum"];?></a></td>
		    </tr>
		    <tr bgcolor="#C2DC71">
              <td height="20" align="left" bgcolor="#C2DC71">ID&nbsp;&nbsp;</td>
              <td bgcolor="#C2DC71">info</td>
              <td colspan="3" align="center" bgcolor="#C2DC71">Pic and other info </td>
		    </tr>

            <?php
				$rootDetailInfo=array();
				$cur_admin->GetAdminDetailInfo( GetCurrentWebHost(), $rootDetailInfo);
				$urlHead="http://".GetCurrentWebHost()."/";
				$picUrlHead="http://".GetCurrentWebHost()."/";
				
				for ($i=0; $i<GetItemCount($itemList); $i++)
				{
					$otherInfo="";
					$sizeInfo="";
					$avaliable=0;
				
					$sizeInfo=$id=$otherInfo="";
					$bRes=GetItemInfoByIndex($itemList, $i, $id, $sizeInfo, $otherInfo);
					if ($bRes==false or substr($id, 0, 1)=="-")
						;
					else
					{
						$sSql="select * from pru where T_ID='".$id."'";
						
						$result = $SQL->Query($sSql);
						$row=mysql_fetch_array($result);
						
						if (!$row)
						{
							$headPath=$urlHead."images/pingoTree.jpg";
							if (empty($id))
								$id="NULL";
							if (empty($sizeInfo))
								$sizeInfo="NULL";
							$pruBrand="NULL";
							$itemSexStyle="NULL";
							$avaliable=0;
							$pruSellPrice="0";
						}
						else
						{
							$id=$row["T_ID"];
							if ( $row["Version"]==1 )
							{
								$strTemppp=explode("-", $id);
								$headPath=$picUrlHead."images/pru/".trim($strTemppp[0])."/".trim($strTemppp[1])."/head.jpg";
							}
							else
								$headPath=$picUrlHead."images/pru/".$id."/head.jpg";

							$itemSexStyle=GetStyleInfo($row["T_STYLE_MEN"]);
							$pruSize=$row["T_SIZE"];
							$pruBrand=$row["T_CHILD"];
							$avaliable=$row["T_STATUS"];
							$pruJinHuoPrice=$row["T_JINHUO_PRICE"];
							if ($row["T_STATUS"]==0)
								$pruSellPrice=$row["T_PRICE"]."usd/pc shipped. ";
							else
								$pruSellPrice=" Cant get it. ";
						}
						
						$sizeInfo=str_replace("_", "<font color=\"#C2DC71\">_</font>", $sizeInfo);
			?>
            <tr bgcolor="#C2DC71">
              <td rowspan="2" bgcolor="#CCCCCC">
			  <font color="#000000"><?php echo $id;?></font></td>
              <td width="223" rowspan="2" align="left" bgcolor="#CCCCCC"><?php 
			  if ($_POST["Add_Price"]==true )
			  	echo $sizeInfo."<br><font color=\"#660033\"><B>".$pruSellPrice.$otherInfo."</B></font>";
			  else
			  	echo $sizeInfo."<br><font color=\"#660033\"><B>".$otherInfo."</B></font>";
			  ?></td>
              <td width="94" rowspan="2" align="left" valign="bottom" bgcolor="#CCCCCC">
			  <img src="<?php echo $headPath;?>" border="0"></td>
              <td height="90" colspan="2" align="left" valign="bottom" bgcolor="#CCCCCC"><?php
			  if (GetUserType()!="FALSE")
			  {
			  	  if (GetUserType()=="admin" && $_POST["CanChange"]==true )
					echo "<a href=\"../EditItem.php?ID=".$id."\"  target=\"_blank\">Change</a><br>";
				  if ($_POST["Buy_Price"]==true )
					echo "".$pruJinHuoPrice."<br>";
				  if ($_POST["Sell_Price"]==true )
					echo "Sell_Price: ".$row["T_PRICE"]."$<br>";
			  }
			  ?>Brand:<b><?php echo $pruBrand;?></b><br>Style:<b><?php echo $itemSexStyle;?></b><br></td>
            </tr>
            
            <tr bgcolor="#C2DC71">
              <td width="206" height="20" align="left" bgcolor="#CCCCCC" <?php
			  if ($avaliable==0)
			  	echo "colspan=\"2\"";
			  ?>>
			  <a href="<?php 
			  if (strlen($id)<4) 
			  	echo "stock_item.php";
			  else
			  	echo $urlHead."?p=ItemDetail&T_ID=".$id;
			  ?>" target="_blank"> View detail</a>
&nbsp;</td>
              <?php
			  if ($avaliable!=0)
			  {
			  ?>
			  <td width="81" height="20" align="center" bgcolor="#CCCCCC"><font color="#FFFFFF">Dont have</font></td>
			  <?php
			  }
			  ?>
            </tr>
            <?php
					}
			}
			?>
        </table>
        </form>        </td>
    <td width="12" background="../../<?php echo GetCurrentWebHost(); ?>/pub/board_right.bmp"></td>
  </tr>
</table>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="right" bgcolor="#666666">
    <td width="774" height="10"><span class="style11">All Content Copyright ? 2006 <?php echo GetCurrentWebHost(); ?>, Inc. </span></td>
  </tr>
</table>
</body>
</html>
