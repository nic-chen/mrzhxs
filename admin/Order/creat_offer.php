<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="daohang_manage.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
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
-->
</style></head>

<body><?php
include("manageOrderDH.php");
require_once('settings.php');

$order_date=$_GET["DATE"];
$order_ser=$_GET["SER"];
$name="???";
$mail="???";
$address="None";

if (strlen($order_date)>0 && strlen($order_ser)>0)
{
	include(APPROOT."/dbCfg.php");
	$sql="select * from OFFER_ALL_USER where CONCAT_WS('', T_DATE, T_SER)='".$order_date.$order_ser."';";
	$result = mysql_query($sql,$allDateBase);
	if (1==mysql_numrows($result))
	{
		$row=mysql_fetch_array($result);
		$name=$row["T_USER_NAME"];
		$mail=$row["T_MAIL"];
		$address=$row["T_CUS_ADDRESS"];
	}
}
?>
<table width="737" height="585" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr>
    <td height="58" align="center" valign="top">
        <form id="lrFrom" name="lrFrom" method="post" action="updateData.php?COM_ID=2001" onsubmit="return(showthis());">
          <table width="90%" height="154" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr align="left" valign="middle">
              <td height="22" align="left">Mail:</td>
              <td height="22" colspan="3"><input name="cMail" type="text" value="<?php echo $mail;?>" size="50" />                <input type="hidden" name="needUpdateText" value="needUpdateInfo,1"/></td>
            </tr>
            <tr align="left" valign="middle">
              <td height="22" align="left">Name：</td>
              <td width="37%" height="22"><input name="cName" type="text" value="<?PHP  echo $name;?>"/></td>
              <td width="8%">Sub ID: </td>
              <td width="46%"><input name="cSubID" type="text"/></td>
            </tr>
            <tr align="left" valign="middle">
              <td height="22" align="left"><label>Payment： </label></td>
              <td height="22"><select name="select2">
                  <option value="paypal">Paypal</option>
                  <option value="Bank transfer" >Bank transfer</option>
                  <option value="moneybooker" >moneybooker</option>
                  <option value="moneygram" >moneygram</option>
                  <option value="western union" >western union</option>
                  <option value="other" >other</option>
              </select></td>
              <td><label>Amount </label></td>
              <td><input name="cMoney" type="text" value="0" />
                  <select name="select">
                    <option value="USD">USD</option>
                    <option value="CAD">CAD</option>
                    <option value="URO">URO</option>
                    <option value="RMB">RMB</option>
                    <option value="其他">Other</option>
                </select></td>
            </tr>
            <tr align="left" valign="middle">
              <td height="22" align="left">Address：</td>
              <td height="22" colspan="3" align="left"><textarea name="cAddress" cols="60" rows="6"><?php echo $address;?></textarea></td>
            </tr>
            <tr valign="top">
              <td width="9%" height="22" align="left" valign="middle"><p>Item List: </p></td>
              <td height="22" colspan="3" align="left" valign="middle"><label> </label>
                  <label>
                  <textarea name="orderList" cols="60" rows="6">None</textarea>
                </label></td>
            </tr>
            <tr valign="top">
              <td width="9%" height="22" align="left" valign="middle"><p>Memo</p></td>
              <td height="22" colspan="3" align="left" valign="middle"><label>
                <textarea name="cOtherInfo" cols="60" rows="6">none</textarea>
              </label></td>
            </tr>
            <tr align="left" valign="middle">
              <td height="22">&nbsp;</td>
              <td height="22" colspan="3" align="right"><input type="submit" name="Submit" value="Submit" />
                &nbsp;&nbsp;</td>
            </tr>
          </table>
        </form></td>
  </tr>
</table>
</body>
</html>
