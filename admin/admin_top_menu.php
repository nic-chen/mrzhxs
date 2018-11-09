<?php
$thisPage=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF'])-strrpos($_SERVER['PHP_SELF'], '/')-1);

$nStep=$_GET["step"];
$strSearchWord=$_GET["key"];
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
<div id="tabs5" style="width:300px">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="adminList.php")
	echo " id=\"current\" ";
?>><a href="adminList.php"><span>Admin  list</span></a></li>
<li <?php
if ($thisPage=="adminAdd.php")
	echo " id=\"current\" ";
?>><a href="adminAdd.php"><span>Add admin</span></a></li>
<?php
if ($thisPage=="adminDetail.php")
{
?>
<li <?php
if ($thisPage=="adminDetail.php")
	echo " id=\"current\" ";
?>><a href="adminDetail.php"><span>Admin Detail</span></a></li>
<?php
}
?>
                        </ul>
</div></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" bgcolor="#663366"></td>
  </tr>
</table><br>