<?php
$dateBaseName="root";	//date base name
$dateBaseUser="root";	//datebase user name
$dateBasePwd="123";		//database user's password
$dateBaseUrl="l27.0.0.1";		//the database's url.

$allDateBase = mysql_connect($dateBaseUrl, $dateBaseName, $dateBasePwd);
mysql_select_db($dateBaseName,$allDateBase);

mysql_query("SET NAMES UTF8");
?>