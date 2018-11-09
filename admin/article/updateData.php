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
	echo "<body></body><script language=\"javascript\">"; 
	if ($IsSuccess)
		echo "location.href=\"$directUrl\""; 
	echo "</script>"; 
}

$com=$_GET["COM_ID"];
if ($com=="1001")	//add new article model
{
	$article = new article();
	$article->AddArticleModel($_POST["name"], $_POST["order"]+0);
	
	SuccessPhpErrorPage("Add the article model succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1002")	//add new article model
{
	if ($_POST["submit"]=="Update")
	{
		$article = new article();
		$article->UpdateArticleModel($_POST["ID"],$_POST["name"], $_POST["order"]+0, $_POST["STATUS"]+0);
		
		SuccessPhpErrorPage("Update the article model succeful!", true, $_SERVER["HTTP_REFERER"]);
	}
	else if ($_POST["submit"]=="Delete")
	{
		$article = new article();
		$article->DeleteArticleModel($_POST["ID"]);
		
		SuccessPhpErrorPage("Delete the article model succeful!", true, $_SERVER["HTTP_REFERER"]);
	}
}
else if ($com=="1004")	//add new article
{
	$article = new article();
	$article->CreateArticle($_POST["title"], $_POST["FCKeditor1"], $_POST["model"]);
	
	SuccessPhpErrorPage("Add the article model succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1005")	//add new article
{
	$article = new article();
	$article->UpdateArticle($_POST["title"], $_POST["FCKeditor1"], $_POST["model"], $_POST["id"], true);
	
	SuccessPhpErrorPage("Update the article succeful!", true, $_SERVER["HTTP_REFERER"]);
}
else if ($com=="1006")	//add new article
{
	$article = new article();
	$article->DeleteArticle($_GET["id"]);
	
	SuccessPhpErrorPage("Delete the article succeful!", true, $_SERVER["HTTP_REFERER"]);
}
?>