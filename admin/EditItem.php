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
<?php
			  $pru_id=$_GET["ID"];
			  
			  $SQL=new SQL;
			  $result = $SQL->Query("select * from pru where T_ID='$pru_id'");
			  $row=mysqli_fetch_array($result);
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="left" bgcolor="#669B31">&nbsp;<span class="ItemManageHead">Edit item</span></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="2" colspan="2" bgcolor="#ECEDE9"></td>
        </tr>
      <tr>
        <td width="6%" bgcolor="#ECEDE9">&nbsp;</td>
        <td width="94%" bgcolor="#ECEDE9"><img src="http://<?PHP  echo GetCurrentWebHost();?>/images/pru/<?php
			  if ($row["Version"]==1)
			  {
				$strTemppp=Split("-", $pru_id);
				echo trim($strTemppp[0])."/".trim($strTemppp[1]);
			  }
			  else 
			   echo Trim($pru_id);
			  ?>/head.jpg"/></td>
      </tr>
      <tr>
        <td height="2" colspan="2" bgcolor="#ECEDE9"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><form action="updateData.php?COM_ID=1009" method="post" enctype="multipart/form-data" name="frEditFrame" id="frEditFrame"  style="margin:0px;padding:0px">
      <table width="100%"  border="0" bgcolor="#C2DC71" >
        <tr align="left">
          <td width="10%">编号</td>
          <td width="40%"><input name="T_ID" type="hidden" value="<?php echo $row["T_ID"];?>" size="30" readonly="true" /><?php echo $row["T_ID"];?></td>
          <td width="9%">尺码</td>
          <td width="41%"><input type="text" name="T_SIZE" size="30" value="<?php echo $row["T_SIZE"]; ?>" />
            <select name="T_SIZE_DANWEI" style="display:none">
            <?php $selected = " selected=\"selected\""; ?>
              <option value="厘米(CM)" <?php if ($row["T_SIZE_DANWEI"]=="厘米(CM)") echo $selected; ?>>厘米(CM)</option>
              <option value="平尺" <?php if ($row["T_SIZE_DANWEI"]=="平尺") echo $selected; ?>>平尺</option>
              <option value="其他" <?php if ($row["T_SIZE_DANWEI"]=="其他") echo $selected; ?>>其他</option>
            </select></td>
        </tr>
        <tr align="left">
          <td>所属人或单位</td>
          <td>
            <input type="text" name="T_USER_ID" size="30" value="<?php echo $row["T_USER_ID"]; ?>" />
            <a href="customer_list.php" target="_blank">查询</a></td>
          <td>分类</td>
          <td><select name="T_CLASS">
			<?php
			$selected = "selected=\"selected\"";
			$isSelected = false;
			?>
              <option value="山水" <?php if ($row["T_CLASS"]=="山水") echo $selected; $isSelected=true;?>>山水</option>
              <option value="花鸟" <?php if ($row["T_CLASS"]=="花鸟") echo $selected; $isSelected=true;?>>花鸟 </option>
              <option value="人物" <?php if ($row["T_CLASS"]=="人物") echo $selected; $isSelected=true;?>>人物 </option>
              <option value="工笔" <?php if ($row["T_CLASS"]=="工笔") echo $selected; $isSelected=true;?>>工笔 </option>
              <option value="书法" <?php if ($row["T_CLASS"]=="书法") echo $selected; $isSelected=true;?>>书法 </option>
              <option value="油画" <?php if ($row["T_CLASS"]=="油画") echo $selected; $isSelected=true;?>>油画 </option>
              <option value="篆刻" <?php if ($row["T_CLASS"]=="篆刻") echo $selected; $isSelected=true;?>>篆刻 </option>
              <option value="其他" <?php if ($row["T_CLASS"]=="其他") echo $selected; $isSelected=true;?>>其他 </option>
            </select>            </td>
        </tr>
        <tr align="left" style="display:none">
          <td>类型</td>
          <td><label>
            <input type="radio" name="T_STYLE_MEN" value="0" <?php  if ($row["T_STYLE_MEN"]==0)  echo "checked";  ?> />
            unsex
            <input type="radio" name="T_STYLE_MEN" value="1" <?php  if ($row["T_STYLE_MEN"]==1) echo "checked";  ?> />
            men
            <input type="radio" name="T_STYLE_MEN" value="2" <?php  if ($row["T_STYLE_MEN"]==2) echo "checked";  ?> />
            women
            <input type="radio" name="T_STYLE_MEN" value="-1" <?php  if (!($row["T_STYLE_MEN"]==0 ||  $row["T_STYLE_MEN"]==1 || $row["T_STYLE_MEN"]==2 ))
				echo "checked";  ?> />
            unknown </label></td>
          <td>进货价格</td>
          <td><input type="text" name="T_JINHUO_PRICE" size="30" value="<?php echo $row["T_JINHUO_PRICE"]; ?>" />
