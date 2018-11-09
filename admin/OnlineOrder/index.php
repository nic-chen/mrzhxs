<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
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
	padding:0px; margin:0px;
}
img{
	padding:2px; border:solid #999999 1px; width:100px;
}
form input{
	width:200px;
}
-->
</style><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php include("top_menu.php");?>
<table width="100%" border="0" cellspacing="3" cellpadding="1">
  <tr>
    <td width="20%" align="left">提交时间</td>
    <td width="20%" align="left">产品列表</td>
    <td width="30%" align="left">联系信息</td>
    <td width="20%" align="left">备注信息</td>
    <td width="10%" align="center">&nbsp;</td>
  </tr>
  <?PHP
  $OnlineOrder = new OnlineOrder;
  $result = $OnlineOrder->GetOnlineOrderList();
  while($row=mysqli_fetch_array($result))
  {
  ?>
  <tr>
    <td width="20%" align="left"><?php echo date("Y-m-d H:m:i", strtotime($row["T_CREATE_TIME"]));?>&nbsp;</td>
    <td width="20%" align="left"><?php echo date("Y-m-d H:m:i", $row["T_CREATE_TIME"]);?>&nbsp;</td>
    <td width="30%" align="left"><?php
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
								 ?></td>
    <td width="20%" align="left"><?php echo $row["T_MEMO"];?>&nbsp;</td>
    <td width="10%" align="center"><a href="updateData.php?COM_ID=1001&id=<?php echo $row["T_ID"];?>">删除</a> | <a href="ViewChange.php?id=<?php echo $row["T_ID"];?>" target="_blank">查看</a></td>
  </tr>
  <?PHP
  }
  ?>
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="15%" align="left">&nbsp;</td>
    <td width="30%" align="left">&nbsp;</td>
    <td width="20%" align="left">&nbsp;</td>
    <td width="10%">&nbsp;</td>
  </tr>
</table>
</body>
</html>