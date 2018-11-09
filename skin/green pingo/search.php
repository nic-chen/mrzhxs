        <h1>Product</h1>
        <div class="itemHeadBody">
  	<?php
	include("dbCfg.php");
    $pru_t_child=$_GET["T_CHILD"];
	$pru_t_class=$_GET["T_CLASS"];
	$pru_class=$_GET["CLASSS"];
	$pru_class = str_replace("'", "''", $pru_class);
	$pru_FenLei=$_GET["FanWei"];
	if (strlen($pru_FenLei)==0)
		$pru_FenLei="By_All";
	
	$pru_class=trim($pru_class);
	$current_page=$_GET["page"];
	$pru_sex=$_GET["sex"];
	$nItemEachPage=30;
	if (true==empty($pru_sex))
		$pru_sex="By_All";

	if ($current_page==0 )
		$current_page=1;
	
	$sSql="";
	
	if (empty($pru_class)==true)
	{
		$sSql=" where T_STATUS=0 ";
			
		if (empty($pru_t_child)==false)
			$sSql =$sSql." and T_CHILD='".$pru_t_child."'";
			
		if (empty($pru_t_class)==false)
			$sSql =$sSql." and T_CLASS='".$pru_t_class."'";
		
		//if (empty($pru_sex)==false)
		//	$sSql =$sSql." and T_STYLE_MEN=$pru_sex";
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;
		
//		if (GetIsVipSignIn())
//			;
//		else
//			$sSql =$sSql." and IS_VIP=false ";
		
		if (GetItemOrderBy()=="ViewTimes")
			$sSql=$sSql." order by T_HOT DESC, T_ID DESC";
		else
			$sSql=$sSql." order by T_DENG_JI_TIME DESC, T_ID DESC, T_HOT DESC";
	}
	else if ($pru_FenLei=="By_All")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";
		$pru_class_fenge = explode(' ', $pru_class);  /* split into parts*/

		foreach ($pru_class_fenge as $word)
		{
			if ($word=="style" ||  $word=="and" ||  $word=="or" )
				;
			else
			{
				if ($isHaveAnd==false)
				{
					$sSql=$sSql." (T_ID like '%".$word."%' OR T_CHILD like '%".$word."%' OR T_CLASS like '%".$word."%' OR KEY_WORD like '%".$word."%')";
					$isHaveAnd=true;
				}
				else
				{
					$sSql=$sSql." and (T_ID like '%".$word."%' OR T_CHILD like '%".$word."%' OR T_CLASS like '%".$word."%' OR KEY_WORD like '%".$word."%')";
				}
			}
		}
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;


		$sSql=$sSql." and T_STATUS=0 ";
		if (GetItemOrderBy()=="DATE")
			$sSql=$sSql." order by T_DENG_JI_TIME DESC, T_HOT DESC, T_ID DESC";
		else
			$sSql=$sSql." order by T_HOT DESC, T_ID DESC";
	}
	else if ($pru_FenLei=="By_Brand")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";

		$sSql=$sSql." (T_CHILD like '%".$pru_class."%' ) ";
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;

		$sSql=$sSql." and T_STATUS=0 ";
		if (GetItemOrderBy()=="DATE")
			$sSql=$sSql." order by T_DENG_JI_TIME DESC, T_HOT DESC, T_ID DESC";
		else
			$sSql=$sSql." order by T_HOT DESC, T_ID DESC";
	}
	else if ($pru_FenLei=="By_Class")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";

		$sSql=$sSql." (T_CLASS like '%".$pru_class."%' ) ";
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;


		$sSql=$sSql." and T_STATUS=0 ";
		if (GetItemOrderBy()=="DATE")
			$sSql=$sSql." order by T_DENG_JI_TIME DESC, T_HOT DESC, T_ID DESC";
		else
			$sSql=$sSql." order by T_HOT DESC, T_ID DESC";
	}
	else if ($pru_FenLei=="By_ID")
	{
		$isHaveAnd=false;
		$pru_class=trim($pru_class);
		$sSql = " where ";

		$sSql=$sSql." (T_ID like '%".$pru_class."%' ) ";
		
		if ($pru_sex=="By_All")
			;
		else
			$sSql =$sSql." and T_STYLE_MEN=".$pru_sex;


		$sSql=$sSql." and T_STATUS=0 ";
		if (GetItemOrderBy()=="DATE")
			$sSql=$sSql." order by T_DENG_JI_TIME DESC, T_HOT DESC, T_ID DESC";
		else
			$sSql=$sSql." order by T_HOT DESC, T_ID DESC";
	}
	//echo "select * from pru ".$sSql." LIMIT ".(($current_page-1)*$nItemEachPage).", $nItemEachPage";
	$result_currect = mysqli_query("select * from pru ".$sSql." LIMIT ".(($current_page-1)*$nItemEachPage).", $nItemEachPage",$allDateBase);
	$nPruNum = mysqli_num_rows($result_currect);
	
	$nItemEachRow=5;			//item total in row
	$nRow=(int)($nPruNum/$nItemEachRow);	//full row total
	$nLeft=$nPruNum%5;			//left total
	
	for ($i=0; $i<$nRow+1; $i++)
	{
	?>
    <div class="itemRow">
    	<?php
        for ($j=0; $j<$nItemEachRow; $j++)
		{
			$row=mysqli_fetch_array($result_currect);
			if ($row)
			{
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
        }
		?>
      </div>
    <?php
    }		
			include("dbCfg.php");
			//$sSql = "select count(*) as nTotal from pru where T_STATUS=0 ";
			//echo $sSql="select count(*) as nTotal from pru ".$sSql;
			$result_currect = mysqli_query("select count(*) as nTotal from pru ".$sSql,$allDateBase);
			if ($row=mysqli_fetch_array($result_currect))
				$nPruNum = $row["nTotal"];
			else
				$nPruNum = 0;
				
			if ($current_page>1)
				$Pree=$current_page-1;
			else
				$Pree=1;
		
			if ($nPruNum % $nItemEachPage == 0)
				$pages = $nPruNum/$nItemEachPage;
			else
				$pages = ($nPruNum-$nPruNum%$nItemEachPage)/$nItemEachPage + 1;
			/*bottom of daohang*/
            $totalpages=$pages;
            $curPage=$current_page;
                 
            if ($totalpages<11)
            {
                $nStartPage=1;
                $nEndPage=$totalpages;
            }
            else
            {
                if ($curPage<6)
                {
                    $nStartPage=1;
                    $nEndPage=10;
                }
                else
                {
                    if ($totalpages-$curPage<6)
                    {
                        $nStartPage=$totalpages-9;
                        $nEndPage=$totalpages;
                    }
                    else
                    {
                        $nStartPage=$curPage-4;
                        $nEndPage=$curPage+5;
                    }
                }
            }
            
            //echo "nStartPage=".$nStartPage." curPage=".$curPage." nEndPage=".$nEndPage." totalpages=".$totalpages."<br>";
            ?>
    <div class="page">
            <ul>
            <?php 
            if ($nStartPage>1)
            {
            ?>
    <li class="long"><a href="<?php echo "?p=search&T_CHILD=".$_GET["T_CHILD"]."&T_CLASS=".$_GET["T_CLASS"]."&page=1&ID=".$_GET["ID"]."&CLASSS=".$_GET["CLASSS"]."&sex=".$_GET["sex"]; ?>">First</a></li>
            <?php 
            }
            if ($curPage>1)
            {
            ?>
    <li class="long"><a href="<?php echo "?p=search&T_CHILD=".$_GET["T_CHILD"]."&T_CLASS=".$_GET["T_CLASS"]."&page=".($curPage-1)."&ID=".$_GET["ID"]."&CLASSS=".$_GET["CLASSS"]."&sex=".$_GET["sex"]; ?>">Pre</a></li>
            <?php 
            }
    
            for($i=$nStartPage; $i<=$nEndPage; $i++)
            {
                if ($i==$curPage)
                    echo "<li>".$i."</li>";
                else
                {
            ?>
    <li><a href="<?php echo "?p=search&T_CHILD=".$_GET["T_CHILD"]."&T_CLASS=".$_GET["T_CLASS"]."&page=".$i."&ID=".$_GET["ID"]."&CLASSS=".$_GET["CLASSS"]."&sex=".$_GET["sex"];?>"><?php echo $i; ?></a></li>
            <?php 
                }
            }
            if ($curPage<$totalpages)
            {
            ?>
    <li class="long"><a  href="<?php echo "?p=search&T_CHILD=".$_GET["T_CHILD"]."&T_CLASS=".$_GET["T_CLASS"]."&page=".($curPage+1)."&ID=".$_GET["ID"]."&CLASSS=".$_GET["CLASSS"]."&sex=".$_GET["sex"];?>">Next</a></li>
            <?php 
            }
            if ($nEndPage<$totalpages)
            {
            ?>
    <li class="long"><a href="<?php echo "?p=search&T_CHILD=".$_GET["T_CHILD"]."&T_CLASS=".$_GET["T_CLASS"]."&page=".$totalpages."&ID=".$_GET["ID"]."&CLASSS=".$_GET["CLASSS"]."&sex=".$_GET["sex"];?>">End</a></li>
            <?php 
            }
            ?>
            </ul>
    </div>

</div>