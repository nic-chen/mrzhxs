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
$artical = new article;

include("top_menu.php"); 

$classID=$_GET["ID"];
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15%" height="25" align="center">&nbsp;</td>
    <td width="65%" height="25">&nbsp;</td>
    <td height="25" align="center"><a href="articleCreate.php?ID=<?php echo $classID;?>">发表文章</a></td>
  </tr>
  <tr>
    <td width="15%" height="25" align="center">发布日期</td>
    <td width="65%" height="25">标题</td>
    <td width="20%" height="25" align="center">&nbsp;</td>
  </tr>
  <?php
  $result = $artical->GetArticleList($classID, -1, -1, true);
  while($row=mysqli_fetch_array($result))
  {
  ?>
  <tr class="article">
    <td width="15%" align="center"><?php echo date("Y-m-d H:i", strtotime($row["T_CREATE_TIME"])); ?></td>
    <td width="65%"><p><?php echo $row["T_TITLE"];?></p></td>
    <td width="20%" align="center"><a href="updateData.php?COM_ID=1006&id=<?php echo $row["T_ID"];?>">Delete</a> | <a href="articleChange.php?ID=<?php echo $row["T_ID"];?>">Change</a></td>
  </tr>
  <?php
  }
  ?>
</table>

</body>
</html>
