<?php
include_once("settings.php");
include_once(LIBPATH."lib.php");

	$pru_id=trim($_GET["T_ID"]);

	include(APPROOT."dbCfg.php");
	$result = mysql_query("select * from pru where T_ID='".$pru_id."'",$allDateBase);
	$nPruNum = mysql_numrows($result);
	if (0==$nPruNum)
		echo "the production is not found!";
	
	else
	{
		$row=mysql_fetch_array($result);
		$pru_brand=$row["T_CHILD"];
		$pru_class=$row["T_CLASS"];
		$pru_size=$row["T_SIZE"];
		$pru_color=$row["T_COLOR"];
		$pru_payment=$row["T_PAYMENT"];
		$pru_meterial=$row["T_CAI_LIAO"];
		$pru_price=$row["T_PRICE"];
		$pru_description=$row["T_BEIZHU"];
		$pru_pic_num=$row["T_XIJIE_PIC"];
		$pru_size_info=$row["T_SIZE_INFO"];
		$pru_have_detail=$row["T_DETAIL_HAVE"];
		$strPruStatus=$row["T_STATUS"];
		$pru_mini_order=$row["T_MIMI_OLDER"];
		$pru_key_word=$row["KEY_WORD"];
		$pru_version=$row["Version"];
		
		if ($pru_mini_order==0)
			$pru_mini_order++;
		
		if ( $row["T_STYLE_MEN"]==2 )
			$pru_style=" for women";
		elseif ($row["T_STYLE_MEN"]==1)
			$pru_style=" for men";
		else
			$pru_style=" unsex";
		
		if (empty($pru_payment)==true)
			$pru_payment="western union, money gram, moneybooker, paypal";
			
		if (strlen($row["T_DETAIL_PICTURE"]."")>0)
		{
		 	$picturePath=explode("?????", trim($row["T_DETAIL_PICTURE"], "?????"));
			$pru_pic_num=count($picturePath);
		}
		else
		{
			$pru_pic_num=$row["T_XIJIE_PIC"];
			for ($i=0; $i<$pru_pic_num; $i++ )
			{
				$picturePath[$i]=($i+1)."_o.jpg";
			}
		}
		
		if (empty($pru_size)==true)
			if ($row["T_STYLE_MEN"]==2)
				$pru_size="26_27_28_29_30_31";
			else 
				$pru_size="30_32_34_36_38_40_42";
		
		if (empty($pru_color)==true)
			$pru_color="pls view the pic, all of the pic taken by actual";
	}
?>
<table width="0" border="0" align="center" class="none">
  <tr>
    <td height="58" align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="none">
      <tr>
        <td align="center">
          <img src="http://<?php echo GetCurrentWebHost();  ?>/images/pru/<?php
			  if ($row["Version"]==1)
			  {
				$strID=Split("-", $pru_id);
				echo $strID[0]."/".$strID[1]."/";
			  }
			  else 
				echo $pru_id."/";
			  ?>/<?php echo $picturePath[0];?>" border="0" id="artshow">
         </td>
      </tr>
      <tr>
        <td align="center"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="none">
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><font color="#808080" face="Trebuchet MS" style="font-size: 9pt">ID: <?php echo $pru_id;?></font></td>
          </tr>
          <tr>
            <td align="left"><font face="Trebuchet MS" style="font-size: 9pt" color="#808080">Brand:<?php echo $pru_brand;?></font></td>
          </tr>
          <tr>
            <td align="left"><font face="Trebuchet MS" style="font-size: 9pt" color="#808080">Size: <?php echo $pru_size;?></font></td>
          </tr>
          <tr>
            <td align="left"><font face="Trebuchet MS" style="font-size: 9pt" color="#808080">Color: <?php echo $pru_color;?></font></td>
          </tr>
          <?php
				if ($row["T_STYLE_MEN"]==0 ||  $row["T_STYLE_MEN"]==1 || $row["T_STYLE_MEN"]==2  )
				{
				?>
          <tr>
            <td align="left"><font face="Trebuchet MS" style="font-size: 9pt" color="#808080">Style: <?php echo $pru_style;?></font></td>
          </tr>
          <?php
				}
				?>
          <tr>
            <td align="left"><font face="Trebuchet MS" style="font-size: 9pt" color="#808080">Raw meterial: <?php echo $pru_meterial;?></font></td>
          </tr>
          <?php
					if (empty($pru_key_word)==false)
					{
				?>
          <tr>
            <td align="left"><font color="#006633" face="Trebuchet MS" style="font-size: 9pt"><b>Other:</b></font></td>
          </tr>
          <?php
					}
				?>
          <?php 
				if (false)
					;
				else
				{
				?>
          <tr>
            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="none">
              <tr>
                <td><font color="#808080" face="Trebuchet MS" style="font-size: 9pt">EMS shipping cost:</font></td>
              </tr>
              <tr>
                <td><font color="#808080" face="Trebuchet MS" style="font-size: 9pt"> all of them are brand new with tags.<br>
                  you can tell me the id and size you would like. thanks.<br>
                  if you have any questions, pls let me know. i'll reply you asap.<br>
                  payment: <font color="#660033" face="Trebuchet MS" style="font-size: 9pt"><b>western union or moneygram and paypal(add 5% paypal fee)</b></font>.</font></td>
              </tr>
            </table></td>
          </tr>
          <?php
				}
				?>
        </table></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><?php		
		for ($j=1; $j<$pru_pic_num; $j++)
		{
		?><table width="660" border="0" class="none">
          <tr>
            <td align="center"><img src="http://<?php echo GetCurrentWebHost();  ?>/images/pru/<?php
			  if ($row["Version"]==1)
			  {
				$strID=Split("-", $pru_id);
				echo $strID[0]."/".$strID[1]."/";
			  }
			  else 
				echo $pru_id."/";
			  ?>/<?php echo $picturePath[$j];?>" border="0"></td>
          </tr>
          <tr>
            <td height="20" align="center"></td>
          </tr>
        </table><?php
		}
		?>
		<font style="font-size: 1pt" color="#FFFFFF">
		<?PHP
		for ($i=0; $i<500; $i++)
		{
			echo " wholesale $pru_brand $pru_class $pru_key_word";
		}
		?></font></td>
      </tr>
      
    </table></td>
  </tr>
</table>
