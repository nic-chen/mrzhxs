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
<script src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/js/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/css/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="../../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<?php
$subWebName = GetCurrentSubWebName();
//$subWebName = "mm";
$customer = new Customer;
$result = $customer->GetCustomerByHeadURL($subWebName);
if ($rowCustomer=mysqli_fetch_array($result))
	$customerID = $rowCustomer["T_ID"];
else
	die("error, dont find the customer!!");
?>
<div class=top_logo_customer>
	<div class="top_logo_customer_text"><?php echo $rowCustomer["T_CUSTOMER_NAME"];?>官方网站<br><span id="top_logo_url"><a href="http://<?php echo GetCurrentWebHost();?>">http://<?php echo GetCurrentWebHost();?></a></span></div>
</div>

<DIV class="clearfix" style="border:none;">
<div style="background-color:#FFFFFF; height:10px;"></div>

<h1><span class="title">&gt;&gt; <?php
		$type = $_GET["p"]."";
		if (strlen($type)==0)
			echo "首页";
		else if ($type=="leaveMsg")
			echo "留言";
		else if ($type=="success")
			echo "成功";
		else if ($type=="search")
			echo "作品";
		else if ($type=="ItemDetail")
			echo "作品查看";
		else if ($type=="viewModel")
			echo "文章";
		else if ($type=="viewCart")
			echo "购物车";
		?></span></h1>

<div style="background-color:#FFFFFF; height:10px;"></div>
</DIV>

<div class="hy_body_frame">
  <div class="left">
    <div class="top_left"></div><div class="top_center"></div><div class="top_right"></div>
		<ul>
			<li id="nav">导航栏</li>
			<?php
            $type = $_GET["p"];
			?>
			<li<?php if (strlen($type)==0) echo " id='current'";?>><a href="http://<?php echo GetCurrentWebHost();?>">网站首页</a></li>
			<li<?php if ($type=="search" && $_GET["order"]=="createTime") echo " id='current'";?>><a href="?p=search&order=createTime">作品展厅</a></li>
			<li<?php if ($type=="search" && $_GET["order"]=="hot") echo " id='current'";?>><a href="?p=search&order=hot">精品推荐</a></li>
            <?php
            $result = $customer->GetCustomerModelList($rowCustomer["T_TYPE"]);
			while($row=mysqli_fetch_array($result))
			{
				if ($row["T_STATUS"]!=0)
					continue;
			?>
			<li<?php if ($type=="viewModel" && $_GET["id"]==$row["T_ID"]) echo " id='current'";?>><a href="?p=viewModel&id=<?php echo $row["T_ID"]; if ($row["T_HAVE_SUB_ARTICLE"]==1) echo "&list=true";?>"><?php echo $row["T_NAME"];?></a></li>
            <?php
            }
			?>
			<li<?php if ($type=="viewCart") echo " id='current'";?>><a href="?p=viewCart">购 物 车</a></li>
            <li<?php if ($type=="leaveMsg") echo " id='current'";?>><a href="?p=leaveMsg">买家留言</a></li>
		</ul>
	<div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div>
  </div>
  
  <div class="right">
  	<div style="overflow:hidden; width:830px;"> <div class="top_left"></div><div class="top_center"></div><div class="top_right"></div> </div>
		<div class="body">
		<?php
		$type = $_GET["p"]."";
		if (strlen($type)==0)
			include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_jianjie.php");
		else if ($type=="leaveMsg")
			include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_leaveMsg.php");
		else if ($type=="success")
			include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_success.php");
		else if ($type=="search")
			include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_pruShow.php");
		else if ($type=="ItemDetail")
			include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_ItemDetail.php");
		else if ($type=="viewModel")
			include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_model.php");
		else if ($type=="viewCart")
			include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_viewCart.php");
		?>
        </div>
    
	<div style="overflow:hidden; width:830px;"> <div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div> </div>
  </div>
</div>

<div class="main_bottom">All Content Copyright ? 2006 <?php echo GetCurrentWebHost();?>, Inc.</div>
</body>
</html>
