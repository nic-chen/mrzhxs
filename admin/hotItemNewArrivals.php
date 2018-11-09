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
<?php include("hotItemMenu.php"); ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="left" bgcolor="#669B31">&nbsp;<span class="ItemManageHead">New arraivals</span></td>
  </tr>
  <tr>
    <td align="center"><form action="updateData.php?COM_ID=1019" method="post" enctype="multipart/form-data" name="frEditFrame" id="frEditFrame"  style="margin:0px;padding:0px">
      <table width="100%"  border="0" bgcolor="#C2DC71" >
      <?php
	  $SQL = new SQL;
	  $nNewArrivalTotal=20;
	  $result = $SQL->Query("select * from T_HOT_ITEM where T_HOT_TYPE='index_new_arraivals' and  T_URL='".GetCurrentWebHost()."' order by T_ORDER ASC, T_ID");
	  $bEnd=false;
      for ($i=0; $i<$nNewArrivalTotal; $i++)
	  {
	  	if (!$bEnd && $row=mysqli_fetch_array($result))
		{
			$pruID=$row["T_ID"];
			$pruOrder=$row["T_ORDER"];
		}
		else
		{
			$pruID=$pruOrder="";
			$bEnd=true;
		}
	  ?>
        <tr align="left">
          <td width="20%" height="26" align="right" valign="bottom">New arrivals [<?php printf("%02d", $i+1);?>]&nbsp;</td>
          <td width="80%" align="left" valign="bottom"> ID:
            <input type="text" name="ID<?php echo $i;?>" id="ID<?php echo $i;?>" value="<?php echo $pruID;?>"/>
            Order:
            <input name="ORDER<?php echo $i;?>" type="text" id="ORDER<?php echo $i;?>"  value="<?php echo $pruOrder;?>" size="6"/></td>
        </tr>
      <?php
      }
	  ?>
        <tr align="left">
          <td width="20%" align="right">&nbsp;</td>
          <td width="80%" align="left">&nbsp;
            <input name="Submit" type="submit" id="Submit" value="Update new arriavals" />
            <input type="hidden" name="nTotal" id="nTotal" value="<?php echo $nNewArrivalTotal;?>"/></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
