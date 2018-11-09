<?php
include_once("settings.php");
include_once(APPROOT."dbCfg.php");

class SQL
{
	function Query($sSql)
	{
		include(APPROOT."dbCfg.php");
		//echo $sSql;
		return mysql_query($sSql, $allDateBase);;
	}
}
?>