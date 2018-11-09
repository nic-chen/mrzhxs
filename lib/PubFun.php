<?php
include_once("settings.php");
include_once(LIBPATH."Sql.php");
include(LIBPATH."/lib.php");

class WebConfig
{
	public  $webURL;			//web URL
	public  $webNAME;			//wen titel
	public  $webCREATE_TIME;	//web create time
	public  $webWELCOME_TEXT;	//web ������
	public  $webCONTACT_INFO;	//contact infomation
	public  $webNIKI_NAME;		//
	public  $webPAYPAL_ACCOUNT;	//paypal account
	public  $webIS_SHOW_PRICE;	//is show sell price on website.
	public  $webOther;
	
	var $errorString;		//error infomation
	function WebConfig() 
	{
		$SQL=new SQL;
		$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentMainWebName()."';");
		
		if ($row=mysqli_fetch_array($result))
		{
			$this->webURL=$row["T_URL"];
			$this->webNAME=$row["T_WEB_NAME"];
			$this->webCREATE_TIME=$row["T_CREATE_TIME"];
			$this->webWELCOME_TEXT=$row["T_WELCOME_TEXT"];
			$this->webCONTACT_INFO=$row["T_CONTACT_INFO"];
			$this->webPAYPAL_ACCOUNT=$row["T_PAYPAL_ACCOUNT"];
			$this->webIS_SHOW_PRICE=$row["T_IS_SHOW_PRICE"];
			$this->webOther=new strList($row["T_OTHER"]);
		}
	}
	
	function GetOderAmoutBySize($itemDetailList, $sizeInfo)
	{
	//echo "sizeInfoCookie=".$sizeInfoCookie." sizeInfo=".$sizeInfo."<br>";
		if (empty($sizeInfoCookie) || empty($sizeInfo))
			return ;
		
		
		$sizeDetailList=explode("_", $sizeInfoCookie);
		for ($ii=0; $ii<count($sizeDetailList); $ii++)
		{
			$detailInfo=explode("*",$sizeDetailList[$ii]);
			if ($detailInfo[0]==$sizeInfo)
				return $detailInfo[1];
		}
		return "0";
	}
	
	/**
	update webconfig detail info.
	*/
	function SetWebConfigDetailInfo($web_url, $web_page_subject, $web_NikiName, $web_ContactInfo,$web_welcome_text, $web_home, $web_paypal, $web_show_sell_price)
	{
		$sSql="";
		$SQL=new SQL;
		$sSql="select * from t_web_conn;";
		$errorInfo+=$sSql."<br>";
	
		$result = $SQL->Query($sSql);
		$nPruNum = mysqli_num_rows($result);
		if ($nPruNum==0)
		{	
			$sSql="INSERT INTO t_web_conn (T_WEB_NAME, T_NIKI_NAME, T_CONTACT_INFO, T_WELCOME_TEXT, T_URL, T_WEB_HOME, T_PAYPAL_ACCOUNT, T_IS_SHOW_PRICE) VALUES('$web_page_subject', '$web_NikiName', '$web_ContactInfo', '$web_welcome_text', '".GetCurrentWebHost()."', '$web_home', '$web_paypal', $web_show_sell_price)";
			$SQL->Query($sSql);
		}
		else
		{
			$sSql="update t_web_conn set T_WEB_NAME='".$web_page_subject."', T_NIKI_NAME='".$web_NikiName."', T_CONTACT_INFO='".$web_ContactInfo."', T_WELCOME_TEXT='$web_welcome_text', T_WEB_HOME='$web_home', T_PAYPAL_ACCOUNT='$web_paypal', T_IS_SHOW_PRICE=$web_show_sell_price where T_URL='".GetCurrentWebHost()."';";
			$SQL->Query($sSql);
		}
		return true;
	}
}

class strList
{
	var $strString;
	var $strSplit;
	var $nTotal;
	var $nName;
	var $nIndex;
	
	var $strNameList;
	var $strValueList;
	
	var $errorString;
	
