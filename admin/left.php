<?php 
include_once('settings.php');
include_once(LIBPATH."lib.php");

$cur_admin = new admin;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
}
body,td,th {
	font-size: 12px;
}

ul {
        list-style: none;
        margin: 0;
        padding: 0;
        }
/* =-=-=-=-=-=-=-[Menu One]-=-=-=-=-=-=-=- */

#menu {
        width: 100%-10;
        border-style: solid solid none solid;
        border-color: #94AA74;
        border-size: 1px;
        border-width: 1px;
        margin: 0px;
        }

#menu li a {
        height: 32px;
          voice-family: "\"}\"";
          voice-family: inherit;
          height: 24px;
        text-decoration: none;
        }

#menu li a:link, #menu li a:visited {
        color: #5E7830;
        display: block;
        background: url("images/menu1.gif");
        padding: 8px 0 0 10px;
        }

#menu li a:hover, #menu li #current {
        color: #26370A;
        background: url("images/menu1.gif") 0 -32px;
        padding: 8px 0 0 10px;
        }

#menu li a:active {
        color: #26370A;
        background: url("images/menu1.gif") 0 -64px;
        padding: 8px 0 0 10px;
        }
-->
</style></head>

<body>
<div style="border:none"><img src="images/logo_admin.jpg" alt="paiple admin!!!" border="0"></div>
<div id="menu">
                        <ul>
                                <!-- CSS Tabs -->
<li><a href="web_conn.php" target="right">Web Config</a></li>
<li><a href="Order/index.php" target="right">Order Manage</a></li>
<li><a href="Order/shipping_list.php?order_by=CreateTime" target="right">Shipping list</a></li>
<li><a href="hotItemNewArrivals.php" target="right">Hot items</a></li>
<li><a href="MsgList.php?type=buyer" target="right">Message<?php
	echo " (".$cur_admin->GetTotalNoReplyMsg().")";
?></a></li>
<li><a href="#" onclick="document.ItemList.submit();">Check price</a></li>
<li><a href="article/index.php" target="right">文章发布</a></li>
<li><a href="customer/index.php" target="right">会员管理</a></li>
<li><a href="customer/index.php?type=hualang" target="right">画廊管理</a></li>
<li><a href="customer/index.php?type=paimai" target="right">拍卖管理</a></li>
<li><a href="AD/index.php?ADType=huandengpian" target="right">广告管理</a></li>
<li><a href="OnlineOrder/index.php" target="right">在线订单</a></li>
<?php
$adminName=$adminPwd="";
$cur_admin->GetAdminSignInfo(&$adminName, &$adminPwd);
if ($adminName=="root")
{
?>
<li><a href="Order/Order_list.php" target="right">Order List</a></li>
<li><a href="subWebList.php" target="right">Sub website</a></li>
<li><a href="adminList.php" target="right">Admin infomation</a></li>
<li><a href="itemManage.php" target="right">Product</a></li>
<?php
}
?>
<li><a href="updateData.php?COM_ID=1016" target="_parent">Sign out</a></li>
</ul>
                </div>
<?php
$SQL=new SQL;

$result_admin = $SQL->Query("select * from admin where T_NAME='".$adminName."' and T_URL='".GetCurrentWebHost()."';");
$rowAdmin=mysqli_fetch_array($result_admin);
?>
<form action="Order/item_list.php" name="ItemList" id="ItemList" method="post" target="_blank">
<div style=" display: none;"><textarea name="userAddress" ><?php echo $row["T_CUS_ADDRESS"];?></textarea>
            <textarea name="orderList" ><?php echo $row["T_DINGDAN_MINGXI"]; ?></textarea>
            <textarea name="otherInfo" ><?php echo $row["T_CREATE_BEIZHU"]; ?></textarea>
			<input name="tttype" type="text" value="1"/>
			<input name="userType" type="text" value="<?php 
			if ($rowAdmin["T_DENG_JI"]==0)
				echo "admin";
			else
				echo "seller"; ?>"/>
			<input name="orderID" type="text" value="<?php echo  $row["T_DATE"].$row["T_SER"]; ?>"/></div></form>
</body>
</html>
