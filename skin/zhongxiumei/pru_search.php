<?php

			$sSql="";
			$orderBy = $_GET["order"];
			$nItemEachPage = 20;
			$current_page = $_GET["page"]+0;
			if ($current_page==0)
				$current_page = 1;
			
			$sSql=" where 1=1 ";
			$class = $_GET["classs"];
			//echo "[".$class."]";
			if ($class=="")
				;
			else
			{
				if ($class=="山水" || $class=="花鸟" || $class=="人物" || $class=="工笔" || $class=="书法" || $class=="油画" || $class=="篆刻")
					$sSql=$sSql." and pru.T_CLASS='$class' ";
				else
					$sSql=$sSql." and (pru.T_CLASS<>'山水' and pru.T_CLASS<>'花鸟' and pru.T_CLASS<>'人物' and pru.T_CLASS<>'工笔' and pru.T_CLASS<>'书法' and pru.T_CLASS<>'油画' and pru.T_CLASS<>'篆刻' )";
			}
			
			$name = trim($_GET["name"]);
			if (strlen($name)==0)
				;
			else
			{
				$sSql=$sSql." and pru.T_USER_ID in (select T_ID from registercustomer where T_CUSTOMER_NAME like '$name') ";
			}
			
			if ($orderBy=="hot")
				$sSql=$sSql." order by pru.T_HOT DESC, pru.T_ID DESC";
			else
				$sSql=$sSql." order by pru.T_DENG_JI_TIME DESC, pru.T_HOT DESC, pru.T_ID DESC";
			
			
			
			$SQL = new SQL;
			$result = $SQL->Query("select pru.T_ID, pru.T_SIZE, pru.T_PRICE, pru.T_USER_ID  from pru ".$sSql." limit ".(($current_page-1)*$nItemEachPage).", $nItemEachPage");
			//echo "select pru.T_ID, pru.T_SIZE, pru.T_PRICE, pru.T_USER_ID  from pru ".$sSql." limit ".(($current_page-1)*$nItemEachPage).", $nItemEachPage";
			$index = 0;
			$Customer = new Customer;
			$totalPru = 0;
			while($row=mysql_fetch_array($result))
			{
				$totalPru++;
				$index=$index%5;
				if ($index==0)
				{
				?>
					<div class="pruRow">
				<?php
				}
				
				$url = "?p=product&type=ItemDetail&T_ID=".$row["T_ID"];
				
				$SQL2 = new SQL;
				$result2 = $SQL2->Query("select T_CUSTOMER_NAME from registercustomer where ".$row["T_USER_ID"]." = registercustomer.T_ID ");
				$row2 = mysql_fetch_array($result2)
			?>
				<ul class="index_pru">
					<li id="picture"><a href="<?php echo $url;?>"><img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";?>"/></a></li>
					<li><?php echo AUTHOR.FENGHAO; echo $row2["T_CUSTOMER_NAME"];?></li>
					<li><?php echo SIZE.FENGHAO; if (empty($row["T_SIZE"])) echo "询问"; else echo $row["T_SIZE"];?></li>
					<li><?php echo PRICE.FENGHAO; if (empty($row["T_PRICE"])) echo "询问"; else echo $row["T_PRICE"].MONEY_DANWEI;?></li>
					<li id="buy_cart"><a href="<?php echo $url;?>"><?php echo BUY;?></a></li>
				</ul>
			<?php
				$index++;
				if ($index==5)
				{
				?>
					</div>
				<?php
				}
			}
			
			if ($index!=5 && $index!=0)
			{
			?>
				</div>
			<?php
			}
			
			if ($totalPru==0)
				echo SEARCH_PRU_NO_RECORD;
			
	$url="?classs=".$_GET["classs"]."&area=".$_GET["area"]."&name=".$_GET["name"]."&p=product&type=search&price=".$_GET["price"]."&runge_price=".$_GET["runge_price"]."&meixie_huiyuan=".$_GET["meixie_huiyuan"]."&shuxie_huiyuan=".$_GET["shuxie_huiyuan"]."&search=".$_GET["search"]."&page="; 
	$result_currect = $SQL->Query("select count(*) as nTotal from pru ".$sSql);
	if ($row=mysql_fetch_array($result_currect))
		$nPruNum = $row["nTotal"];
	else
		$nPruNum = 0;
		
	$PubPage = new PubPage;
	$PubPage->BottomTurnPage($url, $nPruNum, $current_page, $nItemEachPage);
	?>