	function strList($str)
	{
		$this->strString=$str;
		$this->strSplit=explode("#*#*#", $this->strString);
		$this->nTotal=count($this->strSplit);
		
		$this->strNameList=array();
		$this->strValueList=array();
		for ($i=0; $i<$this->nTotal; $i++)
		{
			if ( strlen($this->strSplit[$i])<5 )
				continue;
			$listTmp = explode ('##*##', $this->strSplit[$i]);
			$this->strNameList[$i] = $listTmp[0];
			$this->strValueList[$i] = $listTmp[1];
			//echo $this->strNameList[$i].", ".$this->strValueList[$i];
		}
		//$this->nTotal=$i;
		//echo $this->nTotal."]";
	}
	
	function GetContectByName($strName)
	{
		for ($i=0; $i<$this->nTotal; $i++)
		{
			//echo "[".$this->strNameList[$i]." ".$this->strValueList[$i];
			if ($strName==$this->strNameList[$i])
				return $this->strValueList[$i];
		}
		$this->errorString="Dont find the value by name[$strName]";
		return "";
	}
}

/*
*�趨���ڵ�����˳����TIME ���� DATE
*/
function SetItemOrderBy($OderBy)
{
	//$_COOKIE["WWWPINGOTREECOM_ORDERBY"]=$OderBy;
	setcookie("WWWPINGOTREECOM_ORDERBY", $OderBy, time()+24*3600, "/");
	echo "write order by info: ".$OderBy."<br>";
	return $OderBy;
}

/*
*��ȡ���ڵ�����˳����TIME ���� DATE
*/
function GetItemOrderBy()
{
	if  (true==empty($_GET["OderBy"]) )
	{
		if (true==empty($_COOKIE["WWWPINGOTREECOM_ORDERBY"]) )
			return "DATE";
		else
			return $_COOKIE["WWWPINGOTREECOM_ORDERBY"];
	}
	else
		return $_GET["OderBy"];
}

function wordscut($string, $length) 
{
	if(strlen($string) >= $length) 
	{
		for($i = 0; $i < $length - 3; $i++) 
		{
			if(ord($string[$i]) > 127) 
			{
				$wordscut .= $string[$i].$string[$i + 1].$string[$i + 2];
				$i+=2;
			} 
			else 
			{
				$wordscut .= $string[$i];
			}
		}
		return $wordscut.' ...';
	}
	return $string;
}

//��ȡutf8�ַ���
function utf8Substr($str, $from, $len)
{
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
							   '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
							   '$1',$str);
}


function GetCurrentWebHost()
{
	$styleNum=$_SERVER['HTTP_HOST']."";
	if	(strtolower( substr($styleNum, 0, 4) )=="www.")
	{
		$styleNum=substr($styleNum, 4);
	}
	return $styleNum."";
}

function GetCurrentMainWebName()
{
	$CurrentWebURL=GetCurrentWebHost()."";
	$webName = "";
	$webNameList = explode(".", $CurrentWebURL);
	$nCount = count($webNameList);

		for ($i=$nCount-2; $i<$nCount; $i++)
		{
			if (strlen($webName)==0)
				$webName = $webName.$webNameList[$i];
			else
				$webName = $webName.".".$webNameList[$i];
		}

	return $webName."";
}

function GetCurrentSubWebName()
{
	$CurrentWebURL=GetCurrentWebHost()."";
	$webName = "";
	$webNameList = explode(".", $CurrentWebURL);
	$nCount = count($webNameList);
	if ($nCount>2)
	{
		for ($i=0; $i<$nCount-2; $i++)
		{
			if (strlen($webName)>0)
				$webName = $webName.".".$webNameList[$i];
			else
				$webName = $webNameList[$i];
		}
	}
	return $webName."";
}

function GetCurrentWebHostPath()
{
	$styleNum=GetCurrentWebHost();
	$styleNum=str_replace(":", "", $styleNum);
	return $styleNum."";
}

