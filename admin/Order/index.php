<?php
	include_once('settings.php');
	include_once(LIBPATH."lib.php");
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="daohang_manage.css" type="text/css" media="screen"/>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include("manageOrderDH.php");
?>
<table width="100%" height="585" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr>
    <td height="585" align="center" valign="top">
      <table width="100%" height="80" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
        <tr align="left" bgcolor="#669B31">
          <td height="20" colspan="15">Main Order Info</td>
        </tr>
        <tr bgcolor="#C2DC71" height="20">
          <td width="10%">Track NO. </td>
          <td width="10%">Name</td>
          <td width="20%">Mail</td>
          <td width="10%">Payment</td>
          <td width="10%">Amount</td>
          <td width="30%">Step</td>
          <td width="10%">Action</td>
        </tr>
        <?php
		 	$userInfo[]=array();
			$cur_admin = new admin;
			if (!$cur_admin->GetAdminIfSignIn())
			{
				echo "pls <a href=\"../index.php\">login<a> in at first!";
				exit;
			}
						
			$cur_page=(int)$_GET["page"];
			if ($cur_page==0)
				$cur_page=1;
			
			$SQL = new SQL;
			$result = $SQL->Query("select * from OFFER_ALL_USER where T_URL='".GetCurrentWebHost()."' order by T_CREATE_TIME DESC, T_DATE DESC, T_SER DESC limit ".(($cur_page-1)*15).", 15;");
			$nPruNum=mysqli_num_rows($result);
			while(($row=mysqli_fetch_array($result)))
			{
		  ?>
        <tr align="left" bgcolor="<?php
		 		if ($row["T_STEP"]==1)
					echo "#FFFFFF";
				elseif ($row["T_STEP"]==2)
					echo "#FF99CC";
				elseif ($row["T_STEP"]==3)
					echo "#FFFF99";
				elseif ($row["T_STEP"]==4)
					echo "#C4E0DE";
				elseif ($row["T_STEP"]==5)
					echo "#99CC00";
		  ?>" onmouseover="this.bgColor='#CDD4BD';" onmouseout="this.bgColor='<?php
		 		if ($row["T_STEP"]==1)
					echo "#FFFFFF";
				elseif ($row["T_STEP"]==2)
					echo "#FF99CC";
				elseif ($row["T_STEP"]==3)
					echo "#FFFF99";
				elseif ($row["T_STEP"]==4)
					echo "#C4E0DE";
				elseif ($row["T_STEP"]==5)
					echo "#99CC00";
		  ?>'"  height="20">
          <?php
			$imp_info=$row["T_IMPORTAND_INFO"];
		  ?>
          <td height="25"><?php echo $row["T_DATE"].$row["T_SER"];?></td>
          <td height="25" title="<?php $row["T_USER_NAME"];?>"><?php
			  if (strlen($row["T_USER_NAME"])>10)
					echo substr($row["T_USER_NAME"],0,8)."...";
			  else
					echo $row["T_USER_NAME"];
			  ?></td>
          <td height="25" title="<?php echo $row["T_MAIL"];?>"><?php
											if (strlen($row["T_MAIL"])>25)
												echo substr($row["T_MAIL"],0,22)."..."; 
											else
												echo $row["T_MAIL"];
											?></td>
          <td height="25" ><?php echo $row["T_PAY_TYPEC"];?></td>
          <td height="25" ><?php echo $row["T_JIAOYI_MONEY"]." ".$row["T_JIAOYI_DANWEI"];?></td>
          <td height="25"><?php 	
				if ($row["T_STEP"]==1)
					echo "Waiting for payment";
				elseif ($row["T_STEP"]==2)
					echo "Prepare item, got payment";
				elseif ($row["T_STEP"]==3)
					echo "Sent out add number";
				elseif ($row["T_STEP"]==4)
					echo "Wait for customer confirm";
				elseif ($row["T_STEP"]==5)
					echo "Finished";
			?>
          </td>
          <td height="25" align="center"><a href="view_change.php?<?php echo "DATE=".$row["T_DATE"]."&SER=".$row["T_SER"]."&STEP=".$row["T_STEP"];?>" title="<?php echo $row["T_IMPORTAND_INFO"];?>">View</a></td>
        </tr>
        <?php
		  	}
		  ?>
      </table>
      <table width="100%"  border="0">
        <tr>
          <td align="left"><?php 
		include(APPROOT."/dbCfg.php");
		$result = $SQL->Query("select count(*) as nTotal from OFFER_ALL_USER where T_URL='".GetCurrentWebHost()."' order by T_DATE DESC;");
		$nItemTotal=0;
		if ($row=mysqli_fetch_array($result))
			$nItemTotal=$row["nTotal"];
		else
			$nItemTotal=0;
		
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
              </div></td>
        </tr>
      </table>
    <br /></td>
  </tr>
</table>
</body>
</html>
