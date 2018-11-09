<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
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
<?php
	include_once('settings.php');
	include_once(LIBPATH."lib.php");
	
	include("web_conn_menu.php");
	
	$SQL=new SQL;
	$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentWebHost()."'");
	$nPruNum = mysqli_num_rows($result);
	if ($row=mysqli_fetch_array($result))
	{
		$web_url=$row["T_URL"];
		$web_subject=$row["T_WEB_NAME"];
		$web_creat_time=$row["T_CREATE_TIME"];
		$web_NikiName=$row["T_NIKI_NAME"];
		$web_ContactInfo=$row["T_CONTACT_INFO"];
		$web_welcome_text=$row["T_WELCOME_TEXT"];
		$web_home=$row["T_WEB_HOME"];
		$web_paypal=$row["T_PAYPAL_ACCOUNT"];
		$web_show_sell_price=$row["T_IS_SHOW_PRICE"];
	}
?>
<form id="form1" name="form1" method="post" action="updateData.php?COM_ID=1001">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="142" align="right">Domain:</td>
      <td width="445"><?php
	  echo $web_url;
	  ?></td>
    </tr>
    <tr>
      <td align="right">Subject Window:</td>
      <td><input type="text" name="web_subject" value="<?php
	  echo $web_subject;
	  ?>" />
      eg: welcome to ***</td>
    </tr>
    <tr>
      <td align="right">Admin Niki name: </td>
      <td><input type="text" name="web_NikiName" value="<?php
	  echo $web_NikiName;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">Paypal account:</td>
      <td><input type="text" name="web_paypal" value="<?php
	  echo $web_paypal;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">Home file: </td>
      <td><input type="text" name="web_home" value="<?php
	  echo $web_home;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">Contact info:</td>
      <td><textarea name="web_ContactInfo" cols="40" rows="4"><?php
	  echo $web_ContactInfo;
	  ?></textarea></td>
    </tr>
    <tr>
      <td align="right">Welcome info:</td>
      <td><textarea name="web_welcome_text" cols="40" rows="4"><?php
	  echo $web_welcome_text;
	  ?></textarea></td>
    </tr>
	<tr>
      <td align="right">Sell price:</td>
      <td>
          <label>
            <input name="ShowSellPrice" type="radio" id="ShowSellPrice_0" value="true" <?php if ($web_show_sell_price) echo "checked=\"checked\""; ?>/>
            Show Price</label>
          <label>
            <input type="radio" name="ShowSellPrice" value="false" id="ShowSellPrice_1" <?php if (!$web_show_sell_price) echo "checked=\"checked\""; ?>/>
            Dont Show Price</label>
          <br /></td>
    </tr>
    <tr>
      <td align="right">Create time:</td>
      <td><?php
	  echo $web_creat_time;
	  ?>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="submit" />
      &nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="Submit2" value="reset" /></td>
    </tr>
  </table>
</form>
</body>
</html>