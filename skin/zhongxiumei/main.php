<?php
$artical = new article;
$rowActicaleModel = $artical->GetArticleModelList();

function WriteArticleModel($id, $length, $title)
{
?>
		<h2><span class="title"><a href="?p=news&model=<?php echo $id;?>"><?php echo $title;?></a></span><span class="more"><a href="?p=news&model=<?php echo $id;?>">&gt;&gt;更多</a></span></h2>
        <ul class="article_ul">
        <?php
		$artical = new article;
		$resultTmp = $artical->GetArticleList($id, 0, $length, false);
		while($row=mysql_fetch_array($resultTmp))
		{
		?>
            <li><a href="?p=news&model=<?php echo $id;?>&text=<?php echo $row["T_ID"];?>"><?php echo wordscut($row["T_TITLE"], 60);?></a></li>
        <?php
        }
		?>
        </ul>
<?php
}
?>
<DIV class="clearfix">
  <DIV class="huandengpian_huiyuan">
	   <div class="body_left" >
    	<ul class="body_left_ul">
        	<li id="huandengpian"><script type="text/javascript">
			 var focus_width=308;
			 var focus_height=226;
			 var text_height=23;
			 var swf_height = focus_height+text_height;
			 <?php
			 $AD = new AD;
			 $pics=$links=$texts="";
			 $index = 0;
			 $reslut = $AD->GetAdListByType("huandengpian");
			 while($row=mysql_fetch_array($reslut))
			 {
				if ($index == 0)
				{
					$pics=$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$row["T_VALUE"];
					$texts=$row["T_MEMO"];
				}
				else
				{
					$pics=$pics."|".$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$links."|".$row["T_VALUE"];
					$texts=$texts."|".$row["T_MEMO"];
				}
				$index++;
			 }
			 ?>
			 var pics="<?php echo $pics;?>";
			 var links="<?php echo $links;?>";
			 var texts="<?php echo $texts?>";
			 
			 document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
			 document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="images/focus1.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">');
			 document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
			 document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
			 document.write('</object>')			 </script>
			</li>
            <?php 
			 $reslut = $AD->GetAdListByType("wenziguanggao");
			 while($row=mysql_fetch_array($reslut))
			 {
 			?>
			<li><?php echo $row["T_MEMO"];?></li>
			<?php
			 }
			?>
        </ul>
	   </div>
       <div class="huandengpian_huiyuan_body_right">
    	<?php
        include("skin/".$webConfig->webOther->GetContectByName("Skin")."/headHuiYuan.php");
        ?>
       </DIV>
  </div>
</DIV>

