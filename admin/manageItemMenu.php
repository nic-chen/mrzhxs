<?php
$thisPage=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF'])-strrpos($_SERVER['PHP_SELF'], '/')-1);
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="itemManage.php")
	echo " id=\"current\" ";
?>><a href="itemManage.php"><span>产品列表</span></a></li>
<li<?php
if ($thisPage=="addSingleItem.php")
	echo " id=\"current\" ";
?>><a href="addSingleItem.php"><span>添加产品</span></a></li>
<li<?php
if ($thisPage=="BatChangeItem.php")
	echo " id=\"current\" ";
?>><a href="BatChangeItem.php"><span>批量修改</span></a></li>
<li<?php
if ($thisPage=="AddItem.php")
	echo " id=\"current\" ";
?>><a href="AddItem.php"><span>导入产品</span></a></li>
<?php
if ($thisPage=="EditItem.php")
{
?>
<li<?php
if ($thisPage=="EditItem.php")
	echo " id=\"current\" ";
?>><a href="#"><span>产品编辑</span></a></li>
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