<?php
$sSql="select * from t_top_nav where T_URL='".GetCurrentWebHost()."' AND T_ID=".$_GET["ID"]." order by T_INDEX ASC, T_NAME";
include(APPROOT."dbCfg.php");
$navResult=mysqli_query($sSql,$allDateBase);
$row=mysqli_fetch_array($navResult);
?>
<h1><?php echo $row["T_NAME"];?></h1>

<div class="otherText">
<?php
		$webContactInfo=$webConfig->webCONTACT_INFO;
		//echo $webContactInfo;
		$webContactList=explode("\r\n", $webContactInfo);
		$nContactList=count($webContactList);
		for ($i=0; $i<$nContactList; $i++)
		{
			//echo $webContactList[$i];
			$mailList=explode("-->", $webContactList[$i]);
			if (strcmp($mailList[0],"MSN")==0)
			{
				$contactClass="UL_MSN";
				$contactURL="msnim:chat?contact=$mailList[1]";
			}
			else
			{
				$contactClass="UL_MAIL";
				$contactURL="mailto:$mailList[1]";
			}
			echo $mailList[0].": ";
			?>
            <a href="<?php echo $contactURL;?>"><?php echo $mailList[1]."";?></a><br>
			<?php
		}
?>
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

	if(document.OrderFrom.mail.value!=document.OrderFrom.Rmail.value)
	{
			alert("Please check the mail you inputed, its not the same!");
			return false;
	}

	if(document.OrderFrom.subject.value)
		;
	else
	{
		alert("Please input the subject!");
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
<div id="TabbedPanelsContact01" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Send us an Message</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
  	<form name="OrderFrom" id="OrderFrom" method="post" action="updateData.php?COM_ID=0014" class="cartInputForm" onsubmit="return(showthis());">
    	<div class="TabbedPanelsContent">
        	<ul class="itemDetailText">
        	<li><span class="itemDetailText_Class">E-Mail:</span><input name="mail" type="text" maxlength="32" /></li>
            <li><span class="itemDetailText_Class">Retype E-Mail:</span><input name="Rmail" type="text" maxlength="32" /></li>
            <li><span class="itemDetailText_Class">Subject:</span><input name="subject" type="text" id="subject" /></li>
            <li><span class="itemDetailText_Class">Msg:</span><textarea name="msg" cols="60" rows="4"></textarea></li>
            <li><span class="itemDetailText_Class">&nbsp;</span>
                <input name="Submit" type="submit" id="Submit" value="Send the Message us">&nbsp;&nbsp;&nbsp; <input name="reset" type="reset" id="reset" value="Reset"></li>
        </div>
    </form>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanelsContact01");
//-->
</script>
<p style="font-size:1px; color:#F8F8F8;">power by yuan</p>
