<?php
include_once("PubuserFun.php");
include_once("PubFun.php");


class PubPage
{
	function PubPage()
	{
		
	}
	
	/*
	the bottom turn page
	*/
	function BottomTurnPage($url, $nPruNum, $current_page, $nItemEachPage)
	{
			
			if ($current_page>1)
				$Pree=$current_page-1;
			else
				$Pree=1;
		
			if ($nPruNum % $nItemEachPage == 0)
				$pages = $nPruNum/$nItemEachPage;
			else
				$pages = ($nPruNum-$nPruNum%$nItemEachPage)/$nItemEachPage + 1;

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
            ?>
    <div class="page">
            <ul>
            <?php 
            if ($nStartPage>1)
            {
            ?>
    <li class="long"><a href="<?php echo $url."1"; ?>"><?php echo FIRST_PAGE;?></a></li>
            <?php 
            }
            if ($curPage>1)
            {
            ?>
    <li class="long"><a href="<?php echo $url.($curPage-1); ?>"><?php echo PRE_PAGE;?></a></li>
            <?php 
            }
    
            for($i=$nStartPage; $i<=$nEndPage; $i++)
            {
                if ($i==$curPage)
                    echo "<li>".$i."</li>";
                else
                {
            ?>
    <li><a href="<?php echo $url.$i;?>"><?php echo $i; ?></a></li>
            <?php 
                }
            }
            if ($curPage<$totalpages)
            {
            ?>
    <li class="long"><a  href="<?php echo $url.($curPage+1);?>"><?php echo NEXT_PAGE;?></a></li>
            <?php 
            }
            if ($nEndPage<$totalpages)
            {
            ?>
    <li class="long"><a href="<?php echo $url.$totalpages;?>"><?php echo END_PAGE;?></a></li>
            <?php 
            }
            ?>
            </ul>
    </div>
		<?php
	}
}



/*
*页面头
*/
function WriteHtmlHead()
{
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="12" background="<?php echo GetCurrentWebHost(); ?>/pub/board_left.bmp"></td>
    <td height="58" align="left" background="<?php echo GetCurrentWebHost(); ?>/pub/logo_head_back.bmp"><a href="top.php"><img src="<?php echo GetCurrentWebHost(); ?>/pub/logo.jpg" height="58" border="0"></a></td>
    <td width="12" align="left" background="<?php echo GetCurrentWebHost(); ?>/pub/board_right.bmp">&nbsp;</td>
  </tr>
</table>
<?php
}

/*
*页面尾
*/
function WriteHtmlEnd()
{
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#666666">
    <td height="10" colspan="3"></td>
  </tr>
  <tr>
    <td width="194" height="19"></td>
    <td width="390" align="center"><span class="small_black"> All Content Copyright ? 2006 <?php echo GetCurrentWebHost(); ?>, Inc.</span></td>
    <td width="190" align="right">Power by <a href="mailto:yuan-yuan@hotmail.com">Yuan-Yuan</a></td>
 </tr>
</table>
<?php
}

Function SearchBar($pageName)
{
	//echo GetItemOrderBy();
	
	?>
	<link rel="stylesheet" href="gmenu.css">
	<script type="text/javascript" src="gmenu.js"></script>
	<style type="text/css">
	 table.b{
	  border-color:#99CC33;
	  border-collapse:collapse;
	 }
	 .style16 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	}
	</style>
	<?php
	if (true==GetIsVipSignIn())  //'判断是否是超级用户'
	{?>
	<script type="text/javascript" src="vip_menu.js"></script>
	<?php
	}
	else
	{?>
	<script type="text/javascript" src="menu.js"></script>
	<?php
	}
	?>
	<script language="javascript">
	function WriteSortByType()
	{
		document.OderForm.submit();
	}
	</script>
		  <table width=100% align="center" border="1" class="b" bgcolor="#CCCCCC">
            <tr>
              <td><table border="0" width=100% class="b">
                  <tr bordercolorlight="#FFFFFF" bordercolordark="D9D9D9">
                    <td height="20" align="left" valign="bottom" class="style16">
					<form name="lrFrom" id="lrForm" action="search.php" method="get" onsubmit="return(OnSearch());" style="margin:0px;padding:0px">Search<input name="CLASSS" type="text" id="classs" size="30" maxlength=50 value="<?php echo Trim(Trim($_GET["CLASSS"])." ".Trim($_GET["T_CHILD"])." ".Trim($_GET["T_CLASS"]) ); ?>" />
                      <input type="radio" name="sex" value="2" <?php
					  if ($_GET["sex"]=="2") 
					  	echo "checked";
					  ?>/>women
