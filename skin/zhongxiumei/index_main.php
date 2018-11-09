<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php 
include_once("settings.php");
include(LIBPATH."lib.php");
$webConfig = new WebConfig;
$cart = new cart();

echo $webConfig->webNAME; ?></title>
<meta name="keywords" content="字画销售,字画交易,书画,字画,艺术,艺术爱好,国画,油画,书法,水彩,人物,山水,水彩,油画,年画,工艺,工笔,写意,玉器,彩墨,丙烯,漆画,世界书画,艺术" />
<META content="字画销售 字画交易 书画 字画 艺术 艺术爱好 国画 油画 书法 水彩 人物 山水 水彩 油画 年画 工艺 工笔 写意 玉器 彩墨 丙烯 漆画 世界书画 艺术" NAME="description" />
<LINK media=screen href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/style.css" type=text/css rel=stylesheet>
<LINK media=screen href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/menu_bottom.css" type=text/css rel=stylesheet>
<script src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="top_nav">
    <div class="jigou_name"></div>
<ul>
	<li id="set_home"><a href="javascript:window.external.AddFavorite('http://www.mrzhxs.com','名人字画销售网');" >网站收藏</li>
<?php
$sSql="select * from t_top_nav where T_URL='".GetCurrentWebHost()."' order by T_INDEX ASC, T_NAME";
$SQL=new SQL;
$navResult=$SQL->Query($sSql);
$nIndex=0;
while($row=mysql_fetch_array($navResult))
{
	$strPtype="";
	if ($row["T_TYPE"]=="cart")
		$strPtype="viewCart";
	else if ($row["T_TYPE"]=="product")
		$strPtype="product";
	else if ($row["T_TYPE"]=="contact")
		$strPtype="Contact";
	else if ($row["T_TYPE"]=="Other")
		$strPtype="Other";
	else if ($row["T_TYPE"]=="URL")
		$strPtype="URL";
	else if ($row["T_TYPE"]=="Article")
		$strPtype="Article";
	else
		$strPtype="Home";
	$strID=$row["T_ID"];
	$strNavName=$row["T_NAME"];	
?>
        <li ><a href="<?php
    if ($strPtype=="URL")
		echo $row["T_TEXT"];
	else if ($strPtype=="Home")
		echo "http://".GetCurrentWebHost();
	else if ($strPtype=="viewCart")
		echo "?p=product&type=viewCart";
	else
		echo "?p=$strPtype&ID=$strID&classs=".urlencode($strNavName);
	?>"><?PHP echo $strNavName;?></a> </li>
<?php
	$nIndex++;
	if ($nIndex>=4)
		break;
}
?>
  </ul>
</div>
<div class=top_logo>
<CENTER><EMBED style="LEFT: 0px; TOP:10px; POSITION: relative; " align=center src="<?php echo GetCurrentWebHostPath();?>/pub/logo.swf" width=800 height=133 type=application/x-shockwave-flash wmode="transparent" quality="high" ;></CENTER>
</div>
<?php
$nIndex=-1;
while($row=mysql_fetch_array($navResult))
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
	else if ($row["T_TYPE"]=="URL")
		$strPtype="URL";
	else if ($row["T_TYPE"]=="Article")
		$strPtype="Article";
	else if ($strPtype=="viewCart")
		echo "?p=product&type=viewCart";
	else
		$strPtype="Home";
	$strID=$row["T_ID"];
	$strNavName=$row["T_NAME"];	
	
	if ($nIndex==0)
	{
?>
<div class=nav>
  <ul>
  	<?php
    }
	if ($nIndex>0 && $nIndex!=9)
	{
	?>
	<li class="fenge">|</li>
	<?php
	}
	?>
    <li ><a href="<?php
    if ($strPtype=="URL")
		echo $row["T_TEXT"];
	else if ($strPtype=="Home")
		echo "../../";
	else
		echo "?p=$strPtype&ID=$strID&classs=".urlencode($strNavName);
	?>"><?PHP echo $strNavName;?></a> </li>	<?php
	if ($nIndex+1==18)
		break;
}
if ($nIndex>-1)
{
?>
  </ul>
</div>
<?php
}

