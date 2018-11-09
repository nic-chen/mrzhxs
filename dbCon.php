<?php

$dateBaseName="paipleco_mrzhxs";
$dateBaseUser="paipleco_mrzhxs";
$dateBasePwd="zfm198214";

$allDateBase = mysql_connect("localhost", $dateBaseUser, $dateBasePwd);
mysql_select_db($dateBaseName,$allDateBase);

mysql_query("SET NAMES UTF8");

?>