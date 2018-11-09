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

include("top_menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$result = $artical->GetArticleModelList();
$strSelected="selected=\"selected\"";
while($row=mysql_fetch_array($result))
{
?>
<form action="updateData.php?COM_ID=1002" method="post" style="margin:0px; padding:0px;">
  <tr>
    <td>文章版面名称</td>
    <td>名称：
      <input type="text" name="name" id="name" value="<?php echo $row["T_MODELNAME"];?>"/>
次序
<input type="text" name="order" id="order" value="<?php echo $row["T_ORDER"];?>"/>
<label>状态
<select name="STATUS" id="STATUS">
  <option value="0" <?php if ($row["T_STATUS"]==0) echo $strSelected;?>>正常</option>
  <option value="1" <?php if ($row["T_STATUS"]==1) echo $strSelected;?>>禁用</option>
</select>
</label>
<input type="hidden" name="ID" value="<?php echo $row["T_ID"];?>"/></td>
    <td><input type="submit" name="submit" value="Update" />
    <input type="submit" name="submit" value="Delete" /></td>
  </tr>
</form>
<?php
}
?>
<form action="updateData.php?COM_ID=1001" method="post" style="margin:0px; padding:0px;">
  <tr>
    <td>添加新的文章版面</td>
    <td>名称：
      <input type="text" name="name" id="name" /> 
      次序
      <input type="text" name="order" id="order" /></td>
    <td><input type="submit" name="submit" value="Add" /></td>
  </tr>
</form>
</table>

</body>
</html>
