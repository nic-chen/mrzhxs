<?php
$thisPage=substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/')+1, strlen($_SERVER['REQUEST_URI'])-strrpos($_SERVER['REQUEST_URI'], '/')-1);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5">
 <ul>
<!-- CSS Tabs -->
<li <?php
if ($thisPage=="MsgList.php?type=buyer")
	echo " id=\"current\" ";
?>><a href="MsgList.php?type=buyer"><span><?php echo PRODUCT.LEAVE_MSG." ".BUYER;?></span></a></li>
<li <?php
if ($thisPage=="MsgList.php?type=seller")
	echo " id=\"current\" ";
?>><a href="MsgList.php?type=seller"><span><?php echo PRODUCT.LEAVE_MSG." ".ADMIN;?></span></a></li>
<li <?php
if ($thisPage=="MsgList.php?type=all")
	echo " id=\"current\" ";
?>><a href="MsgList.php?type=all"><span><?php echo PRODUCT.LEAVE_MSG." ".ALL;?></span></a></li>
<li <?php
if ($thisPage=="MsgList.php?type=website")
	echo " id=\"current\" ";
?>><a href="MsgList.php?type=website"><span><?php echo WEBSITE.LEAVE_MSG;?></span></a></li>
 </ul>
</div></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" bgcolor="#663366"></td>
  </tr>
</table>