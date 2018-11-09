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
$Customer = new Customer;

$type = $_GET["type"];
if (strlen($type)==0)
	include($type."top_menu.php");
else
	include($type."_top_menu.php");

$ID=$_GET["ID"];

$result = $Customer->GetCustomerModel($ID);
$row=mysqli_fetch_array($result);
?>
<form action="updateData.php?COM_ID=1008" method="post" style="margin:0px; padding:0px; border:solid #006699 1PX;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" colspan="2" align="center">模块查看修改</td>
  </tr>
  <tr style="padding-right:15px;">
    <td width="20%" height="30" align="right">名称</td>
    <td height="30"><input type="text" name="name" value="<?php echo $row["T_NAME"];?>"/>
      <input type="hidden" name="id" value="<?php echo $ID;?>"/></td>
  </tr>
  <tr style="padding-right:15px;">
    <td height="30" align="right">备注信息</td>
    <td height="30"><input type="text" name="memo" value="<?php echo $row["T_MEMO"];?>"/></td>
  </tr>
  <tr style="padding-right:15px;">
    <td height="30" align="right">状态</td>
    <td height="30"><label>
      <select name="status">
	  <?php
	  $selected = "selected=\"selected\"";
	  ?>
        <option value="0" <?php if ($row["T_STATUS"]==0) echo $selected;?>>可用</option>
        <option value="1" <?php if ($row["T_STATUS"]==1) echo $selected;?>>禁用</option>
      </select>
    </label></td>
  </tr>
  <tr style="padding-right:15px;">
    <td height="30" align="right">子文章</td>
    <td height="30"><select name="subArticle">
      <option value="1" <?php if ($row["T_HAVE_SUB_ARTICLE"]==1) echo $selected;?>>包含</option>
      <option value="0" <?php if ($row["T_HAVE_SUB_ARTICLE"]==0) echo $selected;?>>不包含</option>
    </select></td>
  </tr>
  <tr>
    <td width="20%" height="30">&nbsp;</td>
    <td height="30"><input type="submit" name="Submit" value="修改" />
      <input type="hidden" name="type" value="<?php echo $type;?>" /></td>
  </tr>
</table>
</form>

</body>
</html>
