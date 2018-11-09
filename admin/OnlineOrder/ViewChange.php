<?php
include_once("settings.php");
include(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
form {
	padding:0px; margin:0px; padding-top:20px; padding-bottom:15px; border:solid #0066CC 1px;
}
img{
	padding:2px; border:solid #999999 1px; width:100px;
}
form input{
	width:200px;
}

.viewCartFrame {
	width:90%; margin:0px;overflow:hidden; margin-left:-50px; float:left;
}
.viewCartFrame ul{
	width:90%; overflow:hidden; float:left; text-align:center; padding-top:10px;
}
.viewCartFrame ul #bottom{
	width:90%; overflow:hidden; text-align:center; border-bottom:none; padding-bottom:8px; padding-top:8px; 
}
.viewCartFrame ul #total{
	width:90%; overflow:hidden; text-align:right; border-bottom:none; padding-bottom:0px; padding-top:8px; border-top:double #999999 3px;
}
.viewCartFrame ul #button{
	width:90%; overflow:hidden; text-align:center; border-bottom:none; padding-bottom:0px; padding-top:8px; border-top:double #999999 3px;
}
.viewCartFrame li{
	width:90%; overflow:hidden; text-align:center; border-bottom:double #999999 3px;padding-bottom:8px; padding-top:8px;
}
.viewCartFrame .pictureText{
	width:25%; overflow:hidden;  float:left; 
}
.viewCartFrame .actorText{
	width:10%; overflow:hidden; float:left; 
}
.viewCartFrame .sizeText{
	width:30%; overflow:hidden; float:left;
}
.viewCartFrame .IDText{
	width:15%; overflow:hidden; float:left;
}
.viewCartFrame .priceText{
	width:10%; overflow:hidden; float:left;
}
.viewCartFrame .actionText{
	width:10%; overflow:hidden; float:left;
}
.viewCartFrame .picture{
	width:25%; overflow:hidden;  float:left;
}
.viewCartFrame .picture img{
	width:106px; height:106px; padding:2px; border:solid #999999 1px;
}
.viewCartFrame .actor{
	width:10%; overflow:hidden; float:left; padding-top:35px;
}
.viewCartFrame .size{
	width:30%; overflow:hidden; float:left; padding-top:35px;
}
.viewCartFrame .ID{
	width:15%; overflow:hidden; float:left; padding-top:35px;
}
.viewCartFrame .price{
	width:10%; overflow:hidden; float:left; padding-top:35px;
}
.viewCartFrame .action{
	width:10%; overflow:hidden; float:left; padding-top:35px;
}
-->
</style>
</head>

<body>
<?php
$OnlineOrder = new OnlineOrder;

$result = $OnlineOrder->GetOnlineOrderByID($_GET["id"]);
$row=mysql_fetch_array($result);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" height="25" align="center">订单编号</td>
    <td height="25"><?php echo $row["T_ID"];?>&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="25" align="center">提交时间</td>
    <td height="25"><?php echo $row["T_CREATE_TIME"];?>&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="25" align="center">联系信息</td>
    <td height="25"><?php
								 $contactInfo = "";
								 if (strlen($row["T_NAME"])>0)
								 	$contactInfo = $contactInfo."姓名：".$row["T_NAME"]."<br>";
								 if (strlen($row["T_MOBIL_PHONE"])>0)
								 	$contactInfo = $contactInfo."手机：".$row["T_MOBIL_PHONE"]."<br>";
								 if (strlen($row["T_TEL_PHONE"])>0)
								 	$contactInfo = $contactInfo."电话：".$row["T_TEL_PHONE"]."<br>";
								 if (strlen($row["T_MSN"])>0)
								 	$contactInfo = $contactInfo."MSN：".$row["T_MSN"]."<br>";
								 if (strlen($row["T_MAIL"])>0)
								 	$contactInfo = $contactInfo."MAIL：".$row["T_MAIL"]."<br>";
								 if (strlen($row["T_QQ"])>0)
								 	$contactInfo = $contactInfo."QQ：".$row["T_QQ"]."<br>";
								 if (strlen($row["T_ADDRESS"])>0)
								 	$contactInfo = $contactInfo."地址：".$row["T_ADDRESS"]."<br>";
								 if (strlen($row["T_POST_CODE"])>0)
								 	$contactInfo = $contactInfo."邮编：".$row["T_POST_CODE"];
									
								 echo $contactInfo;
								 ?>&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="25" align="center">其他</td>
    <td height="25"><?php echo $row["T_MEMO"];?>&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center">订购产品</td>
    <td height="25">
	<?php
	$strCookie=$row["T_ITEMLIST"];
	$strItemList=explode("=====",$strCookie);
	$nCount = count($strItemList);
	?>
	<div class="viewCartFrame">
      <ul>
        <?php
	if ($nCount>1)
	{
	?>
        <li><span class="pictureText">商品图片</span><span class="actorText">作者</span><span class="sizeText">尺寸</span><span class="IDText">编号</span><span class="priceText">价格</span></li>
        <?php
	}
	else
		echo "您的购物车里面还没有东西呢！！";
	
	$shizi = "";
	$total = 0;
	
    for ($i=0; $i<$nCount; $i++)
	{
		if (empty($strItemList[$i])==true)
			;
		else
		{
			$strIDItem=explode(" ",$strItemList[$i]);
			$strItemCoolieSI=substr($strItemList[$i], strlen($strIDItem[0])+1,strlen($strItemList[$i]));
			$SQL = new SQL;
			$result_currect = $SQL->Query("select * from pru where T_ID='".$strIDItem[0]."'");
			$row=mysql_fetch_array($result_currect);
			if (strlen($shizi)==0)
				$shizi = $row["T_PRICE"];
			else
				$shizi = $shizi." + ".($row["T_PRICE"]+0);
			$total += $row["T_PRICE"];
			
			$SQL = new SQL;
            $resultTmp = $SQL->Query("select * from registercustomer  where T_ID='".$row["T_USER_ID"]."'");
			$rowUser=mysql_fetch_array($resultTmp);
	?>
        <li <?php if ($i == $nCount-1) echo "id='bottom'";?>><span class="picture"><a href="../../?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>" target="_blank"><img src="../../<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";?>"/></a></span><span class="actor"><?php echo $rowUser["T_CUSTOMER_NAME"];?></span><span class="size"><?php echo $row["T_SIZE"];?></span><span class="ID"><a href="../../?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>" target="_blank"><?php echo $row["T_ID"];?></a></span><span class="price">￥<?php echo $row["T_PRICE"]+0;?></span></li>
        <?php
		}
	}
	if (strlen($shizi) > 0 && strpos($shizi, "+")!=false)
		$shizi = $shizi." = ";
	else
		$shizi = "";
	?>
        <li id="total">金额合计： <?php echo $shizi.$total ;?>￥</li>
      </ul>
    </div></td>
  </tr>
</table>

</body>
</html>
