<div class="hy_body_frame">
<?php
$type = $_GET["type"];
$bShowLeft = true;
		if ($type=="ItemDetail")
			$bShowLeft = false;
		else if ($type=="viewCart")
			$bShowLeft = false;
		else if ($type=="success")
			$bShowLeft = false;
		else if ($type=="search")
			$bShowLeft = true;
		else
			$bShowLeft = true;
?>
  <div class="left" <?php 
  if ($bShowLeft==false)
  	echo "style=\"display:none\"";
  ?>>
    <div class="top_left"></div><div class="top_center"></div><div class="top_right"></div>
		<ul>
			<li id="nav">导航栏</li>
			<?php
			$nowClass = $_GET["classs"];
			$selected = "id='current'";
            for ($i=0; $i<8; $i++)
			{
				if ($i+1==1)
					$class =  "山水";
				else if ($i+1==2)
					$class =  "花鸟";
				else if ($i+1==3)
					$class =  "人物";
				else if ($i+1==4)
					$class =  "工笔";
				else if ($i+1==5)
					$class =  "书法";
				else if ($i+1==6)
					$class =  "油画";
				else if ($i+1==7)
					$class =  "篆刻";
				else if ($i+1==8)
					$class =  "其他";
			?>
			<li <?php if ($nowClass==$class) echo $selected;?>><a href="?p=product&classs=<?php echo urlencode($class);;?>"><?php echo $class;?></a></li>
			<?php
			}
			?>
		</ul>
	<div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div>
  </div>
  
  <div class="<?php
  if ($bShowLeft==true)
  	echo "product_body_frame";
  else
  	echo "hualang_body_frame";
  ?>">
  	<ul class="top"> <li class="top_left"></li><li class="top_center"></li><li class="top_right"></li> </ul>
		<div class="body">
		<?php
		
		if (strlen($type)==0)
			include("pru_class.php");
		else if ($type=="ItemDetail")
			include("pru_ItemDetail.php");
		else if ($type=="viewCart")
			include("pru_viewCart.php");
		else if ($type=="success")
			include("pru_success.php");
		else if ($type=="search")
			include("pru_search.php");
		?>
        </div>
	<ul class="bottom"> <li class="bottom_left"></li><li class="bottom_center"></li><li class="bottom_right"></li></ul>
  </div>
</div>