<DIV class="clearfix">
	<DIV class="article" id="border_right">
        <h2><span class="title">名家展厅销售情况</span></h2>
	  	
	  	<div id="textdiv" style="width:320px;overflow:hidden; padding:0px; height:300px; float:left;" >
       	  <div style="text-align:left; background:#FFFFFF; padding-left:5px;">
          <?php
		  $BuyLog = new BuyLog;
		  $result = $BuyLog->GetBuyLogList(1);
		  $nMaxTotal = 15;
		  $nPos = 0;
		  while($row=mysql_fetch_array($result))
		  {
		  		if (++$nPos>$nMaxTotal)
					break;
		  		if (strlen($row["T_PRU_ID"])>0)
				{
					$SQL = new SQL;
					$resTmp = $SQL->Query("select * from pru where pru.T_ID='".$row["T_PRU_ID"]."' ");
					if ($rowTmp=mysql_fetch_array($resTmp))
					{
						$SQL2 = new SQL;
						$resTmp2 = $SQL2->Query("select * from registercustomer where ".$rowTmp["T_USER_ID"]." = registercustomer.T_ID");
						if ($rowTmp2=mysql_fetch_array($resTmp2))
							echo "买家订购 ".$rowTmp2["T_CUSTOMER_NAME"]." 作品[<a href='?p=product&type=ItemDetail&T_ID=".$row["T_PRU_ID"]."'>".$row["T_PRU_ID"]."</a>] ".date("y-m-d", strtotime($row["T_CREATE_TIME"]))."<br>";
					}
				}
				else if (strlen($row["T_USER_ID"])>0)
				{
					$Customer = new Customer;
					$res = $Customer->GetCustomerByID($row["T_USER_ID"]);
					if ($rowTmp=mysql_fetch_array($res))
						echo "买家从 ".$rowTmp["T_CUSTOMER_NAME"]." 网站订购产品 ".date("y-m-d", strtotime($row["T_CREATE_TIME"]))."<br>";
				}
		  }
		  ?>
          </div>
		
		</div>
	  <script defer>
	  function Marquee()
{
	this.ID = document.getElementById(arguments[0]);
	if(!this.ID)
	{
		alert("您要设置的\"" + arguments[0] + "\"初始化错误\r\n请检查标签ID设置是否正确!");
		this.ID = -1;
		return;
	}
	this.Direction = this.Width = this.Height = this.DelayTime = this.WaitTime = this.CTL = this.StartID = this.Stop = this.MouseOver = 0;
	this.Step = 1;
	this.Timer = 30;
	this.DirectionArray = {"top":0 , "up":0 , "bottom":1 , "down":1 , "left":2 , "right":3};
	if(typeof arguments[1] == "number" || typeof arguments[1] == "string")this.Direction = arguments[1];
	if(typeof arguments[2] == "number")this.Step = arguments[2];
	if(typeof arguments[3] == "number")this.Width = arguments[3];
	if(typeof arguments[4] == "number")this.Height = arguments[4];
	if(typeof arguments[5] == "number")this.Timer = arguments[5];
	if(typeof arguments[6] == "number")this.DelayTime = arguments[6];
	if(typeof arguments[7] == "number")this.WaitTime = arguments[7];
	if(typeof arguments[8] == "number")this.ScrollStep = arguments[8];
	this.ID.style.overflow = this.ID.style.overflowX = this.ID.style.overflowY = "hidden";
	this.ID.noWrap = true;
	this.IsNotOpera = (navigator.userAgent.toLowerCase().indexOf("opera") == -1);
	if(arguments.length >= 7)this.Start();
}

