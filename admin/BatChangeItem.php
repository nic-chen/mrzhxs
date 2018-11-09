<?php
include_once("settings.php");
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

span {
	color:#F0F0F0;
}
</style>
</head>

<body>
<?php include("manageItemMenu.php"); ?>
<form name="itemManaFrm" id="itemManaFrm" action="" method="get" style="margin:0px;padding:0px">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="left" bgcolor="#669B31">&nbsp;<span class="ItemManageHead">Batch Change Item</span></td>
  </tr>
  <tr>
    <td align="center">
      <table width="100%"  border="0" bgcolor="#C2DC71" >
        <tr align="left">
          <td align="right">Search by:</td>
          <td align="left"><input name="CLASSS" type="text" size="30" value="<?php echo $_GET["CLASSS"];?>" /> <select name="FanWei">
                <?php
                $choosedFenlei=$_GET["FanWei"];
				$selectedInfo="selected=\"selected\"";
				?>
            	  <option value="By_All"  <?php if ($choosedFenlei=="By_All") echo "$selectedInfo"; ?>>All</option>
            	  <option value="By_Brand"  <?php if ($choosedFenlei=="By_Brand") echo "$selectedInfo"; ?>>Brand</option>
                  <option value="By_Class"  <?php if ($choosedFenlei=="By_Class") echo "$selectedInfo"; ?>>Class</option>
                  <option value="By_ID"  <?php if ($choosedFenlei=="By_ID") echo "$selectedInfo"; ?>>ID</option>
            	</select>          </td>
        </tr>
        <tr align="left">
          <td align="right">Buy price:</td>
          <td align="left"><input name="Buy_low_price" type="text" size="3" value="<?php 
		  if (intval($_GET["Buy_low_price"])>0 ) 
		  	echo $_GET["Buy_low_price"];
		  else
		  	echo "0"; ?>"/>
            <select name="Buy_low_fuhao">
              <?php
                $tmp=$_GET["Buy_low_fuhao"];
				$selectedInfo="selected=\"selected\"";
			?>
              <option value="&lt;" <?php if ($tmp=="<") echo "$selectedInfo"; ?>>&lt;</option>
              <option value="&lt;=" <?php if ($tmp=="<="  || strlen($tmp)==0) echo "$selectedInfo"; ?>>&lt;=</option>
            </select>            
            Buy&nbsp; price
            <select name="Buy_high_fuhao">
            <?php
                $tmp=$_GET["Buy_high_fuhao"];
				$selectedInfo="selected=\"selected\"";
			?>
              <option value="<" <?php if ($tmp=="<") echo "$selectedInfo"; ?>>&lt;</option>
              <option value="<=" <?php if ($tmp=="<="  || strlen($tmp)==0) echo "$selectedInfo"; ?>>&lt;=</option>
            </select>
            <input name="Buy_high_price" type="text" size="3"  value="<?php 
			if (intval($_GET["Buy_high_price"])!=0)
				echo $_GET["Buy_high_price"];
			else
				echo "99999"; ?>"/></td>
        </tr>
        <tr align="left">
          <td align="right">Sell price:</td>
          <td align="left"><input name="Sell_low_price" type="text" size="3"  value="<?php 
		  if (intval($_GET["Sell_low_price"])>0 ) 
		  	echo $_GET["Sell_low_price"];
		  else
		  	echo "0"; ?>"/>
            <select name="Sell_low_fuhao">
            <?php
                $tmp=$_GET["Sell_low_fuhao"];
				$selectedInfo="selected=\"selected\"";
			?>
              <option value="&lt;" <?php if ($tmp=="<") echo "$selectedInfo"; ?>>&lt;</option>
              <option value="&lt;=" <?php if ($tmp=="<=" || strlen($tmp)==0) echo "$selectedInfo"; ?>>&lt;=</option>
                        </select>
            Sell price
            <select name="Sell_high_fuhao">
            <?php
                $tmp=$_GET["Sell_high_fuhao"];
				$selectedInfo="selected=\"selected\"";
			?>
              <option value="&lt;" <?php if ($tmp=="<") echo "$selectedInfo"; ?>>&lt;</option>
              <option value="&lt;=" <?php if ($tmp=="<=" || strlen($tmp)==0) echo "$selectedInfo"; ?>>&lt;=</option>
                        </select>
            <input name="Sell_high_price" type="text" size="3"  value="<?php 
			if (intval($_GET["Sell_high_price"])!=0)
				echo $_GET["Sell_high_price"];
			else
				echo "99999";  ?>"/></td>
        </tr>
        <tr align="left">
          <td align="right">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr align="left">
          <td width="10%" align="right">Change area:</td>
          <td align="left">
          <select name="changeArea" id="ChangeArea">
          <?php
                $tmp=$_GET["changeArea"];
				$selectedInfo="selected=\"selected\"";
			?>
          <!-- ";" 分号进行分隔，后面的数字 1-数字 2-BOOL型 3-字符串型 -->
          	<option value=";" <?php if ($tmp=="" || $tmp==";") echo "$selectedInfo"; ?>>Area need to update</option>
            <option value="T_SIZE;3" <?php if ($tmp=="T_SIZE;3") echo "$selectedInfo"; ?>>Size</option>
            <option value="T_CHILD;3" <?php if ($tmp=="T_CHILD;3") echo "$selectedInfo"; ?>>Brand</option>
            <option value="T_COLOR;3" <?php if ($tmp=="T_COLOR;3") echo "$selectedInfo"; ?>>Color</option>
            <option value="T_STYLE_MEN;1" <?php if ($tmp=="T_STYLE_MEN;1") echo "$selectedInfo"; ?>>Style</option>
            <option value="T_PRICE;1" <?php if ($tmp=="T_PRICE;1") echo "$selectedInfo"; ?>>Price for sell</option>
            <option value="T_JINHUO_PRICE;1" <?php if ($tmp=="T_JINHUO_PRICE;1") echo "$selectedInfo"; ?>>Price for buy</option>
            <option value="T_STATUS;1" <?php if ($tmp=="T_STATUS;1") echo "$selectedInfo"; ?>>Stock status</option>
            <option value="T_CAI_LIAO;3" <?php if ($tmp=="T_CAI_LIAO;3") echo "$selectedInfo"; ?>>Material</option>
            <option value="T_CLASS;3" <?php if ($tmp=="T_CLASS;3") echo "$selectedInfo"; ?>>Class</option>
            <option value="T_BEIZHU;3" <?php if ($tmp=="T_BEIZHU;3") echo "$selectedInfo"; ?>>Memo</option>
            <option value="T_MIMI_OLDER;1" <?php if ($tmp=="T_MIMI_OLDER;1") echo "$selectedInfo"; ?>>Mini order</option>
            <option value="T_PAYMENT;3" <?php if ($tmp=="T_PAYMENT;3") echo "$selectedInfo"; ?>>Payment way</option>
            <option value="T_HOT;1" <?php if ($tmp=="T_HOT;1") echo "$selectedInfo"; ?>>HOT Number</option>
            <option value="IS_VIP;2" <?php if ($tmp=="IS_VIP;2") echo "$selectedInfo"; ?>>Is VIP</option>
            <option value="KEY_WORD;3" <?php if ($tmp=="KEY_WORD;3") echo "$selectedInfo"; ?>>Key Word</option>
          </select></td>
        </tr>
        <tr align="left">
          <td align="right">New value:</td>
          <td align="left"><input type="text" name="newValue" value="<?php echo $_GET["newValue"]; ?>"/>
            <input type="hidden" name="needSearch" value="true" /></td>
        </tr>
        <tr align="left">
          <td align="right">&nbsp;</td>
          <td align="left">
              <script type="text/javascript">
			  function CheckIfCanBatchItem()
			  {
				  var str;
				  var i=0, j=0; 
				  str=document.itemManaFrm.nItemTotal.value;
				  j=parseInt(str, 10);
				  var bIsHaveSelected=false;
				  for (i=0; i<j; i++)
				  {
					 //alert(document.getElementById("CBOX"+i).value+"] haha!");
					 if (document.getElementById("CBOX"+i).checked)
					 {
					 	bIsHaveSelected=true;
						break;
					 }
				  }
				  if (!bIsHaveSelected)
				  {
				  	alert("pls select item which you would like to update!!");
					return bIsHaveSelected;
				  }
				  
				  
				  str=document.getElementById("ChangeArea").value;
				  if (str==";")
				  {
				  	alert("pls choose the area you need to update!!");
					bIsHaveSelected=false;
				  }
				  	
				  return bIsHaveSelected;
			  }
			  </script>
            <input name="Submit" type="submit" id="Submit" value="Test search item" />&nbsp; &nbsp;
            <input name="Submit" type="submit" id="Submit2" value="Batch item" onclick="if (CheckIfCanBatchItem()) return true; else return false;"/></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr bgcolor="#C2DC71"><td height="80"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="3" align="left" bgcolor="#669B31">&nbsp;<span class="ItemManageHead">Item list
      <?php
	$pru_class=$_GET["CLASSS"];
	$pru_class = str_replace("'", "''", $pru_class);
	$pru_FenLei=$_GET["FanWei"];
	if (strlen($pru_FenLei)==0)
		$pru_FenLei="By_All";
	
	$pru_class=trim($pru_class);
	$current_page=$_GET["page"];
	$pru_sex=$_GET["sex"];
	$nItemEachPage=30;
	if (true==empty($pru_sex))
		$pru_sex="By_All";

	if ($current_page==0 )
		$current_page=1;
	
	$sSql="";
	
	if (strlen($pru_class)==0)
		$sSql = " where 1=1";
	else if ($pru_FenLei=="By_All")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";
		$pru_class_fenge = explode(' ', $pru_class);  /* split into parts*/

		foreach ($pru_class_fenge as $word)
		{
			if ($word=="style" ||  $word=="and" ||  $word=="or" )
				;
			else
			{
				if ($isHaveAnd==false)
				{
					$sSql=$sSql." (T_ID like '%".$word."%' OR T_CHILD like '%".$word."%' OR T_CLASS like '%".$word."%' OR KEY_WORD like '%".$word."%')";
					$isHaveAnd=true;
				}
				else
				{
					$sSql=$sSql." and (T_ID like '%".$word."%' OR T_CHILD like '%".$word."%' OR T_CLASS like '%".$word."%' OR KEY_WORD like '%".$word."%')";
				}
			}
		}
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;
	}
	else if ($pru_FenLei=="By_Brand")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";

		$sSql=$sSql." (T_CHILD like '%".$pru_class."%' ) ";
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;
	}
	else if ($pru_FenLei=="By_Class")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";

		$sSql=$sSql." (T_CLASS like '%".$pru_class."%' ) ";
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;
	}
	else if ($pru_FenLei=="By_ID")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";

		$sSql=$sSql." (T_ID like '%".$pru_class."%' ) ";
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;
	}
	$sSql=$sSql." and ".floatval($_GET["Buy_low_price"])."".$_GET["Buy_low_fuhao"]."T_JINHUO_PRICE and T_JINHUO_PRICE".$_GET["Buy_high_fuhao"].floatval($_GET["Buy_high_price"]);
	$sSql=$sSql." and ".floatval($_GET["Sell_low_price"]).$_GET["Sell_low_fuhao"]."T_PRICE and T_PRICE".$_GET["Sell_high_fuhao"].floatval($_GET["Sell_high_price"]);
	$sSql=$sSql." order by T_HOT DESC, T_ID DESC";
	
	//echo "select * from pru ".$sSql." LIMIT ".(($current_page-1)*$nItemEachPage).", $nItemEachPage mmllmmll";
	if ($_GET["Submit"]=="Batch item")
	{
		$changeAreaList=split(";", $_GET["changeArea"]);
		$sUpdateSql="update pru set $changeAreaList[0]=";
		if (strcmp($changeAreaList[1], "3")==0)
			$sUpdateSql=$sUpdateSql."'".$_GET["newValue"]."'";
		else
			$sUpdateSql=$sUpdateSql.$_GET["newValue"];
		
		$nTotalItem=$_GET["nItemTotal"];
		$bIsHaveFirst=false;
		for ($i=0; $i<$nTotalItem; $i++)
		{
			$pru_id=$_GET["CBOX".$i];
			if (strlen($pru_id)>0)
			{
				if ($bIsHaveFirst==false)
				{
					$sUpdateSql=$sUpdateSql." where T_ID='".$pru_id."'";
					$bIsHaveFirst=true;
				}
				else
				{
					$sUpdateSql=$sUpdateSql." or T_ID='".$pru_id."'";
				}
			}
		}
		if ($bIsHaveFirst==false)
			echo "[***** pls select item you need to update. *****]";
		else
		{
			$SQL=new SQL;
			$result_currect = $SQL->Query($sUpdateSql);
		}
	}
	?>
    </span></td>
  </tr>
  <tr bgcolor="#C2DC71">
    <td colspan="3" align="right" valign="middle"><script type="text/javascript">
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
      <input id="sb" type="submit" value="Select all" onclick="chooseAllCheckBox(true); return false;"/>
      <input id="sb" type="reset" value="Select none" onclick="chooseAllCheckBox(false); return false;"/></td>
    </tr>
  <?PHP
  if (strlen($_GET["Submit"])>0)
  {

	$result_currect = mysql_query("select count(*) as nTotal from pru ".$sSql);
	$row=mysql_fetch_array($result_currect);
	$nItemTotal=$row["nTotal"];
	
	$result_currect = mysql_query("select * from pru ".$sSql." LIMIT ".(($current_page-1)*$nItemEachPage).", $nItemEachPage");
//	echo "["."select * from pru ".$sSql." LIMIT ".(($current_page-1)*$nItemEachPage)."]";
	$nThisPageItemTotal = mysql_numrows($result_currect);
	
	$nIndex=-1;
	while($row=mysql_fetch_array($result_currect))
	{
		$nIndex++;
  ?>
  <tr bgcolor="#C2DC71">
    <td width="100" height="50" align="center" valign="middle"><a href="http://<?php echo GetCurrentWebHost();?>?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>" target="_blank">
										<img src="../<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."1_s.jpg";?>" border="0" alt="<?php echo $row["T_ID"];?>" title="<?php echo $row["T_ID"];?>"></a></td>
    <td height="80"><?php
	if ( $row["T_STYLE_MEN"]==2 )
		$pru_style="For women";
	elseif ($row["T_STYLE_MEN"]==1)
		$pru_style="For men";
	else
		$pru_style="unsex";
	
	if ($row["IS_VIP"])
		$pru_is_vip="TRUE";
	else
		$pru_is_vip="FALSE";
		
	if ( $row["T_STATUS"]==0 )
		$pru_stock_status="Avaliable";
	elseif ($row["T_STATUS"]==1)
		$pru_stock_status="Out of stock";
	else
		$pru_stock_status="Unvaliable for every";
	
    echo "<span>ID:</span> [".$row["T_ID"]."] <span>Brand:</span> [".$row["T_CHILD"]."] <span>Size:</span> [".$row["T_SIZE"]."] <span>Color:</span> [".$row["T_COLOR"]."]<br>";
    echo "<span>Buy price:</span> [￥".$row["T_JINHUO_PRICE"]."] <span>Sell price:</span> [$".$row["T_PRICE"]."] <span>Payment:</span> [".$row["T_PAYMENT"]."] <span>Material:</span> [".$row["T_CAILIAO"]."]<span>Mini order:</span> [".$row["T_MIMI_OLDER"]."]<br>";
    echo "<span>Style:</span> [".$pru_style."]  <span>Class:</span> [".$row["T_CLASS"]."] <span>Key word:</span> [".$row["KEY_WORD"]."] <span>Is vip:</span> [".$pru_is_vip."] <span>Memo:</span> [".$row["T_BEIZHU"]."] <span>Stock status:</span> [".$pru_stock_status."]<br>";
	?></td>
    <td align="center" width="100"><input type="checkbox" name="CBOX<?php echo $nIndex;?>" value="<?php echo $row["T_ID"];?>" /></td>
  </tr>
  <?PHP
  	}
  }
  ?>
  <tr bgcolor="#C2DC71">
    <td colspan="3" align="right" valign="middle"><input type="hidden" name="nItemTotal" value="<?php echo $nThisPageItemTotal; ?>"/>
      <input id="sb" type="submit" value="Select all" onclick="chooseAllCheckBox(true); return false;"/>
      <input id="sb" type="reset" value="Select none" onclick="chooseAllCheckBox(false); return false;"/></td>
    </tr>
