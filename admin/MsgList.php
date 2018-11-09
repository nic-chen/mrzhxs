<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<style type="text/css">
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.STYLE1 {color: #FFFFFF}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style></head>

<body>
<script>
window.parent['left'].location.reload();
</script>
<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");

include("MessageTopBar.php");
?>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
  <tr>
    <td width="1" height="25" bgcolor="#669B31"><div style="width:100px;">&nbsp;&nbsp;</div></td>
    <td width="900" height="25" bgcolor="#669B31"><table width="250" height="23" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100" align="center" bgcolor="C2DC71"><?php echo REPLIED;?></td>
        <td width="150" align="center" bgcolor="FFFF99"><?php echo WATING_REPLY;?></td>
      </tr>
    </table></td>
    <td width="1" height="25" bgcolor="#669B31"><div style="width:200px;">&nbsp;</div></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td  height="25" class="STYLE1"><?php echo NAME;?></td>
    <td  height="25" class="STYLE1"><?php echo CONTECT;?></td>
    <td  height="25" align="right">&nbsp;</td>
  </tr>
  <?php
  	$cur_page=$_GET["page"];
	$msg_type=$_GET["type"];
	
	if (empty($cur_page) || $cur_page<1)
		$cur_page=1;
	$SQL = new SQL;
	$sSql=" from customerleavemsg where 1=1 ";
	if ($msg_type=="buyer")
	{
		$sSql=$sSql." and T_ROLE = 1 and T_TYPE=0 ";
	}
	else if ($msg_type=="seller")
	{
		$sSql=$sSql." and T_ROLE = 0 and T_TYPE=0 ";
	}
	else if ($msg_type=="website")
	{
		$sSql=$sSql." and T_TYPE=1 ";
	} 
	else
	{
		$sSql=$sSql." and T_TYPE=0 ";
	}

	$sSql=$sSql." order by T_IS_REPLY ASC, T_TIME DESC";
//echo "<br>$sSql<br>";
	$result = $SQL->Query("select count(*) as nTotal ".$sSql);

//die("select count(*) as nTotal ".$sSql."<br>");	

	$nItemTotal=0;
	if ($row=mysqli_fetch_array($result))
		$nItemTotal=$row["nTotal"];
	else
		$nItemTotal=0;

	$result = $SQL->Query("select * ".$sSql." LIMIT ".(($cur_page-1)*30).", 30");
//echo "<br>"."select * ".$sSql." LIMIT ".(($cur_page-1)*30).", 30"."<br>";
	while(($row=mysqli_fetch_array($result)))
	{
  ?>
  <tr bgcolor="<?php if ($row["T_IS_REPLY"]) echo "#C2DC71"; else  echo "#FFFF99";?>" onMouseOver="this.bgColor='#CDD4BD';" onMouseOut="this.bgColor='<?php if ($row["T_IS_REPLY"]) echo "#C2DC71"; else  echo "#FFFF99"; ?>'">
    <td><?php echo $row["T_CUSTOMER_NIKI_NAME"]; ?></td>
    <td height="35" ><?php echo $row["T_MSG"]; ?>&nbsp;&nbsp;</td>
	<?php
	if ($row["T_TYPE"]==0)
	{
	?>
    <td align="center"><a href="MsgReply.php?ID=<?php echo $row["T_INDEX"];?>"><?PHP echo REPLY;?></a>&nbsp;|&nbsp;<a href="updateData.php?COM_ID=1011&MSG_ID=<?PHP echo $row["T_INDEX"];?>&ACTION=2"><?php echo SET.REPLIED;?></a>&nbsp;|&nbsp;<a href="updateData.php?COM_ID=1011&MSG_ID=<?PHP echo $row["T_INDEX"];?>&ACTION=1" onclick="if  (confirm('Please confirm you will delete this message!'))  return true; else  return false;"><?php echo DO_DELETE;?></a>&nbsp;|&nbsp;<a href="<?php if ($row["T_URL"] == "mrzhxs.com") echo "../?p=product&type=ItemDetail&T_ID="; else echo "http://".$row["T_URL"]."?p=ItemDetail&T_ID="; ?><?PHP echo $row["T_PRU_ID"];?>" target="_blank"><?php echo VIEW;?></a></td>
	<?php
	}
	else
	{
	?>
	<td align="center"><a href="viewWebsiteMsg.php?ID=<?PHP echo $row["T_INDEX"];?>" target="_blank"><?php echo VIEW;?></a></td>
	<?php
	}
	?>
  </tr>
  <?php
  	}
  ?>
</table>
<?php 
		if ($cur_page>1)
			$Pree=$cur_page-1;
		else
			$Pree=1;
	
		if ($nItemTotal % 30 == 0)
			$pages = $nItemTotal/30;
		else
			$pages = ($nItemTotal-$nItemTotal%30)/30 + 1;
		
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
<li class="long"><a href="<?php echo "?type=$msg_type&page=1"; ?>">First</a></li>
		<?php 
		}
		if ($curPage>1)
		{
		?>
<li class="long"><a href="<?php echo "?type=$msg_type&page=".($curPage-1); ?>">Pre</a></li>
		<?php 
		}

		for($i=$nStartPage; $i<=$nEndPage; $i++)
		{
			if ($i==$curPage)
				echo "<li>".$i."</li>";
			else
			{
		?>
<li><a href="<?php echo "?type=$msg_type&page=".$i;?>"><?php echo $i; ?></a></li>
		<?php 
			}
		}
		if ($curPage<$totalpages)
		{
		?>
<li class="long"><a  href="<?php echo "?type=$msg_type&page=".($curPage+1);?>">Next</a></li>
		<?php 
		}
		if ($nEndPage<$totalpages)
		{
		?>
<li class="long"><a href="<?php echo "?type=$msg_type&page=".$totalpages;?>">End</a></li>
		<?php 
		}
		?>
		</ul>
</div>
</body>
</html>
