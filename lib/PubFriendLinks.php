<?php
include_once("settings.php");
include_once(LIBPATH."Sql.php");
include(LIBPATH."/lib.php");

class FrendLink
{
	var $SQL;
	function FrendLink()
	{
		$this->SQL = new SQL;
	}
	function GetFrendLinkList()
	{
		return $this->SQL->Query("select * from friendlinks order by T_ORDER ASC;");
	}
	function SetFrendLinkByID($id, $text, $memo, $url, $order)
	{
		return $this->SQL->Query("update friendlinks set T_TEXT = '$text', T_MEMO = '$memo', URL = '$url', T_ORDER = $order where T_ID=$id;");
	}
	function GetFrendLinkByID($id)
	{
		return $this->SQL->Query("select * from friendlinks where T_ID=$id;");
	}
	function AddFrendLink($text, $memo, $order, $url)
	{
		return $this->SQL->Query("insert into friendlinks (T_TEXT, T_MEMO, T_ORDER, URL) values ('$text', '$memo', $order, '$url');");
	}
	function DelFrendLink($id)
	{
		return $this->SQL->Query("delete from friendlinks where T_ID = $id;");
	}
}

?>