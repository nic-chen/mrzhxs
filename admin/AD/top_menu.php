<?php
$thisPage=substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/')+1, strlen($_SERVER['REQUEST_URI'])-strrpos($_SERVER['REQUEST_URI'], '/')-1);
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="index.php?ADType=huandengpian_head")
	echo " id=\"current\" ";
?>><a href="index.php?ADType=huandengpian_head"><span>个人专栏幻灯片-1</span></a></li>
<li <?php
if ($thisPage=="index.php?ADType=huandengpian_head2")
	echo " id=\"current\" ";
?>><a href="index.php?ADType=huandengpian_head2"><span>个人专栏幻灯片-2</span></a></li>
<li <?php
if ($thisPage=="index.php?ADType=huandengpian")
	echo " id=\"current\" ";
?>><a href="index.php?ADType=huandengpian"><span>幻灯片</span></a></li>
<li <?php
if ($thisPage=="index.php?ADType=bottomhuandengpian")
	echo " id=\"current\" ";
?>><a href="index.php?ADType=bottomhuandengpian"><span>底部宣传幻灯片</span></a></li>
<li <?php
if ($thisPage=="index.php?ADType=wenziguanggao")
	echo " id=\"current\" ";
?>><a href="index.php?ADType=wenziguanggao"><span>文字广告</span></a></li>
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