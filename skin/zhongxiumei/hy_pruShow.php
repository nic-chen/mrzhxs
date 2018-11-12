			<?php
			$sSql="";
			$orderBy = $_GET["order"];
			$nItemEachPage = 20;
			$current_page = $_GET["page"]+0;
			if ($current_page==0)
				$current_page = 1;
			
			$sSql=" where T_USER_ID='$customerID' ";
			if ($orderBy=="createTime")
				$sSql=$sSql." order by T_DENG_JI_TIME DESC, T_HOT DESC, T_ID DESC";
			else if ($orderBy=="hot")
				$sSql=$sSql." order by T_HOT DESC, T_ID DESC";
			
			$SQL = new SQL;
			$result = $SQL->Query("select * from pru ".$sSql." limit ".(($current_page-1)*$nItemEachPage).", $nItemEachPage");
			//echo "select * from pru ".$sSql." limit ".(($current_page-1)*$nItemEachPage).", $nItemEachPage";
			$index = 0;
			$preUserID = "";
			while($row=mysqli_fetch_array($result))
			{

				
				$index=$index%5;
				if ($index==0)
				{
				?>
					<div class="pruRow">
				<?php
				}
			?>
			
			<?php if(isset($_GET['johz'])){
				var_dump($row);
			} ?>

				<ul class="index_pru">
					<li id="picture">&nbsp;<a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>"><img src="<?php echo GetItemPathInfo($row['T_ID'], $row['Version']).'head.jpg';?>"/></a></li>
					<li><?php echo SIZE.FENGHAO; if (empty($row["T_SIZE"])) echo "询问"; else echo $row["T_SIZE"];?></li>
				  <li><?php echo PRICE.FENGHAO; if (empty($row["T_PRICE"])) echo "询问"; else echo $row["T_PRICE"].MONEY_DANWEI;?></li>
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
			
	$url="?p=search&T_CHILD=".$_GET["T_CHILD"]."&T_CLASS=".$_GET["T_CLASS"]."&order=".$_GET["order"]."&ID=".$_GET["ID"]."&CLASSS=".$_GET["CLASSS"]."&sex=".$_GET["sex"]."&page="; 
	$result_currect = $SQL->Query("select count(*) as nTotal from pru where T_USER_ID='$customerID'");
	if ($row=mysqli_fetch_array($result_currect))
		$nPruNum = $row["nTotal"];
	else
		$nPruNum = 0;
		
	$PubPage = new PubPage;
	$PubPage->BottomTurnPage($url, $nPruNum, $current_page, $nItemEachPage);
	?>