<h1><span class="title">名家展厅</span><span class="more"><a href="?p=actor_all">&gt;&gt;更多</a></span></h1>
<div class="huiyuan_frame">
<?php
$customer = new customer;
$index = 0;
$nItemEachRow = 5;
$result = $customer->GetCustomerList(-1, -1, "");
while($row=mysqli_fetch_array($result))
{
	if ($row["T_STATUS"]!=0 || date("Y-m-d", strtotime($row["T_END_TIME"]))<date("Y-m-d"))
		continue;
	if ($index % $nItemEachRow==0)
		echo "<div style=\"overflow:hidden\">";
?>

<ul class="huiyuan_head">
	<li><a href="<?php echo "http://".$row["T_HEAD_URL"].".".GetCurrentWebHost();?>" target="_blank"><img src="images/customer/<?php echo $row["T_ID"];?>/L.jpg" style="width:100px; height:120px;"/></a></li>
    <li><?php echo $row["T_CUSTOMER_NAME"];?></li>
</ul>
<?php
$index++;
	if ($index % $nItemEachRow==0 || $index>=10)
	{
		echo "</div>";
		if ($index>=10)
			break;
	}
}

if ($index % $nItemEachRow!=4)
		echo "</div>";
?>
</div>