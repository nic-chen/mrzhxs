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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
	<?php
	echo $ErrorString;
	//echo  "update t_web_conn set T_URL='".$web_url."' and T_WEB_NAME='".$web_page_subject."' ";
	echo "<meta "; 
	if ($IsSuccess)
		echo "  http-equiv=refresh  http-equiv=refresh "; 
	die("content=1;URL=$directUrl> </body>");
}

$com=$_GET["COM_ID"];
if ($com=="1001")	//add new Customer model
{
	$Customer = new Customer();
	$Customer->AddCustomerModel($_POST["name"], $_POST["order"]+0);
	
	SuccessPhpErrorPage("Add the Customer model succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1002")	//add new Customer model
{
	if ($_POST["submit"]=="Update")
	{
		$Customer = new Customer();
		$Customer->UpdateCustomerModel($_POST["ID"],$_POST["name"], $_POST["order"]+0, $_POST["STATUS"]+0, $_POST["T_HAVE_SUB_ARTICLE"]+0);
		
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
	$Customer->DoCustomerRegisted($_POST["mail"]." ", $_POST["pwd"], $_POST["country"], $_POST["name"], $_POST["address"], $_POST["dengji"], $_POST["memo"], date("YmdHis"),html_entity_decode($_POST["JianJie"], ENT_QUOTES, "UTF-8"), true,$_POST["type"]);
	
	SuccessPhpErrorPage("Add the Customer model succeful! $errorString", true, "index.php?type=".$_POST["type"]);
}
else if ($com=="1005")	//add new Customer
{
	$Customer = new Customer();
	$Customer->SetUserProfileInfo($_POST["mail"], $_POST["country"], $_POST["name"], $_POST["address"], $_POST["memo"], $_POST["dengji"], html_entity_decode($_POST["JianJie"], ENT_QUOTES, "UTF-8"), $_POST["id"], $errorString);
	
	SuccessPhpErrorPage("Update the Customer succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1006")	//add new Customer
{
	$Customer = new Customer();
	$Customer->DeleteCustomer($_GET["id"]);
	
	SuccessPhpErrorPage(CUSTOMER_DELETE_SUCCESSFUL, true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1007")	//add new Customer model
{
	$Customer = new Customer();
	$Customer->AddCustomerModel($_POST["name"], $_POST["memo"], $_POST["status"], $_POST["type"], $_POST["subArticle"]);
	SuccessPhpErrorPage(CUSTOMER_ADD_NEW_SUCCESSFUL, true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1008")	//update Customer model
{
	$Customer = new Customer();
	$Customer->UpdateCustomerModel($_POST["id"], $_POST["name"], $_POST["memo"], $_POST["status"], $_POST["type"], $_POST["subArticle"]);
	//echo $com;
	SuccessPhpErrorPage("Update the Customer model succeful!", true, "modelIndex.php?type=".$_POST["type"]);
}
else if ($com=="1009")	//update Customer 
{
	$uploadfile = "../../images/customer/".$_POST["ID"]."/L.jpg";
	if(isset( $_FILES ) && !empty( $_FILES [ "head_picture" ]) && $_FILES [ "head_picture" ][ "size" ]> 0 ) 
	{ 
		if (!file_exists("../../images/customer/"))
			mkdir("../../images/customer/");
		if (!file_exists("../../images/customer/".$_POST["ID"]))
			mkdir("../../images/customer/".$_POST["ID"]);
		if (file_exists($uploadfile))
			unlink($uploadfile);
		copy ( $_FILES["head_picture"]["tmp_name"], $uploadfile);
	}
		
	$Customer = new Customer();
	$ADFirstOrder = -1;
	if ($_POST["ifADFirst"]==0)
		$ADFirstOrder = -1;
	else
		$ADFirstOrder = $_POST["ADFirstOrder"];
	
	// 作品类型
	$pruType = "";
	if (strlen($_POST["typeHuaNiao"]) > 0)
		$pruType .= "="."花鸟";
	if (strlen($_POST["typeShanShui"]) > 0)
		$pruType .= "="."山水";
	if (strlen($_POST["typeRenWu"]) > 0)
		$pruType .= "="."人物";
	if (strlen($_POST["typeGongBi"]) > 0)
		$pruType .= "="."工笔";
	if (strlen($_POST["typeShuFa"]) > 0)
		$pruType .= "="."书法";
	if (strlen($_POST["typeYouHua"]) > 0)
		$pruType .= "="."油画";
	if (strlen($_POST["typeZhuanKe"]) > 0)
		$pruType .= "="."篆刻";

	$bRet = $Customer->UpdateCustomerDetail($_POST["ID"], $_POST["mail"], $_POST["name"], $_POST["country"], $_POST["address"], 
								$_POST["dengji"], $_POST["JianJie"], $_POST["memo"], $_POST["oldMail"],$_POST["headUrl"], $_POST["province"], 
								$_POST["telPhone"], $_POST["mobilePhone"], $_POST["rungePrice"]+0, $_POST["meixieType"], $_POST["shuxieType"], 
								$_POST["status"], $_POST["endTime"], $ADFirstOrder, $pruType);
	
	if (!$bRet)
		SuccessPhpErrorPage(CUSTOMER_UPDATE_DETAIL_FAILED.$Customer->errorString, false, "index.php?type=".$_POST["type"]);
	
	$total = $_POST["modelTotal"];
	for ($i=0; $i<$total; $i++)
	{
		$Customer->SetModelContect($_POST["ID"], $_POST["model_id$i"], $_POST["model$i"]);
	}

	SuccessPhpErrorPage(CUSTOMER_UPDATE_DETAIL_SUCCESSFUL, true, "index.php?type=".$_POST["type"]);
}
else if ($com=="1010")	//update Customer model
{
	$Customer = new Customer();
	$Customer->SetModelContectByID($_POST["id"], $_POST["title"], $_POST["text"]);
	//echo $com;
	SuccessPhpErrorPage("Update the article succeful!", true, "index.php?type=".$_POST["type"]);
}
else if ($com=="1011")	//update Customer model
{
	$Customer = new Customer();
	$Customer->AddModelContect($_POST["title"], $_POST["text"], $_POST["customerID"], $_POST["class"]);
	//echo $com;
	SuccessPhpErrorPage("Add the article succeful!", true, "index.php?type=".$_POST["type"]);
}
else if ($com=="1012")	//update Customer model
{
	$Customer = new Customer();
	$Customer->DelModelContect($_GET["id"]);
	//echo $com;
	SuccessPhpErrorPage("Delete the article succeful!", true, "index.php?type=".$_GET["type"]);
}
else if ($com=="1013")	//update Customer model
{
	$Customer = new Customer();
	$Customer->DelCustomerModel($_GET["id"]);
	//echo $com;
	SuccessPhpErrorPage("Delete the customer model succeful!", true, "modelIndex.php?type=".$_POST["type"]);
}
?>