Marquee.prototype.Start = function()
{
	if(this.ID == -1)return;
	if(this.WaitTime < 800)this.WaitTime = 800;
	if(this.Timer < 20)this.Timer = 20;
	if(this.Width == 0)this.Width = parseInt(this.ID.style.width);
	if(this.Height == 0)this.Height = parseInt(this.ID.style.height);
	if(typeof this.Direction == "string")this.Direction = this.DirectionArray[this.Direction.toString().toLowerCase()];
	this.HalfWidth = Math.round(this.Width / 2);
	this.HalfHeight = Math.round(this.Height / 2);
	this.BakStep = this.Step;
	this.ID.style.width = this.Width + "px";
	this.ID.style.height = this.Height + "px";
	if(typeof this.ScrollStep != "number")this.ScrollStep = this.Direction > 1 ? this.Width : this.Height;
	var templateLeft = "<table cellspacing='0' cellpadding='0' style='border-collapse:collapse;display:inline;'><tr><td noWrap=true style='white-space: nowrap;word-break:keep-all;'>MSCLASS_TEMP_HTML</td><td noWrap=true style='white-space: nowrap;word-break:keep-all;'>MSCLASS_TEMP_HTML</td></tr></table>";
	var templateTop = "<table cellspacing='0' cellpadding='0' style='border-collapse:collapse;'><tr><td>MSCLASS_TEMP_HTML</td></tr><tr><td>MSCLASS_TEMP_HTML</td></tr></table>";
	var msobj = this;
	msobj.tempHTML = msobj.ID.innerHTML;
	if(msobj.Direction <= 1)
	{
		msobj.ID.innerHTML = templateTop.replace(/MSCLASS_TEMP_HTML/g,msobj.ID.innerHTML);
	}
	else
	{
		if(msobj.ScrollStep == 0 && msobj.DelayTime == 0)
		{
			msobj.ID.innerHTML += msobj.ID.innerHTML;
		}
		else
		{
			msobj.ID.innerHTML = templateLeft.replace(/MSCLASS_TEMP_HTML/g,msobj.ID.innerHTML);
		}
	}
	var timer = this.Timer;
	var delaytime = this.DelayTime;
	var waittime = this.WaitTime;
	msobj.StartID = function(){msobj.Scroll()}
	msobj.Continue = function()
				{
					if(msobj.MouseOver == 1)
					{
						setTimeout(msobj.Continue,delaytime);
					}
					else
					{	clearInterval(msobj.TimerID);
						msobj.CTL = msobj.Stop = 0;
						msobj.TimerID = setInterval(msobj.StartID,timer);
					}
				}

	msobj.Pause = function()
			{
				msobj.Stop = 1;
				clearInterval(msobj.TimerID);
				setTimeout(msobj.Continue,delaytime);
			}

	msobj.Begin = function()
		{
			msobj.ClientScroll = msobj.Direction > 1 ? msobj.ID.scrollWidth / 2 : msobj.ID.scrollHeight / 2;
			if((msobj.Direction <= 1 && msobj.ClientScroll <= msobj.Height + msobj.Step) || (msobj.Direction > 1 && msobj.ClientScroll <= msobj.Width + msobj.Step))			{
				msobj.ID.innerHTML = msobj.tempHTML;
				delete(msobj.tempHTML);
				return;
			}
			delete(msobj.tempHTML);
			msobj.TimerID = setInterval(msobj.StartID,timer);
			if(msobj.ScrollStep < 0)return;
			msobj.ID.onmousemove = function(event)
						{
							if(msobj.ScrollStep == 0 && msobj.Direction > 1)
							{
								var event = event || window.event;
								if(window.event)
								{
									if(msobj.IsNotOpera)
									{
										msobj.EventLeft = event.srcElement.id == msobj.ID.id ? event.offsetX - msobj.ID.scrollLeft : event.srcElement.offsetLeft - msobj.ID.scrollLeft + event.offsetX;
									}
									else
									{
										msobj.ScrollStep = null;
										return;
									}
								}
								else
								{
									msobj.EventLeft = event.layerX - msobj.ID.scrollLeft;
								}
								msobj.Direction = msobj.EventLeft > msobj.HalfWidth ? 3 : 2;
								msobj.AbsCenter = Math.abs(msobj.HalfWidth - msobj.EventLeft);
								msobj.Step = Math.round(msobj.AbsCenter * (msobj.BakStep*2) / msobj.HalfWidth);
							}
						}
			msobj.ID.onmouseover = function()
						{
							if(msobj.ScrollStep == 0)return;
							msobj.MouseOver = 1;
							clearInterval(msobj.TimerID);
						}
			msobj.ID.onmouseout = function()
						{
							if(msobj.ScrollStep == 0)
							{
								if(msobj.Step == 0)msobj.Step = 1;
								return;
							}
							msobj.MouseOver = 0;
							if(msobj.Stop == 0)
							{
								clearInterval(msobj.TimerID);
								msobj.TimerID = setInterval(msobj.StartID,timer);
							}
						}
		}
	setTimeout(msobj.Begin,waittime);
}

Marquee.prototype.Scroll = function()
{
	switch(this.Direction)
	{
		case 0:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollTop += this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollTop >= this.ClientScroll)
				{
					this.ID.scrollTop -= this.ClientScroll;
				}
				this.ID.scrollTop += this.Step;
			}
		break;

		case 1:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollTop -= this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollTop <= 0)
				{
					this.ID.scrollTop += this.ClientScroll;
				}
				this.ID.scrollTop -= this.Step;
			}
		break;

		case 2:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollLeft += this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollLeft >= this.ClientScroll)
				{
					this.ID.scrollLeft -= this.ClientScroll;
				}
				this.ID.scrollLeft += this.Step;
			}
		break;

		case 3:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollLeft -= this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollLeft <= 0)
				{
					this.ID.scrollLeft += this.ClientScroll;
				}
				this.ID.scrollLeft -= this.Step;
			}
		break;
	}
}
		//new Marquee("textdiv",0,1,760,42,20,4000,5000,14);
		new Marquee("textdiv","top",1,275,163,100,0);
		</script>
    </DIV>
	<div id="border_left">
		<DIV class="article">
			<?php
			if($row=mysql_fetch_array($rowActicaleModel))
				WriteArticleModel($row["T_ID"], 8, $row["T_MODELNAME"]);
			?>
		</DIV>
		<DIV class="article">
			<?php
			if($row=mysql_fetch_array($rowActicaleModel))
				WriteArticleModel($row["T_ID"], 8, $row["T_MODELNAME"]);
			?>
		</DIV>
	</div>
