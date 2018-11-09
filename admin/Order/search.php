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

<body><?php
include("manageOrderDH.php");
?>
<table width="100%" height="585" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr>
    <td height="585" align="center" valign="top">
        <table width="100%" height="80" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31">
          <tr align="left" bgcolor="#669B31">
            <td height="20" colspan="15" bgcolor="#669B31">Main Order Info</td>
          </tr>
          <tr bgcolor="#C2DC71" height="20">
            <td width="10%">Order ID</td>
            <td width="10%">Name</td>
            <td width="20%" bgcolor="#C2DC71">Mail</td>
            <td width="10%">Payment</td>
            <td width="10%">Amount</td>
            <td width="30%">Step</td>
            <td width="10%">Action</td>
          </tr>
          <?php
		 	$cur_admin = new admin;
			if ($cur_admin->GetAdminIfSignIn())
			{
				echo "pls <a href=\"index.php\">login<a> in at first!";
				exit;
			}
			
			$cur_page=(int)$_GET["page"];
			if ($cur_page==0)
				$cur_page=1;
			
			$keyWord=trim($_GET["keyWord"]);
			$nStep=trim($_GET["step"]);
			
			$sSql = " from OFFER_ALL_USER where ";
			$pru_key_fenge = explode(' ', $keyWord);  /* split into parts*/
		
			foreach ($pru_key_fenge as $word)
			{
					if ($isHaveAnd==false)
					{
						$sSql=$sSql." (CONCAT_WS('',T_DATE, T_SER, ' ', T_USER_NAME, ' ', T_MAIL, ' ', T_JIAOYI_MONEY, ' ', T_CUS_ADDRESS, ' ', T_DINGDAN_MINGXI, ' ', T_CREATE_BEIZHU, ' ', T_PAY_CODE, ' ', T_YUNDAN_NUM, ' ', T_YUNDAN_COM, ' ', T_YUNDAN_BEIZHU, ' ', T_SUB_ORDER_ID, ' ') like '%".$word."%')";
						$isHaveAnd=true;
					}
					else
					{
						$sSql=$sSql." and (CONCAT_WS('',T_DATE, T_SER, ' ', T_USER_NAME, ' ', T_MAIL, ' ', T_JIAOYI_MONEY, ' ', T_CUS_ADDRESS, ' ', T_DINGDAN_MINGXI, ' ', T_CREATE_BEIZHU, ' ', T_PAY_CODE, ' ', T_YUNDAN_NUM, ' ', T_YUNDAN_COM, ' ', T_YUNDAN_BEIZHU, ' ', T_SUB_ORDER_ID, ' ') like '%".$word."%')";
					}
			}
			
			if ($nStep+0==0)
			{
				
			}
			else
			{
				if ($isHaveAnd==false)
				{
					$sSql=$sSql." T_STEP=$nStep";
				}
				else
					$sSql=$sSql." and T_STEP=$nStep";
			}

			$sSql=$sSql." AND T_URL='".GetCurrentWebHost()."' ";
