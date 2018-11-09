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
		$id = $_GET["ID"];
		$sSql="select * from t_top_nav where T_ID='$id' and T_URL='".GetCurrentWebHost()."' order by T_INDEX ASC, T_NAME";
		$navResult=$SQL->Query($sSql);
		if ($row=mysqli_fetch_array($navResult))
		{
		?>
		<ul class="jianjie_frame">
			<li id="jianjie_frame_name"><?php echo str_replace("\n", "<br>", $row["T_NAME"]);?></li>
			<li id="jianjie_frame_jianjie"><?php echo str_replace("\n", "<br>", $row["T_TEXT"]);?></li>
		</ul>
		<?php
		}
		?>
        </div>
    
	 <div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div> </div>
  </div>
</div>

