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



$classID=$_GET["ID"];
?>
<form action="updateData.php?COM_ID=1011" method="post" style="margin:0px; padding:0px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="center">会员</td>
    <td height="25" align="left"><select name="customerID">
      <?php
	$selected = "selected=\"selected\"";
	$resultTmp = $Customer->GetCustomerList(-1, -1, $type);
	while($rowTmp=mysql_fetch_array($resultTmp))
	{
			?>
      <option value="<?php echo $rowTmp["T_ID"];?>" <?php if ($_GET["customerID"]==$rowTmp["T_ID"]) echo $selected;?>><?php echo $rowTmp["T_CUSTOMER_NAME"];?></option>
      <?php
	}
	?>
    </select></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="25" align="center">分类</td>
    <td width="80%" height="25" align="left"><select name="class">
	<?php
	$selected = "selected=\"selected\"";
	$resultTmp = $Customer->GetCustomerModelList($type);
	while($rowTmp=mysql_fetch_array($resultTmp))
	{
		if ($rowTmp["T_HAVE_SUB_ARTICLE"]==1)
		{
			?>
			<option value="<?php echo $rowTmp["T_ID"];?>" <?php if ($_GET["articleClassID"]==$rowTmp["T_ID"]) echo $selected;?>><?php echo $rowTmp["T_NAME"];?></option>
			<?php
		}
	}
	?>
    </select>    </td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="25" align="center" valign="middle">标题</td>
    <td width="80%" height="25"><label>
      <input name="title" type="text" id="title" size="50" />
    </label></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr style="padding-left:10px; padding-right:10px;">
    <td width="10%" height="25" align="center" valign="middle">内容</td>
    <td height="25" colspan="2" align="left" valign="top"><?php
$oFCKeditor = new FCKeditor('text') ;
$oFCKeditor->BasePath	= "../../lib/fckeditor/";
$oFCKeditor->Value		= '' ;
$oFCKeditor->Create() ;
?></td>
    </tr>
  <tr>
    <td width="10%" height="25" align="center" valign="middle">&nbsp;</td>
    <td width="80%" height="25"><input type="submit" value="发表新文章">
      <input type="hidden" name="type" value="<?php echo $_GET["type"];?>" /></td>
    <td width="10%" height="25" align="center">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
