<?php
$thisPage=substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/')+1, strlen($_SERVER['REQUEST_URI'])-strrpos($_SERVER['REQUEST_URI'], '/')-1);
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="index.php?type=paimai")
	echo " id=\"current\" ";
?>><a href="index.php?type=paimai"><span>拍卖会员列表</span></a></li>
<li <?php
if ($thisPage=="modelIndex.php?type=paimai")
	echo " id=\"current\" ";
?>><a href="modelIndex.php?type=paimai"><span>拍卖会员模块</span></a></li>
<li <?php
if ($thisPage=="Create.php?type=paimai")
	echo " id=\"current\" ";
?>><a href="Create.php?type=paimai"><span>添加新拍卖会员</span></a></li>
<?php
$show = false;
$list=explode("ViewChangeModel.php", $thisPage);
if (count($list)>1)
	$show = true;

$list=explode("ViewChangeArticle.php", $thisPage);
if (count($list)>1)
	$show = true;

if ($show)
{
?>
<li 
<?php
	echo " id=\"current\" ";
?>><a href="#"><span>查看修改</span></a></li>
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