</DIV>

<DIV class="clearfix">
	<DIV class="article" id="border_right">
        <?php
		if($row=mysql_fetch_array($rowActicaleModel))
			WriteArticleModel($row["T_ID"], 8, $row["T_MODELNAME"]);
		?>
    </DIV>
	<div id="border_left">
		<DIV class="article">
			<?php
			if($row=mysql_fetch_array($rowActicaleModel))
				WriteArticleModel($row["T_ID"], 8, $row["T_MODELNAME"]);
			?>
		</DIV>
		<DIV class="article">
			<?php
			if($row=mysql_fetch_array($rowActicaleModel))
				WriteArticleModel($row["T_ID"], 8, $row["T_MODELNAME"]);
			?>
		</DIV>
	</div>
</DIV>

<?php
$AD = new AD;
$guanggaoweiResult = $AD->GetAdListByType("huandengpian_head2");
		?>
		<div class="guanggao01">
			<script type="text/javascript">
			 var focus_width=969;
			 var focus_height=107;
			 var text_height=0;
			 var swf_height = focus_height+text_height;
			 <?php
			 $AD = new AD;
			 $pics=$links=$texts="";
			 $index = 0;
			 $reslut = $AD->GetAdListByType("huandengpian_head2");
			 while($row=mysql_fetch_array($reslut))
			 {
				if ($index == 0)
				{
					$pics=$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$row["T_VALUE"];
					$texts=$row["T_MEMO"];
				}
				else
				{
					$pics=$pics."|".$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$links."|".$row["T_VALUE"];
					$texts=$texts."|".$row["T_MEMO"];
				}
				$index++;
			 }
			 ?>
			 var pics="<?php echo $pics;?>";
			 var links="<?php echo $links;?>";
			 var texts="<?php echo $texts?>";
			 
			 document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
			 document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="images/focus1.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">');
			 document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
			 document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
			 document.write('</object>')			 </script>
		</div>

<DIV class="clearfix" style="text-align:left;">
<h1><span class="title">作品分类</span><span class="more"><a href="?p=product">&gt;&gt;更多</a></span></h1>
<?php
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
		
	$url = "?p=product&classs=".urlencode($class);
?>
<ul class="fenlei_head" <?php if ($i==0) echo "id=\"firstRowFenLei\"";?>>
	<li><a href="<?php echo $url;?>"><img src="skin/<?php echo $webConfig->webOther->GetContectByName("Skin");?>/pub_images/class_0<?php echo $i+1;?>.jpg" /></a></li>
    <li><a href="<?php echo $url;?>"><?php
	echo $class;
	?></a></li>
</ul>
<?php
}
?>
</DIV>

