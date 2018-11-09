<h1>Product Detail</h1>
<script type="text/javascript">
	function ChangeToMainPic(obj_this)
	{
		//alert(obj_this);
		document.getElementById("mainPicture").src=obj_this;
	}
</script>
<?php
include("dbCfg.php");
$sSql = "select * from pru where T_ID='".$_GET["T_ID"]."'";
$result_currect = mysql_query($sSql,$allDateBase);
$row=mysql_fetch_array($result_currect);

$pru_brand=$row["T_CHILD"];
if (strlen($row["T_TEMP_SIZE"])>0)
	$pru_size=$row["T_TEMP_SIZE"];
else
	$pru_size=$row["T_SIZE"];
$pru_color=$row["T_COLOR"];
$pru_payment=$row["T_PAYMENT"];
$pru_meterial=$row["T_CAI_LIAO"];
$pru_price=$row["T_PRICE"]+0;
if ($pru_price==0)
{
	$pru_price="No record";
}
else
{
	$pru_price=$pru_price." usd";
}

$pru_description=$row["T_BEIZHU"];
$pru_pic_num=$row["T_XIJIE_PIC"];
$pru_size_info=$row["T_SIZE_INFO"];
$pru_have_detail=$row["T_DETAIL_HAVE"];
$strPruStatus=$row["T_STATUS"];
$pru_mini_order=$row["T_MIMI_OLDER"];
$pru_key_word=$row["KEY_WORD"];
$pru_version=$row["Version"];

/*T_HOT+1*/
include("dbCfg.php");
mysql_query("update pru set T_HOT=T_HOT+1 where T_ID='".$_GET["T_ID"]."'",$allDateBase);

if ( $row["T_STYLE_MEN"]==2 )
	$pru_style=" For women";
elseif ($row["T_STYLE_MEN"]==1)
	$pru_style=" For men";
else
	$pru_style=" unsex";
	
if (empty($pru_size)==true)
	if ($row["T_STYLE_MEN"]==2)
		$pru_size="26_27_28_29_30_31";
	else 
		$pru_size="30_32_34_36_38_40_42";

if (empty($pru_color)==true)
	$pru_color="pls view the pic, all of the pic taken by actual";

if (empty($pru_payment)==true)
	$pru_payment="western union, money gram, moneybooker, paypal";
			
if (!$row)
	echo "Dont find the product!";
