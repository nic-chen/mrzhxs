			<?php
			$nItemEachPage = 9;
			$current_page = $_GET["page"]+0;
			if ($current_page==0)
				$current_page = 1;
			$result = $Customer->GetCustomerList(($current_page-1)*$nItemEachPage, $nItemEachPage, $type);
			$index = -1;
			while($row=mysql_fetch_array($result))
			{
				if ($index==-1)
					$index = 0;
				$index = $index % 3;
				if ($index==0)
					echo "<div style=\"overflow:hidden;padding-left:10px; padding-right:10px;\">";
			?>
            <ul class="hezuo_block">
		  	<li id="firstRow"><span class="text"><?php echo $row["T_CUSTOMER_NAME"];?></span><span class="url"><a href="<?php echo "http://".$row["T_HEAD_URL"].".".GetCurrentWebHost();?>" target="_blank">点击进入</a></span></li>
			<li class="itemRow"><span class="name">编号</span><span class="size">尺寸/厘米(cm)</span><span class="price">价格 ￥</span></li>
			<?php 
			$index001 = 0;
			$Product = new Product;
			$resultHuaLang = $Product->SelectProductList($row["T_ID"], 0, 0);
			while($rowHuaLang=mysql_fetch_array($resultHuaLang))
			{
				if ($index001>3)
					break;
			?>
            <li class="itemRow"><span class="name"><?php echo $rowHuaLang["T_ID"];?></span><span class="size"><?php echo $rowHuaLang["T_SIZE"];?></span><span class="price"><?php echo $rowHuaLang["T_PRICE"];?></span></li>
			<?php
				$index001++;
			}
			?>
            <li id="contactInfo"><span class="tel">联系电话<?php echo FENGHAO.$row["T_TEL_PHONE"]." ".$row["T_MOBIL_PHONE"];?></span><span class="address">联系地址<?php echo FENGHAO.$row["T_PRIVINCE"]." ".$row["T_ADDRESS"];?></span></li>
            </ul>
			<?php
				$index++;
				if ($index==3)
					echo "</div>";
			}
			if ($index==1 || $index==2)
					echo "</div>";
			?>
		  
		<?php
		$url="?p=Other&ID=".$_GET["ID"]."&classs=".urlencode($class)."&page="; 
		$PubPage = new PubPage;
		$PubPage->BottomTurnPage($url, $Customer->GetCustomerAmount($type), $current_page, $nItemEachPage);
		?>