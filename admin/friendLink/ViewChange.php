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
-->
</style>
</head>

<body>
<?php
$FrendLink = new FrendLink;
include("top_menu.php"); 

$result = $FrendLink->GetFrendLinkByID($_GET["ID"]);
$row=mysql_fetch_array($result);
?>

<form action="updateData.php?COM_ID=1009" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" height="25" align="center">文字</td>
    <td height="25"><input type="text" name="text" value="<?php echo $row["T_TEXT"];?>"/></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center">链接地址</td>
    <td height="25"><input type="text" name="url" value="<?php echo $row["URL"];?>"/></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center">备注</td>
    <td height="25"><input type="text" name="memo"  value="<?php echo $row["T_MEMO"];?>" /></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center">排序</td>
    <td height="25"><input type="text" name="order"  value="<?php echo $row["T_ORDER"];?>" /></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td width="80%" height="25"><input type="submit" value="提交更改">
      <input type="hidden" name="id" value="<?php echo $row["T_ID"];?>" /></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
