<h1>Order infomation</h1>
<?php
$itemList;
$itemOtherInfo;
$bShowPayment;
$bAddSellPrice;

$SQL = new SQL;

$searchBy=$_GET["SEARCH_BY"];
if (strlen($searchBy)>0)
{
	if ($searchBy=="SER")
	{
		$orderRecord=$_GET["T_ID"];
		$sSql="select * from OFFER_ALL_USER where (CONCAT_WS('', T_DATE, T_SER)) like '%$orderRecord%';";
		//echo "$sSql<br>";
		$bShowPayment=false;
		$bAddSellPrice=false;
		
		
		$result = $SQL->Query($sSql);
		$nPruNum = mysqli_num_rows($result);
		if ($nPruNum==0)
			die("wrong order record");
		
		$rowOrder=mysqli_fetch_array($result);	
		$itemList=$rowOrder["T_DINGDAN_MINGXI"];
		$itemOtherInfo=stripslashes("ORDER ID --- [<b>".$rowOrder["T_DATE"].$rowOrder["T_SER"]."</b>]\n\nwe got your payment and have arranged to prepare the items for you. \nPls confirm the shipping address we'll send to:\n--------------------\n".$rowOrder["T_CUS_ADDRESS"]."\n--------------------\n\nIf you have any questions, pls let me know. i'll reply you asap.\nThanks and greeting from ".GetWebNikiName()."");;
	}
}
else
{
	$orderRecord=$_GET["T_ID"];
	$sSql="select * from t_order_record_his where T_ID='$orderRecord'";
	
	
	$result = $SQL->Query($sSql);
	$nPruNum = mysqli_num_rows($result);
	if ($nPruNum==0)
		die("wrong order record");
		
	$row=mysqli_fetch_array($result);	
	$itemList=$row["T_ITEM_LIST"];
	$itemOtherInfo=$row["T_MEMO"];
	$bShowPayment=$row["T_SHOW_PAYMENT"];
	$bAddSellPrice=$row["T_ADD_PRICE_INFO"];
}

$strItemList=explode("\r\n",$itemList);
$nCount = count($strItemList);

if (strlen($itemOtherInfo)>0 || $bShowPayment)
{
?>

<div id="TabbedPanels3" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Text Infomation</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    	<div class="paymentInfo">
        <?php
		if ($bShowPayment)
		{
		?>
         <ul>
            <li>West union || Moneygram info</li>
            <li>First name: <span class="contect">ZhenSheng</span></li>
            <li>Last name: <span class="contect">Liu</span></li>
            <LI>City: <span class="contect">BeiJing</span></LI>
        	<LI>Country:<span class="contect">China</span></LI>
         </ul>
         <ul>
            <li>Paypal account</li>
            <li><?php
  	include(APPROOT."dbCfg.php");
	$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentWebHost()."'");
	if ($row=mysqli_fetch_array($result))
	{
		echo $row["T_PAYPAL_ACCOUNT"];
	}
  ?></li>
  			<li>HaiTao Liu</li>
         </ul>
         <?php
        }
		if (strlen($itemOtherInfo)>0)
		{
		?>
	
		<div class="viewOrderText">
			<?php
			echo str_replace("\r\n", "<br>", $itemOtherInfo);
			?>
		</div>
		<?php
		}
		?>
	    </div>
    </div>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels3 = new Spry.Widget.TabbedPanels("TabbedPanels3");
//-->
</script>
<p>&nbsp;</p>
<?php
}
?>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">With picture view</li>
    <li class="TabbedPanelsTab" tabindex="0">Only text view</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">

    <?php
    for ($i=0; $i<$nCount; $i++)
	{
		if (empty($strItemList[$i])==true)
			;
		else
		{
			$strIDItem=explode(" ",trim($strItemList[$i]));
			$pruMemo=substr($strItemList[$i], strlen($strIDItem[0])+1,strlen($strItemList[$i]));
			
			$result_currect = $SQL->Query("select * from pru where T_ID='".$strIDItem[0]."'",$allDateBase);
			$row=mysqli_fetch_array($result_currect);
			$pru_size=$row["T_SIZE"];
			$pru_Style=GetStyleInfo($row["T_STYLE_MEN"]);
			$pru_Brand=$row["T_CHILD"];
			if ($i>0)
			{
	?>
    		  
	<?php
    		}
	?>
            
          <div class="cartItemMainFrame">
            <div class="cartItemMainPicture">
                    <div class="cartItemMainPicture_pic">
                            <ul class="pru_each">
      							<li class="pru_pic"><a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>">
                                            <img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";?>" border="0" alt="<?php echo $row["T_ID"];?>" title="<?php echo $row["T_ID"];?>"></a>
                                    </span>
                                </li>
                            </ul>
                    </div>					
            </div>
            <div class="cartItemMainText">
                <ul class="itemDetailText">
                        <li><span class="itemDetailText_Class">ID:</span><span class="cartValue"><?php echo $strIDItem[0]; ?>&nbsp;</span><span class="itemDetailText_Class2">Brand:</span><?php echo $pru_Brand; ?>&nbsp;</li>
                        

                        <li><span class="itemDetailText_Class">Style:</span><span class="cartValue"><?php echo $pru_Style;?>&nbsp;</span><?PHP if ($bAddSellPrice) {?><span class="itemDetailText_Class2">Price:</span><?php echo $row["T_PRICE"]." usd";?>&nbsp;<?php }?></li>
                        <?php if (strlen($pruMemo)>0) {?><li><span class="itemDetailText_Class">Memo1:</span><?php echo $pruMemo;?>&nbsp;</li><?php } ?>
                </ul>
            </div>
          </div>
    <?php
			}
		}
	?>
    </div>
    <div class="TabbedPanelsContent">
    	<ul class="itemDetailText">
        	
    	<?php
        for ($i=0; $i<$nCount; $i++)
		{
			if (empty($strItemList[$i])==true)
				;
			else
			{
				$strIDItem=explode(" ",trim($strItemList[$i]));
				$strItemCoolieSI=substr($strItemList[$i], strlen($strIDItem[0])+1,strlen($strItemList[$i]));
		?>
        	<li><span class="itemDetailText_Class"><?php echo $strIDItem[0];?>:</span><?php
			 if ($bAddSellPrice) echo $row["T_PRICE"]." usd";
			 echo str_replace("memo*", " ",str_replace("_", " ",$strItemCoolieSI))."&nbsp;";?></li>
        <?php
			}
        }
		?>
        </ul>
    </div>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>

<script type="text/javascript">
function showthis(){
	var str="";
	if(document.OrderFrom.mail.value)
	{
		str = document.OrderFrom.mail.value;
		var re =/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;  
		//var loc=str.indexOf("@");
		//if (loc==-1)
		if (re.test(str))
			;
		else
		{
			alert("Please check your E-mail format!");
			return false;
		}
	}
	else
	{
		alert("Please input your E-Mail!");
		return false;
	}

	if(document.OrderFrom.mail.value!=document.OrderFrom.Rmail.value)
	{
			alert("Please check the mail you inputed, its not the same!");
			return false;
	}

	if(document.OrderFrom.country.value)
		;
	else
	{
		alert("Please input the country where they will be send to!");
		return false;
	}
	if(document.OrderFrom.msg.value){
		str = str + document.lrFrom.msg.value;
		if (str.length>255)
		{
			alert("The msg's max length is 255!");
			return false;
		}
	}
	return true;
}
</script>
<p style="font-size:1px; color:#F8F8F8;">power by yuan</p>

