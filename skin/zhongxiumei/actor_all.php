<div class="hy_body_frame">

    <div class="hualang_body_frame">
        <ul class="top"> <li class="top_left"></li><li class="top_center"></li><li class="top_right"></li> </ul>
            <div class="body">
				<?php
				$page = $_GET["page"];
				if ($page+0 == 0)
					$page = 1;
				$customer = new customer;
				$index = 0;
				$nItemEachRow = 3;
				$nRow = 4;
				$result = $customer->GetCustomerList(($page-1)*$nItemEachRow*$nRow, $nItemEachRow*$nRow, "");
				while($actor=mysql_fetch_array($result))
				{
					if ($actor["T_STATUS"]!=0 || date("Y-m-d", strtotime($actor["T_END_TIME"]))<date("Y-m-d"))
						continue;
					if ($index % $nItemEachRow==0)
						echo "<div style=\"overflow:hidden\">";
					$resultTmp = $SQL->Query("select count(*) as nTotal from pru where T_USER_ID='".$actor["T_ID"]."'");
					$rowTmp = mysql_fetch_array($resultTmp);
					$pruTotal = $rowTmp["nTotal"];
                ?>
                <ul class="actor_block">
                <li id="actor_picture"><img src="images\customer\<?php echo $actor["T_ID"]."\\L.jpg"; ?>" /></li>
                <li id="actor_text">姓名<?php echo FENGHAO.$actor["T_CUSTOMER_NAME"];?></li>
                <li id="actor_text">作品数量<?php echo FENGHAO.$pruTotal;?>件</li>
                <li id="actor_text">加入时间<?php echo FENGHAO.date("Y年m月d日", strtotime($actor["T_CREATE_TIME"]));?></li>
                <li id="actor_text">网址<?php echo FENGHAO;?><a href="http://<?php echo $actor["T_HEAD_URL"].".".GetCurrentWebHost();?>" target="_blank"><?php echo $actor["T_HEAD_URL"].".".GetCurrentWebHost();?></a></li>
                </ul>
                <?php
                    $index++;
                    if ($index % $nItemEachRow==0)
					{
                        echo "</div>";
					}
                }
                if ($index % $nItemEachRow==1 || $index% $nItemEachRow==2)
                        echo "</div>";
                ?>
                
              
            <?php
            $url="?p=actor_all&page="; 
			$nTotal = $customer->GetCustomerAmount("");
			$current_page = $page;
			$nItemEachPage = $nItemEachRow*$nRow;
            $PubPage = new PubPage;
            $PubPage->BottomTurnPage($url, $nTotal, $current_page, $nItemEachPage);
            ?>
            </div>
        <ul class="bottom"> <li class="bottom_left"></li><li class="bottom_center"></li><li class="bottom_right"></li> </ul>
    </div>
    
</div>