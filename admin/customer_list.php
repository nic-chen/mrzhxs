<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" colspan="5"><form id="form1" name="form1" method="get" action="">
      <input type="text" name="key" value="<?php echo $_GET["key"];?>"/>
      <input type="submit" name="Submit" value="̑搜索" />
        </form>    </td>
  </tr>
  <tr>
    <td width="20%" height="30" align="center" bgcolor="#999999">ID编号</td>
    <td width="20%" height="30" align="center" bgcolor="#999999">姓名</td>
    <td width="20%" height="30" align="center" bgcolor="#999999">省份</td>
    <td width="20%" align="center" bgcolor="#999999">地址</td>
    <td width="20%" height="30" align="center" bgcolor="#999999">到期时间</td>
  </tr>
  <?php
	include_once('settings.php');
	include_once(LIBPATH."lib.php");
	?>
  <?php
  $keyWord = trim($_GET["key"]);
  $sql = "select * from registercustomer where T_CUSTOMER_NAME like '%$keyWord%' or T_ADDRESS like '%$keyWord%' or T_PRIVINCE like '%$keyWord%' or T_MAIL like '%$keyWord%' or T_TEL_PHONE like '%$keyWord%' order by T_END_TIME  ";
  $SQL = new SQL;
  $result = $SQL->Query($sql);
  while($row=mysql_fetch_array($result))
  {
  ?>
  <tr>
    <td width="20%" height="30" align="center">&nbsp;<?php echo $row["T_ID"];?></td>
    <td width="20%" height="30" align="center">&nbsp;<?php echo $row["T_CUSTOMER_NAME"];?></td>
    <td width="20%" height="30" align="center">&nbsp;<?php echo $row["T_PRIVINCE"];?></td>
    <td width="20%" align="center">&nbsp;<?php echo $row["T_ADDRESS"];?></td>
    <td width="20%" height="30" align="center">&nbsp;<?php echo $row["T_END_TIME"];?></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>
