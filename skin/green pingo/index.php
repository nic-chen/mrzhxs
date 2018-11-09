<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php 
include_once("settings.php");
include_once(LIBPATH."lib.php");
$webConfig = new WebConfig;
$cart = new cart();

echo $webConfig->webNAME; ?></title>
<LINK media=screen href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/style.css" type=text/css rel=stylesheet>
<LINK media=screen href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/menu_bottom.css" type=text/css rel=stylesheet>
<SCRIPT language=JavaScript src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/common.js" type=text/javascript></SCRIPT>
<SCRIPT language=JavaScript src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/common2.js" type=text/javascript></SCRIPT>
<SCRIPT language=JavaScript src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/imagerollover.js" type=text/javascript></SCRIPT>
<SCRIPT language=JavaScript src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/small.images.js" type=text/javascript></SCRIPT>
<script src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body <?php 
	$pageIndex=$_GET["p"];
	if (strlen($pageIndex)==0 || $pageIndex=="product")
		echo "onload=\"init()\"";
		?>>
<div class=top_logo>
<img src="<?php echo GetCurrentWebHost();?>/pub/logo.jpg" />
</div>

<?php
$sSql="select * from t_top_nav where T_URL='".GetCurrentWebHost()."' order by T_INDEX ASC, T_NAME";
$SQL=new SQL;
$navResult=$SQL->Query($sSql);
$nIndex=-1;
while($row=mysqli_fetch_array($navResult))
{
	$nIndex++;
	$strPtype="";
	if ($row["T_TYPE"]=="cart")
		$strPtype="viewCart";
	else if ($row["T_TYPE"]=="product")
		$strPtype="product";
	else if ($row["T_TYPE"]=="contact")
		$strPtype="Contact";
	else if ($row["T_TYPE"]=="Other")
		$strPtype="Other";
	$strID=$row["T_ID"];
	$strNavName=$row["T_NAME"];	
	
	if ($nIndex==0)
	{
?>
<div class=nav>
  <ul>
  	<?php
    }
	if ($nIndex>0)
	{
	?>
	<li>|</li>
	<?php
	}
	?>
    <li ><a href="<?php echo "?p=$strPtype&ID=$strID"?>"><?PHP echo $strNavName;?></a> </li>	<?php
}
if ($nIndex>-1)
{
?>
  </ul>
</div>
<?php
}
?>

<DIV class="clearfix" id="itemBody">
	<div class="body_left" >
	<b class="xtop"><b class="xt1"></b><b class="xt2"></b><b class="xt3"></b><b class="xt4"></b></b>
	  <div class="xboxcontent"><p></p>
<h1 style="margin-top:10px;">Contact us</h1>
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
				?>
				
                <ul id=<?php echo $contactClass;?>><p></p>
                    <li class="contact_info">
                        <a href="<?php echo $contactURL;?>"><?php echo $mailList[1]."";?></a>
                    </li>
				</ul>
				<?php
		}
?>
<h1>Product</h1>
<link rel="stylesheet" href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/gmenu.css">
<script type="text/javascript" src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/gmenu.js"></script>
<div style="float:inherit;">
    	<div id="TabbedPanels2" class="TabbedPanels2">
          <ul class="TabbedPanelsTabGroup">
            <li class="TabbedPanelsTab" tabindex="0">Categories</li>
            <li class="TabbedPanelsTab" tabindex="0">Brand</li>
          </ul>
          <div class="TabbedPanelsContentGroup">
            <div class="TabbedPanelsContent">
                      	<script type="text/javascript" src="menu_class.js"></script>
            </div>
            <div class="TabbedPanelsContent">

					  	<script type="text/javascript" src="menu_brand.js"></script>

            </div>
          </div>
        </div>
        <script type="text/javascript">
        <!--
        var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");
        //-->
        </script>
    </div>
<h1 class="PaymentTitle">Payment</h1>
<UL class="PAYMENT_PIC">
  <li><a href="http://www.boc.cn/en/static/index.html"><img src="pub_images/Payment01.jpg" /></a></li>
  <li><a href="http://www.westernunion.com/"><img src="pub_images/Payment02.jpg" /></a></li>
  <li><a href="http://www.moneygram.com/"><img src="pub_images/Payment03.jpg" /></a></li>
  <li><a href="http://www.visa.com/"><img src="pub_images/Payment04.jpg" /></a></li>
</UL>

<h1 class="ShippingTitle">Shipping</h1>
<UL class="PAYMENT_PIC">
  <li><a href="http://www.dhl.com/splash.html"><img src="pub_images/Shipping01.jpg" /></a></li>
  <li><a href="http://www.tnt.com.cn/en/index.asp"><img src="pub_images/Shipping02.jpg" /></a></li>
  <li><a href="http://www.ems.com.cn/english-main.jsp"><img src="pub_images/Shipping03.jpg" /></a></li>
  <li><a href="http://www.ups.com/"><img src="pub_images/Shipping04.jpg" /></a></li>
</UL>
</div>
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div>