function UpdateWebMenu()
{
	$nClassTotal=0;
	$nPruTotal=0;
	$nMenuStart=100;
	
	$file = '../menu_class.js';
	if (file_exists($file) == true) {
         unlink ($file);
	}
	
	$SQL=new SQL;
	$result = $SQL->Query("SELECT DISTINCT T_CLASS FROM pru ");
	$i=0; $pruClass=array();$pruClassHot=array();
	while($row=mysqli_fetch_array($result))
	{
		$pruClass[$i]=$row["T_CLASS"];
		
		$resultCur=$SQL->Query("SELECT * FROM pru where T_CLASS='".$row["T_CLASS"]."' order by T_HOT DESC LIMIT 0,1");
		$rowCur=mysqli_fetch_array($resultCur);
		$pruClassHot[$i]=$rowCur["T_HOT"];
		$i++;
		echo $pruClass[$i-1]." ".$pruClassHot[$i-1]." <br>";
	}
	$nClassTotal=$i;
	
	
	
	for ($m=0; $m<$nClassTotal; $m++)
	{
		for ($n=1; $n<$nClassTotal-$m; $n++)
		{
		//echo "$m $n $pruClassHot[$n]>$pruClassHot[$m]<br>";
			if ($pruClassHot[$n]>$pruClassHot[$n-1])
			{
				$temp=$pruClassHot[$n];
				$pruClassHot[$n]=$pruClassHot[$n-1];
				$pruClassHot[$n-1]=$temp;
				
				$temp=$pruClass[$n];
				$pruClass[$n]=$pruClass[$n-1];
				$pruClass[$n-1]=$temp;
			}
		//echo "$m $n $pruClassHot[$n]>$pruClassHot[$m]<br><br>";
		}
	}
	
	for ($m=0; $m<$nClassTotal; $m++)
	{
		//echo " $pruClass[$m]-->$pruClassHot[$m]<br>";
	}
	//die("<er>end;");
	
	$f = fopen($file, 'w');
	
	fwrite($f, " var stop;\r\n var stopsub; \r\n var curmenu;\r\n var submenu;\r\n var thousands_start=$nMenuStart;\r\n var menuwidth=200; \r\n var menuheight=50;\r\n var menu = new Menu();\r\n");
	for ($m=0; $m<$i; $m++)
	{
		$data="menu.addItem('$pruClass[$m]','?p=search&CLASSS=$pruClass[$m]');\r\n";
		fwrite($f, $data);
		
		$SQL=new SQL;
		$result = $SQL->Query("SELECT DISTINCT T_CHILD FROM pru where T_CLASS='$pruClass[$m]' ORDER BY T_CHILD");
		$bFirst=true;
		while($row=mysqli_fetch_array($result))
		{
			if ($bFirst)
			{
				$bFirst=false;
				fwrite($f, "menu.addsubmenu();\r\n");
			}
			
			$data="menu.addsubmenuitem('".$row["T_CHILD"]."','?p=search&T_CHILD=".$row["T_CHILD"]."&T_CLASS=$pruClass[$m]');\r\n";
			fwrite($f, $data);
			$data="menu.addlevel2menu();\r\n";
			fwrite($f, $data);
			$SQL=new SQL;
			$resultTmp = $SQL->Query("SELECT * FROM pru where T_CLASS='$pruClass[$m]' and T_CHILD='".$row["T_CHILD"]."' and T_STYLE_MEN=2 limit 0,1");
			if (mysqli_fetch_array($resultTmp))
			{
				$data="menu.addlevel2menuitem('Women style','?p=search&T_CHILD=".$row["T_CHILD"]."&T_CLASS=$pruClass[$m]&sex=2');\r\n";
				fwrite($f, $data);
			}
			$resultTmp = $SQL->Query("SELECT * FROM pru where T_CLASS='$pruClass[$m]' and T_CHILD='".$row["T_CHILD"]."' and T_STYLE_MEN=1 limit 0,1");
			if (mysqli_fetch_array($resultTmp))
			{
				$data="menu.addlevel2menuitem('Men style','?p=search&T_CHILD=".$row["T_CHILD"]."&T_CLASS=$pruClass[$m]&sex=1');\r\n";
				fwrite($f, $data);
			}
			$resultTmp = $SQL->Query("SELECT * FROM pru where T_CLASS='$pruClass[$m]' and T_CHILD='".$row["T_CHILD"]."' and T_STYLE_MEN=0 limit 0,1");
			if (mysqli_fetch_array($resultTmp))
			{
				$data="menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=".$row["T_CHILD"]."&T_CLASS=$pruClass[$m]&sex=0');\r\n";
				fwrite($f, $data);
			}
		}
		fwrite($f, "\r\n");
	}
	
	fwrite($f, "menu.showMenu();");
	
	fclose($f);
	
	$file = '../menu_brand.js';
	if (file_exists($file) == true) {
         unlink ($file);
	}
	
	$SQL=new SQL;
	$result = $SQL->Query("SELECT DISTINCT T_CHILD FROM pru ");
	$i=0; $pruChild=array();$pruChildHot=array();
	while($row=mysqli_fetch_array($result))
	{
		$pruChild[$i]=$row["T_CHILD"];
		
		$resultCur=$SQL->Query("SELECT * FROM pru where T_CHILD='".$row["T_CHILD"]."' order by T_HOT desc limit 0,1");
		$rowCur=mysqli_fetch_array($resultCur);
		$pruChildHot[$i]=$rowCur["T_HOT"];
		$i++;
	}
	
	$nPruTotal=$i;
	
	for ($m=0; $m<$nPruTotal; $m++)
	{
		for ($n=1; $n<$nPruTotal; $n++)
		{
		//echo "$m $n $pruChildHot[$n]>$pruChildHot[$m]<br>";
			if ($pruChildHot[$n]>$pruChildHot[$n-1])
			{
				$temp=$pruChildHot[$n];
				$pruChildHot[$n]=$pruChildHot[$n-1];
				$pruChildHot[$n-1]=$temp;
				
				$temp=$pruChild[$n];
				$pruChild[$n]=$pruChild[$n-1];
				$pruChild[$n-1]=$temp;
			}
		//echo "$m $n $pruChildHot[$n]>$pruChildHot[$m]<br><br>";
		}
	}
	for ($m=0; $m<$nPruTotal; $m++)
	{
		//echo " $pruChild[$m]-->$pruChildHot[$m]<br>";
	}
	
	$f = fopen($file, 'w');
	
	fwrite($f, " var stop;\r\n var stopsub; \r\n var curmenu;\r\n var submenu;\r\n var thousands_start=$nClassTotal+$nMenuStart;\r\n var menuwidth=200; \r\n var menuheight=50;\r\n var menu = new Menu();\r\n");
	for ($m=0; $m<$nPruTotal; $m++)
	{
		$data="menu.addItem('$pruChild[$m]','?p=search&CLASSS=$pruChild[$m]');\r\n";
		fwrite($f, $data);
		
		$SQL=new SQL;
		$result = $SQL->Query("SELECT DISTINCT T_CLASS FROM pru where T_CHILD='$pruChild[$m]' ORDER BY T_CLASS");
		$bFirst=true;
		while($row=mysqli_fetch_array($result))
		{
			if ($bFirst)
			{
				$bFirst=false;
				fwrite($f, "menu.addsubmenu();\r\n");
			}
			
			$data="menu.addsubmenuitem('".$row["T_CLASS"]."','?p=search&T_CHILD=$pruChild[$m]&T_CLASS=".$row["T_CLASS"]."');\r\n";
			fwrite($f, $data);
			$data="menu.addlevel2menu();\r\n";
			fwrite($f, $data);
			$resultTmp = $SQL->Query("SELECT * FROM pru where T_CHILD='$pruChild[$m]' and T_CLASS='".$row["T_CLASS"]."' and T_STYLE_MEN=2 limit 0,1");
			if (mysqli_fetch_array($resultTmp))
			{
				$data="menu.addlevel2menuitem('Women style','?p=search&T_CHILD=$pruChild[$m]&T_CLASS=".$row["T_CLASS"]."&sex=2');\r\n";
				fwrite($f, $data);
			}
			$resultTmp = $SQL->Query("SELECT * FROM pru where T_CHILD='$pruChild[$m]' and T_CLASS='".$row["T_CLASS"]."' and T_STYLE_MEN=1 limit 0,1");
			if (mysqli_fetch_array($resultTmp))
			{
				$data="menu.addlevel2menuitem('Men style','?p=search&T_CHILD=$pruChild[$m]&T_CLASS=".$row["T_CLASS"]."&sex=1');\r\n";
				fwrite($f, $data);
			}
			$resultTmp = $SQL->Query("SELECT * FROM pru where T_CHILD='$pruChild[$m]' and T_CLASS='".$row["T_CLASS"]."' and T_STYLE_MEN=0 limit 0,1");
			if (mysqli_fetch_array($resultTmp))
			{
				$data="menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=$pruChild[$m]&T_CLASS=".$row["T_CLASS"]."&sex=0');\r\n";
				fwrite($f, $data);
			}
		}
		fwrite($f, "\r\n");
	}
	
	fwrite($f, "menu.showMenu();");
	
	fclose($f);

}

