		<h1>Hot items</h1>
             <div id="MarqueePictues">
               <div>
                <table cellpadding="0" cellspacing="0" border="0">
                 <tbody>
                  <tr id="pictures">
                  <?php
                  include("dbCfg.php");
    			  $sSql = "select * from pru where T_STATUS=0 order by T_HOT DESC, T_ID DESC LIMIT 0, 40";
				  $result_currect = mysql_query($sSql,$allDateBase);
				  while($row=mysql_fetch_array($result_currect))
				  {
				  ?>
                     <td><a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>"><img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";?>" class="roll_item_pic"/></a></td>
                  <?php
                  }
				  ?>
                  </tr>
                 </tbody>
                </table>
               </div>
             </div>
        <h1>Recommended</h1>
<div class="itemHeadBody">
  	<?php
	include("dbCfg.php");
    	
	$sSql="select * from T_HOT_ITEM where T_HOT_TYPE='index_new_arraivals' and  T_URL='".GetCurrentWebHost()."' order by T_ORDER ASC, T_ID DESC";
	$result_HOT_item = mysql_query($sSql,$allDateBase);
	$nPruNum = mysql_numrows($result_HOT_item);
	
	$nItemEachRow=5;			//item total in row
	$nRow=(int)($nPruNum/$nItemEachRow);	//full row total
	$nLeft=$nPruNum%5;			//left total
	
	$bIsHaveNextRow=true;
	
	while($bIsHaveNextRow)
	{
	?>
    <div class="itemRow">
    	<?php
		$bIsHaveNextOne=true;
		$thisRowTotalItem=0;
        while($bIsHaveNextOne)
		{
			$rowHotItem=mysql_fetch_array($result_HOT_item);
			if (!$rowHotItem)
			{
				$bIsHaveNextRow=false;
				break;
			}
			$sSql="select * from pru where T_ID='".$rowHotItem["T_ID"]."'";
			$result_correct_item = mysql_query($sSql,$allDateBase);
			$row=mysql_fetch_array($result_correct_item);
			if ($row)
			{
				$thisRowTotalItem++;
				?>
				<ul class="pru_each">
      				<li class="pru_pic"><a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>">
										<img src="<?php echo GetItemPathInfo($row["T_ID"], $row["Version"])."head.jpg";?>" border="0" alt="<?php echo $row["T_ID"];?>" title="<?php echo $row["T_ID"];?>"></a>
								</li>
        			<li class="pru_id"><?php echo $row["T_ID"];?></li>
      				<li class="pru_cart"><a href="?p=ItemDetail&T_ID=<?php echo $row["T_ID"];?>"><img src="pub_images/order.jpg"/></a></li>
    			</ul>
				<?php
			}
			else
				$j--;
			
			if ($thisRowTotalItem==5)
			{
				$bIsHaveNextOne=false;
				break;
			}
        }
		?>
      </div>
    <?php
    }
	?>	
</div>