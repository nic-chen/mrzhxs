<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
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
form {
	padding:0px; margin:0px;
}
img{
	padding:2px; border:solid #999999 1px; width:100px;
}
form input{
	width:200px;
}
-->
</style><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php include("top_menu.php");?>
<table width="100%" border="0" cellspacing="3" cellpadding="1">
  <tr>
    <td width="30%" align="left">链接位置</td>
    <td width="15%" align="center">图片</td>
    <td width="15%" align="center">排序</td>
    <td width="20%" align="center">备注信息</td>
    <td width="20%" align="center">&nbsp;</td>
  </tr>
  <?PHP
  $AD = new AD;
  $adType = $_GET["ADType"];
  $result = $AD->GetAdListByType($adType);
  while($row=mysqli_fetch_array($result))
  {
  ?>
  <tr>
    <td width="30%" align="left"><?php echo $row["T_VALUE"];?>&nbsp;</td>
    <td width="15%" align="center"><img src="../../<?PHP echo $AD->GetADPath();?>/<?php echo $row["T_PICTURE_NAME"];?>"/></td>
    <td width="15%" align="center"><?php echo $row["T_ORDER"];?></td>
    <td width="20%" align="left"><?php echo $row["T_MEMO"];?>&nbsp;</td>
    <td width="20%" align="center"><a href="ViewChange.php?ID=<?php echo $row["T_ID"];?>">查看修改</a> | <a href="updateData.php?COM_ID=1006&id=<?php echo $row["T_ID"];?>">删除</a></td>
  </tr>
  <?PHP
  }
  ?>
  <tr>
    <td width="30%">&nbsp;</td>
    <td width="15%" align="left">&nbsp;</td>
    <td width="15%" align="left">&nbsp;</td>
    <td width="20%" align="left">&nbsp;</td>
    <td width="20%">&nbsp;</td>
  </tr>
</table>
<form action="updateData.php?COM_ID=1001" method="post" style="margin:0px; padding:0px;border:solid #006699 1PX; margin-top:-1px; padding-top:20px; padding-bottom:10px;"  enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" height="25" align="center">&nbsp;</td>
    <td width="80%" height="25" align="center">添加</td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center">链接位置</td>
    <td height="25" colspan="2"><input type="text" name="value" /></td>
    </tr>
  <tr>
    <td height="25" align="center" valign="bottom">图片</td>
    <td height="25" colspan="2"><input type="file" name="picture" style="width:250px;"  onchange="document.getElementById('pictureShow').src=this.value;"/>
    (像素：<?php
	if ($adType == "huandengpian")
		echo "308*286";
	else if ($adType == "guanggaowei")
		echo "970*108";
	?>)
      <img src="" id="pictureShow"/></td>
    </tr>
  <tr>
    <td height="25" align="center">备注</td>
    <td height="25" colspan="2"><input type="text" name="memo" />
      <input type="hidden" name="type" value="<?php echo $adType;?>"/></td>
    </tr>
  <tr>
    <td height="25" align="center">排序</td>
    <td height="25" colspan="2"><input type="text" name="order" /></td>
  </tr>
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td height="25" colspan="2"><input type="submit" value="添加"></td>
    </tr>
</table>
</form>

</body>
</html>