</table></td>
    </tr>
</table>

<?php 
		$cur_page=$_GET["page"]+0;
		if ($cur_page==0)
			$cur_page=1;
			
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
		$herfHead="?CLASSS=".$_GET["CLASSS"]."&FanWei=".$_GET["FanWei"]."&Buy_low_price=".$_GET["Buy_low_price"]."&Buy_low_fuhao=".$_GET["Buy_low_fuhao"]."&Buy_high_fuhao=".$_GET["Buy_high_fuhao"]."&Buy_high_price=".$_GET["Buy_high_price"]."&Sell_low_price=".$_GET["Sell_low_price"]."&Sell_low_fuhao=".$_GET["Sell_low_fuhao"]."&Sell_high_fuhao=".$_GET["Sell_high_fuhao"]."&Sell_high_price=".$_GET["Sell_high_price"]."&changeArea=".$_GET["changeArea"]."&newValue=".$_GET["newValue"]."&Submit=".$_GET["Submit"];
		if ($nStartPage>1)
		{
		?>
<li class="long"><a href="<?php echo $herfHead."&page=1"; ?>">First</a></li>
		<?php 
		}
		if ($curPage>1)
		{
		?>
<li class="long"><a href="<?php echo $herfHead."&page=".($curPage-1); ?>">Pre</a></li>
		<?php 
		}

		for($i=$nStartPage; $i<=$nEndPage; $i++)
		{
			if ($i==$curPage)
				echo "<li>".$i."</li>";
			else
			{
		?>
<li><a href="<?php echo $herfHead."&page=".$i;?>"><?php echo $i; ?></a></li>
		<?php 
			}
		}
		if ($curPage<$totalpages)
		{
		?>
<li class="long"><a  href="<?php echo $herfHead."&page=".($curPage+1);?>">Next</a></li>
		<?php 
		}
		if ($nEndPage<$totalpages)
		{
		?>
<li class="long"><a href="<?php echo $herfHead."&page=".$totalpages;?>">End</a></li>
		<?php 
		}
		?>
		</ul>
</div>
</form>
</body>
</html>
