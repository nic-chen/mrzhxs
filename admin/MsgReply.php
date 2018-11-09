<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
include_once('settings.php');
include_once(LIBPATH."lib.php");
 ?>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5" style="width:300px">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="MsgList.php")
	echo " id=\"current\" ";
?>><a href="MsgList.php"><span>Message list</span></a></li>
<li <?php
if ($thisPage=="MsgReply.php")
	echo " id=\"current\" ";
?>><a href="MsgReply.php<?php echo "?ID=".$_GET["ID"]; ?>"><span>Reply customer's message</span></a></li>
                        </ul>
</div></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" bgcolor="#663366"></td>
  </tr>
</table><br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
  <tr>
    <td height="25" colspan="2" bgcolor="#669B31" class="style1">Detail infomation</td>
  </tr>
   <?php
  	$SQL = new SQL;
	$msg_id=$_GET["ID"];
	$result = $SQL->Query("select * from customerleavemsg where T_INDEX='$msg_id' ");
	
	while(($row=mysql_fetch_array($result)))
	{
  ?>
  <form action="updateData.php?COM_ID=1010" method="post">
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1"><?php echo CONTECT_WAY.FENGHAO;?></td>
    <td height="35" bgcolor="#C2DC71"><?PHP echo $row["T_CUSTOMER_MAIL"];?></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1"><?php echo PRODUCT.FENGHAO;?></td>
    <td height="35" bgcolor="#C2DC71"><img src="../<?php echo GetItemPathInfo($row["T_PRU_ID"])."1_s.jpg";?>" border="0"/> <a href="../?p=ItemDetail&T_ID=<?PHP echo $row["T_PRU_ID"];?>" target="_blank"><?php echo $row["T_PRU_ID"];?></a></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1"><?php echo NAME.FENGHAO;?></td>
    <td height="35" bgcolor="#C2DC71"><?PHP echo $row["T_CUSTOMER_NIKI_NAME"];?></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">IP <?PHP echo ADDRESS.FENGHAO;?></td>
    <td height="35" bgcolor="#C2DC71"><?PHP echo $row["T_IP_ADD"];?></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1"><?php echo LEAVE_MSG.FENGHAO?></td>
    <td height="35" bgcolor="#C2DC71"><?php echo str_replace("\r\n", "<br>",$row["T_MSG"]);?></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="25" align="right" valign="top" class="style1"><?php echo REPLY.LEAVE_MSG.FENGHAO;?></td>
    <td height="25"><textarea name="leaveMsg" cols="60" rows="5"></textarea>
      <input type="hidden" name="MSG_ID" value="<?php echo $row["T_INDEX"];?>" />
      <input type="hidden" name="PRU_ID" value="<?php echo $row["T_PRU_ID"];?>" />
	  <input type="hidden" name="CUSTOMER_MAIL" value="<?PHP echo $row["T_CUSTOMER_MAIL"];?>" />
	  <input type="hidden" name="NIKI_NAME" value="<?php echo $row["T_CUSTOMER_NIKI_NAME"];?>" />
	  <input type="hidden" name="ORIGINAL_MSG" value="<?php echo str_replace("\r\n", "<br>",$row["T_MSG"]);?>" /></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" align="right" bgcolor="#C2DC71" class="style1">&nbsp;</td>
    <td height="35" align="left" bgcolor="#C2DC71"><input name="sendMail" type="checkbox" id="sendMail" value=1 />
      <?php echo DO_SEND.MAIL.FENGHAO;?></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td height="35" colspan="2" align="center" bgcolor="#C2DC71"><input type="submit" name="Submit" value="Reply This Message" /></td>
  </tr>
 </form>
  <?php
  	}
  ?>
</table>
</body>
</html>