<input type="radio" name="sex" value="1" <?php
					  if ($_GET["sex"]=="1") 
					  	echo "checked";
					  ?>/>men
<input name="sex" type="radio" value="0" <?php
					  if ($_GET["sex"]!="1" && $_GET["sex"]!="2")
					  	echo "checked";
					  ?>/>
all
<input name="Submit" type="submit" value="search" />
&nbsp; </form></td> 
                    <td align="right" valign="bottom" class="style16">
					<form id="OderForm" name="OderForm" action="<?php echo "updateOrderBy.php" ?>" method="get" style="margin:0px;padding:0px">
					<input type="hidden" id="T_CHILD" name="T_CHILD" value="<?php echo $_GET["T_CHILD"]; ?>"/>
                      <input type="hidden" id="T_CLASS" name="T_CLASS" value="<?php echo $_GET["T_CLASS"]; ?>"/>
                      <input type="hidden" id="ID" name="ID" value="<?php echo $_GET["ID"]; ?>"/>
					  <input type="hidden" id="CLASSS" name="CLASSS" value="<?php echo $_GET["CLASSS"]; ?>"/>
					  <input type="hidden" id="sex" name="sex" value="<?php echo $_GET["sex"]; ?>"/>
					  <input type="hidden" id="page" name="page" value="<?php echo $_GET["page"]; ?>"/>
					  <input type="hidden" id="Add" name="Add" value="<?php echo $pageName; ?>"/>
					  <input type="radio" name="OderBy" value="DATE" <?php
  if (GetItemOrderBy()=="DATE")
  	echo "checked";
  ?>  onclick="WriteSortByType()"/>Date
					  <input type="radio" name="OderBy" value="ViewTimes" <?php
  if (GetItemOrderBy()=="ViewTimes")
  	echo "checked";
  ?>  onclick="WriteSortByType()"/>Number of view
                      </form></td>
                  </tr>
              </table></td>
            </tr>
         </table>
	<?php
}

/*
*联系方式模块
*/
function ContactInfo()
{
?>
	<table border="1" width="180" id="table3" cellpadding="0" cellspacing="0" class="b">
	  <tr>
		<td><table border="0" width="175" id="table3" align="center">
		<?php
		$webContactInfo=GetWebContactInfo();
		//echo $webContactInfo;
		$webContactList=explode("\r", $webContactInfo);
		$nContactList=count($webContactList);
		for ($i=0; $i<$nContactList; $i++)
		{
			//echo $webContactList[$i];
			$mailList=explode("-->", $webContactList[$i]);
		?>
		  <tr>
			<td align="left" ><font color="#669900" style="font-size: 9pt" face="Trebuchet MS"><?php echo $mailList[0]; ?>:</font></td>
		  </tr>
		  <tr>
			<td align="left" ><font color="#669900" style="font-size: 9pt" face="Trebuchet MS"><?php echo $mailList[1]; ?></font></td>
		  </tr>
		<?php
		}
		?>  
		  <tr>
			<td align="center" ><a href="contact.php"><img src="<?php echo GetCurrentWebHost(); ?>/pub/LeaveMessage.jpg" border="0"/></a></td>
		  </tr>
		</table></td>
	  </tr>
</table>
<?php
}

