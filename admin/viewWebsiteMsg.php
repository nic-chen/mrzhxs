<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站留言</title>
</head>

<body>
<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");

include("MessageTopBar.php");

  	$SQL = new SQL;
	$msg_id=$_GET["ID"];
	$result = $SQL->Query("select * from customerleavemsg where T_INDEX='$msg_id' ");
	
	while(($row=mysqli_fetch_array($result)))
	{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="20" valign="middle">联系人</td>
    <td width="90%" height="20"><?php echo $row["T_CUSTOMER_NIKI_NAME"];?></td>
  </tr>
  <tr>
    <td width="10%" height="20" valign="middle">联系方式</td>
    <td width="90%" height="20"><?php echo $row["T_CUSTOMER_MAIL"];?></td>
  </tr>
  <tr>
    <td width="10%" height="20" valign="top">留言内容</td>
    <td width="90%" height="20"><?php echo $row["T_MSG"];?></td>
  </tr>
  <tr>
    <td width="10%" height="20" valign="top">链接地址</td>
    <td width="90%" height="20">http://www.<?php echo $row["T_URL"];?></td>
  </tr>
</table>
<?php
	}
?>
</body>
</html>
