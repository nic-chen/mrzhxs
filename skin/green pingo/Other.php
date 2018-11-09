<?php
$sSql="select * from t_top_nav where T_URL='".GetCurrentWebHost()."' AND T_ID=".$_GET["ID"]." order by T_INDEX ASC, T_NAME";
include(APPROOT."dbCfg.php");
$navResult=mysqli_query($sSql,$allDateBase);
$row=mysqli_fetch_array($navResult);
?>
<h1><?php echo $row["T_NAME"];?></h1>

<div class="otherText">
<?php echo str_replace("\r\n", "<br>", $row["T_TEXT"]);?>
</div>
<p>&nbsp;</p>