$p = $_GET["p"]."";

$AD = new AD;
$guanggaoweiResult = $AD->GetAdListByType("guanggaowei");
	if (strlen($p)==0)
	{
		?>
		<div class="guanggao01">
			<script type="text/javascript">
			 var focus_width=969;
			 var focus_height=107;
			 var text_height=0;
			 var swf_height = focus_height+text_height;
			 <?php
			 $AD = new AD;
			 $pics=$links=$texts="";
			 $index = 0;
			 $reslut = $AD->GetAdListByType("huandengpian_head");
			 while($row=mysql_fetch_array($reslut))
			 {
				if ($index == 0)
				{
					$pics=$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$row["T_VALUE"];
					$texts=$row["T_MEMO"];
				}
				else
				{
					$pics=$pics."|".$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$links."|".$row["T_VALUE"];
					$texts=$texts."|".$row["T_MEMO"];
				}
				$index++;
			 }
			 ?>
			 var pics="<?php echo $pics;?>";
			 var links="<?php echo $links;?>";
			 var texts="<?php echo $texts?>";
			 
			 document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
			 document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="images/focus1.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">');
			 document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
			 document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
			 document.write('</object>')			 </script>
		</div>
		<?php
	}
	else if ($p=="Other" && $_GET["classs"]=="合作拍卖")
	{
?>
<div class="guanggao01">
<img src="pub_images/paimai_top.jpg" />
</div>
<?php
	}
	else if ($p=="Other" && $_GET["classs"]=="合作画廊")
	{
?>
<div class="guanggao01">
<img src="pub_images/hualang_top.jpg" />
</div>
<?php
	}
	else if ($p=="product" && $_GET["classs"]=="名作欣赏")
	{
?>
<div class="guanggao01">
<img src="pub_images/xinshang_top.jpg" />
</div>
<?php
	}
	else if ($p=="product")
	{
?>
<div class="guanggao01">
<img src="pub_images/pru_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="花鸟")
	{
?>
<div class="guanggao01">
<img src="pub_images/huaniao_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="山水")
	{
?>
<div class="guanggao01">
<img src="pub_images/shanshui_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="人物")
	{
?>
<div class="guanggao01">
<img src="pub_images/renwu_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="工笔")
	{
?>
<div class="guanggao01">
<img src="pub_images/gongbi_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="书法") 
	{
?>
<div class="guanggao01">
<img src="pub_images/shufa_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="油画")
	{
?>
<div class="guanggao01">
<img src="pub_images/youhua_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="其他")
	{
?>
<div class="guanggao01">
<img src="pub_images/otheractor_top.jpg" />
</div>
<?php
	}
	else if ($p=="actor" &&  $_GET["classs"]=="篆刻")
	{
?>
<div class="guanggao01">
<img src="pub_images/zhuanke_top.jpg" />
</div>
<?php
	}
	else if ($p=="Other" &&  $_GET["classs"]=="会员展厅")
	{
?>
<div class="guanggao01">
<img src="pub_images/yishu_top.jpg" />
</div>
<?php
	}
?>
<div class="clearfix" id="gerenzhuanlan">
	<div class="searchForm">
  <script type="text/javascript">
  function updateSearchType()
  {
  	var nType=document.getElementById('searchType').selectedIndex;
  	if (nType==0) 							
	{
		document.getElementById('searchByActor').style.display='none';
		document.getElementById('searchByPru').style.display='block'; 
	} 
	else 
	{ 
		document.getElementById('searchByPru').style.display='none';
		document.getElementById('searchByActor').style.display='block';
	}
  }
  </script>
	<!--   <div style="float:left; padding-top:2px;">
       
	  	<select id="searchType" name="searchType" onchange="javascript:updateSearchType();">
		<option value="1" selected="selected">搜索作品</option>
		<option value="2">搜索画家</option>
	  </select>
      
	  </div> -->
    <div class="searchSubForm" id="searchByPru">
		<form action="" method="get" style="width:250px; display:block; float:left;">
		  按作品查找：<select name="classs" id="class">
		  <?php
		  $classTmp = $_GET["classs"];
		  $selectedStr = " selected=\"selected\" ";
		  ?>
			<option value=""  <?php if ($classTmp=="") echo $selectedStr;?>>分类</option>
			<option value="花鸟" <?php if ($classTmp=="花鸟") echo $selectedStr;?>>花鸟</option>
			<option value="山水" <?php if ($classTmp=="山水") echo $selectedStr;?>>山水</option>
			<option value="人物" <?php if ($classTmp=="人物") echo $selectedStr;?>>人物</option>
			<option value="工笔 <?php if ($classTmp=="工笔") echo $selectedStr;?>">工笔</option>
			<option value="书法" <?php if ($classTmp=="书法") echo $selectedStr;?>>书法</option>
			<option value="油画" <?php if ($classTmp=="油画") echo $selectedStr;?>>油画</option>
			<option value="篆刻" <?php if ($classTmp=="篆刻") echo $selectedStr;?>>篆刻</option>
			<option value="其他" <?php if ($classTmp=="其他") echo $selectedStr;?>>其他</option>
		  </select>
		  <input name="p" type="hidden" value="product" />
		<input name="type" type="hidden" value="search" />
        <!-- 
		<select name="price" id="price">
		  <?php
		  $classTmp = $_GET["price"];
		  ?>
		  <option value="" <?php if ($classTmp=="") echo $selectedStr;?>>作品单价</option>
		  <option value="0-99" <?php if ($classTmp=="0-99") echo $selectedStr;?>>50-99</option>
		  <option value="100-499" <?php if ($classTmp=="100-499") echo $selectedStr;?>>100-499</option>
		  <option value="500-999" <?php if ($classTmp=="500-999") echo $selectedStr;?>>500-999</option>
		  <option value="1000-1999" <?php if ($classTmp=="1000-1999") echo $selectedStr;?>>1000-1999</option>
		  <option value="2000-2999" <?php if ($classTmp=="2000-2999") echo $selectedStr;?>>2000-2999</option>
		  <option value="3000-3999" <?php if ($classTmp=="3000-3999") echo $selectedStr;?>>3000-3999</option>
		  <option value="4000-5999" <?php if ($classTmp=="4000-5999") echo $selectedStr;?>>4000-5999</option>
		  <option value="6000-8999" <?php if ($classTmp=="6000-8999") echo $selectedStr;?>>6000-8999</option>
		  <option value="9000-11999" <?php if ($classTmp=="9000-11999") echo $selectedStr;?>>9000-11999</option>
		  <option value="12000-14999" <?php if ($classTmp=="12000-14999") echo $selectedStr;?>>12000-14999</option>
		  <option value="15000-19999" <?php if ($classTmp=="15000-19999") echo $selectedStr;?>>15000-19999</option>
		  <option value="20000-25999" <?php if ($classTmp=="20000-25999") echo $selectedStr;?>>20000-25999</option>
		  <option value="26000-29999" <?php if ($classTmp=="26000-29999") echo $selectedStr;?>>26000-29999</option>
		  <option value="30000-9999999" <?php if ($classTmp=="30000-9999999") echo $selectedStr;?>>30000以上</option>
		</select>-->
        <!--  
		<select name="runge_price" id="runge_price">
		  <?php
		  $classTmp = $_GET["runge_price"];
		  ?>
		  <option value="" <?php if ($classTmp=="") echo $selectedStr;?>>作品润格</option>
		  <option value="50-99" <?php if ($classTmp=="50-99") echo $selectedStr;?>>50-99</option>
		  <option value="100-499" <?php if ($classTmp=="100-499") echo $selectedStr;?>>100-499</option>
		  <option value="500-999" <?php if ($classTmp=="500-999") echo $selectedStr;?>>500-999</option>
		  <option value="1000-1999" <?php if ($classTmp=="1000-1999") echo $selectedStr;?>>1000-1999</option>
		  <option value="2000-2999" <?php if ($classTmp=="2000-2999") echo $selectedStr;?>>2000-2999</option>
		  <option value="3000-3999" <?php if ($classTmp=="3000-3999") echo $selectedStr;?>>3000-3999</option>
		  <option value="4000-5999" <?php if ($classTmp=="4000-5999") echo $selectedStr;?>>4000-5999</option>
		  <option value="6000-8999" <?php if ($classTmp=="6000-8999") echo $selectedStr;?>>6000-8999</option>
		  <option value="9000-11999" <?php if ($classTmp=="9000-11999") echo $selectedStr;?>>9000-11999</option>
		  <option value="12000-14999" <?php if ($classTmp=="12000-14999") echo $selectedStr;?>>12000-14999</option>
		  <option value="15000-19999" <?php if ($classTmp=="15000-19999") echo $selectedStr;?>>15000-19999</option>
		  <option value="20000-25999" <?php if ($classTmp=="20000-25999") echo $selectedStr;?>>20000-25999</option>
		  <option value="26000-29999" <?php if ($classTmp=="26000-29999") echo $selectedStr;?>>26000-29999</option>
		  <option value="30000-999999" <?php if ($classTmp=="30000-999999") echo $selectedStr;?>>30000以上</option>
		</select>-->
		<input name="search" type="submit" value="查找" />
	  </form>
  <!-- </div>

  <div class="searchSubForm"  id="searchByActor" style="display:none">-->
  	<form action="" method="get" style="width:300px; display:block; float:left;">
  	  <!--  
      <select name="area" id="area">
	  <?php
	  $classTmp = $_GET["area"];
	  ?>
<option value="" <?php if ($classTmp=="") echo $selectedStr;?>>地区</option> 
		<?php
		$Customer = new Customer;
		$result = $Customer->GetProvinceList();
		while ($row=mysql_fetch_array($result))
		{
		?>
	    <option value="<?php echo $row["T_PRIVINCE"];?>" <?php if ($classTmp==$row["T_PRIVINCE"]) echo $selectedStr;?>><?php echo $row["T_PRIVINCE"];?></option>
	    <?php
		}
		?>
      </select>-->
      <!--  
      <select name="classs" id="select">
        <?php
	  $classTmp = $_GET["classs"];
	  $selectedStr = " selected=\"selected\" ";
	  ?>
        <option value=""  <?php if ($classTmp=="") echo $selectedStr;?>>专长</option>
        <option value="花鸟" <?php if ($classTmp=="花鸟") echo $selectedStr;?>>花鸟</option>
        <option value="山水" <?php if ($classTmp=="山水") echo $selectedStr;?>>山水</option>
        <option value="人物" <?php if ($classTmp=="人物") echo $selectedStr;?>>人物</option>
        <option value="工笔 <?php if ($classTmp=="工笔") echo $selectedStr;?>">工笔</option>
        <option value="书法" <?php if ($classTmp=="书法") echo $selectedStr;?>>书法</option>
        <option value="油画" <?php if ($classTmp=="油画") echo $selectedStr;?>>油画</option>
        <option value="篆刻" <?php if ($classTmp=="篆刻") echo $selectedStr;?>>篆刻</option>
        <option value="其他" <?php if ($classTmp=="其他") echo $selectedStr;?>>其他</option>
      </select>-->
      按姓名查找：
      <input id="name" name="name" type="text" value="<?php echo $_GET["name"];?>"/>
	<input name="p" type="hidden" value="actor" />
	<input name="type" type="hidden" value="search" />
	<!--  
    <select name="meixie_huiyuan">
	  <?php
	  $classTmp = $_GET["meixie_huiyuan"];
	  ?>
      <option value="" <?php if ($classTmp=="") echo $selectedStr;?>>选择美协会员类型</option>
      <option value="1" <?php if ($classTmp=="1") echo $selectedStr;?>>中国美协会员</option>
      <option value="2" <?php if ($classTmp=="2") echo $selectedStr;?>>省美协会员</option>
      <option value="3" <?php if ($classTmp=="3") echo $selectedStr;?>>市美协会员</option>
    </select>-->
    <!--  
     <select name="shuxie_huiyuan">
	  <?php
	  $classTmp = $_GET["shuxie_huiyuan"];
	  ?>
      <option value="" <?php if ($classTmp=="") echo $selectedStr;?>>选择书协会员类型</option>
      <option value="1" <?php if ($classTmp=="1") echo $selectedStr;?>>中国书协会员</option>
      <option value="2" <?php if ($classTmp=="2") echo $selectedStr;?>>省书协会员</option>
      <option value="3" <?php if ($classTmp=="3") echo $selectedStr;?>>市书协会员</option>
    </select>-->
    <input name="search" type="submit" value="查找" />
  </form>
  </div>
  
  </div>
  
  <div class="speed_login">
  	<form style="padding:0px; margin:0px;">www.<input id="url_head_name" name="name" type="text" onkeydown="if(event.keyCode=='13'&&event.srcElement.type!='textarea') return false;" />.mrzhxs.com<input name="访问" type="button" value="访问" onclick="if (document.getElementById('url_head_name').value) window.open('http://www.'+document.getElementById('url_head_name').value+'.mrzhxs.com', '_blank',''); "/></form>
  </div>
  
</div>
<?php
if (strlen($p)==0)
	include("main.php");
else if ($p=="news")
	include("news_index.php");
else if ($p=="product")
	include("pru_index.php");
else if ($p=="success")
	include("success_index.php");
else if ($p=="Other")
	include("other_index.php");
else if ($p=="actor")
	include("actor_index.php");
else if ($p=="Contact")
	include("leaveMsg_index.php");
else if ($p=="Article")
	include("Article_index.php");
else if ($p=="actor_all")
	include("actor_all.php");	
?>
<div class="main_bottom">
<span class="bottomContactInfo">
<?php 
$nIndex=-1;
while($row=mysql_fetch_array($navResult))
{
	$strPtype="";
	if ($row["T_TYPE"]=="cart")
		$strPtype="viewCart";
	else if ($row["T_TYPE"]=="product")
		$strPtype="product";
	else if ($row["T_TYPE"]=="contact")
		$strPtype="Contact";
	else if ($row["T_TYPE"]=="Other")
		$strPtype="Other";
	else if ($row["T_TYPE"]=="URL")
		$strPtype="URL";
	else if ($row["T_TYPE"]=="Article")
		$strPtype="Article";
	else
		$strPtype="Home";
	$strID=$row["T_ID"];
	$strNavName=$row["T_NAME"];	
?>
        <a style="color:#CC9900" href="<?php
    if ($strPtype=="URL")
		echo $row["T_TEXT"];
	else if ($strPtype=="Home")
		echo "http://".GetCurrentWebHost();
	else if ($strPtype=="viewCart")
		echo "?p=product&type=viewCart";
	else
		echo "?p=$strPtype&ID=$strID&classs=".urlencode($strNavName);
	?>"><?PHP echo $strNavName;?></a> 
<?php
	$nIndex++;
}
if ($nIndex>=0)
	echo "<br>";

echo str_replace("\n", "<br>", $webConfig->webCONTACT_INFO)."<br>";?></span>
All Content Copyright ? 2006 <?php echo GetCurrentWebHost();?>, <a href="admin">Inc.</a></div>
</body>
</html>
