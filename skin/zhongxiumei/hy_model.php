<?php
if ($_GET["list"]!="true")
{
	if (strlen($_GET["articleID"])>0)
	{
		$result = $customer->GetModelContectByID($_GET["articleID"]);
		if ($row=mysql_fetch_array($result))
		{
		?>
				<ul class="jianjie_frame">
				<li id="jianjie_frame_name"><?php echo $row["T_TITLE"];?></li>
				<li id="jianjie_frame_jianjie"><?php
			echo $row["T_TEXT"];
		}
		else
			echo CUSTOMER_MODEL_TEXT_NONE;
		?></li>
				</ul>
	<?php
	}
	else
	{
		$result = $customer->GetModelContect($customerID, $_GET["id"]);
		if ($row=mysql_fetch_array($result))
			echo $row["T_TEXT"];
		else
			echo CUSTOMER_MODEL_TEXT_NONE;
	}
	
}
else
{
	$result = $customer->GetModelContect($customerID, $_GET["id"]);
	?>
	<ul class="article_ul">
	<?php
	while($row=mysql_fetch_array($result))
	{
		?><li><a href="?p=viewModel&id=<?php echo $_GET["id"];?>&articleID=<?php echo $row["T_ID"];?>"><?php echo $row["T_TITLE"];?> <span class="hyperlink"> 点击查看</span></a></li>
		<?php
	}
	?>
	</ul>
	<?php
}
?>