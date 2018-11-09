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
?>><a href="index.php"><span>文章模块管理</span></a></li>
<li <?php
if ($thisPage=="articleCreate.php")
	echo " id=\"current\" ";
?>><a href="articleCreate.php"><span>新文章</span></a></li>
<?php
$result = $artical->GetArticleModelList();
while($row=mysql_fetch_array($result))
{
	if ($row["T_STATUS"]==1)
		continue;
?>
<li <?php
if ($thisPage=="articleList.php?ID=".$row["T_ID"])
	echo " id=\"current\" ";
?>><a href="articleList.php?ID=<?php echo $row["T_ID"];?>"><span><?php echo $row["T_MODELNAME"];?></span></a></li>
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