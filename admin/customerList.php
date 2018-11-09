<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
	include_once("../dbCfg.php");
	$result = mysqli_query("select * from t_web_conn ",$pingoDateBase);
	$nPruNum = mysqli_num_rows($result);
	if ($nPruNum==0)
	{
		$web_url="";
		$web_subject="";
	}
	else
	{
		$row=mysqli_fetch_array($result);
		$web_url=$row["T_URL"];
		$web_subject=$row["T_WEB_NAME"];
	}
?>
<form id="form1" name="form1" method="post" action="updateData.php?COM_ID=1001">
  <table width="600" border="1" cellspacing="1" cellpadding="1">
    <tr>
      <td width="142" align="right">注册邮箱：</td>
      <td width="445"><input type="text" name="web_url" value="<?php
	  echo $web_url;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">客户姓名：</td>
      <td><input type="text" name="UserName" value="<?php
	  echo $web_url;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">所在国家：</td>
      <td><input type="text" name="country" value="<?php
	  echo $web_url;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">客户地址：</td>
      <td><input type="text" name="address" value="<?php
	  echo $web_url;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">VIP等级：</td>
      <td><input type="text" name="web_url5" value="<?php
	  echo $web_url;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">注册时间：</td>
      <td><input type="text" name="web_url6" value="<?php
	  echo $web_url;
	  ?>" /></td>
    </tr>
    <tr>
      <td align="right">其他备注信息：</td>
      <td><input type="text" name="web_url7" value="<?php
	  echo $web_url;
	  ?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="Submit" value="提交" />
      &nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="Submit2" value="重置" /></td>
    </tr>
  </table>
</form>
</body>
</html>