/*
*显示右侧的内容
*/
function RightView($showSingIn)
{
	if ($showSingIn==true)
	{
		?>
		<script type="text/javascript">
		function CustomerSignInOut()
		{
			var str="";
			
			if(document.right_c_account.UserMail.value)
			{
				str = document.right_c_account.UserMail.value;
				var loc=str.indexOf("@");
				if (loc==-1)
				{
					alert("Please check your E-mail format!");
					return false;
				}
			}
			else
			{
				alert("Please input your E-Mail!");
				return false;
			}
			document.right_c_account.submit();
			return true;
		}
		</script><?php
	}
	?><br>
		<table width="180" height="73" border="1" cellpadding="0" cellspacing="0" class="b">
          <tr>
            <td height="44" align="center" valign="middle" ><div>
                <table width="180" height="30" border="0" cellpadding="0" cellspacing="0" bordercolor="#009999">
                  <tr>
                    <td align="left" bgcolor="#99CC00">&nbsp;<strong><font color="#FFFFFF" size="2">&nbsp;<?php echo GetWebNikiName();?><font></strong></td>
                  </tr>
              </table></td>
          </tr>
          <tr>
            <td height="140" align="center" valign="middle" bgcolor="F2F6E5"><table id="__01" width="180" height="90" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="100" align="left"  bgcolor="#F2F6E5"><table width="100%" height="100" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?php
				  echo GetWelcomeText();
				  ?></td>
  </tr>
</table>
</td>
                </tr>
              </table>
                <table width="100%" border="0" class="b">
                  <?
			if (GetIsCustomerSignIn() && $showSingIn==true)
			{
			  ?>
                  <form id="right_c_account" name="right_c_account" action="<?php echo "updateData.php?COM_ID=0006"; ?>" method="post" style="margin:0px;padding:0px">
                    
                    <tr>
                      <td width="71%" align="left">&nbsp;<b><a href="account_info.php?type=1">My account</a></b> 
                      <input name="do_Update" id="do_Update" type="hidden" value="true" /></td>
                      <td width="29%"><a style="cursor:hand" onclick='document.right_c_account.submit();'><img src="<?php echo GetCurrentWebHost(); ?>/pub_images/btn_logout_sm.gif" width="47" height="20" border="0" /></a></td>
                    </tr>
                  </form>
                  <?php
			}
			elseif ($showSingIn==true)
			{
			  ?>
                  <form id="right_c_account" name="right_c_account" action="updateData.php?COM_ID=0007" method="post" style="margin:0px;padding:0px">
                    <tr>
                      <td colspan="2" align="left"  bgcolor="#F2F6E5" ><font color="#669900" style="font-size: 9pt" face="Trebuchet MS">Mail: </font>
                          <input name="UserMail" type="text" id="UserMail" size="15" /></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left"  bgcolor="#F2F6E5"><font color="#669900" style="font-size: 9pt" face="Trebuchet MS">Pwd: </font>
                          <input name="userPwd" type="password" id="userPwd" size="15" /></td>
                    </tr>
                    <tr>
                      <td align="left"  bgcolor="#F2F6E5"><font color="#669900" style="font-size: 9pt" face="Trebuchet MS"><a href="account_info.php?type=4">Forget Password?</a></font></td>
                      <td bgcolor="#F2F6E5"><a style="cursor:hand" onclick='return CustomerSignInOut();' ><img src="<?php echo GetCurrentWebHost(); ?>/pub_images/btn_login_sm.gif" width="47" height="20" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center"  bgcolor="#F2F6E5"><font color="#669900" style="font-size: 9pt" face="Trebuchet MS"><a href="account_info.php?type=5">Register Free</a></font></td>
                    </tr>
                  </form>
                  <?php
			}
		?>
              </table></td>
          </tr>
        </table>
	<?
}

/*
*显示搜索到的内容
*/
Function headPic($ID, $brandName, $isMen, $TuiJianDu, $Version)
{
if (empty($ID)==true) 
	 return "";
?>
<style type="text/css">
<!--
.style1 {font-size: 12}
-->
</style>
<?php
if ($isMen==0 || $isMen==1)
{
?>
<table id="__01" width="257" height="217" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td colspan="3"> <img src="images/eeee_men_01.gif" width="257" height="21" alt=""></td>
			</tr>
			<tr>
			  <td> <img src="images/eeee_men_02.gif" width="21" height="145" alt=""></td>
			  <td width="216" height="145" align="center" valign="bottom" bgcolor="#ECEDE9"><a href="detail_pic.php?ID=<?php echo $ID; ?>"><img src="images/pru/<?php
			  if ($Version==1)
			  {
				$strTemppp=Split("-", $ID);
				echo trim($strTemppp[0])."/".trim($strTemppp[1]);
			  }
			  else 
			   echo Trim($ID);
			  ?>/head.jpg" border="1" style="border:2px solid #99CC00"></a></td>
			  <td> <img src="images/eeee_men_04.gif" width="20" height="145" alt=""></td>
			</tr>
			<tr>
			  <td colspan="3"> <img src="images/eeee_men_05.jpg" width="257" height="14" alt=""></td>
			</tr>
			<tr>
			  <td height="37" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="48" align="right"><a href="detail_pic.php?ID=<?php echo $ID; ?>" >Brand:</a></td>
                  <td colspan="3" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>" ><?php echo $brandName; ?></a>&nbsp;&nbsp;&nbsp;<?php 
				  getTuiJianDuHtml($TuiJianDu);
				  ?>&nbsp;</td>
                </tr>
                <tr>
                  <td width="48" align="right"><a href="detail_pic.php?ID=<?php echo $ID; ?>" >ID:</a></td>
                  <td width="122" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>" align="left"><?php echo $ID; ?></a></td>
                  <td width="34" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>" align="right"><?php echo GetStyleInfo($isMen); ?></a></td>
                  <td width="35" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>" ><img src="<?php echo GetCurrentWebHost(); ?>/pub_images/buy.gif" border="0"/></a></td>
                </tr>
              </table> </td>
			</tr>
</table>
<?php
}
else 
{
?>
<table id="__01" width="257" height="217" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="images/eeee_women_01.gif" width="257" height="21" alt="" /></td>
  </tr>
  <tr>
    <td><img src="images/eeee_women_02.gif" width="21" height="145" alt="" /></td>
    <td width="216" height="145" align="center" valign="bottom" bgcolor="#F5E8F6"><a href="detail_pic.php?ID=<?php echo $ID; ?>"><img src="images/pru/<?php
			  if ($Version==1)
			  {
				$strTemppp=Split("-", $ID);
				echo trim($strTemppp[0])."/".trim($strTemppp[1]);
			  }
			  else 
			  	echo Trim($ID);
			  ?>/head.jpg" border="1" style="border:2px solid #99CC00" /></a></td>
    <td><img src="images/eeee_women_04.gif" width="20" height="145" alt="" /></td>
  </tr>
  <tr>
    <td colspan="3"><img src="images/eeee_women_05.jpg" width="257" height="14" alt="" /></td>
  </tr>
  <tr>
    <td height="37" colspan="3"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="48" align="right"><a href="detail_pic.php?ID=<?php echo $ID; ?>" >Brand:</a></td>
        <td height="20" colspan="3" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>"><?php echo $brandName; ?></a>&nbsp;&nbsp;&nbsp;
              <?php
				  getTuiJianDuHtml(nTuiJianDu);
				  ?></td>
      </tr>
      <tr>
        <td width="48" align="right"><a href="detail_pic.php?ID=<?php echo $ID; ?>" >ID:</a></td>
        <td width="92" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>" align="left"><?php echo $ID; ?></a></td>
        <td width="64" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>" align="right"><?php echo GetStyleInfo($isMen); ?></a></td>
        <td width="35" align="left"><a href="detail_pic.php?ID=<?php echo $ID; ?>" ><img src="<?php echo GetCurrentWebHost(); ?>/pub_images/buy.gif" border="0"/></a></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php
}
}

