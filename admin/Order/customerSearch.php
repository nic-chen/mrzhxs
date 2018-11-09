<?php
require_once('settings.php');

include_once(APPROOT."admin/PubAdminUserFun.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="daohang_manage.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body><?php
include("manageOrderDH.php");
?>
<table width="735" height="585" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr>
    <td height="2" align="center" valign="top"><?php include("menu.php"); ?></td>
  </tr>
  <tr>
    <td height="585" align="center" valign="top"><br><br><table width="720" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
      <tr>
        <td align="left" bgcolor="#669B31">Mail List </td>
      </tr>
      <tr>
        <td align="left" bgcolor="#C2DC71"><?php
			$adminInfo[]=array();
			GetAdminDetailInfo(GetAdminSignInName(), $adminInfo);
			
			$action=$_GET["type"];
			
			$sSql="select DISTINCT T_MAIL from OFFER_ALL_USER WHERE T_USER_MANAGE=$adminInfo[10] ";
			if ($action=="all")
				;
			elseif ($action=="ordered")
				$sSql=$sSql." AND T_STEP=5 ";
			//
			include(APPROOT."/dbCfg.php");
			$result = mysql_query($sSql."order by T_DATE;",$pingoDateBase);
			
			while(($row=mysql_fetch_array($result)))
			{
				echo $row["T_MAIL"]."<br>";
			}
		?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
