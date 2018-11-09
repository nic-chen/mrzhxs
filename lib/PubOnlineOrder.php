<?php
include_once("settings.php");
include_once(LIBPATH."Sql.php");
include(LIBPATH."/lib.php");

class OnlineOrder
{
	var $SQL;
	function OnlineOrder()
	{
		$this->SQL = new SQL;
	}
	
	function GetOnlineOrderList()
	{
		return $this->SQL->Query("select * from orderhistory where T_URL='".GetCurrentWebHost()."' order by T_CREATE_TIME DESC;");
	}
	
	function GetOnlineOrderByID($id)
	{
		return $this->SQL->Query("select * from orderhistory where T_ID='$id' and T_URL='".GetCurrentWebHost()."';");
	}
	
	function AddNewOnlineOrder($name, $mobilPhone, $telPhone, $msn, $mail, $qq, $address, $postCode, $memo, $itemList)
	{
		return $this->SQL->Query("INSERT INTO orderhistory (T_NAME , T_MOBIL_PHONE , T_TEL_PHONE , T_MSN, T_MAIL, T_QQ, T_ADDRESS, T_POST_CODE, T_MEMO, T_CREATE_TIME, T_URL,T_ITEMLIST) VALUES ('$name', '$mobilPhone', '$telPhone', '$msn', '$mail', '$qq', '$address', '$postCode', '$memo', now(), '".GetCurrentWebHost()."', '$itemList');");
	}
	
	function DelOnlineOrder($id)
	{
		return $this->SQL->Query("delete from orderhistory where T_ID='$id' and T_URL='".GetCurrentWebHost()."';");
	}
	
	function UpdateOnlineOrder($id, $name, $mobilPhone, $telPhone, $msn, $mail, $qq, $address, $postCode, $memo)
	{
		return $this->SQL->Query("update orderhistory set T_NAME='$name', T_MOBIL_PHONE='$mobilPhone', T_TEL_PHONE='$telPhone', T_MSN='$msn', T_MAIL='$mail', T_QQ='$qq', T_ADDRESS='$address', T_POST_CODE='$postCode', T_MEMO='$memo' where T_ID='$id'  and T_URL='".GetCurrentWebHost()."';");
	}
}

?>