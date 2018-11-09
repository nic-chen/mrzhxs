<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>
<?php
echo $_FILES["ShppingListFile"]["tmp_name"];
?>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" style="margin:0px;padding:0px">
  <tr>
    <td height="20">&nbsp;</td>
    <td height="20">&nbsp;</td>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="3" align="left" bgcolor="#669B31">Add new shipping list</td>
    </tr>
  <tr>
    <td height="20" bgcolor="#C2DC71">&nbsp;</td>
    <td height="20" bgcolor="#C2DC71"><input name="Memo" type="text" size="40" value="<?php echo date("Y-m-d",$timeInfo)." Shipping list"; ?>"/></td>
    <td height="20" bgcolor="#C2DC71">
      <input type="file" name="ShppingListFile" />
      <input type="submit" name="Submit" value="Add List" style="height:20px;"/>    </td>
  </tr>
  </form>
</table>

</body>
</html>
