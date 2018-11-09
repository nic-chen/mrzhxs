<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");

$subWebName = GetCurrentSubWebName();

if (strlen($subWebName)>0)
	include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/hy_index.php");
else
	include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/index_main.php");

?>