￥</td>
        </tr>
        <tr align="left" style="display:none;">
          <td>Color</td>
          <td><input type="text" name="T_COLOR" size="30"  value="<?php echo $row["T_COLOR"]; ?>" /></td>
          <td>Material</td>
          <td><input type="text" name="T_CAI_LIAO" size="30" value="<?php echo $row["T_CAI_LIAO"]; ?>" /></td>
        </tr>
        <tr align="left" style="display:none">
          <td>LARGE PICTURE </td>
          <td><input type="radio" name="T_DETAIL_HAVE" value="1" <?php  if ($row["T_DETAIL_HAVE"]) echo "checked";  ?> />
            YES
              <input name="T_DETAIL_HAVE" type="radio" value="0" <?php  if (!$row["T_DETAIL_HAVE"]) echo "checked";  ?> />
            NO</td>
          <td>VIP</td>
          <td><input type="radio" name="IS_VIP" value="true" <?php  if ($row["IS_VIP"]) echo "checked";  ?> />
            Only for VIP
              <input name="IS_VIP" type="radio" value="false" <?php  if (!$row["IS_VIP"]) echo "checked";  ?> />
            For all customer </td>
        </tr>
        <tr align="left">
          <td>状态</td>
          <td><input type="radio" name="T_STATUS" value="0" <?php  if ($row["T_STATUS"]==0) echo "checked";  ?> />
            有货
              <input type="radio" name="T_STATUS" value="1" <?php  if ($row["T_STATUS"]==1) echo "checked";?> />