<DIV class="clearfix">
<h1><span class="title">当代名家作品展厅</span><span class="more"><a href="?p=product">&gt;&gt;更多</a></span></h1>
<?php
			$sSql="";
			$nItemEachPage = 12;
			$current_page = $_GET["page"]+0;
			if ($current_page==0)
				$current_page = 1;
			
			// $sSql=" where ";
			
			// $sSql=$sSql." pru.T_USER_ID = registercustomer.T_ID ";
			
			$sSql=$sSql." order by pru.T_DENG_JI_TIME DESC, pru.T_HOT DESC, pru.T_ID DESC";
			
			$SQL = new SQL;
			$result = $SQL->Query("select T_ID, T_SIZE, T_PRICE, T_USER_ID from pru ".$sSql." limit ".(($current_page-1)*$nItemEachPage).", $nItemEachPage");
			$index = 0;
			$Customer = new Customer;
			$totalPru = 0;
			while($row=mysql_fetch_array($result))
			{
				$totalPru++;
				$index=$index%6;
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
					<li><?php echo SIZE.FENGHAO; if (empty($row["T_SIZE"])==true) echo "询问"; else echo $row["T_SIZE"];?></li>
					<li><?php echo PRICE.FENGHAO; if (empty($row["T_PRICE"])==true) echo "询问"; else echo $row["T_PRICE"]." ￥";?></li>
					<li id="buy_cart"><a href="<?php echo $url;?>"><?php echo BUY;?></a></li>
				</ul>
			<?php
				$index++;
				if ($index==6)
				{
				?>
					</div>
				<?php
				}
			}
			
			if ($index!=6 && $index!=0)
			{
			?>
				</div>
			<?php
			}
			
			if ($totalPru==0)
				echo SEARCH_PRU_NO_RECORD;
?>
</DIV>

<DIV class="clearfix">
	<DIV class="article" id="border_right">
        <h2><span class="title">联盟单位销售情况</span></h2>
        <ul class="article_ul">
        <?php
		$result = $BuyLog->GetBuyLogList(1);
		$nMaxTotal = 10;
		$nPos = 0;
		while($row=mysql_fetch_array($result))
		{
			if (++$nPos>$nMaxTotal)
				break;
		?>
            <li><?php 
				if (strlen($row["T_PRU_ID"])>0)
				{
					$SQL = new SQL;
					$resTmp = $SQL->Query("select * from pru where pru.T_ID='".$row["T_PRU_ID"]."'");
					if ($rowTmp=mysql_fetch_array($resTmp))
					{
						$SQL2 = new SQL;
						$resTmp2 = $SQL2->Query("select * from registercustomer where '".$rowTmp["T_USER_ID"]."' = registercustomer.T_ID");
						if ($rowTmp2=mysql_fetch_array($resTmp2))
							echo "买家订购 ".$rowTmp2["T_CUSTOMER_NAME"]." 作品[<a href='?p=product&type=ItemDetail&T_ID=".$row["T_PRU_ID"]."'>".$row["T_PRU_ID"]."</a>] ".date("y-m-d", strtotime($row["T_CREATE_TIME"]));
					}
					else
						echo "订购1";
				}
				else if (strlen($row["T_USER_ID"])>0)
				{
					$Customer = new Customer;
					$res = $Customer->GetCustomerByID($row["T_USER_ID"]);
					if ($rowTmp=mysql_fetch_array($res))
						echo "买家从 ".$rowTmp["T_CUSTOMER_NAME"]." 网站订购产品 ".date("y-m-d", strtotime($row["T_CREATE_TIME"]));
				}
			?></li>
        <?php
        }
		?>
      </ul>
    </DIV>
    <DIV class="article">
        <h2><span class="title">交易服务中心</span></h2>
        <ul class="article_ul">
			<?php
			$result = $BuyLog->GetBuyLogList(NULL);
			$nMaxTotal = 10;
			$nPos = 0;
			while($row=mysql_fetch_array($result))
			{
				if (++$nPos>$nMaxTotal)
					break;
			?>
            <li><?php
			if ($row["T_TYPE"]==0)
			{
				if (strlen($row["T_PRU_ID"])>0)
				{
					$SQL = new SQL;
					$resTmp = $SQL->Query("select * from pru where pru.T_ID='".$row["T_PRU_ID"]."' ");
					if ($rowTmp=mysql_fetch_array($resTmp))
					{
						$SQL2 = new SQL;
						$resTmp2 = $SQL2->Query("select T_CUSTOMER_NAME from registercustomer where '".$rowTmp["T_USER_ID"]."' = registercustomer.T_ID");
						if ($rowTmp2=mysql_fetch_array($resTmp2))
							echo "买家订购 ".$rowTmp2["T_CUSTOMER_NAME"]." 作品[<a href='?p=product&type=ItemDetail&T_ID=".$row["T_PRU_ID"]."'>".$row["T_PRU_ID"]."</a>] ".date("y-m-d", strtotime($row["T_CREATE_TIME"]));
					}
				}
				else if (strlen($row["T_USER_ID"])>0)
				{
					$Customer = new Customer;
					$res = $Customer->GetCustomerByID($row["T_USER_ID"]);
					if ($rowTmp=mysql_fetch_array($res))
						echo "买家给 ".$rowTmp["T_CUSTOMER_NAME"]." 网站留言 ".date("y-m-d", strtotime($row["T_CREATE_TIME"]));
				}
			}
			else if ($row["T_TYPE"]==1)
			{
				if (strlen($row["T_PRU_ID"])>0)
				{
					$SQL = new SQL;
					$resTmp = $SQL->Query("select * from pru where pru.T_ID='".$row["T_PRU_ID"]."' ");
					if ($rowTmp=mysql_fetch_array($resTmp))
					{
						$SQL2 = new SQL;
						$resTmp2 = $SQL2->Query("select T_CUSTOMER_NAME from registercustomer where '".$rowTmp["T_USER_ID"]."' = registercustomer.T_ID");
						if ($rowTmp2=mysql_fetch_array($resTmp2))
							echo "买家订购 ".$rowTmp2["T_CUSTOMER_NAME"]." 作品[<a href='?p=product&type=ItemDetail&T_ID=".$row["T_PRU_ID"]."'>".$row["T_PRU_ID"]."</a>] ".date("y-m-d", strtotime($row["T_CREATE_TIME"]));
					}
				}
				else if (strlen($row["T_USER_ID"])>0)
				{
					$Customer = new Customer;
					$res = $Customer->GetCustomerByID($row["T_USER_ID"]);
					if ($rowTmp=mysql_fetch_array($res))
						echo "买家从 ".$rowTmp["T_CUSTOMER_NAME"]." 网站订购产品 ".date("y-m-d", strtotime($row["T_CREATE_TIME"]));
				}
			}
				
			?></li>
			<?php
			}
			?>
        </ul>
    </DIV>
    <DIV class="article">
        <h2><span class="title">宣传专栏</span></h2>
        <?php
