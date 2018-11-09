<?php

$dateBaseName="all";
$dateBaseUser="all";
$dateBasePwd="all";

$pingoDateBase = mysql_connect("localhost", $dateBaseName, $dateBasePwd);
mysql_select_db($dateBaseName,$pingoDateBase);
$allDateBase = mysql_connect("localhost", $dateBaseName, $dateBasePwd);
mysql_select_db($dateBaseName,$allDateBase);

mysql_query("SET NAMES UTF8");

?>