//echo "<br><br><br>$sSql<br><br><br>";
			$SQL = new SQL;
			$result = $SQL->Query("select * ".$sSql." order by T_CREATE_TIME DESC, T_DATE DESC, T_SER DESC limit ".(($cur_page-1)*15).", 15");
			
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
			?>            </td>
            <td height="25" align="center"><a href="view_change.php?<?php echo "DATE=".$row["T_DATE"]."&SER=".$row["T_SER"]."&STEP=".$row["T_STEP"];?>" title="<?php echo $row["T_IMPORTAND_INFO"];?>">View</a></td>
          </tr>
          <?php
		  	}
		  ?>
      </table>
	  <table width="100%" height="80" border="0" cellpadding="0" cellspacing="1" bgcolor="#669B31" style="display:none;">
          <tr align="left" bgcolor="#669B31">
            <td height="20" colspan="15" bgcolor="#669B31">Other found ,, </td>
          </tr>
          <tr bgcolor="#C2DC71" height="20">
            <td width="10%">Order ID</td>
            <td width="10%">Name</td>
            <td width="20%" bgcolor="#C2DC71">Mail</td>
            <td width="10%">Payment</td>
            <td width="10%">Amount</td>
            <td width="30%">Belong to </td>
            <td width="10%">&nbsp;</td>
          </tr>
          <?php
			$isHaveAnd=false;
			
			$cur_page=(int)$_GET["page"];
			if ($cur_page==0)
				$cur_page=1;
			
			$keyWord=trim($_GET["keyWord"]);
			$nStep=trim($_GET["step"]);
			
			$sSuoShuSql = " from OFFER_ALL_USER where (";
			$pru_key_fenge = explode(' ', $keyWord);  /* split into parts*/
			
			foreach ($pru_key_fenge as $word)
			{
					if ($isHaveAnd==false)
					{
						$sSuoShuSql=$sSuoShuSql." (CONCAT(T_DATE, T_SER) = '$word') or T_USER_NAME = '$word' or T_MAIL = '$word' or T_PAY_CODE = '$word'";
						$isHaveAnd=true;
					}
					else
					{
						$sSuoShuSql=$sSuoShuSql." or (CONCAT(T_DATE, T_SER) = '$word') or T_USER_NAME = '$word' or T_MAIL = '$word' or T_PAY_CODE = '$word'";
					}
			}
			$sSuoShuSql=$sSuoShuSql.")";
			
			if ($nStep+0==0)
			{
				
			}
			else
			{
				if ($isHaveAnd==false)
				{
					$sSuoShuSql=$sSuoShuSql." T_STEP=$nStep";
				}
				else
					$sSuoShuSql=$sSuoShuSql." and T_STEP=$nStep";
			}

			$sSuoShuSql=$sSuoShuSql." order by T_USER_MANAGE ";
//echo "<br><br><br>$sSuoShuSql<br><br><br>";
			$result = $SQL->Query("select * ".$sSuoShuSql);
			$preOrerManage=-1;
			$nPruNum=mysqli_num_rows($result);
			while(($row=mysqli_fetch_array($result)))
			{
				if ($preOrerManage!=$row["T_USER_MANAGE"])
					$preOrerManage=$row["T_USER_MANAGE"];
				else
				{
					continue;
				}
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
            <td height="25" colspan="2"><?php
			echo $row["T_URL"];
			?>&nbsp;</td>
          </tr>
          <?php
		  	}
		  ?>
      </table>
      <table width="100%"  border="0">
          <tr>
            <td align="left"><?php 
			$result = $SQL->Query("select count(*) as nTotal ".$sSql);
			$nItemTotal=0;
			if ($row=mysqli_fetch_array($result))
				$nItemTotal=$row["nTotal"];
			else
				$nItemTotal=0;
//echo "<br>select count(*) as nTotal $sSql<br>$nItemTotal<br>";
		$nEndPage=0;
		$Pree=0;
		$totalpages=0; 
			
		if ($cur_page>1)
			$Pree=$cur_page-1;
		else
			$Pree=1;
	
		if ($nItemTotal % 15 == 0)
			$pages = $nItemTotal/15;
		else
			$pages = ($nItemTotal-$nItemTotal%15)/15 + 1;
		
		$curPage=$cur_page;
		$totalpages=$pages; 
			 
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
		
		//echo "<br>nStartPage=".$nStartPage." curPage=".$curPage." nEndPage=".$nEndPage." totalpages=".$totalpages."<br>";
		?>
              <div class="page">
                <ul>
                  <?php 
		if ($nStartPage>1)
		{
		?>
                  <li class="long"><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&step=".$_GET["step"]."&page=1"; ?>">First</a></li>
                  <?php 
		}
		if ($curPage>1)
		{
		?>
                  <li class="long"><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&step=".$_GET["step"]."&page=".($curPage-1); ?>">Pre</a></li>
                  <?php 
		}
		for($i=$nStartPage; $i<=$nEndPage; $i++)
		{
			if ($i==$curPage)
				echo "<li>".$i."</li>";
			else
			{
		?>
                  <li><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&step=".$_GET["step"]."&page=".$i;?>"><?php echo $i; ?></a></li>
                  <?php 
			}
		}
		if ($curPage<$totalpages)
		{
		?>
                  <li class="long"><a  href="<?php echo "?keyWord=".$_GET["keyWord"]."&step=".$_GET["step"]."&page=".($curPage+1);?>">Next</a></li>
                  <?php 
		}
		if ($nEndPage<$totalpages)
		{
		?>
                  <li class="long"><a href="<?php echo "?keyWord=".$_GET["keyWord"]."&step=".$_GET["step"]."&page=".$totalpages;?>">End</a></li>
                  <?php 
		}
		?>
                </ul>
            </div></td>
          </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
