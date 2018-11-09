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

$articleID=$_GET["ID"];
?>
<form action="updateData.php?COM_ID=1005" method="post" style="margin:0px; padding:0px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" height="25" align="center">&nbsp;</td>
    <td width="80%" height="25" align="center">文章编辑</td>
    <td width="10%" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="left"  style="padding-left:10px;">所属分类</td>
    <td width="80%" height="25"><label>
    <?php
    $result = $artical->GetArticle($articleID);
	$row=mysqli_fetch_array($result);
	?>
    <select name="model" id="model">
		<?php
		$resultModelList = $artical->GetArticleModelList();
		while($rowModelList=mysqli_fetch_array($resultModelList))
		{
		?>
        <option value="<?php echo $rowModelList["T_ID"];?>" <?php if ($rowModelList["T_ID"]==$row["T_MODEL_ID"]) echo "selected=\"selected\"";?>><?php echo $rowModelList["T_MODELNAME"];?></option>
		<?php
		}
		?>
      </select>
    </label></td>
    <td width="10%" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="left" style="padding-left:10px;">文章标题</td>
    <td width="80%" height="25"><label>
      <input name="title" type="text" id="title" size="50" value="<?php echo $row["T_TITLE"];?>"/>
      <input type="hidden" name="id" value="<?php echo $row["T_ID"];?>"/>
    </label></td>
    <td width="10%" align="center">&nbsp;</td>
  </tr>
  <tr style="padding-left:10px; padding-right:5px;">
    <td height="25" colspan="3" align="center"><?php
{
	$oFCKeditor = new FCKeditor('FCKeditor1') ;
	$oFCKeditor->BasePath	= "../../lib/fckeditor/";
	$oFCKeditor->Value		= $row["T_TEXT"] ;
	$oFCKeditor->Create() ;
}

?></td>
    </tr>
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td width="80%" height="25"><input type="submit" value="发布" /></td>
    <td width="10%" align="center">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
