<div class="hy_body_frame">



    <div class="hualang_body_frame">

        <ul class="top"> <li class="top_left"></li><li class="top_center"></li><li class="top_right"></li> </ul>

            <div class="body">

				<?php

                $class = $_GET["classs"];
				$class = str_replace(" ", "", $class);
				$class = str_replace("画家", "", $class);
				$class = str_replace("家", "", $class);

                $nItemEachPage = 12;
                $current_page = $_GET["page"]+0;
                if ($current_page==0)
                    $current_page = 1;

				if ($class == "")
					$sSql = "select T_ID as T_USER_ID from registercustomer where 1=1 ";
				else 
          $sSql = "select T_ID as T_USER_ID from registercustomer where pruTypeList like '%$class%' ";

				$name = trim($_GET["name"]);

				if (strlen($name)==0)
					;
				else
				{
					$sSql=$sSql." and registercustomer.T_CUSTOMER_NAME like '%".$name."%' ";
				}

				$area = $_GET["area"];
				if ($area=="")
					;
				else
				{
					$sSql=$sSql." and registercustomer.T_PRIVINCE = '$area' ";
				}

				
				$meixie_huiyuan = $_GET["meixie_huiyuan"];
				if ($meixie_huiyuan=="")
					;
				else
				{
					$sSql=$sSql." and registercustomer.T_MEIXIE_TYPE = $meixie_huiyuan ";
				}

				$shuxie_huiyuan = $_GET["shuxie_huiyuan"];
				if ($shuxie_huiyuan=="")
					;
				else
				{
					$sSql=$sSql." and registercustomer.T_SHUXIE_TYPE = $shuxie_huiyuan ";
				}

					

                $SQL = new SQL;

                $result = $SQL->Query($sSql." order by T_CREATE_TIME desc limit ".(($current_page-1)*$nItemEachPage).", $nItemEachPage");

                $nTotal = mysqli_num_rows($result);

                $index = 0;

                while($row=mysqli_fetch_array($result))
                {
                    if (strlen($row["T_USER_ID"])==0)
                        continue;

										$Customer = new Customer;
                    $resultActor = $Customer->GetCustomerByID($row["T_USER_ID"]);
                    $actor = mysqli_fetch_array($resultActor);

										if ($actor["T_STATUS"]!=0 || date("Y-m-d", strtotime($actor["T_END_TIME"]))<date("Y-m-d"))
					
											continue;

						

					$index++;

                    if ($index % 3==0)

                        echo "<div style=\"overflow:hidden;padding-left:10px; padding-right:10px;\">";

                        

                    

					$resultTmp = $SQL->Query("select count(*) as nTotal from pru where T_USER_ID='".$actor["T_ID"]."'");

					$rowTmp = mysqli_fetch_array($resultTmp);

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

                    if ($index % 3==0)

					{

                        echo "</div>";

					}

                }

                if ($index % 3==1 || $index% 3==2)

                        echo "</div>";

                ?>

                

              

            <?php

			$result = $SQL->Query($sSql);

            $nTotal = mysqli_num_rows($result);

            $url="?p=actor&classs=".urlencode($class)."&area=".urlencode($area)."&name=".urlencode($name)."&type="."search"."&meixie_huiyuan=".urlencode($meixie_huiyuan)."&shuxie_huiyuan=".urlencode($shuxie_huiyuan)."&page="; 

            $PubPage = new PubPage;

            $PubPage->BottomTurnPage($url, $nTotal, $current_page, $nItemEachPage);

            ?>

            </div>

        <ul class="bottom"> <li class="bottom_left"></li><li class="bottom_center"></li><li class="bottom_right"></li> </ul>

    </div>

    

</div>