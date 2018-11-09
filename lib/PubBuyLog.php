<?php
include_once("settings.php");
include_once(LIBPATH."Sql.php");
include(LIBPATH."/lib.php");

class BuyLog
{
	var $SQL;
	function BuyLog()
	{
		$this->SQL = new SQL;
	}
	function GetBuyLogList($type)
	{
		if ($type==NULL)
			return $this->SQL->Query("select * from buylog order by T_CREATE_TIME DESC;");
		else
			return $this->SQL->Query("select * from buylog where T_TYPE=$type order by T_CREATE_TIME DESC;");
	}
	function AddBuyLog($pruID, $type, $userID)
	{
		return $this->SQL->Query("insert into buylog (T_PRU_ID, T_TYPE, T_CREATE_TIME, T_USER_ID) values('$pruID', $type, now(), '$userID');");
	}
}

?>