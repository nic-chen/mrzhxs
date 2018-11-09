<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$artical = new article;

include("top_menu.php"); 

$classID=$_GET["ID"];
?>
<form action="updateData.php?COM_ID=1004" method="post" style="margin:0px; padding:0px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td width="80%" height="25" align="center">添加新会员基本信息</td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center" valign="middle">会员姓名</td>
    <td width="80%" height="25"><label>
      <input name="name" type="text" id="name" size="50" />
    </label></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center" valign="middle">邮件地址</td>
    <td width="80%" height="25"><label>
      <input name="mail" type="text" id="mail" size="50" />
    </label></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="25" align="center" valign="middle">所属国家</td>
    <td width="80%" height="25"><input name="country" type="text" id="country" size="50" /></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center" valign="middle">客户地址</td>
    <td width="80%" height="25"><input name="address" type="text" id="address" size="50" /></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center" valign="middle">客户等级</td>
    <td width="80%" height="25"><label>
      <select name="dengji" id="dengji">
        <option value="1">普通会员</option>
        <option value="2">银卡会员</option>
        <option value="3">铜卡会员</option>
      </select>
    </label></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr style="padding-left:10px; padding-right:10px;">
    <td height="25" align="center" valign="middle">简介信息</td>
    <td height="25" colspan="2" align="center" valign="top"><?php
$oFCKeditor = new FCKeditor('JianJie') ;
$oFCKeditor->BasePath	= "../../lib/fckeditor/";
$oFCKeditor->Value		= '简介信息' ;
$oFCKeditor->Create() ;
?>
&nbsp;</td>
    </tr>
  <tr>
    <td height="25" align="center" valign="middle">备注信息</td>
    <td width="80%" height="25"><label>
      <input name="memo" type="text" id="memo" size="50" />
      </label></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center" valign="middle">&nbsp;</td>
    <td width="80%" height="25"><input type="submit" value="添加"></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
