<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="00_manage.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	background-color: #FAFAFA;
}
a:link {
	text-decoration: none;
	color: #669900;
}
a:visited {
	text-decoration: none;
	color: #669900;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
body,td,th {
	font-size: 12px;
	table-layout:fixed;
	word-break:break-all;
	word-wrap:break-word;
	FONT: 12px/160% Verdana,Arial,sans-serif,"Times New Roman","sans-serif";
}
-->
table.line{
		border-color:#6B9833;
		border-collapse:collapse;
　　} 
.ItemManageHead {color: #FFFFFF}
</style>
</head>

<body>
<?php include("manageItemMenu.php"); ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="left" bgcolor="#669B31"><span class="ItemManageHead">Add Single item</span></div>
    </td>
  </tr>
  <tr>
    <td align="center"><form action="updateData.php?COM_ID=1022" method="post" enctype="multipart/form-data" name="frEditFrame" id="frEditFrame"  style="margin:0px;padding:0px">
      <table width="100%"  border="0" bgcolor="#C2DC71" >
        <tr align="left">
          <td width="10%">编号</td>
          <td width="40%"><input name="T_ID" type="text" size="30"/></td>
          <td width="9%">尺寸</td>
          <td width="41%"><input type="text" name="T_SIZE" size="30"/></td>
        </tr>
        <tr align="left">
          <td>所属人或单位</td>
          <td><input type="text" name="T_USER_ID" size="30"/><a href="customer_list.php" target="_blank">查询</a></td>
          <td>分类</td>
          <td><select name="T_CLASS">
              <option value="山水">山水</option>
              <option value="花鸟">花鸟 </option>
              <option value="人物">人物 </option>
              <option value="工笔">工笔 </option>
              <option value="书法">书法 </option>
              <option value="油画">油画 </option>
              <option value="篆刻">篆刻 </option>
              <option value="其他" selected="selected">其他 </option>
            </select></td>
        </tr>
        <tr align="left" style="display:none;">
          <td>Payment</td>
          <td><input type="text" name="T_PAYMENT" size="30"/></td>
          <td>HOT</td>
          <td><input type="text" name="T_HOT" size="30"/></td>
        </tr>
        <tr align="left" style="display:none;">
          <td>Color</td>
          <td><input type="text" name="T_COLOR" size="30"/></td>
          <td>Material</td>
          <td><input type="text" name="T_CAI_LIAO" size="30"/></td>
        </tr>
        <tr align="left">
          <td>状态</td>
          <td><input type="radio" name="T_STATUS" value="0" <?php  if ($row["T_STATUS"]==0) echo "checked";  ?> />
有货
  <input type="radio" name="T_STATUS" value="1" <?php  if ($row["T_STATUS"]==1) echo "checked";?> />
暂时缺货
<input type="radio" name="T_STATUS" value="2" <?php  if ($row["T_STATUS"]!=0 && $row["T_STATUS"]!=1) echo "checked";?> />
永久缺货
<input type="radio" name="T_STATUS" value="2" <?php  if ($row["T_STATUS"]!=0 && $row["T_STATUS"]!=1) echo "checked";?> />
销售出去了 </td>
          <td>销售价格</td>
          <td><input type="text" name="T_PRICE" size="30"/></td>
        </tr>
        <tr align="left" style="display:none;">
          <td>Mini order </td>
          <td><input type="text" name="T_MIMI_OLDER" size="30" /></td>
          <td>Memo</td>
          <td><input type="text" name="T_BEIZHU" size="30" /></td>
        </tr>
        <tr align="left" style="display:none;">
          <td>Buy price </td>
          <td><input type="text" name="T_JINHUO_PRICE" size="30" />
            ￥ </td>
          <td>VIP</td>
          <td><input type="radio" name="IS_VIP" value="true"/>
Only for VIP
  <input name="IS_VIP" type="radio" value="false"/>
For all customer </td>
        </tr>
        <tr align="left">
          <td valign="top">图片</td>
          <td colspan="3" align="left">
		  
		  <script type="text/javascript">
		  function AddUploadForm()
		  {
		  	var nTotalPicShowed=0;
			var nMaxPicture=12;
		  	nTotalPicShowed=parseInt(document.getElementById('nTotalPicShowed').value, 10); 
			if (nTotalPicShowed>=nMaxPicture)
				return false;
			nTotalPicShowed=document.getElementById('nTotalPicShowed').value=nTotalPicShowed+1; 
		  	document.getElementById('addPicForm'+nTotalPicShowed).style.display='block'; 
			if (nTotalPicShowed==nMaxPicture)
				document.getElementById('AddPicture').style.display='none';
		  }
		  </script>
		  <div>
		  <?php
		  $nMaxPicLoadForm=12;
		  $nPictureTotal=1;
		  for ($i=1; $i<=$nMaxPicLoadForm; $i++)
		  {
		  ?><div style="display:<?php if ($i<=$nPictureTotal)  echo "block"; else echo "none";?>" id="addPicForm<?php  echo $i;?>">
		  <table width="100%" border="0">
            <tr>
              <td><input name="PicUploadLocalFile<?php  echo $i;?>" type="file" id="PicUploadLocalFile<?php  echo $i;?>"  style="display:block" size="50"/></td>
              </tr>
          </table>
		  </div>
		  <?php
		  }
		  ?>
</div></td>
        </tr>
        <tr align="left">
          <td>&nbsp;</td>
          <td colspan="3" align="left"><input type="button" value="添加图片" id="AddPicture" onclick="AddUploadForm(); return false;" />
            <input type="hidden" name="nTotalPicShowed" value="1"/></td>
        </tr>
        <tr align="left">
          <td>&nbsp;</td>
          <td colspan="3" align="center"><input name="Submit" type="submit" id="Submit" value="添加作品" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
