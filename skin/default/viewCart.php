<h1>My Cart</h1>
<?php
$cart = new cart;
$strCookie=$cart->GetCustomerOrderList();
$strItemList=explode("=====",$strCookie);
$nCount = count($strItemList);
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
			$strIDItem=explode(" ",$strItemList[$i]);
			$strItemCoolieSI=substr($strItemList[$i], strlen($strIDItem[0])+1,strlen($strItemList[$i]));
			include("dbCfg.php");
			$result_currect = mysql_query("select * from pru where T_ID='".$strIDItem[0]."'",$allDateBase);
			$row=mysql_fetch_array($result_currect);
			$pru_size=$row["T_SIZE"];
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
                    <div class="cartItemMainPicture_text"><a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>">Change</a> | <a href="updateData.php?COM_ID=0002&ID=<?php echo $row["T_ID"];?>">Remove it</a>
                    </div>
					
            </div>
            
            <div class="cartItemMainText">
            	<ul class="itemDetailText">
                	<li><span class="itemDetailText_Class">ID:</span><?php echo $row["T_ID"];?></li>
                    
                    <li><span class="itemDetailText_Class">Total:</span><?php
					echo $cart->GetOderAmoutBySize($strItemCoolieSI, "sum");
					if ($cart->GetOderAmoutBySize($strItemCoolieSI, "sum")>1)
						echo " pcs";
					else
						echo " pc";
					?></li>
                
                <?php
                if (($strMemo=$cart->GetOderAmoutBySize($strItemCoolieSI, "memo"))!='0')
				{
				?>
                	<li><span class="itemDetailText_Class">Memo:</span><?php echo $strMemo;?></li>
                <?php
                }
				?>
                	<li><span class="itemDetailText_Class">Size:</span>Amount submited</li>
    <?php
		$buySizeList=explode("_",$strItemCoolieSI);
		$nSizeCount=count($buySizeList);
		for ($j=0; $j<$nSizeCount;$j++)
		{
			$sizeDetail=explode("*",$buySizeList[$j]);
			if ($sizeDetail[0]=="sum")
				break;

	?>
                <li><span class="itemDetailText_Class"><?php echo $sizeDetail[0];?>:</span><?php 
					echo $sizeDetail[1];
					if ($sizeDetail[1]>1)
						echo " pcs";
					else
						echo " pc";?></li>
    <?php
    	}
	?>			</ul>
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
				$strIDItem=explode(" ",$strItemList[$i]);
				$strItemCoolieSI=substr($strItemList[$i], strlen($strIDItem[0])+1,strlen($strItemList[$i]));
		?>
        	<li><span class="itemDetailText_Class"><?php echo $strIDItem[0];?>:</span><?php echo str_replace("memo*", " ",str_replace("_", " ",$strItemCoolieSI));?></li>
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
		str = str + document.OrderFrom.msg.value;
		if (str.length>255)
		{
			alert("The msg's max length is 255!");
			return false;
		}
	}
	return true;
}
</script>

<div id="TabbedPanels3" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Submit the order</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
  	<form name="OrderFrom" id="OrderFrom" method="post" action="updateData.php?COM_ID=0013" class="cartInputForm" onsubmit="return(showthis());">
    	<div class="TabbedPanelsContent">
        	<ul class="itemDetailText">
        		<li><span class="itemDetailText_Class">E-Mail:</span><input name="mail" type="text" maxlength="32" /></li>
                
                <li><span class="itemDetailText_Class">Retype E-Mail:</span><input name="Rmail" type="text" maxlength="32" /></li>
                <li><span class="itemDetailText_Class">Country:</span><input name="country" type="text" id="country" /><input type="hidden" name="OrderInfo" value="<?php echo $strCookie; ?>" /></li>
                <li><span class="itemDetailText_Class">Msg:</span><textarea name="msg" cols="60" rows="4"></textarea></li>
                <li><div class="cartInputButtonForm">
                <input name="Submit" type="submit" id="Submit" value="Send the item list to us">&nbsp;&nbsp;&nbsp; <input name="reset" type="reset" id="reset" value="Reset"></div></li>
            </ul>
        </div>
    </form>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels3");
//-->
</script>


