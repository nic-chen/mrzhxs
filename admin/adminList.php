<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
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
</style>
-->
</style></head>

<body>
<?php
$thisPage=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF'])-strrpos($_SERVER['PHP_SELF'], '/')-1);

$nStep=$_GET["step"];
$strSearchWord=$_GET["key"];
?>
<? include("admin_top_menu.php"); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
  <tr>
    <td width="1" height="25" bgcolor="#669B31"><div style="width:100px;">&nbsp;&nbsp;</div></td>
    <td width="900" height="25" bgcolor="#669B31">&nbsp;</td>
    <td width="1" height="25" bgcolor="#669B31"><div style="width:200px;">&nbsp;</div></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td  height="25" class="STYLE1">Login Name </td>
    <td  height="25" class="STYLE1">Memo Infomation </td>
    <td  height="25" align="center" class="STYLE1">Action</td>
  </tr>
  <?php
  include_once('settings.php');
  include_once(LIBPATH."lib.php");
  
  $SQL = new SQL;
  
  	$cur_page=$_GET["page"];
	if (empty($cur_page) || $cur_page<1)
		$cur_page=1;

	$sSql="select * from admin order by T_ID ASC LIMIT ".(($cur_page-1)*30).", 30";
	$result = $SQL->Query($sSql);
	$nItemTotal = mysqli_num_rows($result);

	while(($row=mysqli_fetch_array($result)))
	{
  ?>
  <tr bgcolor="#C2DC71" onMouseOver="this.bgColor='#CDD4BD';" onMouseOut="this.bgColor='#C2DC71'">
    <td><?php echo $row["T_NAME"]; ?></td>
    <td height="35" ><?php echo $row["T_MEMO"]; ?>&nbsp;&nbsp;</td>
    <td align="center"><a href="updateData.php?COM_ID=1012&ID=<?PHP echo $row["T_ID"];?>&ACTION=1" onclick="if  (confirm('Please confirm you will delete [<?php echo $row["T_NAME"]; ?>]!'))  return true; else  return false;">Delete</a>&nbsp;|&nbsp;<a href="adminDetail.php?ID=<?PHP echo $row["T_ID"];?>">Change</a></td>
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
</div>
</body>
</html>