/**
get item file path
return /images/pru/AF/001/
*/
function GetItemPathInfo($pru_id, $pru_version=NULL)
{
	$itemPath="images/pru/";
	
	if (strlen($pru_version."")>0)
	{
		 if ($pru_version==1)
		 {
			$strTemppp=Split("-", $pru_id);
			$itemPath=$itemPath.trim($strTemppp[0])."/".trim($strTemppp[1])."/";
		 }
		 else 
		 	$itemPath=$itemPath.Trim($pru_id)."/";
	}
	else
	{
		$SQL=new SQL;
		$sSql="select * from pru where T_ID='$pru_id'";
		$result = $SQL->Query($sSql);
		if ($row=mysqli_fetch_array($result))
		{
			if ($row["Version"]==1)
			{
				$strTemppp=Split("-", $pru_id);
				$itemPath=$itemPath.trim($strTemppp[0])."/".trim($strTemppp[1])."/";
			}
			else 
				$itemPath=$itemPath.Trim($pru_id)."/";
		}
		else
			return "false";
	}
	
	return $itemPath;
}

function deldir($dir) 
{
//  if (substr($dir, strlen($dir)-1, 1)=="/")
//  	$dir=substr($dir, 0, strlen($dir)-1);
  if (file_exists($dir))
  {
	  $dh=opendir($dir);
	  while ($file=readdir($dh)) 
	  {
		if($file!="." && $file!="..") 
		{
		  $fullpath=$dir."/".$file;
		  if(!is_dir($fullpath)) 
			  unlink($fullpath);
		  else
			  deldir($fullpath);
		}
	  }
	
	  closedir($dh);
	  
	  if(rmdir($dir))
		return true;
	  else
		return false;
  }
}

