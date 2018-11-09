<div class="hy_body_frame">
  <div class="left">
    <div class="top_left"></div><div class="top_center"></div><div class="top_right"></div>
		<ul>
			<li id="nav">导航</li>
			<?php
			$id = $_GET["model"];
			$selected = "id='current'";
            $artical = new article;
			$result = $artical->GetArticleModelList();
			while($row=mysqli_fetch_array($result))
			{
				if ($row["T_STATUS"]!=0)
					continue;
			?>
			<li <?php if ($id==$row["T_ID"]) echo $selected;?>><a href="?p=news&model=<?php echo $row["T_ID"];?>"><?php echo $row["T_MODELNAME"];?></a></li>
			<?php
			}
			?>
		</ul>
	<div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div>
  </div>
  
  <div class="right">
  	<div style="overflow:hidden; width:830px;"> <div class="top_left"></div><div class="top_center"></div><div class="top_right"></div> </div>
		<div class="body">
		<?php
		$text = $_GET["text"]."";
		if ($text=="")
		{
		?>
			<ul class="article_ul">
			<?php
			$nItemEachPage = 18;
			$current_page = $_GET["page"]+0;
			if ($current_page==0)
				$current_page = 1;
				
			$resultTmp = $artical->GetArticleList($_GET["model"], ($current_page-1)*$nItemEachPage, $nItemEachPage, true);
			while($row=mysqli_fetch_array($resultTmp))
			{
			?>
				<li><a href="?p=news&model=<?php echo $_GET["model"];?>&text=<?php echo $row["T_ID"];?>"><?php echo $row["T_TITLE"];?> <span class="hyperlink">点击查看</span></a></li>
			<?php
			}
			?>
			</ul>
		<?php
			$PubPage = new PubPage;
			$PubPage->BottomTurnPage("?p=news&model=".$_GET["model"]."&page=", $artical->GetArticleAmount($_GET["model"], true), $current_page, $nItemEachPage);
		}
		else if (""!="text")
		{
			$resultTmp = $artical->GetArticle($_GET["text"], 0, 38);
			if ($row=mysqli_fetch_array($resultTmp))
			{
				?>
				<ul class="jianjie_frame">
				<li id="jianjie_frame_name"><?php echo $row["T_TITLE"];?></li>
				<li id="jianjie_frame_jianjie"><?php echo $row["T_TEXT"];?></li>
				</ul>
				<?php
			}
		}
		?>
        </div>
    
	 <div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div> </div>
  </div>
</div>

