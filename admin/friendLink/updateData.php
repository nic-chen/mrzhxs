<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");

/**
SUCCESS.PHP 错误提交表单
*/
function SuccessPhpErrorPage($ErrorString, $IsSuccess, $directUrl)
{
	echo $ErrorString;
	//echo  "update t_web_conn set T_URL='".$web_url."' and T_WEB_NAME='".$web_page_subject."' ";
	echo "<meta "; 
	if ($IsSuccess)
		echo "  http-equiv=refresh  http-equiv=refresh "; 
	die("content=1;URL=$directUrl>");
}

$com=$_GET["COM_ID"];
if ($com=="1001")	//add new Customer model
{
	
	$FrendLink = new FrendLink();
	
	$FrendLink->AddFrendLink($_POST["text"], $_POST["memo"], $_POST["order"]+0, $_POST["url"]);
	
	SuccessPhpErrorPage("Add the FriendLink succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1002")	//add new Customer model
{
	if ($_POST["submit"]=="Update")
	{
		$Customer = new Customer();
		$Customer->UpdateCustomerModel($_POST["ID"],$_POST["name"], $_POST["order"]+0, $_POST["STATUS"]+0);
		
		SuccessPhpErrorPage("Update the Customer model succeful!", true, $_SERVER["HTTP_REFERER"]);
	}
	else if ($_POST["submit"]=="Delete")
	{
		$Customer = new Customer();
		$Customer->DeleteCustomerModel($_POST["ID"]);
		
		SuccessPhpErrorPage("Delete the Customer model succeful!", true, $_SERVER["HTTP_REFERER"]);
	}
}
else if ($com=="1004")	//add new Customer
{

	$Customer = new Customer();
	$errorString;
	$Customer->DoCustomerRegisted($_POST["mail"]." ", $_POST["pwd"], $_POST["country"], $_POST["name"], $_POST["address"], $_POST["dengji"], $_POST["memo"], date("YmdHis"),$_POST["JianJie"], $errorString);
	
	SuccessPhpErrorPage("Add the Customer model succeful! $errorString", true, "index.php");
}
else if ($com=="1005")	//add new Customer
{
	$Customer = new Customer();
	$Customer->SetUserProfileInfo($_POST["mail"], $_POST["country"], $_POST["name"], $_POST["address"], $_POST["memo"], $_POST["dengji"], $_POST["JianJie"], $_POST["id"], $errorString);
	
	SuccessPhpErrorPage("Update the Customer succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1006")	//add new Customer
{
	$FrendLink = new FrendLink();
	$id = $_GET["ID"];
	$FrendLink->DelFrendLink($_GET["id"]);
	
	SuccessPhpErrorPage("Delete the FrendLink succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1007")	//add new Customer model
{
	$Customer = new Customer();
	$Customer->DelFrendLink($_POST["name"], $_POST["memo"], $_POST["status"]);
	echo $com;
	SuccessPhpErrorPage("Add the Customer model succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1008")	//update Customer model
{
	$Customer = new Customer();
	$Customer->UpdateCustomerModel($_POST["id"], $_POST["name"], $_POST["memo"], $_POST["status"]);
	//echo $com;
	SuccessPhpErrorPage("Update the Customer model succeful!", true, "modelIndex.php");
}
else if ($com=="1009")	//update Customer 
{
	$FrendLink = new FrendLink();
	
	$FrendLink->SetFrendLinkByID($_POST["id"], $_POST["text"], $_POST["memo"], $_POST["url"], $_POST["order"]);
	
	SuccessPhpErrorPage("Update the FrendLink succeful!", true, "index.php?ADType=".$_POST["type"]);
}
?>