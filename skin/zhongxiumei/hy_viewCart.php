﻿<?php
$cart = new cart;
$strCookie=$cart->GetCustomerOrderList();
$strItemList=explode("=====",$strCookie);
$nCount = count($strItemList);
?>
<div class="viewCartFrame">
	<ul>
	<?php
	if ($nCount>1)
	{
	?>
		<li><span class="pictureText">商品图片</span><span class="actorText">作者</span><span class="sizeText">尺寸</span><span class="IDText">编号</span><span class="priceText">价格</span><span class="actionText">动作</span></li>
	<?php
	}
	else
		echo "您的购物车里面还没有东西呢！！";
	
	$shizi = "";
	$total = 0;
	
    for ($i=0; $i<$nCount; $i++)
	{
		if (empty($strItemList[$i])==true)
			;
		else
		{
			$strIDItem=explode(" ",$strItemList[$i]);
			$strItemCoolieSI=substr($strItemList[$i], strlen($strIDItem[0])+1,strlen($strItemList[$i]));
			$SQL = new SQL;
			$result_currect = $SQL->Query("select * from pru where T_ID='".$strIDItem[0]."'");
			$row=mysqli_fetch_array($result_currect);
			if (strlen($shizi)==0)
				$shizi = $row["T_PRICE"];
			else
				$shizi = $shizi." + ".($row["T_PRICE"]+0);
			$total += $row["T_PRICE"];
			
			$SQL = new SQL;
            $resultTmp = $SQL->Query("select * from registercustomer  where T_ID='".$row["T_USER_ID"]."'");
			$rowUser=mysqli_fetch_array($resultTmp);
	?>
		<li <?php if ($i == $nCount-1) echo "id='bottom'";?>><span class="picture"><a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>"><img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";?>"/></a></span><span class="actor"><?php echo $rowUser["T_CUSTOMER_NAME"];?></span><span class="size"><?php echo $row["T_SIZE"];?></span><span class="ID"><a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>"><?php echo $row["T_ID"];?></a></span><span class="price">￥<?php echo $row["T_PRICE"]+0;?></span><span class="action"><a href="updateData.php?COM_ID=0002&ID=<?php echo $row["T_ID"];?>">删除</a></span></li>
	<?php
		}
	}
	if (strlen($shizi) > 0 && strpos($shizi, "+")!=false)
		$shizi = $shizi." = ";
	else
		$shizi = "";
	?>
		<li id="total" style="display:none;">金额合计： <?php echo $shizi.$total ;?>￥</li>
		<li id="button"><input class="submitBtn" type="button" value="提交订单" onclick="document.getElementById('button').style.display='none'; document.getElementById('submitForm').style.display='block';"/></li>
	</ul>
</div>

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

	//if(document.OrderFrom.mail.value!=document.OrderFrom.Rmail.value)
	//{
	//		alert("Please check the mail you inputed, its not the same!");
	//		return false;
	//}

	//if(document.OrderFrom.country.value)
	//	;
	//else
	//{
	//	alert("Please input the country where they will be send to!");
	//	return false;
	//}
	if(document.OrderFrom.msg.value){
		str = str + document.OrderFrom.msg.value;
		if (str.length>255)
		{
			alert("The msg's max length is 255!");
			return false;
		}
	}
	if(document.OrderFrom.randcode.value)
		;
	else
	{
		alert("Please input the Random Code!");
		return false;
	}
	return true;
}
function change(id){
   document.getElementById(id).src = 'randcode.php?'+Math.random(1);
}
</script>

 <div class="TabbedPanelsContentGroup" id="submitForm">
  	<form name="OrderFrom" id="OrderFrom" method="post" action="updateData.php?COM_ID=0013" class="cartInputForm" onsubmit="return(showthis());">
    	<div class="TabbedPanelsContent">
        	<ul class="itemDetailText">
				<li><span class="itemDetailText_Class">联 系 人:</span><input name="name" type="text" maxlength="32" /></li>
				<li><span class="itemDetailText_Class">联系电话:</span><input name="mobilePhone" type="text" maxlength="32" /></li>
				<li><span class="itemDetailText_Class">E-Mail:</span><input name="mail" type="text" maxlength="32" /></li>
        		<li><span class="itemDetailText_Class">QQ 号:</span><input name="qq" type="text" maxlength="32" /></li>
                <li><span class="itemDetailText_Class">其他备注:</span><textarea name="msg" style="width:500px; height:200px;"></textarea></li>
                <li><span class="itemDetailText_Class">验证码：</span><input name="randcode" type="text"  maxlength="4"  style="width:50px;" /><img src="randcode.php"  id="code" /><a style="cursor:hand" onclick="change('code');" >看不清，换一张</a></li>
				<li><div class="cartInputButtonForm">
                <input class="submitBtn" name="Submit" type="submit" id="Submit" value="提交订单">&nbsp;&nbsp;&nbsp; <input class="submitBtn" name="reset" type="reset" id="reset" value="重置"></div></li>
            </ul>
      </div>
      <input name="itemList" type="hidden" value="<?php echo $strCookie;?>" />
	  <input name="url" type="hidden" value="?p=success" />
    </form>
</div>


