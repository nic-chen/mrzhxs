<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.STYLE1 {color: #FFFFFF}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style>
-->
</style></head>

<body>
<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");

$thisPage=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF'])-strrpos($_SERVER['PHP_SELF'], '/')-1);

$nStep=$_GET["step"];
$strSearchWord=$_GET["key"];
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="tabs5" style="width:300px">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="subWebList.php")
	echo " id=\"current\" ";
?>><a href="subWebList.php"><span>Sub website  list</span></a></li>
</ul>
</div></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" bgcolor="#663366"></td>
  </tr>
</table><br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
  <tr>
    <td width="1" height="25" bgcolor="#669B31"><div style="width:100px;">&nbsp;&nbsp;</div></td>
    <td width="900" height="25" bgcolor="#669B31">&nbsp;</td>
    <td width="1" height="25" bgcolor="#669B31"><div style="width:200px;">&nbsp;</div></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td  height="25" colspan="2" class="STYLE1">&nbsp;&nbsp;Web Url</td>
    <td  height="25" align="center" class="STYLE1">Action</td>
  </tr>
  <?php
  	$cur_page=$_GET["page"];
	if (empty($cur_page) || $cur_page<1)
		$cur_page=1;
	$SQL = new SQL;
	
	$sSql="select * from t_web_conn";
	$result = $SQL->Query($sSql);
	$nItemTotal = mysql_numrows($result);

	while(($row=mysql_fetch_array($result)))
	{
  ?>
  <tr bgcolor="#C2DC71" onMouseOver="this.bgColor='#CDD4BD';" onMouseOut="this.bgColor='#C2DC71'">
    <td height="35" colspan="2">&nbsp;&nbsp;<?php echo $row["T_URL"]; ?></td>
    <td align="center"><a href="updateData.php?COM_ID=1018&T_URL=<?PHP echo $row["T_URL"];?>" onclick="if  (confirm('Please confirm you will delete [<?php echo $row["T_URL"]; ?>]!'))  return true; else  return false;">Delete</a></td>
  </tr>
  <?php
  	}
  ?>
  <form method="post" style="margin:0px; padding:0px;" action="updateData.php?COM_ID=1017">
  <tr bgcolor="#C2DC71">
    <td height="35" colspan="2">&nbsp;
      <label>
      <input type="text" name="WEB_URL" id="WEB_URL" />
      </label></td>
    <td align="center"><input type="submit" name="button" id="button" value="Add new sub website" /></td>
  </tr>
  </form>
</table>
</body>
</html>
