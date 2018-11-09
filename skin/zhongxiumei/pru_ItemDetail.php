<script type="text/javascript">
	function ChangeToMainPic(obj_this)
	{
		//alert(obj_this);
		document.getElementById("mainPicture").src=obj_this;
	}
</script>
<?php
include("dbCfg.php");
$pru_id = $_GET["T_ID"];
$sSql = "select * from pru where T_ID='$pru_id'";
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
$pru_size_danwei=$row["T_SIZE_DANWEI"];

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
	$pru_size="询问";

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

    <?php
    for ($i=0; $i<1; $i++)
	{
	?>
        <img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"]).$pictureName[$i];?>" id="mainPicture">
    <?php
    }
	?>
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
	function showthis()
	{
		if(document.LeaveMsgForm.randcode.value)
			;
		else
		{
			alert("Please input the Random Code!");
			return false;
		}
	}
	
	function change(id){
	   document.getElementById(id).src = 'randcode.php?'+Math.random(1);
	}
	</script>
    
    <div>
        <ul class="itemDetailText">
        	<?php
			$SQL = new SQL;
            $resultTmp = $SQL->Query("select * from registercustomer  where T_ID='".$row["T_USER_ID"]."'");
			$rowUser=mysql_fetch_array($resultTmp);
			?>
            <li><span class="itemDetailText_Class">编号:</span><?php echo $row["T_ID"];?></li>
            <li><span class="itemDetailText_Class">作者:</span><?php echo $rowUser["T_CUSTOMER_NAME"];?></li>
            <li><span class="itemDetailText_Class">尺寸:</span><?php echo $pru_size;?> </li>
            <li><span class="itemDetailText_Class">类别:</span><?php echo $row["T_CLASS"];?></li>
            <?php
            if ($webConfig->webIS_SHOW_PRICE)
            {
            ?>
            	<li><span class="itemDetailText_Class">价格:</span><?php echo $pru_price;?></li>
            <?php
            }
            ?>
            <li id="buyCart"><form name="fmAdd" method="post" action="updateData.php?COM_ID=0001" style="padding:0px; margin:0px;">
            	   <input name="sizeInfoSel0" type="hidden" value="1" />
                   <input type="hidden" name="sizeInfo0" value="M">
                   <input class="submitBtn" name="Submit" type="submit" value="订购"  onclick="return CanDoSubmit();"/>
                   
                   <input type="hidden"  name="totalInput" value="1" />
                   <input type="hidden"  name="total" value="1" />
                  <input type="hidden" id="ItemID" name="ItemID" value="<?php echo $pru_id; ?>" />
				  <input name="url" type="hidden" value="?p=product&type=viewCart"/>
                </form></li>
        </ul> 
    </div>
    	<?php
		
		/*customer's leaving message*/
		include("dbCfg.php");
		$sSql = "select * from customerleavemsg where T_PRU_ID='".$_GET["T_ID"]."' and T_URL='".GetCurrentWebHost()."' and T_ROLE=1 order by T_TIME ASC ";
		$result_all_message = mysql_query($sSql,$allDateBase);
		$nMessageTotal = mysql_numrows($result_all_message);
		?>
<div id="TabbedPanels4" class="TabbedPanels">
	<ul class="TabbedPanelsTabGroup">
    	<li class="TabbedPanelsTab" tabindex="0">在线留言</li>
		<li class="TabbedPanelsTab" tabindex="0">留言回复</li>
	</ul>
	<div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
        	<form name="LeaveMsgForm" id="LeaveMsgForm" method="post" action="updateData.php?COM_ID=0010" style="padding:0px; margin:0px;" onsubmit="return showthis();">
            	<ul class="itemLeaveMsg">
               	 <li><span class="itemDetailText_Class">联系方式:</span><input name="C_MAIL" type="text" /></li>
                 <li><span class="itemDetailText_Class">姓名:</span><input name="Nickname" type="text" /></li>
                 <li><span class="itemDetailText_Class">留言内容:</span><textarea name="leaveMsg" id="msg" style="width:500px; height: 100px;"></textarea>(*)</li>
				 <li><span class="itemDetailText_Class">验证码：</span><input name="randcode" type="text"  style="width:50px;"  maxlength="4" /><img src="randcode.php" id="code"/><a style="cursor:hand" onclick="change('code');" >看不清，换一张</a></li>
                 <li><span class="itemDetailText_Class">&nbsp;</span><input type="submit" name="Submit2" value="提交留言内容" /><input type="hidden" name="PRU_ID" value="<?php echo $pru_id;?>">
                 </li>
                </ul>
            </form>
		</div>
        <div class="TabbedPanelsContent">
          <?php
		  $nJiOu=1;
          while($row=mysql_fetch_array($result_all_message))
		  {
		  ?>
          <ul class="msgReplied<?php echo $nJiOu=($nJiOu+1)%2;?>">
              <li class="CustomerMsg">
              <span class="CustomerMsg_actor">买家</span><span class=time> <?php 
			  if (strlen($row["T_CUSTOMER_NIKI_NAME"])>0 && strcmp($row["T_CUSTOMER_NIKI_NAME"], "Customer")!=0) 
			  	echo $row["T_CUSTOMER_NIKI_NAME"]; 
			  else 
			  {
			  	$ipList=Split("\.", $row["T_IP_ADD"]);
				echo $ipList[0].".".$ipList[1].".*.* ";
			  }
			  ?> <?php echo date("Y-m-d H:i:s", strtotime($row["T_TIME"])); ?></span></li>
                <li class="LeaveMsgText">
               <?php echo str_replace("\n", "<br>", $row["T_MSG"]);?></li>
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
                <span class="aminMsg_actor">管理员</span><span class=time>2008-05-10 10:20</span></li>
                <li class="LeaveMsgText"><?php echo str_replace("\n", "<br>", $row["T_MSG"]);?></li>
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