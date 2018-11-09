<?php
$thisPage=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF'])-strrpos($_SERVER['PHP_SELF'], '/')-1);

$nStep=$_GET["step"];
$strSearchWord=$_GET["keyWord"];
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="9%"><div id="tabs5" style="width:300px">
                        <ul>
                                <!-- CSS Tabs -->
<li <?php
if ($thisPage=="index.php")
	echo " id=\"current\" ";
?>><a href="index.php"><span>Order List</span></a></li>
<li <?php
if ($thisPage=="creat_offer.php")
	echo " id=\"current\" ";
?>><a href="creat_offer.php?<?php echo "DATE=".$_GET["DATE"]."&"."SER=".$_GET["SER"];?>"><span>Create New Order</span></a></li>
                        </ul>
                </div></td>
    <td width="91%" align="left" valign="bottom"><form name="lrForm" id="lrForm" method="get" action="search.php" style="margin:0px;padding:0px">
      <input type="text" name="keyWord" value="<?php echo $strSearchWord; ?>"/>
      <select name="step">
        <option value="ALL" <?php if ($nStep+0==0) echo "selected=\"selected\""; ?>>All</option>
        <option value="1" <?php if ($nStep+0==1) echo "selected=\"selected\""; ?>>Waiting for payment</option>
        <option value="2" <?php if ($nStep+0==2) echo "selected=\"selected\""; ?>>Prepare item, got payment</option>
        <option value="3" <?php if ($nStep+0==3) echo "selected=\"selected\""; ?>>Sent out add number</option>
        <option value="4" <?php if ($nStep+0==4) echo "selected=\"selected\""; ?>>Wait for customer confirm</option>
        <option value="5" <?php if ($nStep+0==5) echo "selected=\"selected\""; ?>>Finished order</option>
                  </select>
      <input type="hidden" name="action" value="keyword" />
      <input type="submit" name="Submit2" value="Search" />
        </form></td>
  </tr>
  <tr bgcolor="#663366">
    <td height="2" colspan="2" bgcolor="#663366"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
