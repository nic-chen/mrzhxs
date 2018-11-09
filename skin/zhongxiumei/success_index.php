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
			while($row=mysql_fetch_array($result))
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
		include("hy_success.php");
		?>
        </div>
    
	 <div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div> </div>
  </div>
</div>

