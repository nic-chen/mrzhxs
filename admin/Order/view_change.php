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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<script language="javascript">

function ChangeHowToSend()
{
	var theObj=document.getElementById("SendOderDate") ;
	if(theObj)
	{
		if (theObj.style.display=="none")
			theObj.style.display="block";
		else
			theObj.style.display="none";
	}

}

function CheckShouKuan()
{
	if(!document.lrFrom.cJianKongNum.value)
	{
		alert("请输入付款监控号码信息! ");
		return false;
	}
	
	if(!document.lrFrom.cBeiZhuInfo.value)
	{
		alert("请输入备注信息! \n如果是paypal付款，请填写收款帐号！\n如果是非paypal收款，请填写收款人姓名！");
		return false;
	}	
	return true;
}
</script>
<body><?php
include("manageOrderDH.php");
?>
<?php
$timeInfo=time()+14*60*60;
$strTime=date("Y-m-d",$timeInfo);

$strCreateDate=$_GET["DATE"];
$strCreateSer=$_GET["SER"];
$strStep=$_GET["STEP"];

$SQL = new SQL;

$result = $SQL->Query("select * from OFFER_ALL_USER where T_DATE='$strCreateDate' and T_SER='$strCreateSer' and T_URL='".GetCurrentWebHost()."';");
$row=mysql_fetch_array($result);
if (!$row)
	die("dont find this order DATE=[$strCreateDate] SER=[$strCreateSer]");

$cur_admin = new admin;
$cur_admin->GetAdminSignInfo($adminName, $adminPwd);

