<html>
<head><link rel="stylesheet" href="gmenu.css">
<script type="text/javascript" src="gmenu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<title>Welcome to pingoTree!</title>
<?php
include_once('settings.php');
include_once(LIBPATH."lib.php");
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FAFAFA;
}
.style1 {
	font-size: 9px;
	color: #a7a7a6;
}
.style9 {
	color: #669933;
	font-weight: bold;
}
.style13 {
	color: #000000;
	font-size: 12px;
}
.style16 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
.style25 {color: #FF9966; font-family: "Courier New", Courier, mono; }
a:link {
	text-decoration: none;
	color: #FF9966;
}
a:visited {
	text-decoration: none;
	color: #FF9966;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
body,td,th {
	font-size: 12px;
	color: #666666;
	table-layout:fixed;
	word-break:break-all;
	word-wrap:break-word;
	FONT: 12px/160% Verdana,Arial,sans-serif,"Times New Roman","sans-serif";
}
.hxlad a:active {test:expression(target="_blank");}
.style30 {color: #999999; font-family: "Courier New", Courier, mono; }
p.MsoNormal1 {mso-style-parent:"";
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	font-size:10.5pt;
	font-family:"Times New Roman";
	margin-left:0cm; margin-right:0cm; margin-top:0cm}
p.MsoNormal11 {mso-style-parent:"";
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	font-size:10.5pt;
	font-family:"Times New Roman";
	margin-left:0cm; margin-right:0cm; margin-top:0cm}
p.MsoNormal111 {mso-style-parent:"";
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	font-size:10.5pt;
	font-family:"Times New Roman";
	margin-left:0cm; margin-right:0cm; margin-top:0cm}
-->
</style>
</head>
<body>
<?php include("manageItemMenu.php"); ?>
<?php
UpdateWebMenu();
echo "Update website's left menu successfual!";
?>
</body>
</html>
