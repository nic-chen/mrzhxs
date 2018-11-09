<?php
$thisPage=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF'])-strrpos($_SERVER['PHP_SELF'], '/')-1);

$nStep=$_GET["step"];
$strSearchWord=$_GET["key"];
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5" >
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="web_conn.php")
	echo " id=\"current\" ";
?>><a href="../web_conn.php"><span>Web Config</span></a></li>
<li <?php
if ($thisPage=="web_top_nav.php")
	echo " id=\"current\" ";
?>><a href="../web_top_nav.php"><span><?php echo NAV_BAR;?></span></a></li>
<li <?php
if ($thisPage=="index.php")
	echo " id=\"current\" ";
?>><a href="index.php"><span><?php echo FRIEND_BAR;?></span></a></li>
                        </ul>
</div></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" bgcolor="#663366"></td>
  </tr>
</table><br>