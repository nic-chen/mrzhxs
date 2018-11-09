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
    <td width="10%" height="25" align="center">&nbsp;</td>
    <td width="70%" height="25" align="center">发布新文章</td>
    <td width="20%" height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="left" style="padding-left:10px;">所属分类</td>
    <td height="25"><label>
      <select name="model" id="model">
		<?php
		$selected = "selected=\"selected\"";
		$result = $artical->GetArticleModelList();
		while($row=mysqli_fetch_array($result))
		{
		?>
        <option value="<?php echo $row["T_ID"];?>" <?php if ($row["T_ID"]==$_GET["ID"]) echo $selected;?>><?php echo $row["T_MODELNAME"];?></option>
		<?php
		}
		?>
      </select>
    </label></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="left" style="padding-left:10px;">文章标题</td>
    <td height="25"><label>
      <input name="title" type="text" id="title" size="50" />
    </label></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
  <tr style="padding-left:10px; padding-right:5px;">
    <td height="25" colspan="3" align="center"><?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= "../../lib/fckeditor/";
$oFCKeditor->Value		= '文章内容' ;
$oFCKeditor->Create() ;
?></td>
    </tr>
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td height="25"><input type="submit" value="发布"></td>
    <td height="25" align="center">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
