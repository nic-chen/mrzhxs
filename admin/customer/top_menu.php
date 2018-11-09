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
?>><a href="index.php"><span>会员列表</span></a></li>
<li <?php
if ($thisPage=="modelIndex.php")
	echo " id=\"current\" ";
?>><a href="modelIndex.php"><span>会员模块</span></a></li>
<li <?php
if ($thisPage=="Create.php")
	echo " id=\"current\" ";
?>><a href="Create.php"><span>添加新会员</span></a></li>
<?php
$list=explode("ViewChangeModel.php", $thisPage);
if (count($list)>1)
{
?>
<li 
<?php
	echo " id=\"current\" ";
?>><a href="#"><span>会员模块查看修改</span></a></li>
<?php
}
?>
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