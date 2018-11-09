<?php
$thisPage=substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/')+1, strlen($_SERVER['REQUEST_URI'])-strrpos($_SERVER['REQUEST_URI'], '/')-1);
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="index.php")
	echo " id=\"current\" ";
?>><a href="index.php"><span>在线订单</span></a></li>
<li <?php
if ($thisPage=="index.php?ADType=guanggaowei")
	echo " id=\"current\" ";
?>><a href="index.php?ADType=guanggaowei"><span>广告位</span></a></li>
                        </ul>
                </div></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" bgcolor="#663366"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>