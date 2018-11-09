<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<style type="text/css">
<!--

body {
background-color: #FAFAFA;
}
.ItemManageHead {color: #FFFFFF}
-->
</style></head>
<body>
<?php
	include_once('settings.php');
	include_once(LIBPATH."lib.php");
	
	include("web_conn_menu.php");
	
	$SQL=new SQL;
	$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentWebHost()."'");
	$nPruNum = mysql_numrows($result);
	if ($nPruNum==0)
	{
		$web_url="";
		$web_subject="";
	}
	else
	{
		$row=mysql_fetch_array($result);
		$web_url=$row["T_URL"];
		$web_subject=$row["T_WEB_NAME"];
		$web_creat_time=$row["T_CREATE_TIME"];
		$web_NikiName=$row["T_NIKI_NAME"];
		$web_ContactInfo=$row["T_CONTACT_INFO"];
		$web_welcome_text=$row["T_WELCOME_TEXT"];		
		$web_home=$row["T_WEB_HOME"];
		$web_paypal=$row["T_PAYPAL_ACCOUNT"];
	}
?>
<script  type="text/javascript">
function ShowText(nID)
{
	if (document.getElementById("checkbox"+nID).checked)
	{
		if (document.getElementById("Type"+nID).value=="Other" || document.getElementById("Type"+nID).value=="URL"|| document.getElementById("Type"+nID).value=="Article")
		{
			document.getElementById("row"+nID).style.display=''; 
		}
	}
	else
		document.getElementById("row"+nID).style.display='none'; 
}
</script>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" align="left" bgcolor="#669B31">&nbsp;Web top nav</td>
    </tr>
    <tr>
      <td align="center"><table width="100%"  border="0" bgcolor="#C2DC71" >
          <?php
	  include("../dbCfg.php");
	  $nNewArrivalTotal=20;
	  $result = mysql_query("select * from t_top_nav where T_URL='".GetCurrentWebHost()."' order by T_INDEX ASC, T_NAME",$allDateBase);
	  $nPos=-1;
      while($row=mysql_fetch_array($result))
	  {
	  	$nPos++;
	  	
	  ?>
      	<form id="form1" name="form1" method="post" action="updateData.php?COM_ID=1021" style="margin:0px; padding:0px;">
          <tr align="left">
            <td width="14%" height="26" align="right" valign="bottom"><?php echo NAV_BAR.FENGHAO?> [<?php printf("%02d", $nPos+1);?>]&nbsp;</td>
            <td width="63%" align="left" valign="bottom"><input type="text" name="Name" value="<?php echo $row["T_NAME"];?>"/>
              <?php echo ORDER.FENGHAO; ?>
              <input name="Order" value="<?php echo $row["T_INDEX"];?>" size="5" />
              <input name="checkbox<?php echo $nPos;?>" type="checkbox" id="checkbox<?php echo $nPos;?>" value="true" onclick="ShowText('<?php echo $nPos;?>')"/>
              <?php echo DO_EDIT;?> 
              <select name="Type" id="Type<?php echo $nPos;?>" onchange="ShowText('<?php echo $nPos;?>')">
              <?php
              $sSelected="selected=\"selected\"";
			  echo $row["T_TYPE"];
			  ?>
			  	<option value="Home" <?php if ($row["T_TYPE"]=="Home") echo $sSelected;?>><?php echo Home;?></option>
                <option value="cart" <?php if ($row["T_TYPE"]=="cart") echo $sSelected;?>><?php echo My_Cart;?></option>
                <option value="product" <?php if ($row["T_TYPE"]=="product") echo $sSelected;?>><?php echo Product;?></option>
                <option value="contact" <?php if ($row["T_TYPE"]=="contact") echo $sSelected;?>><?php echo Contact_US;?></option>
                
                <option value="URL" <?php if ($row["T_TYPE"]=="URL") echo $sSelected;?>><?php echo URL;?></option>
                <option value="Article" <?php if ($row["T_TYPE"]=="Article") echo $sSelected;?>><?php echo Article;?></option>
                <option value="Other" <?php if ($row["T_TYPE"]!="cart" && $row["T_TYPE"]!="product" && $row["T_TYPE"]!="contact" && $row["T_TYPE"]!="URL" && $row["T_TYPE"]!="Home" && $row["T_TYPE"]!="Article") echo $sSelected;?> ><?php echo Other;?></option>
              </select>
            <input type="hidden" name="ID" value="<?php echo $row["T_ID"];?>"/></td>
            <td width="23%" align="right" valign="bottom"><input type="submit" name="action" id="button" value="<?PHP echo DO_UPDATE;?>" onclick="this.value='Update';return true;"/>
            <input type="submit" name="action" id="button2" value="<?PHP echo DO_DELETE;?>"  onclick="this.value='Delete';return true;"/></td>
          </tr>
          <tr align="left" id="row<?php echo $nPos;?>" style="display:none;">
            <td width="14%" align="right">&nbsp;</td>
            <td colspan="2" align="left"><textarea name="Text" cols="70" rows="5"><?php echo $row["T_TEXT"];?></textarea></td>
          </tr>
          </form>
          <?php
      }
	  ?>
          <tr align="left">
            <td width="14%" align="right">&nbsp;</td>
            <td colspan="2" align="left">&nbsp;</td>
          </tr>
          <form id="form1" name="form1" method="post" action="updateData.php?COM_ID=1020">
          <tr align="left">
            <td width="14%" align="right" valign="bottom"><?php echo DO_NEW." ".NAV_BAR;?></td>
            <td colspan="2" align="left" valign="bottom"><input type="text" name="Name""/>
              <?php echo ORDER.FENGHAO; ?>
              <input name="Order" size="5" />
              <select name="Type"">
  <option value="cart" >My Cart</option>
  <option value="product">Product</option>
  <option value="contact">Contact US</option>
  <option value="URL">URL</option>
  <option value="Other" selected="selected">Other</option>
            </select></td>
          </tr>
          <tr align="left">
            <td width="14%" align="right">&nbsp;</td>
            <td colspan="2" align="left"><textarea name="Text" cols="70" rows="5"></textarea>
            <input name="Submit" type="submit" id="Submit" value="<?php echo DO_INSERT.DO_NEW.NAV_BAR?>" /></td>
          </tr>
          </form>
      </table></td>
    </tr>
  </table>


</body>

</html>

