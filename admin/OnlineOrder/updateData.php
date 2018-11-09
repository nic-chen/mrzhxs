<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");

/**
SUCCESS.PHP 错误提交表单
*/
function SuccessPhpErrorPage($ErrorString, $IsSuccess, $directUrl)
{
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv=refresh charset=utf-8; content="1;<?php echo "URL=$directUrl";?>" />
<body>
	<?php echo $ErrorString;?>
</body>
	<?php
}

$com=$_GET["COM_ID"];
if ($com=="1001")	//delete online order
{
	$OnlineOrder = new OnlineOrder;
	$OnlineOrder->DelOnlineOrder($_GET["id"]);

	SuccessPhpErrorPage(ADMIN_DELETE_ONLINE_ORDER_SUCCESS, true, $_SERVER["HTTP_REFERER"]);
}
?>