暂时缺货
<input type="radio" name="T_STATUS" value="2" <?php  if ($row["T_STATUS"]!=0 && $row["T_STATUS"]!=1) echo "checked";?> />
永久缺货</td>
          <td>点击量</td>
          <td><input type="text" name="T_PAYMENT" size="30" value="<?php echo $row["T_PAYMENT"]; ?>" style="display:none"/>
            <input type="text" name="T_HOT" size="30" value="<?php echo $row["T_HOT"]; ?>" /></td>
        </tr>
        <tr align="left">
          <td>销售价格 </td>
          <td><label>
            <input type="text" name="T_PRICE" size="30" value="<?php echo $row["T_PRICE"]; ?>" />
            $</label></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr align="left" style="display:none;">
          <td>Mini order </td>
          <td><input type="text" name="T_MIMI_OLDER" size="30" value="<?php echo $row["T_MIMI_OLDER"]; ?>" /></td>
          <td>Create date</td>
          <td><input type="text" name="T_DENG_JI_TIME" size="30" value="<?php echo $row["T_DENG_JI_TIME"] ;?>" readonly="true" /></td>
        </tr>
        <tr align="left" style="display:none;">
          <td>备注</td>
          <td colspan="3"><input size="30" name="T_BEIZHU" type="text" value="<?php echo $row["T_BEIZHU"];?>"/>
            品牌
            <input type="text" name="T_CHILD" size="30"  value="<?php echo $row["T_CHILD"]; ?>" /></td>
          </tr>
        <tr align="left">
          <td valign="top">picture</td>
          <td colspan="3" align="left">
		  <?php
		  $nMaxPicLoadForm=20;
		  $nPictureTotal=0;
		  $picturePath=array();
		  
		  $pictureMainPath="../".GetItemPathInfo($row["T_ID"], $row["Version"]);
		  if (strlen($row["T_DETAIL_PICTURE"]."")>0)
		  {
		  	$picturePath=explode("?????", trim($row["T_DETAIL_PICTURE"], "?????"));
			$nPictureTotal=count($picturePath);
		  }
		  else
		  {
		  	$nPictureTotal=$row["T_XIJIE_PIC"];
		  	for ($i=0; $i<$nPictureTotal; $i++ )
			{
				$picturePath[$i]=($i+1)."_o.jpg";
			}
		  }
		  ?>
		  <script type="text/javascript">
		  function ChangeUpdateType(nIndex, nType)
		  {
		  	  if (nType==0) 
			  {
			  	document.getElementById('PicUploadURL'+nIndex).style.display='none'; 
				document.getElementById('PicUploadLocalFile'+nIndex).style.display='block'; 
			  } 
			  else 
			  {
			  	document.getElementById('PicUploadLocalFile'+nIndex).style.display='none'; 
				document.getElementById('PicUploadURL'+nIndex).style.display='block'; 
			  }
		  }
		  function AddUploadForm()
		  {
		  	var nTotalPicShowed=0;
			var nMaxPicture=<?php echo $nMaxPicLoadForm;?>;
		  	nTotalPicShowed=parseInt(document.getElementById('nTotalPicShowed').value, 10); 
			if (nTotalPicShowed>=nMaxPicture)
				return false;
			nTotalPicShowed=document.getElementById('nTotalPicShowed').value=nTotalPicShowed+1; 
		  	document.getElementById('addPicForm'+nTotalPicShowed).style.display='block'; 
			document.getElementById('ItemAvaliable'+nTotalPicShowed).value=1; 
			if (nTotalPicShowed==nMaxPicture)
				document.getElementById('AddPicture').style.display='none';
		  }
		  function ChangeItemAvaliable(nIndex)
		  {
		  	var nAvaliable=0;
		  	nAvaliable=parseInt(document.getElementById('ItemAvaliable'+nIndex).value, 10); 
			if (nAvaliable==1)
			{
				document.getElementById('changeItemAvaliable'+nIndex).src="images/unavaliable.jpg";
				document.getElementById('ItemAvaliable'+nIndex).value=0;
				document.getElementById('PicUploadURL'+nIndex).disabled=true; 
				document.getElementById('PicUploadLocalFile'+nIndex).disabled=true; 
				document.getElementById('nTotalPicShowed').disabled=true; 
			}
			else
			{
				document.getElementById('changeItemAvaliable'+nIndex).src="images/avaliable.jpg";
				document.getElementById('ItemAvaliable'+nIndex).value=1;
				document.getElementById('PicUploadURL'+nIndex).disabled=false; 
				document.getElementById('PicUploadLocalFile'+nIndex).disabled=false; 
				document.getElementById('nTotalPicShowed').disabled=false; 
			}
		  }
		  </script>
		  <div>
		  <?php
		  for ($i=1; $i<=$nMaxPicLoadForm; $i++)
		  {
		  ?><div >
		  <table width="100%" border="0" style="display:<?php if ($i<=$nPictureTotal)  echo "block"; else echo "none";?>" id="addPicForm<?php  echo $i;?>">
            <tr>
              <td width="63%">
                <select name="PicUploadType<?php  echo $i;?>" onchange="ChangeUpdateType(<?php  echo $i;?>, this.value)">
                  <option value=0 >upload</option>
                  <option value=1 <?php if ($i<=$nPictureTotal)  echo "selected=\"selected\""; ?>>URL</option>
                </select>
                <input type="text" name="PicUploadURL<?php  echo $i;?>" id="PicUploadURL<?php  echo $i;?>" style="display:<?php if ($i<=$nPictureTotal)  echo "block"; else echo "none"; ?>"  size="50" value="<?php if ($i<=$nPictureTotal) echo $picturePath[$i-1];?>"/>
                <input name="PicUploadLocalFile<?php  echo $i;?>" type="file" id="PicUploadLocalFile<?php  echo $i;?>"  style="display:<?php if ($i<=$nPictureTotal)  echo "none"; else echo "block"; ?>" size="50"/></td>
              <td width="37%"><img id="changeItemAvaliable<?php  echo $i;?>" src="images/avaliable.jpg" width="71" height="20" onclick="ChangeItemAvaliable(<?php  echo $i;?>); return false;"/>
                <input type="hidden" name="ItemAvaliable<?php  echo $i;?>" value=<?php if ($i<=$nPictureTotal)  echo "1"; else echo "0"; ?> />
                <input type="hidden" name="ItemPicNumOriginal<?php  echo $i;?>" value="<?php  echo $picturePath[$i-1];?>"/></td>
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
            <input type="hidden" name="nTotalPicShowed" value="<?php  echo $nPictureTotal;?>"/></td>
        </tr>
        <tr align="left">
          <td>&nbsp;</td>
          <td colspan="3" align="center"><input name="Submit" type="submit" id="Submit" value="提交" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
