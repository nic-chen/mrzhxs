		<ul class="jianjie_frame">
			<li id="jianjie_frame_name"><?php echo $rowCustomer["T_CUSTOMER_NAME"];?></li>
			<li id="jianjie_frame_jianjie"><?php 
			if (strlen($rowCustomer["T_JIANJIE"])>0)
			{
				echo substr($rowCustomer["T_JIANJIE"], 0, 3);
				?><img src="images/customer/<?php echo $rowCustomer["T_ID"];?>/L.jpg"  align="left" style="border:solid #999999 1px; padding:2px; margin:2px;"><?php
				echo substr($rowCustomer["T_JIANJIE"], 3, strlen($rowCustomer["T_JIANJIE"]));
			}
			?></li>
			<?php
			$sSql="";
			$orderBy = $_GET["order"];
			$nItemEachPage = 10;
			$current_page = $_GET["page"]+0;
			if ($current_page==0)
				$current_page = 1;
			
			$sSql=" where T_USER_ID='$customerID' ";
			$sSql=$sSql." order by T_DENG_JI_TIME DESC, T_HOT DESC, T_ID DESC";
			
			$SQL = new SQL;
			$result = $SQL->Query("select * from pru ".$sSql." limit 0, $nItemEachPage");
			//echo "select * from pru ".$sSql." limit ".(($current_page-1)*$nItemEachPage).", $nItemEachPage";
			$index = 0;
			$preUserID = "";
			while($row=mysqli_fetch_array($result))
			{
				if ($preUserID != $row["T_USER_ID"])
				{
					$resultTmp = $SQL->Query("select * from registercustomer  where T_ID='".$row["T_USER_ID"]."'");
					$rowUser=mysqli_fetch_array($resultTmp);
					$preUserID = $row["T_USER_ID"];
				}
				if (!$rowUser)
					continue;
				
			?>
            <li>
				<ul class="index_pru">
					<li id="picture">&nbsp;<a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>"><img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";?>" /></a></li>
					<li><?php echo AUTHOR.FENGHAO; echo $rowUser["T_CUSTOMER_NAME"];?></li>
					<li>尺寸：<?php echo $row["T_SIZE"];?></li>
					<li>价格：<?php echo $row["T_PRICE"];?>￥</li>
				</ul>
            </li>
			<?php
			}
			?>
		</ul>
