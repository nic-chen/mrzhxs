<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");

$cur_admin = new admin;

if (!$cur_admin->GetAdminIfSignIn())
{
	echo "pls <a href=\"index.php\">login<a> in at first!";
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>后台管理</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
-->
</style></head>
<frameset rows="*" cols="150,*" framespacing="0" frameborder="no" border="0" bordercolor="#999999"> 
<frame src="left.mrzhxs.php" name="left" noresize="noresize"> 
<frame src="web_conn.php" name="right"> 
</frameset>
<noframes></noframes>
</html>
