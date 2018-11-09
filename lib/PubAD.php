<?php
include_once("settings.php");
include_once(LIBPATH."Sql.php");
include(LIBPATH."/lib.php");

class AD
{
	var $SQL;
	function AD()
	{
		$this->SQL = new SQL;
	}
	function GetADPath()
	{
		return "images/AD";
	}
	function GetAdListByType($type)
	{
		return $this->SQL->Query("select * from ad where T_TYPE='$type' order by T_ORDER ASC;");
	}
	
	function GetAdDetailByID($id)
	{
		return $this->SQL->Query("select * from ad where T_ID='$id';");
	}
	
	function AddNewAD($id, $value, $type, $picture, $memo, $order)
	{
		return $this->SQL->Query("INSERT INTO `ad` ( `T_ID` , `T_TYPE` , `T_PICTURE_NAME` , `T_VALUE` , `T_MEMO`, T_ORDER ) VALUES ('$id', '$type', '$picture', '$value', '$memo', $order);");
	}
	
	function DelAD($id)
	{
		return $this->SQL->Query("delete from ad where T_ID='$id';");
	}
	
	function UpdateAD($id, $value, $type, $picture, $memo, $order)
	{
		return $this->SQL->Query("update ad set `T_TYPE`='$type' , `T_PICTURE_NAME`='$picture' , `T_VALUE`='$value' , `T_MEMO`='$memo', T_ORDER=$order where T_ID='$id';");
	}
}

?>