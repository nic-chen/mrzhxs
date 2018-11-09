<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");

class article
{
	var $SQL;
	var $ifAllSql;
	function article()
	{
		$this->SQL = new SQL;
		$this->ifAllSql = " T_URL = '".GetCurrentWebHost()."' ";
	}
	
	function GetArticleList($id, $nStart, $nTotal, $ifAll)
	{
		if ($ifAll)
			$addSql = "";
		else
			$addSql = "and ".$this->ifAllSql;
			
		if ($nStart>-1 && $nTotal>-1)
			return $this->SQL->Query("select * from article where T_MODEL_ID=$id $addSql order by T_CREATE_TIME DESC LIMIT $nStart, $nTotal");
		else
			return $this->SQL->Query("select * from article where T_MODEL_ID=$id $addSql order by T_CREATE_TIME DESC");
	}
	
	function CreateArticle($title, $body, $modelID)
	{
		$id=$modelID.date("YmdHis");
		return $this->SQL->Query("INSERT INTO `article` ( `T_MODEL_ID` , `T_TITLE` , `T_TEXT`, T_CREATE_TIME, T_URL, T_STATUS, T_ID ) VALUES ('$modelID', '$title', '$body', now(), '".GetCurrentWebHost()."', 0, $id);");
	}
	
	function UpdateArticle($title, $body, $modelID, $id, $ifAll)
	{
		if ($ifAll)
			$addSql = "";
		else
			$addSql = "and ".$this->ifAllSql;
			
		return $this->SQL->Query("update `article` set `T_MODEL_ID`= $modelID, `T_TITLE` = '$title', `T_TEXT` = '$body' where T_ID = '$id' $addSql;");
	}
	
	function DeleteArticle($id)
	{
		return $this->SQL->Query("delete from `article` where T_ID = $id");
	}
	
	function GetArticleAmount($id, $ifAll)
	{
		if ($ifAll)
			$addSql = "";
		else
			$addSql = "and ".$this->ifAllSql;
			
		$result = $this->SQL->Query("select count(*) as nTotal from article where T_MODEL_ID=$id $addSql order by T_CREATE_TIME DESC");
		$row = mysqli_fetch_array($result);
		return $row["nTotal"];
	}
	
	function GetArticle($id)
	{
		return $this->SQL->Query("select * from article where T_ID='$id';");
	}
	
	function GetArticleModelList()
	{
		return $this->SQL->Query("select  * from articlemodel order by T_ORDER");
	}
	
	function AddArticleModel($modelName, $index)
	{
		//die("INSERT INTO `article` ( `T_MODELNAME` , `T_CREATE_TIME` , `T_ORDER` ) VALUES ('$modelName', now(), $index);") ;
		return $this->SQL->Query("INSERT INTO `articlemodel` ( `T_MODELNAME` , `T_CREATE_TIME` , `T_ORDER` ) VALUES ('$modelName', now(), $index);");
	}
	
	function UpdateArticleModel($id, $modelName, $index, $status)
	{
		return $this->SQL->Query("update articlemodel set T_MODELNAME='$modelName', T_ORDER=$index,T_STATUS=$status where T_ID=$id;");
	}
	
	function DeleteArticleModel($id)
	{
		return $this->SQL->Query("DELETE FROM `articlemodel` WHERE `T_ID` = $id LIMIT 1;");
	}
}
?>