function getTuiJianDuHtml($nTuiJianDu)
{
	if (is_int($nTuiJianDu))
		return ;
		
	//nTuiJianDu=CInt($nTuiJianDu)
	
	for ($i=nTuiJian; $i<$nTuiJian; $i=$i+1)
	{
		?>
<img src="pub_images/g.gif" width="11" height="11" alt="Recommend"/>
<?php
	}
}

function ClassList($classs)
{
	$sSql="select *, count(distinct T_CHILD) from pru where T_STATUS=0 and (T_CLASS='".$classs."')";
	if (GetIsCustomerSignIn())
		;
	else
		$sSql=$sSql." and IS_VIP=FALSE ";
	$sSql=$sSql." group by T_CHILD";

	include("dbCfg.php");
	$result_currect = mysqli_query($allDateBase, $sSql);
	if (mysqli_num_rows($result_currect)!=0)
	{
?>
<table width="160" border="1" align="left" class="b">
<?php
		while($row=mysqli_fetch_array($result_currect))
		{
		//echo "0001".$row["T_CHILD"];
?>
<tr>
  <td width="160" class="style48" align="left"><a style="cursor:hand" href="search.php?T_CHILD=<?php echo $row["T_CHILD"];?>&T_CLASS=<?php echo $row["T_CLASS"];?>"><?php echo $row["T_CHILD"];?></a></td>
</tr>
<?php
		}
?>
</table>
<?php
	}
}