/**
GetLastRemindMailDate
*/
function GetLastRemindMailDate()
{
	$SQL=new SQL;
	//die("select * from t_web_conn where T_URL='".GetCurrentWebHost()."' ;");
	$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentWebHost()."' ;");
	
	$nPruNum = mysqli_num_rows($result);
	if ($nPruNum==0)
	{
		return "";
	}
	else
	{
		$row=mysqli_fetch_array($result);
		return $row["T_TELL_ADMIN_FOR_NEW"];
	}
}

/**
SaveDateOfWebsite
*/
function SaveDateOfWebsite($strTime)
{
	$SQL=new SQL;
	exec("mysqldump -u$dateBaseUser -c -p$dateBasePwd --default-character-set=UTF8 $dateBaseName >./data_back/".$dateBaseName."_$strTime.sql");
	//die("mysqldump -u$dateBaseUser -c -p$dateBasePwd --default-character-set=UTF8 $dateBaseName >./data_back/".$dateBaseName."_$strTime.sql");
	return true;
}

/**
update pru size and stock status
*/
function updateProductAndStockStatus()
{
	$SQL=new SQL;
	//more than 7 days, update the item's size and stock status.
	$sSql="update `PRU` set T_STATUS=0, T_TEMP_SIZE='', T_LAST_CHANGE_TIME=0 WHERE `T_LAST_CHANGE_TIME`<now()-60*60*24*7  and (T_STATUS=1 OR LENGTH(T_TEMP_SIZE)>0)";
	$SQL->Query($sSql);
	return true;
}

function createDstImage($img_tempname,$max_width, $max_height, $dst_url)

{

        global $uploadpath,$id,$uploadtype;

        

		//echo "img_tempname=$img_tempname<br>";

        if (!file_exists($img_tempname)) 

        {

                die('ǸҪϴͼƬ!');        

        }

        $img_src=file_get_contents($img_tempname);

        $image=imagecreatefromstring($img_src);//ø÷ͼ,Ա⡰ͼƬ�?
        $width=imagesx($image);//ȡͼ 1

        $height=imagesy($image);//ȡͼ߶ 2

        $x_ratio=$height/$width;//߿ 2

        

        if ($width<=$max_width && $height<=$max_height) 

        {

                $tn_width=$width;

                $tn_height=$height;

        }

        else

        {

                $tn_width=$max_width; 

                $tn_height=$x_ratio*$tn_width;

					

					if ($tn_width<=$max_width && $tn_height<=$max_height) 

						;

					else

					{

						$tn_height=$max_height;

						$tn_width=$tn_height/$x_ratio;

					}

        }

        

			//echo "new size: $tn_width,$tn_height,$width,$height,$x_ratio ";

        /*ɸͼ*/

        $dst=imagecreatetruecolor($tn_width,$tn_height);//½һɫͼ

        imagecopyresampled($dst,$image,0,0,0,0,$tn_width,$tn_height,$width,$height);//زͼ񲢵С

        imagejpeg($dst,$dst_url,100);//JPEGʽͼļ,100(,ļ)ĬΪIJGĬϵֵ(Լ75) 

        imagedestroy($image);

        imagedestroy($dst);

        

        if (!file_exists($dst_url)) 

        {

                return false;        

        } else {

                return basename($dst_url);

        }

}