$AD = new AD;
$guanggaoweiResult = $AD->GetAdListByType("bottomhuandengpian");
		?>
		<div class="guanggao01" style="width:310px; height:220px; padding:3px; ">
			<script type="text/javascript">
			 var focus_width=310;
			 var focus_height=220;
			 var text_height=0;
			 var swf_height = focus_height+text_height;
			 <?php
			 $AD = new AD;
			 $pics=$links=$texts="";
			 $index = 0;
			 $reslut = $AD->GetAdListByType("bottomhuandengpian");
			 while($row=mysql_fetch_array($reslut))
			 {
				if ($index == 0)
				{
					$pics=$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$row["T_VALUE"];
					$texts=$row["T_MEMO"];
				}
				else
				{
					$pics=$pics."|".$AD->GetADPath()."/".$row["T_PICTURE_NAME"];
					$links=$links."|".$row["T_VALUE"];
					$texts=$texts."|".$row["T_MEMO"];
				}
				$index++;
			 }
			 ?>
			 var pics="<?php echo $pics;?>";
			 var links="<?php echo $links;?>";
			 var texts="<?php echo $texts?>";
			 
			 document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
			 document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="images/focus1.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">');
			 document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
			 document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
			 document.write('</object>')			 </script>
		</div>
    </DIV>
</DIV>
<DIV class="clearfix">
	<ul class="nav2">
		<li>&gt;&gt;友情连接</li>
	<?php
	$frendLink = new FrendLink;
	$result  = $frendLink->GetFrendLinkList();
	while($row=mysql_fetch_array($result))
	{
	?>
		<li>|</li>
    	<li><a href="http://<?php echo $row["URL"];?>" target="_blank"><?php echo $row["T_TEXT"];?></a></li>
	<?php
	}
	?>
    </ul>
</DIV>