else
{
	$pictureName=array();	//picture's path
	$pru_pic_num=0;			//picture in total
	if (strlen($row["T_DETAIL_PICTURE"]."")>0)
	{
	 	$pictureName=explode("?????", trim($row["T_DETAIL_PICTURE"], "?????"));
		$pru_pic_num=count($pictureName);
	}
	else
	{
		$pru_pic_num=$row["T_XIJIE_PIC"];
		for ($i=0; $i<=$pru_pic_num; $i++ )
		{
			$pictureName[$i]=($i+1)."_o.jpg";
		}
	}
?>
    <div class="itemDetailPicture">
    <ul class="smallImg">
    <?php
    for ($i=0; $i<$pru_pic_num; $i++)
	{
	?>
    	<li><a href="#" onclick="ChangeToMainPic('<?php echo GetItemPathInfo($row["T_ID"], $row["Version"]).$pictureName[$i];?>'); return false;"><img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"]).$pictureName[$i];?>" width="45"></a>
        </li>
    <?php
    }
	?>
    </ul>
    <?php
    for ($i=0; $i<1; $i++)
	{
	?>
        <img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"]).$pictureName[$i];?>" id="mainPicture">
    <?php
    }
	?>
    <p style="text-align:right; padding-right:10%;"><a href="detail_ebay.php?T_ID=<?PHP echo $row["T_ID"];?>" target="_blank">View it singe</span></a></p>
    </div>
    
    <script type="text/javascript">
	
    function GetTotal(showError, MiniOrder)
    {
        var str="";
        str = document.fmAdd.total.value;
        var count=0;
        count=parseInt(str, 10);
        //alert(count);
        var sum=0;
        var i=0;
        
        var error=false;
        for (i=0;i<count; i++)
        {
            if (document.getElementById("sizeInfoSel"+i).value)
            {
                str=document.getElementById("sizeInfoSel"+i).value;
                if (isNaN(str))
                {
                    if (showError)
                    {	
                        str="The size info '"+str+"', its not number. pls input it with digitals!";
                        alert(str);
                        return false;
                    }
                    else
                        continue;
                }
                document.getElementById("sizeInfoSel"+i).value=parseInt(str, 10)
                if (parseInt(str, 10)>999)
                {
                    if (showError)
                    {	
                        alert("the max items 999 for each size. pls change it!");
                         return false;
                    }
                    else
                        continue;
                }
                sum=sum+parseInt(str, 10);
            }		
        }
        
        document.fmAdd.totalInput.value=sum;
        document.getElementById("item_total").innerHTML=sum;
        //alert(sum+" "+MiniOrder);
        if (showError)
        {
            if (sum<MiniOrder)
            {
				if (sum==0)
					alert("Please input the amount you would like directly then click the Submit button!");
				else
                	alert("For this style, the mini order is "+MiniOrder+" items, pls change and submit!");
                return false;
            }
        }
        return !error;
    }
    
    function CanDoSubmit()
    {
    if ( GetTotal(true, <?php if ($pru_mini_order==0) echo "1"; else echo $pru_mini_order;?>)  )
        return true; 
    else 
        return false;
    }
    
    function check(obj)
    {
     if(event.keyCode == 13)
    
      return true;
     if(event.keyCode <48 || event.keyCode >57)
     {
      return false;
      }
     else
      return true;
    }
	</script>
    
    <div>
    	<div id="TabbedPanels1" class="TabbedPanels">
          <ul class="TabbedPanelsTabGroup">
            <li class="TabbedPanelsTab" tabindex="0">Product detail infomation</li>
            <li class="TabbedPanelsTab" tabindex="0">Add to cart or Change</li>
          </ul>
          <div class="TabbedPanelsContentGroup">
            <div class="TabbedPanelsContent">
                    <ul class="itemDetailText">
                        <li><span class="itemDetailText_Class">ID:</span><?php echo $row["T_ID"];?></li>
                        <li><span class="itemDetailText_Class">Brand:</span><?php echo $row["T_CHILD"];?></li>
                        <li><span class="itemDetailText_Class">Size:</span><?php echo str_replace("_", " ", $pru_size);?></li>
                        <li><span class="itemDetailText_Class">Color:</span><?php echo $pru_color;?></li>
                        <li><span class="itemDetailText_Class">Style:</span><?php echo $pru_style;?></li>
                    <?php
                    if ($webConfig->webIS_SHOW_PRICE)
					{
					?>
                    	<li><span class="itemDetailText_Class">Sell price:</span><?php echo $pru_price;?></li>
                    <?php
                    }
                    if (strlen($pru_meterial)>0)
					{
					?>
                    	<li><span class="itemDetailText_Class">Raw meterial:</span><?php echo $pru_meterial;?></li>
                    <?php
                    }

                    if (strlen($pru_description)>0)
					{
					?>
                    	<li><span class="itemDetailText_Class">Memo:</span><?php echo $pru_description;?></li>
                    <?php
                    }
					?>
                    </ul>     		
            </div>
            <div class="TabbedPanelsContent">
            	<form name="fmAdd" method="post" action="updateData.php?COM_ID=0001" style="padding:0px; margin:0px;">
                <ul class="itemDetailText">
                <li><span class="itemDetailText_Class">Size:</span>Amount (*Input the amout of the size directly)</li>
                <?php
				$pru_id=$row["T_ID"];
                $strItemCookieStr=$cart->GetCurrectOrderInfo($pru_id);
				$strItemCookieListTemp=explode(" ",$strItemCookieStr);
				$buySizeList=explode("_", $pru_size);
			
				$nSizeCount=count($buySizeList)-1;
				for ($i=0; $i<=$nSizeCount; $i++)
				{
					if (strlen($buySizeList[$i])==0)
						continue;
				?>
                    <li><span class="itemDetailText_Class"><?php echo $buySizeList[$i]?>:</span><?php 
			  echo "<input name=\"sizeInfoSel".$i."\" value=\"".$cart->GetOderAmoutBySize($strItemCookieStr, $buySizeList[$i])."\" id=\"sizeInfoSel".$i."\" type=\"text\" size=\"6\" onkeypress=\"javascript: var bRes=check(this); return bRes;\" onkeyup=\"javascript: if (event.keyCode==13 || event.keyCode==37 || event.keyCode==38 || event.keyCode==39 || event.keyCode==40) return true; else GetTotal(false, 0);\" onpaste=\"return false;\">";
			  ?>
                          <input type="hidden" name="sizeInfo<?php echo $i;?>" value="<?php echo $buySizeList[$i];?>"></li>
                <?php
                }
				?>
                    <li><span class="itemDetailText_Class">Total:</span><input name="totalInput" type="hidden" value="<?php echo $cart->GetOderAmoutBySize($strItemCookieStr, "sum")+0; ?>" size="2" readonly="true" >
                       <strong> <span id="item_total" style="color:#990000"><?php echo $cart->GetOderAmoutBySize($strItemCookieStr, "sum")+0; ?></span></strong></li>
                    <li><span class="itemDetailText_Class" title="For example you can input the color you would like.">Memo:</span><input name="Memo" value="<?php echo $cart->GetOderAmoutBySize($strItemCookieStr, "memo");?>">Memo infomation</li>
                    <li><span class="itemDetailText_Class">Action:</span><input name="Submit" type="submit" value="Submit"  onclick="return CanDoSubmit();"/>
                      <input name="Reset" type="reset" id="Reset" value="Reset"/></li>
                  </ul>
                  <input type="hidden" id="total" name="total" value="<?php echo $nSizeCount+1; ?>" />
                  <input type="hidden" id="ItemID" name="ItemID" value="<?php echo $pru_id; ?>" />
                  <input type="hidden" id="COM_ID" name="COM_ID" value="0001" />
                </form>
            </div>
          </div>
        </div>
        <script type="text/javascript">
        <!--
        var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
        //-->
        </script>
    </div>
    	<?php
		
		/*customer's leaving message*/
		include("dbCfg.php");
		$sSql = "select * from customerleavemsg where T_PRU_ID='".$_GET["T_ID"]."' and T_URL='".GetCurrentWebHost()."' and T_ROLE=1 order by T_TIME ASC ";
		$result_all_message = mysql_query($sSql,$allDateBase);
		$nMessageTotal = mysql_numrows($result_all_message);
		if ($nMessageTotal>0)
			$bShowLeavedMessage=true;
		else
			$bShowLeavedMessage=false;
		?>
<div id="TabbedPanels4" class="TabbedPanels">
	<ul class="TabbedPanelsTabGroup">
    	<?php
        if ($bShowLeavedMessage)
		{
		?>
		<li class="TabbedPanelsTab" tabindex="0">Message</li>
        <?php
        }
		?>
        <li class="TabbedPanelsTab" tabindex="0">Leave A New Message</li>
	</ul>
	<div class="TabbedPanelsContentGroup">
    	<?php
        if ($bShowLeavedMessage)
		{
		?>
		<div class="TabbedPanelsContent">
          <?php
		  $nJiOu=1;
          while($row=mysql_fetch_array($result_all_message))
		  {
		  ?>
          <ul class="msgReplied<?php echo $nJiOu=($nJiOu+1)%2;?>">
              <li class="CustomerMsg">
              <span class="CustomerMsg_actor">Buyer</span><span class=time>From <?php 
			  if (strlen($row["T_CUSTOMER_NIKI_NAME"])>0 && strcmp($row["T_CUSTOMER_NIKI_NAME"], "Customer")!=0) 
			  	echo $row["T_CUSTOMER_NIKI_NAME"]; 
			  else 
			  {
			  	$ipList=Split("\.", $row["T_IP_ADD"]);
				echo $ipList[0].".".$ipList[1].".*.* ";
			  }
			  ?> <?php echo date("Y-m-d H:i:s", strtotime($row["T_TIME"])); ?></span></li>
                <li class="LeaveMsgText">
                <span class="CustomerMsg_actor">&nbsp;</span><?php echo $row["T_MSG"];?></li>
              <?php
              if (strlen($row["T_REPLIED_MSG_INDEX"])>0)
			  {
			  	$idListRepliedMsg=split(";", $row["T_REPLIED_MSG_INDEX"]);
				$nTotal=count($idListRepliedMsg);
				for ($i=0; $i<$nTotal; $i++)
				{
					if (strlen($idListRepliedMsg[$i])==0)
						continue;
					include("dbCfg.php");
					$sSql = "select * from customerleavemsg where T_INDEX='".$idListRepliedMsg[$i]."' and  T_URL='".GetCurrentWebHost()."'";
					$result_currect = mysql_query($sSql,$allDateBase);
					if ($row=mysql_fetch_array($result_currect))
					{
					?>
                <li class="aminMsg" style="width:100%; color:#999999"">
                <span class="aminMsg_actor">Seller</span><span class=time>2008-05-10 10:20</span></li>
                <li class="LeaveMsgText"><span class="aminMsg_actor">&nbsp;</span><?php echo $row["T_MSG"];?></li>
					<?php
					}
				}
			  ?>
              <?php
              }
			  ?>
          </ul>
          <?php
          }
		  ?>
		</div>
        <?php
        }
		?>
        <div class="TabbedPanelsContent">
        	<form name="LeaveMsgForm" method="post" action="updateData.php?COM_ID=0010" style="padding:0px; margin:0px;">
            	<ul class="itemDetailText">
               	 <li><span class="itemDetailText_Class">Mail:</span><input name="C_MAIL" type="text" /></li>
                 <li><span class="itemDetailText_Class">Nickname:</span><input name="Nickname" type="text" /></li>
                 <li><span class="itemDetailText_Class">Message:</span><textarea name="leaveMsg" cols="50" $rows="4" id="msg"></textarea>(*)</li>
                 <li><span class="itemDetailText_Class">&nbsp;</span><input type="submit" name="Submit2" value="Leave an Msg" /><input type="hidden" name="PRU_ID" value="<?php echo $pru_id;?>">
                 </li>
                </ul>
            </form>
		</div>
	</div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels4");
//-->
</script>
<?php
}
?>