<div class="body_right">
	<div class="main_logo">
		<div id="logo">
			<SCRIPT language=javascript>
			var m_nPageInitTime = new Date();
			var MainTopRoll = new xwzRollingImageTrans("IMG_MAIN_TOP_ROLL_DETAIL", "IMGS_MAIN_TOP_ROLL_THUMBNAIL");
			MainTopRoll.addItem("#","pub_images/banner001.jpg");
			MainTopRoll.addItem("#","pub_images/banner002.jpg");
			MainTopRoll.addItem("#","pub_images/banner003.jpg");
		</SCRIPT>
		<IMG class=clssMainRoll
				src="pub_images/banner001.jpg" border=0 
				name=IMG_MAIN_TOP_ROLL_DETAIL>      
		</div>
        
        <div id=control_logo_frame>
        	<div style="margin:0px 0px 7px 0px">
			<img  src="pub_images/mini_01.jpg" style="CURSOR: pointer" 
					  onclick=MainTopRoll.alterImage(0)  /></div>
            <div style="margin:0px 0px 7px 0px">
            <img  src="pub_images/mini_02.jpg" style="CURSOR: pointer" 
					  onclick=MainTopRoll.alterImage(1)  /></div>
            <div style="margin:0px 0px 0px 0px">
            <img  src="pub_images/mini_03.jpg" style="CURSOR: pointer" 
					  onclick=MainTopRoll.alterImage(2)  /></div>
        </div>
        
        <IMG style="DISPLAY: none" height=5 
					  width=9 align=absMiddle border=0 
					  name=IMGS_MAIN_TOP_ROLL_THUMBNAIL>
		<IMG style="DISPLAY: none" height=5 
					  width=9 align=absMiddle border=0 
					  name=IMGS_MAIN_TOP_ROLL_THUMBNAIL>
		<IMG style="DISPLAY: none" height=5 
					  width=9 align=absMiddle border=0 
					  name=IMGS_MAIN_TOP_ROLL_THUMBNAIL>
	  <SCRIPT language=JavaScript>
		MainTopRoll.Index =  parseInt('0');
		MainTopRoll.install();
		</SCRIPT>
	</div>
    
	<div class="ItemShowMain">
		<b class="xtop"><b class="xt1"></b><b class="xt2"></b><b class="xt3"></b><b class="xt4"></b></b>
		<div class="xboxcontent"><p>&nbsp;</p>
        	<div class="searchForm">
            <form action="?p=search" method="get" style="margin:0px; padding:3px;">
            	<input name="CLASSS" type="text" style="width:280px;" value="<?php echo Trim(Trim($_GET["CLASSS"])." ".Trim($_GET["T_CHILD"])." ".Trim($_GET["T_CLASS"]) ); ?>" />
            	By:
            	<select name="FanWei">
                <?php
                $choosedFenlei=$_GET["FanWei"];
				$selectedInfo="selected=\"selected\"";
				?>
            	  <option value="By_All"  <?php if ($choosedFenlei=="By_All") echo "$selectedInfo"; ?>>All</option>
            	  <option value="By_Brand"  <?php if ($choosedFenlei=="By_Brand") echo "$selectedInfo"; ?>>Brand</option>
                  <option value="By_Class"  <?php if ($choosedFenlei=="By_Class") echo "$selectedInfo"; ?>>Categories</option>
                  <option value="By_ID"  <?php if ($choosedFenlei=="By_ID") echo "$selectedInfo"; ?>>ID</option>
            	</select>
                Style:<select name="sex">
                <?php
                $choosedSex=$_GET["sex"];
				$selectedInfo="selected=\"selected\"";
				?>
            	  <option value="By_All" <?php if ($choosedSex=="By_all") echo "$selectedInfo"; ?>>All</option>
            	  <option value="2"  <?php if ($choosedSex=="2") echo "$selectedInfo"; ?>>For Women style</option>
                  <option value="1"  <?php if ($choosedSex=="1") echo "$selectedInfo"; ?>>For Men style</option>
                  <option value="0"  <?php if ($choosedSex=="0") echo "$selectedInfo"; ?>>Unsex style</option>
            	</select>
                <input name="Search" type="submit" id="Search" value="Search" /><input name="p" type="hidden" value="search" />
              </select>
            </form>
            </div>
		  	<?php
				$pageIndex=$_GET["p"];
				if (strlen($pageIndex)==0 || $pageIndex=="product")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/main.php");
				else if ($pageIndex=="search")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/search.php");
				else if ($pageIndex=="ItemDetail")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/ItemDetail.php");
				else if ($pageIndex=="viewCart")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/viewCart.php");
				else if ($pageIndex=="Other")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/Other.php");
				else if ($pageIndex=="success")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/success.php");	
				else if ($pageIndex=="viewOrder")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/viewOrder.php");	
				else if ($pageIndex=="Contact")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/Contact.php");	
				else if ($pageIndex=="ebay")
					include_once("skin/".$webConfig->webOther->GetContectByName("Skin")."/ebay.php");
			?>
		</div>
	  <b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
	</div>
  </div>
</DIV>

<div class="main_bottom">All Content Copyright ? 2006 buy.paiple.com, Inc.</div>
</body>
</html>
