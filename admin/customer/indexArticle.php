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
<ul class="article_ul">
	<?php
    $result = $Customer->GetModelContect($_GET["customerID"], $_GET["articleClassID"]);
	while($row=mysql_fetch_array($result))
	{
	?>
	<li><?php echo $row["T_TITLE"];?> <a href="ViewChangeArticle.php?type=hualang&id=<?php echo $row["T_ID"];?>"><span class="hyperlink">查看修改</span></a> | <a href="updateData.php?COM_ID=1012&id=<?php echo $row["T_ID"];?>&type=<?php echo $_GET["type"];?>"><span class="hyperlink">删除</span></a></li>
    <?php
    }
	?>
<ul>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="center">&nbsp;</td>
    <td width="50%" align="center"><a href="CreateArticle.php?articleClassID=<?php echo $_GET["articleClassID"];?>&customerID=<?php echo $_GET["customerID"];?>&type=<?php echo $_GET["type"];?>">发表新文章</a></td>
  </tr>
</table>

</body>
</html>
