<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
$Customer = new Customer;
$type = $_GET["type"];
if (strlen($type)==0)
	include($type."top_menu.php");
else
	include($type."_top_menu.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr style="padding-left:10px;">
    <td width="20%">会员姓名</td>
    <td width="20%">备注</td>
    <td width="20%" align="center">创建时间</td>
    <td width="40%">&nbsp;</td>
  </tr>
  <?php
$result = $Customer->GetCustomerList(-1, -1, $type);

while($row=mysql_fetch_array($result))
{
?>
  <form action="updateData.php?COM_ID=1002" method="post" style="margin:0px; padding:0px;">
    <tr style="padding-left:10px;">
      <td width="20%"><?php echo $row["T_CUSTOMER_NAME"];?>&nbsp;</td>
      <td width="20%"><?php echo $row["T_MEMO"];?>&nbsp;</td>
      <td width="20%" align="center"><?php echo date("Y-m-d H:i", strtotime($row["T_CREATE_TIME"])); ?></td>
      <td width="40%" align="center"><?php
	$resultTmp = $Customer->GetCustomerModelList($type);
	while($rowTmp=mysql_fetch_array($resultTmp))
	{
		if ($rowTmp["T_HAVE_SUB_ARTICLE"]==1)
		{
			?>
			<a href="indexArticle.php?type=<?php echo $type;?>&articleClassID=<?PHP echo $rowTmp["T_ID"];?>&customerID=<?PHP echo $row["T_ID"];?>&mail=<?PHP echo urlencode($row["T_MAIL"]);?>"><?php echo $rowTmp["T_NAME"];?></a>
			<?php
			echo " | ";
		}
	}
	  ?> <a href="ViewChange.php?type=<?php echo $type;?>&ID=<?PHP echo $row["T_ID"];?>&mail=<?PHP echo urlencode($row["T_MAIL"]);?>">基本信息查看</a> | <a href="updateData.php?COM_ID=1006&id=<?php echo $row["T_ID"];?>">删除</a></td>
    </tr>
  </form>
  <?php
}
?>
  <form action="updateData.php?COM_ID=1001" method="post" style="margin:0px; padding:0px;">
  </form>
</table>
</body>
</html>