function ShowOrerList()
{
	$strCookie=GetCustomerOrderList();
	if (empty($strCookie))
		echo " ";
	else
	{
		$strItemList=explode("=====",$strCookie);
		$nCount = count($strItemList);
		
		if ($nCount>=0)
		{
	?>
	</p>
	<script language=javascript> 
	function setshow(ID){ 
	
	var theObj=document.getElementById("boysoft_"+ID) ;
	if(theObj)
	{
		if (theObj.style.display=="none")
		{
			theObj.style.display="block";
			document.getElementById("Img_"+ID).setAttribute('src','<?php echo GetCurrentWebHost(); ?>/pub_images/da_ka.gif');
		}
		else
		{
			theObj.style.display="none";
			document.getElementById("Img_"+ID).setAttribute('src','<?php echo GetCurrentWebHost(); ?>/pub_images/bi_he.gif');
		}
	}
	
	} 
	</script> <table width="175"  border="0">
		<tr>
		<td bgcolor="#339900"><table width="100%" border="0" bgcolor="#F2F6E5">
		  <tr>
			<td align="right"><a href="orderInfo.php">View order list</a></td>
		  </tr>
		</table> 
	<?php 
		}
		
		for ($i=0; $i<($nCount+0); $i++)
		{
			if (empty($strItemList[$i]))
				;
			else
			{
				$strIDItem=explode(" ",$strItemList[$i]);
				$strItemCoolieSI=substr($strItemList[$i], strlen($strID[0])+1,strlen($strItemList[$i]));
	?>     
		  <table width="100%"  border="0" bgcolor="#F2F6E5">
			<tr>
			  <td height="1" colspan="2" align="left" bgcolor="#339900"></td>
			</tr>
			<tr>
			  <td width="524" height="19" align="left">ID: <a href="javascript:setshow(<?php echo "'".$strIDItem[0]."'"?>)"><?php echo $strIDItem[0];?></a></td>
			  <td width="399" height="19" align="right" valign="middle"><a href="javascript:setshow(<?php echo "'".$strIDItem[0]."'" ;?>)">&nbsp&nbsp<img src="<?php echo GetCurrentWebHost(); ?>/pub_images/bi_he.gif" border="0" id="<?php  echo "IMG_".$strIDItem[0]; ?>" />&nbsp&nbsp</a></td>
			</tr>
			<tr>
			  <td colspan="2" align="left"><div id=boysoft<?php echo "_".$strIDItem[0];?> style=" display: none;" ><table width="100%"  border="0" bgcolor="#F2F6E5">
				<tr>
				  <td width="80" height="15" align="left">Total:<a href="detail_pic.php?ID=<?php echo $strIDItem[0];?>"><?php echo GetOderAmoutBySize($strItemCoolieSI, "sum");?></a></td>
				  <td width="100" rowspan="2" align="right" valign="top"><a href="detail_pic.php?ID=<?php echo $strIDItem[0];?>"><img src="images/pru/<?php  
				include("dbCfg.php");
				$sSql="select * from pru where T_ID='".$strIDItem[0]."'";
				//echo $sSql;
				$result = mysqli_query($allDateBase, $sSql);
				$rstTemp=mysqli_fetch_array($result);
				if ($rstTemp["Version"]==1)
				{
					$strTemppp=explode("-", $strIDItem[0]);
					echo $strTemppp[0]."/".$strTemppp[1];
				}
				else 
					echo $strIDItem[0];
			   ?>/1_s.jpg" border="0" /></a></td>
				</tr>
				<tr>
				  <td align="left" valign="bottom"><a href="detail_pic.php?ID=<?php  echo $strIDItem[0];?>"><img src="<?php echo GetCurrentWebHost(); ?>/pub_images/change_it.gif" width="80" height="20" border="0" /></a></td>
				</tr>
			  </table></div></td>
			</tr>
		  </table>
	<?php 
			}
		}
		
		if ($nCount>=0)
		{
	?>
		  </td>
	  </tr>
	</table>
	<?php 
		}
	}
}

function ShowLeaveMsgOnItem($pru_id)
{
?>
<table width="90%" border="1" bgcolor="#F2F6E5">
		  <tr bgcolor="ABCE3C">
            <td width="12%" height="20" align="center"><span class="ViewLeaveMsgSubject">Nickname</span></td>
            <td width="69%" height="20" align="center"><span class="ViewLeaveMsgSubject">Message</span></td>
            <td width="19%" height="20" align="center"><span class="ViewLeaveMsgSubject">TIME</span></td>
          </tr>
          <?php
		  include_once("PubFun.php");
		  $sSql="select * from customerleavemsg where T_PRU_ID='$pru_id' and T_URL='".GetCurrentWebHost()."' order by T_TIME ASC ";
		  //echo "<br>$sSql<br>";
		  include("dbCfg.php");
		  $result = mysqli_query($sSql, $pingoDateBase);
		  while($row=mysqli_fetch_array($result))
		  {
		  ?>
		  <tr <?php
		  	if ($row["T_ROLE"]==1)
				echo " bgcolor=\"#FFFFFF\"";
		  ?>>
            <td width="12%" align="right" valign="top"><?php echo $row["T_CUSTOMER_NIKI_NAME"].":";  ?></td>
            <td width="69%" align="left" valign="bottom"><span class="ViewLeaveMsgSubject"><?php echo str_replace("\r\n", "<br>",$row["T_MSG"]);?> </span></td>
            <td width="19%" align="center" valign="top"><span class="ViewLeaveMsgTime"><?php echo date("Y-m-d H:i:s", strtotime($row["T_TIME"])); ?></span></td>
          </tr>
          <?php
		  }
		  ?>
</table>
<?php
}
?>
