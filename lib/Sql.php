<?php
include_once("settings.php");
include_once(APPROOT."dbCfg.php");

class SQL
{
	function Query($sSql)
	{
		global $allDateBase;
		include(APPROOT."dbCfg.php");
		//echo $sSql;
		return mysqli_query($allDateBase, $sSql);
	}
}
?>