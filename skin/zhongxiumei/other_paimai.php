			<?php
			$nItemEachPage = 8;
			$current_page = $_GET["page"]+0;
			if ($current_page==0)
				$current_page = 1;
			$result = $Customer->GetCustomerList(($current_page-1)*$nItemEachPage, $nItemEachPage, $type);
			$index = -1;
			while($row=mysqli_fetch_array($result))
			{
				if ($index==-1)
					$index = 0;
				$index = $index % 2;
				if ($index==0)
					echo "<div style=\"overflow:hidden;padding-left:10px; padding-right:10px; width:100%;\">";
			?>
            <ul class="paimai_block">
			<li class="paimai_title"><span class="paimai_name"><?php echo $row["T_CUSTOMER_NAME"];?></span><span class="paimai_url"><a href="<?php echo "http://".$row["T_HEAD_URL"].".".GetCurrentWebHost();?>" target="_blank">[查看详细信息]</a></span></li>
            <li class="paimai_contact">联系电话<?php echo FENGHAO.$row["T_TEL_PHONE"]." ".$row["T_MOBIL_PHONE"];;?><br>联系地址<?php echo FENGHAO.$row["T_PRIVINCE"]." ".$row["T_ADDRESS"];?></li>
            </ul>
			<?php
				$index++;
				if ($index==2)
					echo "</div>";
			}
			if ($index==1)
					echo "</div>";
			?>
		  
		<?php
		$url="?p=Other&ID=".$_GET["ID"]."&classs=".urlencode($class)."&page="; 
		$PubPage = new PubPage;
		$PubPage->BottomTurnPage($url, $Customer->GetCustomerAmount($type), $current_page, $nItemEachPage);
		?>