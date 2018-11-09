<html>
<head><link rel="stylesheet" href="gmenu.css">
<script type="text/javascript" src="gmenu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<title>Welcome to pingoTree!</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FAFAFA;
}
.style1 {
	font-size: 9px;
	color: #a7a7a6;
}
.style9 {
	color: #669933;
	font-weight: bold;
}
.style13 {
	color: #000000;
	font-size: 12px;
}
.style16 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
.style25 {color: #FF9966; font-family: "Courier New", Courier, mono; }
a:link {
	text-decoration: none;
	color: #FF9966;
}
a:visited {
	text-decoration: none;
	color: #FF9966;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
body,td,th {
	font-size: 12px;
	color: #666666;
	table-layout:fixed;
	word-break:break-all;
	word-wrap:break-word;
	FONT: 12px/160% Verdana,Arial,sans-serif,"Times New Roman","sans-serif";
}
.hxlad a:active {test:expression(target="_blank");}
.style30 {color: #999999; font-family: "Courier New", Courier, mono; }
p.MsoNormal1 {mso-style-parent:"";
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	font-size:10.5pt;
	font-family:"Times New Roman";
	margin-left:0cm; margin-right:0cm; margin-top:0cm}
p.MsoNormal11 {mso-style-parent:"";
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	font-size:10.5pt;
	font-family:"Times New Roman";
	margin-left:0cm; margin-right:0cm; margin-top:0cm}
p.MsoNormal111 {mso-style-parent:"";
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	font-size:10.5pt;
	font-family:"Times New Roman";
	margin-left:0cm; margin-right:0cm; margin-top:0cm}
-->
</style>
</head>
<body>
<?php include("manageItemMenu.php"); ?>
<table width="774" height="437" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="750" align="center" valign="top"><form name="ItemDetailFrm" method="post" action=""  style="margin:0px;padding:0px">
	   <table width="90%"  border="0" bgcolor="#C2DC71" >
         <tr align="left">
           <td align="center"><textarea name="ItemDetail" cols="100" rows="20"><?php echo $_POST["ItemDetail"]; ?></textarea></td>
          </tr>
         <tr align="left">
           <td align="right">
             <input type="submit" name="Submit" id="Submit" value="Preview" >
&nbsp;&nbsp;&nbsp;
<input type="submit" name="Submit" id="Submit" value="Add to System" onClick="if  (confirm('您确定产品批量录入到数据库里')) 
{
	document.ItemDetailFrm.action='updateData.php?COM_ID=1004';
	return true;
}
else  return false;"></td>
          </tr>
       </table>
      </form><br>
	   <?php
		$pru_ItemDetail=$_POST["ItemDetail"];
		$pru_ItemDetail=trim($pru_ItemDetail);
		if (empty($pru_ItemDetail))
			$need_update=false;
		else
			$need_update=true;

		if ($need_update==true)
		{
			$pru_allInfo=explode("\n",$pru_ItemDetail);
			$nTotal = count($pru_allInfo);
			
			for ($j=0; $j<$nTotal; $j++)
			{
			//echo "[0]=$pruItemDetail[0], [1]=$pruItemDetail[1]";
				if (strlen($pru_allInfo[$j])>5 )
				{
					$pruItemDetail=explode("\t",$pru_allInfo[$j]);
					
	   ?>
	   
	   <table width="90%"  border="0" bgcolor="#C2DC71" cellpadding="1" cellspacing="1" bordercolorlight="#CCCCCC" bordercolordark="#FFFFFF">
         <tr align="left">
           <td width="9%">ID</td>
           <td width="38%"><?php echo $pruItemDetail[0]; ?>&nbsp;</td>
           <td width="11%">SIZE</td>
           <td width="42%"><?php echo $pruItemDetail[6]; ?></td>
         </tr>
         <tr align="left">
           <td>Brand</td>
           <td><?php echo $pruItemDetail[4]; ?></td>
           <td>Class</td>
           <td><?php echo $pruItemDetail[5]; ?></td>
         </tr>
         <tr align="left">
           <td>Style</td>
           <td><?php
		   if ($pruItemDetail[14]==0)
		   	echo "Unsex";
		   elseif ($pruItemDetail[14]==1 )
		   	echo "Men style";
		   elseif ($pruItemDetail[14]==2)
		   	echo "Women style";
			?></td>
           <td>Hot</td>
           <td><?php echo $pruItemDetail[11]; ?></td>
         </tr>
         <tr align="left">
           <td>Color</td>
           <td><?php echo $pruItemDetail[2]; ?></td>
           <td>Material</td>
           <td><?php echo $pruItemDetail[3]; ?></td>
         </tr>
         <tr align="left">
           <td>Large</td>
           <td><?php echo $pruItemDetail[13]; ?></td>
           <td>VIP</td>
           <td><?php echo $pruItemDetail[16]; ?></td>
         </tr>
         <tr align="left">
           <td>Status</td>
           <td><?php
		   if ($pruItemDetail[15]==0)
		   	echo "Avalialbe";
		   elseif  ($pruItemDetail[15]==1 )
		   	echo "Will get them after one week";
		   elseif ($pruItemDetail[15]==2 )
		   	echo "Unavaliable forevery";
		   elseif ($pruItemDetail[15]==3 )
		   	echo "Unavaliable for other";
		   ?></td>
           <td>Payment</td>
           <td><?php echo $pruItemDetail[10]; ?></td>
         </tr>
         <tr align="left">
           <td>Price</td>
           <td><?php echo $pruItemDetail[8]; ?></td>
           <td>Size </td>
           <td><?php echo $pruItemDetail[12]; ?></td>
         </tr>
         <tr align="left">
           <td>Pic toal </td>
           <td><?php echo $pruItemDetail[1]; ?> pcs </td>
           <td>Mini order </td>
           <td><?php echo $pruItemDetail[9]; ?> pcs </td>
         </tr>
         <tr align="left">
           <td>Memo</td>
           <td colspan="3"><?php echo $pruItemDetail[7]; ?></td>
         </tr>
      </table><br>
    <?php
				}
			}
		}
	   ?>    </td>
  </tr>
</table>
</body>
</html>