/* 

* ܣPHPͼƬˮӡ (ˮӡ֧ͼƬ) 

*  

*      $groundImage    ͼƬҪˮӡͼƬֻ֧GIF,JPG,PNGʽ 

*      $waterPos        ˮӡλã10״̬0Ϊλã 

*                        1Ϊ˾2Ϊ˾У3Ϊ˾ң 

*                        4Ϊв5ΪвУ6Ϊвң 

*                        7Ϊ׶˾8Ϊ׶˾У9Ϊ׶˾ң 

*      $waterImage        ͼƬˮӡΪˮӡͼƬֻ֧GIF,JPG,PNGʽ 

*      $waterText        ˮӡΪΪˮӡ֧ASCII룬֧�?

*      $textFont        ִСֵΪ12345ĬΪ5 

*      $textColor        ɫֵΪʮɫֵĬΪ#FF0000(ɫ) 

* 

* ע⣺Support GD 2.0Support FreeTypeGIF ReadGIF CreateJPG PNG 

*      $waterImage  $waterText òҪͬʱʹãѡ֮һɣʹ $waterImage 

*      $waterImageЧʱ$waterString$stringFont$stringColorЧ 

*      ˮӡͼƬļ $groundImage һ 

* ߣlongware @ 2004-11-3 14:15:13 

*/ 

function imageWaterMark ( $groundImage , $waterPos = 0 , $waterImage = "" , $waterText = "" , $textFont = 5 , $textColor = "#FF0000" ) 

