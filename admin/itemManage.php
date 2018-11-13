<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
.STYLE1 {color: #FFFFFF}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	FONT: 12px Verdana,Arial,sans-serif,"Times New Roman","sans-serif";
}
-->
</style></head>

<body>
<?php include("manageItemMenu.php"); ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#669B31">
  <tr>
    <td height="25" bgcolor="#669B31">&nbsp;&nbsp;<span class="STYLE1">Manage item </span></td>
    <td height="25" colspan="3" bgcolor="#669B31"><table width="200" height="23" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100" align="center" bgcolor="#C2DC71">Avaliable one </td>
        <td width="100" align="center" bgcolor="#FFFF99">Unavaliable one </td>
      </tr>
    </table></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td width="71" height="25" align="center" bgcolor="#C2DC71" class="STYLE1">Picture</td>
    <td height="25" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%" class="STYLE1">&nbsp;&nbsp;Detail info </td>
        <td width="84%" align="right"><form id="form" name="form" method="get" action=""  style="margin:0px;padding:0px">
          <input type="text" name="keyWord" value="<?php echo $_GET["keyWord"]; ?>"/>
          <select name="LEAVE_STATUS">
            <option value=0 <?php if ($_GET["LEAVE_STATUS"]==0) echo "selected=\"selected\""; ?>>All ones</option>
            <option value=1 <?php if ($_GET["LEAVE_STATUS"]==1) echo "selected=\"selected\""; ?>>Avaliable ones</option>
            <option value=2 <?php if ($_GET["LEAVE_STATUS"]==2) echo "selected=\"selected\""; ?>>Not Avaliable ones</option>
            <option value=3 <?php if ($_GET["LEAVE_STATUS"]==3) echo "selected=\"selected\""; ?>>Lossed picture</option></select>
          <input type="submit" name="Submit" value="Search" />
                                </form>        </td>
      </tr>
    </table></td>
  </tr>
  <form name="itemManaFrm" id="itemManaFrm" action="" method="post" style="margin:0px;padding:0px">
  <?php
  	$SQL=new SQL;
	$cur_page=$_GET["page"];
	if (empty($cur_page) || $cur_page<1)
		$cur_page=1;
	$sSql = "select * from pru ";
	$keyword=$_GET["keyWord"];
	$isHaveAnd=false;
	$isHaveWhere=false;
	if (!empty($_GET["keyWord"]))
	{
		if (!$isHaveWhere)
		{
			$sSql=$sSql." where ";
			$isHaveWhere=true;
		}
		
		$pru_class_fenge = explode(' ', trim($keyword));  /* split into parts*/

		foreach ($pru_class_fenge as $word)
		{
			if ($word=="style" ||  $word=="and" ||  $word=="or" )
				;
			else 
			{
				if ($isHaveAnd==false)
				{
					if (strtoupper($word)=="WOMEN" || strtoupper($word)=="FEMALE")
						$sSql =$sSql."  T_STYLE_MEN=2 ";
					elseif (strtoupper($word)=="MEN" || strtoupper($word)=="MALE")
						$sSql =$sSql."  T_STYLE_MEN=1 ";
					else 
						$sSql=$sSql." (T_ID like '%".$word."%' OR T_CHILD like '%".$word."%' OR T_CLASS like '%".$word."%' OR KEY_WORD like '%".$word."%')";
					$isHaveAnd=true;
				}
				else
				{
					if (strtoupper($word)=="WOMEN" || strtoupper($word)=="FEMALE")
						$sSql =$sSql." and T_STYLE_MEN=2 ";
					elseif (strtoupper($word)=="MEN" || strtoupper($word)=="MALE")
						$sSql =$sSql." and T_STYLE_MEN=1 ";
					else 
						$sSql=$sSql." and (T_ID like '%".$word."%' OR T_CHILD like '%".$word."%' OR T_CLASS like '%".$word."%' OR KEY_WORD like '%".$word."%')";
				}
			}
		}
		
		$isHaveAnd=true;
		
	}
	$itemStatus=$_GET["LEAVE_STATUS"];
	
	if ($itemStatus==0)
	{
		;
	}
	elseif ($itemStatus==1)
	{
		if (!$isHaveWhere)
		{
			$sSql=$sSql." where ";
			$isHaveWhere=true;
		}
		if ($isHaveAnd)
			$sSql=$sSql." and ";
		$sSql=$sSql." T_STATUS=0 ";
		$isHaveAnd=true;
	}
	elseif ($itemStatus==2)
	{
		if (!$isHaveWhere)
		{
			$sSql=$sSql." where ";
			$isHaveWhere=true;
		}
		if ($isHaveAnd)
			$sSql=$sSql." and ";
		$sSql=$sSql." T_STATUS<>0 ";
		$isHaveAnd=true;
	}
	
	$result = $SQL->Query($sSql);
	
	if ($itemStatus<>3)
	{
		$sSql=$sSql." order by T_ID ASC LIMIT ".(($cur_page-1)*15).",15";
	}
	//echo "$sSql <br>";
	$result = $SQL->Query($sSql);
	
	$nIndex=0;
	while(($row=mysqli_fetch_array($result)))
	{
		if ($itemStatus==3)
		{
			//echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";
			if (file_exists(GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg"))
			{
				//echo file_exists(GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg");
				continue;
			}
			if ($nIndex>15)
				break;
		}
  ?>
  
  <tr bgcolor="<?php if ($row["T_STATUS"]==0 ) echo "#C2DC71"; else echo "#FFFF99"; ?>" onMouseOver="this.bgColor='#CDD4BD';" onMouseOut="this.bgColor='<?php if ($row["T_STATUS"]==0 ) echo "#C2DC71"; else  echo "#FFFF99"; ?>'">
    <td align="center" valign="middle"><a href="../detail_pic.php?ID=<?php echo $row["T_ID"]; ?>" target="_blank"><img src="http://<?PHP  echo GetCurrentWebHost();?>/images/pru/<?php
			  if ($row["Version"]==1)
			  {
				$strTemppp=explode("-", $row["T_ID"]);
				echo trim($strTemppp[0])."/".trim($strTemppp[1]);
			  }
			  else 
			   echo Trim($row["T_ID"]);
			  ?>/head.jpg" border="0"></a></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="19%" height="15" align="right">编号: </td>
        <td width="81%" height="15"><?php echo $row["T_ID"]; ?>&nbsp;</td>
      </tr>
      <tr>
        <td height="15" align="right">分类:</td>
        <td height="15"><?php echo $row["T_CLASS"]; ?></td>
      </tr>
      <tr>
        <td height="15" align="right">尺寸: </td>
        <td height="15"><?php echo $row["T_SIZE"]; ?></td>
      </tr>

    </table></td>
    <td align="right"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left"><a href="../?p=product&type=ItemDetail&T_ID=<?php echo $row["T_ID"]; ?>" target="_blank">查看</a></td>
      </tr>
      <tr>
        <td align="left"><a href="EditItem.php?ID=<?php echo $row["T_ID"]; ?>">修改</a></td>
      </tr>
    </table></td>
    <td align="center"><input type="checkbox" name="CBOX<?php echo $nIndex;?>" value="selected" />
    <input type="hidden" name="nItemID<?php echo $nIndex;?>" value="<?php echo $row["T_ID"]; ?>"/></td>
  </tr>
  <?php
  	$nIndex++;
  	}
  ?>
  <tr bgcolor="#FFFF99" onMouseOver="this.bgColor='#CDD4BD';" onMouseOut="this.bgColor='#FFFF99'">
    <td colspan="4" align="right" valign="middle"><input type="hidden" name="nItemTotal" value="<?php echo $nIndex; ?>"/>
      <input id=sb type="submit" value="设为可用" onclick="document.itemManaFrm.action='updateData.php?COM_ID=1006'; "/>
      <input id=sb type="submit" value="设为不可用" onclick="document.itemManaFrm.action='updateData.php?COM_ID=1007';" />
      <input id=sb type="submit" value="删除" onclick="if  (confirm('Please confirm you will delete the item you have seleted!'))  document.itemManaFrm.action='updateData.php?COM_ID=1008'; else  return false;"/>
      <script type="text/javascript">
		  function chooseAllCheckBox(IsSelect)
		  {
			  var i=0, j=0; 
			  var str;
			  str=document.itemManaFrm.nItemTotal.value;
			  j=parseInt(str, 10);
			  for (i=0; i<j; i++)
			  {
				document.getElementById("CBOX"+i).checked = IsSelect;
			  } 
			  return false;
		  }
		  </script>
      <input id=sb type="submit" value="全选" onclick="chooseAllCheckBox(true); return false;"/>
      <input id=sb type="reset" value="取消全选" onclick="chooseAllCheckBox(false); return false;"/></td>
  </tr>
  </form>
</table>
<?php 
		if ($cur_page>1)
			$Pree=$cur_page-1;
		else
			$Pree=1;
	
		if ($nItemTotal % 15 == 0)
			$pages = $nItemTotal/15;
		else
			$pages = ($nItemTotal-$nItemTotal%15)/15 + 1;
		
		$totalpages=$pages;
		$curPage=$cur_page;
			 
		if ($totalpages<11)
		{
			$nStartPage=1;
			$nEndPage=$totalpages;
		}
		else
		{
			if ($curPage<6)
			{
				$nStartPage=1;
				$nEndPage=10;
			}
			else
			{
				if ($totalpages-$curPage<6)
				{
					$nStartPage=$totalpages-9;
					$nEndPage=$totalpages;
				}
				else
				{
					$nStartPage=$curPage-4;
					$nEndPage=$curPage+5;
				}
			}
		}
		
		//echo "nStartPage=".$nStartPage." curPage=".$curPage." nEndPage=".$nEndPage." totalpages=".$totalpages."<br>";
		?>
		<div class="page">
		<ul>
		<?php 
		if ($nStartPage>1)
		{
		?>
<li class="long"><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&LEAVE_STATUS=".$_GET["LEAVE_STATUS"]."&page=1"; ?>">First</a></li>
		<?php 
		}
		if ($curPage>1)
		{
		?>
<li class="long"><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&LEAVE_STATUS=".$_GET["LEAVE_STATUS"]."&page=".($curPage-1); ?>">Pre</a></li>
		<?php 
		}

		for($i=$nStartPage; $i<=$nEndPage; $i++)
		{
			if ($i==$curPage)
				echo "<li>".$i."</li>";
			else
			{
		?>
<li><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&LEAVE_STATUS=".$_GET["LEAVE_STATUS"]."&page=".$i;?>"><?php echo $i; ?></a></li>
		<?php 
			}
		}
		if ($curPage<$totalpages)
		{
		?>
<li class="long"><a  href="<?php echo "?keyWord=".$_GET["keyWord"]."&LEAVE_STATUS=".$_GET["LEAVE_STATUS"]."&page=".($curPage+1);?>">Next</a></li>
		<?php 
		}
		if ($nEndPage<$totalpages)
		{
		?>
<li class="long"><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&LEAVE_STATUS=".$_GET["LEAVE_STATUS"]."&page=".$totalpages;?>">End</a></li>
		<?php 
		}
		?>
		</ul>
</div>
</body>
</html>
