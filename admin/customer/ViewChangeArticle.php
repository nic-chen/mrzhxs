<?php
include_once("settings.php");
include(LIBPATH."lib.php");
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
$Customer = new Customer;
$type = $_GET["type"];
if (strlen($type)==0)
	include($type."top_menu.php");
else
	include($type."_top_menu.php");

$result = $Customer->GetModelContectByID($_GET["id"]);
$row=mysqli_fetch_array($result);
?>

<form action="updateData.php?COM_ID=1010" method="post" style="margin:0px; padding:0px;border:solid #006699 1PX; margin-top:-1px; padding-top:20px; padding-bottom:15px;" id="baseInfo"  enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" height="25" align="center">名称</td>
    <td width="80" height="25">
      <input name="title" type="text" id="title" size="50" value="<?php echo $row["T_TITLE"];?>"/>
    </td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr style="padding-left:10px; padding-right:10px;">
    <td height="25" align="center">正文</td>
    <td height="25" colspan="2" align="center" valign="top" style="padding:0px; padding-right:10px;"><?php
$oFCKeditor = new FCKeditor('text') ;
$oFCKeditor->BasePath	= "../../lib/fckeditor/";
$oFCKeditor->Value		= $row["T_TEXT"] ;
$oFCKeditor->Create() ;
?></td>
  </tr>
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td width="80%" height="25"><input type="submit" value="提交更改">
      <input type="hidden" name="id" value="<?php echo $_GET["id"];?>" />
      <input type="hidden" name="type" value="<?php echo $_GET["type"];?>" /></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
