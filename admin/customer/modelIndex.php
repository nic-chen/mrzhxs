<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
$Customer = new Customer;

$type = $_GET["type"];
if (strlen($type)==0)
	include($type."top_menu.php");
else
	include($type."_top_menu.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr style="padding-left:10px;">
    <td width="20%">名称</td>
    <td width="40%">备注</td>
    <td width="15%" align="center">子文章</td>
    <td width="15%" align="center">状态</td>
    <td width="10%">&nbsp;</td>
  </tr>
  <?php
$result = $Customer->GetCustomerModelList($type);

while($row=mysql_fetch_array($result))
{
?>
  <form action="updateData.php?COM_ID=1002" method="post" style="margin:0px; padding:0px;">
    <tr style="padding-left:10px;">
      <td width="20%"><?php echo $row["T_NAME"];?>&nbsp;</td>
      <td width="40%"><?php echo $row["T_MEMO"];?>&nbsp;</td>
      <td width="15%" align="center"><select name="subArticle">
        <?php
	  $selected = "selected=\"selected\"";
	  ?>
        <option value="1" <?php if ($row["T_HAVE_SUB_ARTICLE"]==1) echo $selected;?>>包含</option>
        <option value="0" <?php if ($row["T_HAVE_SUB_ARTICLE"]==0) echo $selected;?>>不包含</option>
      </select></td>
      <td width="15%" align="center"><select name="status">
	  <?php
	  $selected = "selected=\"selected\"";
	  ?>
        <option value="0" <?php if ($row["T_STATUS"]==0) echo $selected;?>>可用</option>
        <option value="1" <?php if ($row["T_STATUS"]==1) echo $selected;?>>禁用</option>
      </select>      </td>
      <td width="10%" align="center"><a href="ViewChangeModel.php?type=<?php echo $type;?>&ID=<?PHP echo $row["T_ID"];?>">查看</a> | <a href="updateData.php?COM_ID=1013&id=<?php echo $row["T_ID"];?>">删除</a></td>
    </tr>
  </form>
  <?php
}
?>
  <form action="updateData.php?COM_ID=1001" method="post" style="margin:0px; padding:0px;">
  </form>
</table>
<br><br>
<form action="updateData.php?COM_ID=1007" method="post" style="margin:0px; padding:0px; border:solid #006699 1PX;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center">增加新的模块</td>
  </tr>
  <tr style="padding-right:15px;">
    <td width="20%" height="30" align="right">名称</td>
    <td height="30"><input type="text" name="name" /></td>
  </tr>
  <tr style="padding-right:15px;">
    <td height="30" align="right">备注信息</td>
    <td height="30"><input type="text" name="memo" /></td>
  </tr>
  <tr style="padding-right:15px;">
    <td height="30" align="right">状态</td>
    <td height="30"><label>
      <select name="status">
        <option value="0">可用</option>
        <option value="1">禁用</option>
      </select>
      <input type="hidden" name="type" value="<?php echo $type;?>" />
    </label></td>
  </tr>
  <tr>
    <td height="30" align="right">子文章</td>
    <td height="30"><select name="subArticle">
      <option value="1">包含</option>
      <option value="0">不包含</option>
    </select></td>
  </tr>
  <tr>
    <td width="20%" height="30">&nbsp;</td>
    <td height="30"><input type="submit" name="Submit" value="增加" /></td>
  </tr>
</table>
</form>
</body>
</html>
