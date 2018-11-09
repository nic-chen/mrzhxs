<?php
	include_once('settings.php');
	include_once(LIBPATH."lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="daohang_manage.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
</head>

<body>
<?php
include("Shpping_list_Bar.php");
?>
<br>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="1" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr  height=20 bgcolor="#669B31">
    <td height="20" colspan="3" align="left">Shpping list </td>
  </tr>
  <tr  bgcolor="#C2DC71" height="20">
    <td width="20%" height="20">File name </td>
    <td width="30%" height="20">Memo</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <?php
  $timeInfo=time()+14*60*60;
  $strTime=date("Y-m-d H:i:s",$timeInfo);
  $cur_page=(int)$_GET["page"];
  if ($cur_page==0)
	$cur_page=1;
  $orderBy=$_GET["order_by"];
  $orderByDatabase;
  if ($orderBy=="CreateTime")
  	$orderByDatabase="T_CREATE_TIME";
  else if ($orderBy=="UpdateTime")
  	$orderByDatabase="T_UPDATE_TIME";
  else if ($orderBy=="FileName")
  	$orderByDatabase="T_FILE_NAME";
  else
  	$orderByDatabase="T_CREATE_TIME";
  
  $SQL=new SQL;
  $result = $SQL->Query("select * from shipping_list where T_URL='".GetCurrentWebHost()."' order by $orderByDatabase DESC limit  ".(($cur_page-1)*15).", 15;");
  $nShippingListNum = mysqli_num_rows($result);
  if ($nShippingListNum>0)
  {
  	$nItemIndex=0;
  	while($row=mysqli_fetch_array($result))
  	{
		$nItemIndex++;
  ?>
  <form action="updateData.php?COM_ID=2011" method="post" enctype="multipart/form-data" name="form1" id="form1" style="margin:0px;padding:0px">
  <tr bgcolor="#C2DC71">
    <td height="20"><a href="<?php echo $row["T_FILE_PATH"]."/".$row["T_FILE_NAME"]; ?>" target="_blank" title="<?php echo $row["T_FILE_NAME"]; ?>"><?php 
	if (strlen($row["T_FILE_NAME"])>30)
		echo substr($row["T_FILE_NAME"],0,25)."...";
	else
		echo $row["T_FILE_NAME"];?></a></td>
    <td height="20"><input name="Memo" type="text" size="40" value="<?php echo $row["T_MOEO"];?>"/></td>
    <td height="20">
      <input type="file" name="ShppingListFile" />
      <input type="checkbox" name="IsSendMailToPingo" value="true" onclick="if (!this.checked) document.getElementById('Memo<?php  echo $nItemIndex;?>').style.display='none'; else document.getElementById('Memo<?php  echo $nItemIndex;?>').style.display=''; "/>
      Send to Admin
      <input type="submit" name="Submit" value="Submit" style="height:20px;"/>
      <input type="hidden" name="FilePath" value="<?php echo $row["T_FILE_PATH"];?>"/>
      <input type="hidden" name="FileName" value="<?php echo $row["T_FILE_NAME"]; ?>"/></td>
  </tr>
  <tr bgcolor="#C2DC71" id="Memo<?php  echo $nItemIndex;?>" style="display:none">
    <td height="20"><a href="<?php echo $row["T_FILE_PATH"]."/".$row["T_FILE_NAME"]; ?>" target="_blank" title="<?php echo $row["T_FILE_NAME"]; ?>"></a></td>
    <td height="20" colspan="2" align="left" valign="bottom"><textarea name="MemoMail" cols="50" rows="5"></textarea>
      Mail Memo </td>
    </tr>
  </form>
  <?php
  	}
  }
  ?>
  <form action="updateData.php?COM_ID=2009" method="post" enctype="multipart/form-data" name="form1" id="form1" style="margin:0px;padding:0px">
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
  <?php
  
  ?>
   <tr height="20">
     <td height="20" colspan="3">&nbsp;</td>
   </tr>
   <tr height="20">
    <td height="20" colspan="3"><?php 
		$result = mysqli_query("select * from shipping_list where T_URL='".GetCurrentWebHost()."';",$allDateBase);
  		$nShippingListNum = mysqli_num_rows($result);
		
		if ($nShippingListNum % 15 == 0)
			$pages = $nShippingListNum/15;
		else
			$pages = ($nShippingListNum-$nShippingListNum%15)/15 + 1;
			
		$totalpages=$pages;
		$curPage=$pru_page;
			 
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
<li class="long"><a href="<?php echo "?page=1"; ?>">First</a></li>
		<?php 
		}
		if ($curPage>1)
		{
		?>
<li class="long"><a href="<?php echo "?page=".($curPage-1); ?>">Pre</a></li>
		<?php 
		}

		for($i=$nStartPage; $i<=$nEndPage; $i++)
		{
			if ($i==$curPage)
				echo "<li>".$i."</li>";
			else
			{
		?>
<li><a href="<?php echo "?page=".$i;?>"><?php echo $i; ?></a></li>
		<?php 
			}
		}
		if ($curPage<$totalpages)
		{
		?>
<li class="long"><a  href="<?php echo "?page=".($curPage+1);?>">Next</a></li>
		<?php 
		}
		if ($nEndPage<$totalpages)
		{
		?>
<li class="long"><a href="<?php echo "?page=".$totalpages;?>">End</a></li>
		<?php 
		}
		?>
		</ul>
</div><br></td>
  </tr>
</table>
</body>
</html>
