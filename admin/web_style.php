<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<title>无标题文档</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
body {
	background-color: #FAFAFA;
}
-->
</style></head>

<body>
<? include("web_conn_menu.php"); ?>
<?php
	include_once("../dbCfg.php");
	$result = mysql_query("select * from t_web_conn ",$pingoDateBase);
	$nPruNum = mysql_numrows($result);
	if ($nPruNum==0)
	{
		$web_url="";
		$web_subject="";
	}
	else
	{
		$row=mysql_fetch_array($result);
		$web_url=$row["T_URL"];
		$web_subject=$row["T_WEB_NAME"];
		$web_creat_time=$row["T_CREATE_TIME"];
		$web_YouJu_IP=$row["T_YOUJU_IP_ADD"];
		$web_DuanKou_YouJu=$row["T_YOUJU_DUANKOU"];
		$web_welcome_text=$row["T_WELCOME_TEXT"];
	}
?>
<form id="form1" name="form1" method="post" action="updateData.php?COM_ID=1001">
  <table width="600" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td align="right">Main Logo</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Mini Logo </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Detail Pic Logo </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Style CSS</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="142" align="right">Domain：</td>
      <td width="445"><input type="text" name="web_url" value="<?php
	  echo $web_url;
	  ?>" />
        eg：www.paiple.com</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="submit" />
      &nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="Submit2" value="reset" /></td>
    </tr>
  </table>
</form>
</body>
</html>
