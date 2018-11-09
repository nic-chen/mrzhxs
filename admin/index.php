<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php
include_once("settings.php");
include_once(LIBPATH."lib.php");

$webConfig = new WebConfig;
$cart = new cart();

echo $webConfig->webNAME;
?></title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td align="center" valign="top"><form name="lrForm" method="post" action="updateData.php?COM_ID=1005">
      <table width="252" height="35"  border="0">
        <tr>
          <td colspan="2">Input your login info </td>
          </tr>
        <tr>
          <td height="1" colspan="2" bgcolor="#0000CC"></td>
          </tr>
        <tr align=left>
          <td width="84">User Name: </td>
          <td><input type="text" name="userName"></td>
          </tr>
        <tr align=left>
          <td>Pwd:</td>
          <td><input type="password" name="userPwd"></td>
          </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="Submit" value="Submit">&nbsp;&nbsp;</td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
