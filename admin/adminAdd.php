<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
body {
	background-color: #FAFAFA;
	font-family:Arial, Helvetica, sans-serif;
}
body,td,th {
	font-size: 12px;
}
.style1 {color: #FFFFFF}
-->
</style></head>

<body>
<?php
$thisPage=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF'])-strrpos($_SERVER['PHP_SELF'], '/')-1);

$nStep=$_GET["step"];
$strSearchWord=$_GET["key"];
?>
<? include("admin_top_menu.php"); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
  <tr>
    <td height="25" colspan="2" bgcolor="#669B31" class="style1">Add  admin</td>
  </tr>
  <form action="updateData.php?COM_ID=1015" method="post">
  <tr bgcolor="#C2DC71">
    <td width="19%" height="35" align="right" bgcolor="#C2DC71" class="style1">Login Name :</td>
    <td width="81%" height="35" bgcolor="#C2DC71"><input name="T_NAME" type="text"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Login Password :</td>
    <td height="35" bgcolor="#C2DC71"><input type="text" name="T_PWD"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Level:</td>
    <td height="35" bgcolor="#C2DC71">
      <select name="T_DENG_JI">
        <option value="0" selected="selected">Admin</option>
        <option value="1">Seller</option>
      </select>
      </td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Memo::</td>
    <td height="35" bgcolor="#C2DC71"><input type="text" name="T_MEMO" /></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Sign Info: :</td>
    <td height="35" bgcolor="#C2DC71">
      <textarea name="T_QIAN_MING" cols="50" rows="5"></textarea></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="25" align="right" valign="top" class="style1">Reply message:</td>
    <td height="25"><input type="text" name="textfield6"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Mail address: </td>
    <td height="35" align="left" bgcolor="#C2DC71"><input type="text" name="T_USER_MAIL_ADD"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Mail password: </td>
    <td height="35" align="left" bgcolor="#C2DC71"><input type="text" name="T_USER_MAIL_PWD"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Manage domain </td>
    <td height="35" align="left" bgcolor="#C2DC71"><input type="text" name="T_USER_WEBSITE"/>
    you domain you told to your customs. eg: ****.com</td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Nika name </td>
    <td height="35" align="left" bgcolor="#C2DC71"><input type="text" name="T_USER_NI_CHENG"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Mail server IP address </td>
    <td height="35" align="left" bgcolor="#C2DC71"><input type="text" name="T_YOUJU_IP_ADD"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Mail server Port: </td>
    <td height="35" align="left" bgcolor="#C2DC71"><input type="text" name="T_YOUJU_DUANKOU"/></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">Domain</td>
    <td height="35" align="left" bgcolor="#C2DC71"><input type="text" name="T_DOMAIN"/>
    the domain you use login in your admin account. eg: ****.com</td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" colspan="2" align="center" bgcolor="#C2DC71"><input type="submit" name="Submit" value="Add new admin" /></td>
  </tr>
 </form>
</table>
</body>
</html>
