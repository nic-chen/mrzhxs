			<?php
                $nItemEachPage = 9;
                $current_page = $_GET["page"]+0;
                if ($current_page==0)
                    $current_page = 1;
                $sSql = "select distinct T_USER_ID from pru where LENGTH(T_USER_ID)>0 order by T_DENG_JI_TIME desc";
                $SQL = new SQL;
                $result = $SQL->Query($sSql." limit ".($current_page-1)*$nItemEachPage.", $nItemEachPage");
				//echo $sSql." limit ".($current_page-1)*$nItemEachPage.", $nItemEachPage";
				$resultTotal = $SQL->Query($sSql);
                $nTotal = mysql_numrows($resultTotal);
                $index = 0;
                while($row=mysql_fetch_array($result))
                {
                    if (strlen($row["T_USER_ID"])==0)
                        continue;
					if ($index > $nItemEachPage -1 )
						break;
                    if ($index % 3==0)
                        echo "<div style=\"overflow:hidden;padding-left:10px; padding-right:10px;\">";
                        
                    $Customer = new Customer;
                    $resultActor = $Customer->GetCustomerByID($row["T_USER_ID"]);
                    $actor = mysql_fetch_array($resultActor);
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
                    if ($index % 3==0)
					{
                        echo "</div>";
					}
                }
                if ($index % 3==1 || $index% 3==2)
                        echo "</div>";
                ?>
                
              
            <?php
            $url="?p=Other&ID=".$_GET["ID"]."&classs=".urlencode($class)."&page="; 
            $PubPage = new PubPage;
            $PubPage->BottomTurnPage($url, $nTotal, $current_page, $nItemEachPage);
            ?>