{ 

     $isWaterImage = FALSE ; 

     $formatMsg = "ݲָ֧ļʽͼƬͼƬתΪGIFJPGPNGʽ" ; 



     //ȡˮӡļ 

     if(!empty( $waterImage ) && file_exists ( $waterImage )) 

    { 

         $isWaterImage = TRUE ; 

         $water_info = getimagesize ( $waterImage ); 

         $water_w     = $water_info [ 0 ]; //ȡˮӡͼƬĿ 

         $water_h     = $water_info [ 1 ]; //ȡˮӡͼƬĸ 



         switch( $water_info [ 2 ]) //ȡˮӡͼƬĸʽ 

         { 

            case 1 : $water_im = imagecreatefromgif ( $waterImage );break; 

            case 2 : $water_im = imagecreatefromjpeg ( $waterImage );break; 

            case 3 : $water_im = imagecreatefrompng ( $waterImage );break; 

            default:die( $formatMsg ); 

        } 

    } 



     //ȡͼƬ 

     if(!empty( $groundImage ) && file_exists ( $groundImage )) 

    { 

         $ground_info = getimagesize ( $groundImage ); 

         $ground_w     = $ground_info [ 0 ]; //ȡñͼƬĿ 

         $ground_h     = $ground_info [ 1 ]; //ȡñͼƬĸ 



         switch( $ground_info [ 2 ]) //ȡñͼƬĸʽ 

         { 

            case 1 : $ground_im = imagecreatefromgif ( $groundImage );break; 

            case 2 : $ground_im = imagecreatefromjpeg ( $groundImage );break; 

            case 3 : $ground_im = imagecreatefrompng ( $groundImage );break; 

            default:die( $formatMsg ); 

        } 

    } 

    else 

    { 

        die( "ҪˮӡͼƬڣ" ); 

    } 



     //ˮӡλ 

     if( $isWaterImage ) //ͼƬˮӡ 

     { 

         $w = $water_w ; 

         $h = $water_h ; 

         $label = "ͼƬ" ; 

    } 

    else //ˮӡ 

     { 

         $temp = imagettfbbox ( ceil ( $textFont * 2.5 ), 0 , "./comicbd.ttf" , $waterText ); //ȡʹ TrueType ıķΧ 

         $w = $temp [ 2 ] - $temp [ 6 ]; 

         $h = $temp [ 3 ] - $temp [ 7 ]; 

        unset( $temp ); 

         $label = "" ; 

    } 

    if( ( $ground_w < $w ) || ( $ground_h < $h ) ) 

    { 

        echo "ҪˮӡͼƬĳȻȱˮӡ" . $label . "С޷ˮӡ" ; 

        return; 

    } 

    switch( $waterPos ) 

    { 

        case 0 : // 

             $posX = rand ( 0 ,( $ground_w - $w )); 

             $posY = rand ( 0 ,( $ground_h - $h )); 

            break; 

        case 1 : //1Ϊ˾ 

             $posX = 0 ; 

             $posY = 0 ; 

            break; 

        case 2 : //2Ϊ˾ 

             $posX = ( $ground_w - $w ) / 2 ; 

             $posY = 0 ; 

            break; 

        case 3 : //3Ϊ˾ 

             $posX = $ground_w - $w ; 

             $posY = 0 ; 

            break; 

        case 4 : //4Ϊв 

             $posX = 0 ; 

             $posY = ( $ground_h - $h ) / 2 ; 

            break; 

        case 5 : //5Ϊв 

             $posX = ( $ground_w - $w ) / 2 ; 

             $posY = ( $ground_h - $h ) / 2 ; 

            break; 

        case 6 : //6Ϊв 

             $posX = $ground_w - $w ; 

             $posY = ( $ground_h - $h ) / 2 ; 

            break; 

        case 7 : //7Ϊ׶˾ 

             $posX = 0 ; 

             $posY = $ground_h - $h ; 

            break; 

        case 8 : //8Ϊ׶˾ 

             $posX = ( $ground_w - $w ) / 2 ; 

             $posY = $ground_h - $h ; 

            break; 

        case 9 : //9Ϊ׶˾ 

             $posX = $ground_w - $w ; 

             $posY = $ground_h - $h ; 

            break; 

        default: // 

             $posX = rand ( 0 ,( $ground_w - $w )); 

             $posY = rand ( 0 ,( $ground_h - $h )); 

            break;     

    } 



     //趨ͼĻɫģ�?

     imagealphablending ( $ground_im , true ); 



    if( $isWaterImage ) //ͼƬˮӡ 

     { 

         imagecopy ( $ground_im , $water_im , $posX , $posY , 0 , 0 , $water_w , $water_h ); //ˮӡĿļ         

     } 

    else //ˮӡ 

     { 

        if( !empty( $textColor ) && ( strlen ( $textColor )== 7 ) ) 

        { 

             $R = hexdec ( substr ( $textColor , 1 , 2 )); 

             $G = hexdec ( substr ( $textColor , 3 , 2 )); 

             $B = hexdec ( substr ( $textColor , 5 )); 

        } 

        else 

        { 

            die( "ˮӡɫʽȷ" ); 

        } 

         imagestring ( $ground_im , $textFont , $posX , $posY , $waterText , imagecolorallocate ( $ground_im , $R , $G , $B ));         

    } 



     //ˮӡͼƬ 

     @ unlink ( $groundImage ); 

    switch( $ground_info [ 2 ]) //ȡñͼƬĸʽ 

     { 

        case 1 : imagegif ( $ground_im , $groundImage );break; 

        case 2 : imagejpeg ( $ground_im , $groundImage );break; 

        case 3 : imagepng ( $ground_im , $groundImage );break; 

        default:die( $errorMsg ); 

    } 



     //ͷڴ 

     if(isset( $water_info )) unset( $water_info ); 

    if(isset( $water_im )) imagedestroy ( $water_im ); 

    unset( $ground_info ); 

     imagedestroy ( $ground_im ); 

} 

/**
SetLastRemindMailDate
*/
function SetLastRemindMailDate($strTime)
{
	$SQL=new SQL;
	$sSql="update t_web_conn set T_TELL_ADMIN_FOR_NEW='$strTime' where T_URL='".GetCurrentWebHost()."' ";
	$SQL->Query($sSql);
	return true;
}


?>