<?php
$thisPage=substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/')+1, strlen($_SERVER['REQUEST_URI'])-strrpos($_SERVER['REQUEST_URI'], '/')-1);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5">
 <ul>
<!-- CSS Tabs -->
<li <?php
if ($thisPage=="shipping_list.php?order_by=CreateTime")
	echo " id=\"current\" ";
?>><a href="?order_by=CreateTime"><span>List By Create Time</span></a></li>
<li <?php
if ($thisPage=="shipping_list.php?order_by=UpdateTime")
	echo " id=\"current\" ";
?>><a href="?order_by=UpdateTime"><span>List By Update Time</span></a></li>
<li <?php
if ($thisPage=="shipping_list.php?order_by=FileName")
	echo " id=\"current\" ";
?>><a href="?order_by=FileName"><span>List By File Name</span></a></li>
 </ul>
</div></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" bgcolor="#663366"></td>
  </tr>
</table>