$result_admin = $SQL->Query("select * from admin where T_NAME='".$adminName."' and T_URL='".GetCurrentWebHost()."';");
//echo "select * from admin where T_NAME='".GetAdminSignInName()."' and T_URL='".GetCurrentWebHost()."';"."<br>";
$rowAdmin=mysql_fetch_array($result_admin);
?>
<table width="700" height="585" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
  <tr>
    <td height="2" align="center" valign="top"><?php include("menu.php"); ?></td>
  </tr>
  <tr>
    <td height="585" align="center" valign="top">
	<table width="90%"  border="0" cellspacing="1" cellpadding="1">
      <tr align="left">
        <td height="20" colspan="4"> </td>
      </tr>
      <tr align="left">
        <td><a href="item_list.php?<?php echo "DATE=$strCreateDate&SER=$strCreateSer&type=price";?>" target="_blank">Price detail</a></td>
        <td><a href="item_list.php?<?php echo "DATE=$strCreateDate&SER=$strCreateSer&type=price_payment";?>" target="_blank">Price+payment info</a></td>
        <td><a  href="item_list.php?<?php echo "DATE=$strCreateDate&SER=$strCreateSer&type=user_confirm";?>" target="_blank">Customers confirm</a></td>
        <td align="right"><a href="item_list.php?<?php echo "DATE=$strCreateDate&SER=$strCreateSer&type=Out_of_stock";?>" target="_blank">Out of stock</a></td>
      </tr>
    </table>
	<?php
		if ((int)$strStep+1==1) 
		{
		?><br><br>
	<form id="lrFrom" name="lrFrom" method="post" action="<?php echo "updateData.php?COM_ID=2002&DATE=".$strCreateDate."&SER=".$strCreateSer."&STEP=1";?>" onSubmit="return(showthis());"  style="margin:0px;padding:0px" >
        <table width="90%" height="159" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C2DC71">
          <tr align="left" valign="middle">
            <td height="5" align="left">&nbsp;</td>
            <td width="35%" height="5">&nbsp;</td>
            <td width="8%" height="5">&nbsp;</td>
            <td width="46%" height="5">&nbsp;</td>
          </tr>
          <tr align="left" valign="middle">
            <td width="11%" height="22" align="left">Mail:</td>
            <td height="22" colspan="3"><input name="cMail" type="text" value="<?php echo $row["T_MAIL"];?>" size="50" /></td>
          </tr>
          <tr align="left" valign="middle">
            <td height="22" align="left">Name:</td>
            <td height="22"><input name="cName" type="text" value="<?php echo $row["T_USER_NAME"];?>"/></td>
            <td>Sub ID: </td>
            <td><input name="cSubID" type="text" value="<?php echo $row["T_SUB_ORDER_ID"];?>"/></td>
          </tr>
          <tr align="left" valign="middle">
            <td height="22" align="left">Payment:</td>
            <td height="22"><select name="select2">
              <option value="paypal" <?php 
			  if ($row["T_PAY_TYPEC"]=="paypal" ) 
			 	 echo "selected=\"selected\"";
			  ?>>Paypal</option>
              <option value="Bank transfer" <?php
			  if ($row["T_PAY_TYPEC"]=="Bank transfer" ) 
			  	echo "selected=\"selected\"";
			  ?>>Bank transfer</option>
              <option value="moneybooker" <?php
			  if ($row["T_PAY_TYPEC"]=="moneybooker" ) 
				  echo "selected=\"selected\"";
			  ?>>moneybooker</option>
              <option value="moneygram" <?php
			  if ($row["T_PAY_TYPEC"]=="moneygram" ) 
			  	echo "selected=\"selected\"";
			  ?>>moneygram</option>
              <option value="western union" <?php
			  if ($row["T_PAY_TYPEC"]=="western union" ) 
			  	echo "selected=\"selected\"";
			  ?>>western union</option>
              <option value="other" <?php
			  if ($row["T_PAY_TYPEC"]=="other" ) 
			  	echo "selected=\"selected\"";
			  ?>>other</option>
            </select></td>
            <td>Amount</td>
				<td><input name="cMoney" type="text" value="<?php echo $row["T_JIAOYI_MONEY"];?>" />
              <select name="select">
                <option value="USD">USD</option>
                <option value="CAD">CAD</option>
                <option value="URO">URO</option>
                <option value="RMB">RMB</option>
                <option value="other">other</option>
              </select></td>
          </tr>
		  <tr align="left" valign="middle">
		    <td height="22" align="left">Address:</td>
		    <td height="22" colspan="3" align="left"><textarea name="cAddress" cols="60" rows="6"><?php echo $row["T_CUS_ADDRESS"];?></textarea></td>
	      </tr>
		  <tr valign="top">
            <td width="11%" height="22" align="left" valign="middle">Item List:            </td>
            <td height="22" colspan="3" align="left" valign="middle">
              <textarea name="orderList" cols="60" rows="6"><?php echo $row["T_DINGDAN_MINGXI"];?></textarea></td>
          </tr>
		  <tr valign="top">
            <td width="11%" height="22" align="left" valign="middle">Memo:            </td>
            <td height="22" colspan="3" align="left" valign="middle">
              <textarea name="cOtherInfo" cols="60" rows="6"><?php echo $row["T_CREATE_BEIZHU"];?></textarea></td>
          </tr>
		  <tr align="left" valign="middle">
            <td height="22" align="left">&nbsp;            </td>
            <td height="22" colspan="3" align="right"><input type="submit" name="Submit" value="Submit" />&nbsp;&nbsp;</td>
          </tr>
        </table>
	</form>
	<?php
	    }
	    else
	    {
	  ?>
	<form name="ItemList" id="form2" method="post" action="../../item_list.php" style="margin:0px;padding:0px" target="_blank">
	  <table width="90%"  border="0">
        <tr>
          <td width="100%"><table width="100%" height="155" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr align="left" valign="middle">
                <td height="20" colspan="3"> </td>
                <td height="20" align="right"> </td>
              </tr>
              <tr align="left" valign="middle">
                <td height="22" colspan="3">Order ID---[<?php echo $row["T_DATE"].$row["T_SER"];?>]<?php
				if (strlen($row["T_SUB_ORDER_ID"])>0)
					echo "&nbsp;&nbsp;Sub ID--[".$row["T_SUB_ORDER_ID"]."]";
				?></td>
                <td height="22" align="right"><a href="<?php echo "?DATE=".$strCreateDate."&SER=".$strCreateSer."&STEP=0&USTEP=TRUE";?>">Change</a></td>
              </tr>
              <tr align="left" valign="middle">
                <td height="1" colspan="4" bgcolor="#0066CC"></td>
              </tr>
              <tr align="left" valign="middle">
                <td width="11%" height="22" align="left">Name:</td>
                <td width="39%" height="22"><?php echo $row["T_USER_NAME"];?></td>
                <td width="10%">Mail:</td>
                <td width="40%"><?php echo $row["T_MAIL"];?></td>
              </tr>
              <tr align="left" valign="middle">
                <td height="22" align="left">Payment:</td>
                <td height="22"><?php echo $row["T_PAY_TYPEC"];?></td>
                <td>Amount:</td>
                <td width="40%"><?php echo $row["T_JIAOYI_MONEY"]." ".$row["T_JIAOYI_DANWEI"];?></td>
              </tr>
              <tr valign="top">
                <td width="11%" height="22" align="left" valign="middle"><p>Address:</p></td>
                <td height="22" colspan="3" align="left" valign="middle">
                  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                      <td height="100%" bgcolor="#CCFF99"><?php echo str_replace("\r\n","<br>",$row["T_CUS_ADDRESS"]."");?>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top">
                <td width="11%" height="22" align="left" valign="middle"><p>Item List:</p></td>
                <td height="22" colspan="3" align="left" valign="middle">
                  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                      <td bgcolor="#FFFF99"><?php echo str_replace("\r\n","<br>", $row["T_DINGDAN_MINGXI"]."");?>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top">
                <td width="11%" height="22" align="left" valign="middle"><p>Memo:</p></td>
                <td height="22" colspan="3" align="left" valign="middle"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td bgcolor="#CCCCCC"><?php echo str_replace("\r\n","<br>", $row["T_CREATE_BEIZHU"]);?>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
    </form>
	<?php
		}
		
		?><br>
		<table width="90%"  border="0">
          <tr>
            <td width="50%" align="left">Customer's payment info</td>
            <td width="50%" align="right"><a href="<?php echo "?DATE=".$strCreateDate."&SER=".$strCreateSer."&STEP=1&USTEP=TRUE";?>">Change</a></td>
          </tr>
          <tr>
            <td height="1" colspan="2" bgcolor="#0066CC"></td>
          </tr>
        </table>
		<?php
		if ($strStep+1==2) 
		{
		?>
    <form id="lrFrom" name="lrFrom" method="post" action="<?php echo "updateData.php?COM_ID=2003&DATE=".$strCreateDate."&SER=".$strCreateSer."&STEP=1";?>" onsubmit="return(showthis());" style="margin:0px;padding:0px">
      <table width="90%"  border="0" bgcolor="#C2DC71">
        <tr valign="bottom">
          <td width="14%" align="left">Payment ID:</td>
          <td width="36%" align="left"><input name="cJianKongNum" type="text" value="<?php echo $row["T_PAY_CODE"];?>" />
          *</td>
          <td width="10%" align="left">Date:</td>
          <td width="40%" align="left"><input name="cHuiKuanDate" type="text" value="<?php
			  if (strlen($row["T_PAY_DATE"])>0)
			  	echo $row["T_PAY_DATE"];
			  else
			  	echo $strTime;
			  ?>" />
            eg:20060822</td>
        </tr>
        <tr valign="bottom">
          <td align="left">Money actual:</td>
          <td colspan="3" align="left"><input name="cMoneyActual" type="text" value="<?php echo $row["T_PAY_RECIEVE"];?>" /></td>
        </tr>
        <tr valign="bottom">
          <td align="left">Memo info:</td>
          <td align="left"><input type="text" name="cBeiZhuInfo" value="<?php echo $row["T_PAY_BEIZHU"];?>" />
          *</td>
          <td align="left"> </td>
          <td align="right"><input type="submit" name="Submit3" value="Submit" onClick="return CheckShouKuan();"/></td>
        </tr>
      </table>
    </form>
	<?php
	    }
	    else
	    {
	  ?><table width="90%" border="0">
          <tr align="left">
            <td width="14%">Payment ID:</td>
            <td width="36%"><?php echo $row["T_PAY_CODE"];?></td>
            <td width="10%">Date:</td>
            <td width="40%"><?php echo $row["T_PAY_DATE"];?></td>
          </tr>
          <tr align="left">
            <td>Money actual:</td>
            <td colspan="3"><?php echo $row["T_PAY_RECIEVE"];?></td>
          </tr>
		  <tr align="left">
		    <td>Memo:</td>
		    <td colspan="3"><?php echo $row["T_PAY_BEIZHU"];?></td>
	      </tr>

        </table>
		<?php
		}
		?>
		<br>
		<table width="90%"  border="0">
          <tr>
            <td width="50%" align="left">Prepare items:</td>
            <td width="50%" align="right"><a href="<?php echo "?DATE=".$strCreateDate."&SER=".$strCreateSer."&STEP=2&USTEP=TRUE";?>">Change</a></td>
          </tr>
          <tr>
            <td height="1" colspan="2" bgcolor="#0066CC"></td>
          </tr>
        </table>
		<?php
		if ($strStep+1==3)
		{ 
		?>
        <form id="lrFrom" name="lrFrom" method="post" action="<?php echo "updateData.php?COM_ID=2004&DATE=".$strCreateDate."&SER=".$strCreateSer;?>" onSubmit="return(showthis());" style="margin:0px;padding:0px">
		  <table width="90%"  border="0" bgcolor="#C2DC71">
            <tr valign="bottom">
              <td width="10%" align="left">Infomation: </td>
              <td colspan="2" align="left"><input name="cKuaiJiBeiZhu" type="text" value="<?php
			  if (strlen($row["T_KUAIJI_BEIZHU"])>0)
			  		echo $row["T_KUAIJI_BEIZHU"];
			  else
			  	echo $strTime." Make shipping list!";
			  ?>" size="40" />
              <input name="IsSendConfirmMail" type="checkbox" id="IsSendConfirmMail" value="true" />Send confirm mail
              <input type="hidden" name="mail" value="<?php echo $row["T_MAIL"];?>"/>
              <input name="cYunDanNum" type="hidden" />
              <input name="SUB_ID" type="hidden" value="<?php echo $row["T_SUB_ORDER_ID"]; ?>"/>
              <input name="update" type="hidden" value="true"/>
              <textarea name="address" cols="50" rows="6" style="display:none"><?php echo $row["T_CUS_ADDRESS"]; ?></textarea>
              <textarea name="itemList" cols="50" rows="6" style="display:none"><?php echo $row["T_DINGDAN_MINGXI"]; ?></textarea></td>
              <td width="11%" align="right"><input type="submit" name="Submit32" value="Submit" /></td>
            </tr>
          </table>
        </form>
        <?php
	    }
	    else
	    {
	  ?>
        <table width="90%"  border="0"><tr align="left" valign="bottom">
          <td valign="middle">Infomation: <?php echo $row["T_KUAIJI_BEIZHU"];?></td>
          </tr>
      </table>
	  <?php
	  }
	  ?><br>
      <table width="90%"  border="0">
        <tr>
          <td width="50%" align="left">Shipping Infomation </td>
          <td width="50%" align="right"><a href="<?php echo "?DATE=".$strCreateDate."&SER=".$strCreateSer."&STEP=3&USTEP=TRUE";?>">Change</a></td>
        </tr>
        <tr>
          <td height="1" colspan="2" bgcolor="#0066CC"></td>
        </tr>
      </table>
      <?php
		if ($strStep+1==4) 
		{
		?>
      <form id="lrFrom" name="lrFrom" method="post" action="<?php echo "updateData.php?COM_ID=2005&DATE=".$strCreateDate."&SER=".$strCreateSer;?>" onSubmit="return(showthis());" style="margin:0px;padding:0px">
        <table width="90%"  border="0" bgcolor="#C2DC71">
          <tr valign="bottom">
            <td width="12%" align="left">Shpping co :</td>
            <td width="33%" align="left"><select name="ShippingCom">
              <option value="EMS" <?php if ($row["T_YUNDAN_COM"]=="EMS" || strlen($row["T_YUNDAN_COM"])==0) 
			  echo "selected=\"selected\"";
			  ?>>EMS</option>
              <option value="DHL" <?php if ($row["T_YUNDAN_COM"]=="DHL" ) 
			  echo "selected=\"selected\"";
			  ?>>DHL</option>
              <option value="TNT" <?php if ($row["T_YUNDAN_COM"]=="TNT" ) 
			  echo "selected=\"selected\"";
			  ?>>TNT</option>
              <option value="UPS" <?php if ($row["T_YUNDAN_COM"]=="UPS" ) 
			  echo "selected=\"selected\"";
			  ?>>UPS</option>
              <option value="OTHERS" <?php if ($row["T_YUNDAN_COM"]!="EMS" && $row["T_YUNDAN_COM"]!="DHL" && $row["T_YUNDAN_COM"]!="TNT" && $row["T_YUNDAN_COM"]!="UPS" && strlen($row["T_YUNDAN_COM"])!=0)
			   echo "selected=\"selected\"";
			   ?>>OTHERS</option>
            </select></td>
            <td width="10%" align="left">Date:</td>
            <td colspan="2" align="left"><input name="cFaHuoDate" type="text" value="<?php
			  if (strlen($row["T_YUNDAN_DATE"])>0)
			  	echo $row["T_YUNDAN_DATE"];
			  else
			  	echo $strTime;
			  ?>" /></td>
          </tr>
          <tr valign="bottom">
            <td align="left" valign="top">Track no: </td>
            <td colspan="4" align="left"><textarea name="cFaHuoBeiZhu" cols="50" rows="6"><?php 
				if (strlen($row["T_YUNDAN_NUM"])>0)
					echo $row["T_YUNDAN_NUM"]."\r\n".$row["T_YUNDAN_BEIZHU"];
					
				if (strlen($row["T_YUNDAN_BEIZHU"])>0)
					echo $row["T_YUNDAN_BEIZHU"]."\r\n"." ".$strTime;
				else
					echo " ".$strTime;
			?></textarea></td>
          </tr>
          <tr valign="bottom">
            <td align="left">&nbsp;</td>
            <td colspan="2" align="left"><input name="IsSendMail" type="checkbox" id="IsSendMail" value="true" />Send tracking number to customer
              <input type="hidden" name="mail" value="<?php echo $row["T_MAIL"];?>"/><input name="cYunDanNum" type="hidden" /><input name="SUB_ID" type="hidden" value="<?php echo $row["T_SUB_ORDER_ID"]; ?>"/>
<input name="update" type="hidden" value="true"/>
<textarea name="address" cols="50" rows="6" style="display:none"><?php echo $row["T_CUS_ADDRESS"]; ?></textarea>
<textarea name="itemList" cols="50" rows="6" style="display:none"><?php echo $row["T_DINGDAN_MINGXI"]; ?></textarea></td>
            <td width="26%" align="left"><input type="submit" name="Submit3" value="Submit" /></td>
            <td width="19%" align="right">&nbsp;</td>
          </tr>
        </table>
      </form>
      <?php
	  }
	  else
	  {
	  ?>
      <table width="90%"  border="0">
        <tr align="left" valign="bottom">
          <td width="13%">Shpping co:</td>
          <td width="37%"><?php
		  if (strlen($row["T_YUNDAN_COM"])>0 )
		  	echo $row["T_YUNDAN_COM"];
		  else
		  	echo "EMS or Unkwon";
		  ?></td>
          <td width="10%">Date:</td>
          <td width="40%"><?php echo $row["T_YUNDAN_DATE"];?></td>
        </tr>
        <tr align="left" valign="bottom">
          <td valign="top">Track NO::</td>
          <td colspan="3"><?php if (strlen($row["T_YUNDAN_NUM"])>0)
					echo str_replace("\r\n", "<br>", $row["T_YUNDAN_NUM"]."<BR>".$row["T_YUNDAN_BEIZHU"]);
				else
					echo str_replace("\r\n", "<br>", $row["T_YUNDAN_BEIZHU"]);
					?></td>
        </tr>
      </table>
      <?php
	  }
	  ?><br>   
      <table width="90%"  border="0">
        <tr>
          <td width="50%" align="left">Shipping Status </td>
          <td width="50%" align="right"><a href="<?php echo "?DATE=".$strCreateDate."&SER=".$strCreateSer."&STEP=4&USTEP=TRUE";?>">Change</a></td>
        </tr>
        <tr>
          <td height="1" colspan="2" bgcolor="#0066CC"></td>
        </tr>
      </table>
	  <?php
		if ($strStep+1==5 ) 
		{
		?>
	  	<table width="90%"  border="0" bgcolor="#C2DC71">
			<tr valign="bottom">
              <td align="center"><form name="lrFrom" id="lrFrom" method="post" action="<?php echo "updateData.php?COM_ID=2006&DATE=".$strCreateDate."&SER=".$strCreateSer;?>" style="margin:0px;padding:0px">
                <input type="hidden" name="querenShouHuo" value="true"/>
                <input type="submit" name="submit" value="Deliveried" />
              </form></td>
            </tr>
      </table>
	  <?php
	  }
	  else
	  {
	  ?>
	  <table width="90%"  border="0">
            <tr align="left" valign="bottom">
             <td>Shipping Result :
             <?php
			 if ($row["T_STEP"]==5)
			  echo $row["T_C_RECIEVE"]."  ".$row["T_SHOUHUO_DATA"];?></td>
      </table>
	  <?php
	  }
	  
	  if (false)
	  {
	  ?>
      <table width="90%"  border="0">
        <tr>
          <td colspan="4" align="left">MoneySpend (RMB) </td>
        </tr>
		<tr>
          <td height="1" colspan="4" bgcolor="#0066CC"></td>
        </tr>
        <tr>
          <td align="left">国内运费</td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
          <td align="center">Remove | Change </td>
        </tr>
       <form action="<?php echo "updateData.php?COM_ID=2012&DATE=".$strCreateDate."&SER=".$strCreateSer;?>" method="post" style="margin:0px;padding:0px">
	   <tr>
          <td width="25%" align="left"><select name="select3">
            <option value="1">国外运费 如EMS</option>
            <option value="2">国内运费</option>
            <option value="3">自己备货费用</option>
            <option value="4">其他费用</option>
          </select>
          </td>
          <td width="29%" align="left"><input name="textfield2" type="text" size="20" /></td>
          <td width="25%" align="left"><input name="textfield3" type="text" size="20" /></td>
          <td width="21%" align="center"><input type="submit" name="Submit4" value="Add" /></td>
        </tr></form>
        
      </table>
	  <?php
      }
	  ?>
       
      	</td>
  </tr>
</table>
</body>
</html>
