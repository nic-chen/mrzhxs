<?php
include_once("settings.php");
include_once(LIBPATH."Sql.php");
include(LIBPATH."/lib.php");

class WebConfig
{
	public  $webURL;			//web URL
	public  $webNAME;			//wen titel
	public  $webCREATE_TIME;	//web create time
	public  $webWELCOME_TEXT;	//web 公告栏
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
*设定现在的排列顺序是TIME 还是 DATE
*/
function SetItemOrderBy($OderBy)
{
	//$_COOKIE["WWWPINGOTREECOM_ORDERBY"]=$OderBy;
	setcookie("WWWPINGOTREECOM_ORDERBY", $OderBy, time()+24*3600, "/");
	echo "write order by info: ".$OderBy."<br>";
	return $OderBy;
}

/*
*获取现在的排列顺序是TIME 还是 DATE
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

//截取utf8字符串
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

                die('歉要洗图片!');        

        }

        $img_src=file_get_contents($img_tempname);

        $image=imagecreatefromstring($img_src);//酶梅图,员狻巴计?
        $width=imagesx($image);//取图 1

        $height=imagesy($image);//取图叨 2

        $x_ratio=$height/$width;//呖 2

        

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

        /*筛图*/

        $dst=imagecreatetruecolor($tn_width,$tn_height);//陆一色图

        imagecopyresampled($dst,$image,0,0,0,0,$tn_width,$tn_height,$width,$height);//夭图癫⒌小

        imagejpeg($dst,$dst_url,100);//JPEG式图募,100(,募)默为IJG默系值(约75) 

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

* 埽PHP图片水印 (水印支图片) 

*  

*      $groundImage    图片要水印图片只支GIF,JPG,PNG式 

*      $waterPos        水印位茫10状态0为位茫 

*                        1为司2为司校3为司遥 

*                        4为胁5为胁校6为胁遥 

*                        7为锥司8为锥司校9为锥司遥 

*      $waterImage        图片水印为水印图片只支GIF,JPG,PNG式 

*      $waterText        水印为为水印支ASCII耄?

*      $textFont        执小值为12345默为5 

*      $textColor        色值为十色值默为#FF0000(色) 

* 

* 注猓篠upport GD 2.0Support FreeTypeGIF ReadGIF CreateJPG PNG 

*      $waterImage  $waterText 貌要同时使茫选之一桑使 $waterImage 

*      $waterImage效时$waterString$stringFont$stringColor效 

*      水印图片募 $groundImage 一 

* 撸longware @ 2004-11-3 14:15:13 

*/ 

function imageWaterMark ( $groundImage , $waterPos = 0 , $waterImage = "" , $waterText = "" , $textFont = 5 , $textColor = "#FF0000" ) 

{ 

     $isWaterImage = FALSE ; 

     $formatMsg = "莶支指募式图片图片转为GIFJPGPNG式" ; 



     //取水印募 

     if(!empty( $waterImage ) && file_exists ( $waterImage )) 

    { 

         $isWaterImage = TRUE ; 

         $water_info = getimagesize ( $waterImage ); 

         $water_w     = $water_info [ 0 ]; //取水印图片目 

         $water_h     = $water_info [ 1 ]; //取水印图片母 



         switch( $water_info [ 2 ]) //取水印图片母式 

         { 

            case 1 : $water_im = imagecreatefromgif ( $waterImage );break; 

            case 2 : $water_im = imagecreatefromjpeg ( $waterImage );break; 

            case 3 : $water_im = imagecreatefrompng ( $waterImage );break; 

            default:die( $formatMsg ); 

        } 

    } 



     //取图片 

     if(!empty( $groundImage ) && file_exists ( $groundImage )) 

    { 

         $ground_info = getimagesize ( $groundImage ); 

         $ground_w     = $ground_info [ 0 ]; //取帽图片目 

         $ground_h     = $ground_info [ 1 ]; //取帽图片母 



         switch( $ground_info [ 2 ]) //取帽图片母式 

         { 

            case 1 : $ground_im = imagecreatefromgif ( $groundImage );break; 

            case 2 : $ground_im = imagecreatefromjpeg ( $groundImage );break; 

            case 3 : $ground_im = imagecreatefrompng ( $groundImage );break; 

            default:die( $formatMsg ); 

        } 

    } 

    else 

    { 

        die( "要水印图片冢" ); 

    } 



     //水印位 

     if( $isWaterImage ) //图片水印 

     { 

         $w = $water_w ; 

         $h = $water_h ; 

         $label = "图片" ; 

    } 

    else //水印 

     { 

         $temp = imagettfbbox ( ceil ( $textFont * 2.5 ), 0 , "./comicbd.ttf" , $waterText ); //取使 TrueType 谋姆围 

         $w = $temp [ 2 ] - $temp [ 6 ]; 

         $h = $temp [ 3 ] - $temp [ 7 ]; 

        unset( $temp ); 

         $label = "" ; 

    } 

    if( ( $ground_w < $w ) || ( $ground_h < $h ) ) 

    { 

        echo "要水印图片某然缺水印" . $label . "小薹水印" ; 

        return; 

    } 

    switch( $waterPos ) 

    { 

        case 0 : // 

             $posX = rand ( 0 ,( $ground_w - $w )); 

             $posY = rand ( 0 ,( $ground_h - $h )); 

            break; 

        case 1 : //1为司 

             $posX = 0 ; 

             $posY = 0 ; 

            break; 

        case 2 : //2为司 

             $posX = ( $ground_w - $w ) / 2 ; 

             $posY = 0 ; 

            break; 

        case 3 : //3为司 

             $posX = $ground_w - $w ; 

             $posY = 0 ; 

            break; 

        case 4 : //4为胁 

             $posX = 0 ; 

             $posY = ( $ground_h - $h ) / 2 ; 

            break; 

        case 5 : //5为胁 

             $posX = ( $ground_w - $w ) / 2 ; 

             $posY = ( $ground_h - $h ) / 2 ; 

            break; 

        case 6 : //6为胁 

             $posX = $ground_w - $w ; 

             $posY = ( $ground_h - $h ) / 2 ; 

            break; 

        case 7 : //7为锥司 

             $posX = 0 ; 

             $posY = $ground_h - $h ; 

            break; 

        case 8 : //8为锥司 

             $posX = ( $ground_w - $w ) / 2 ; 

             $posY = $ground_h - $h ; 

            break; 

        case 9 : //9为锥司 

             $posX = $ground_w - $w ; 

             $posY = $ground_h - $h ; 

            break; 

        default: // 

             $posX = rand ( 0 ,( $ground_w - $w )); 

             $posY = rand ( 0 ,( $ground_h - $h )); 

            break;     

    } 



     //瓒ㄍ寄簧Ｊ?

     imagealphablending ( $ground_im , true ); 



    if( $isWaterImage ) //图片水印 

     { 

         imagecopy ( $ground_im , $water_im , $posX , $posY , 0 , 0 , $water_w , $water_h ); //水印目募         

     } 

    else //水印 

     { 

        if( !empty( $textColor ) && ( strlen ( $textColor )== 7 ) ) 

        { 

             $R = hexdec ( substr ( $textColor , 1 , 2 )); 

             $G = hexdec ( substr ( $textColor , 3 , 2 )); 

             $B = hexdec ( substr ( $textColor , 5 )); 

        } 

        else 

        { 

            die( "水印色式确" ); 

        } 

         imagestring ( $ground_im , $textFont , $posX , $posY , $waterText , imagecolorallocate ( $ground_im , $R , $G , $B ));         

    } 



     //水印图片 

     @ unlink ( $groundImage ); 

    switch( $ground_info [ 2 ]) //取帽图片母式 

     { 

        case 1 : imagegif ( $ground_im , $groundImage );break; 

        case 2 : imagejpeg ( $ground_im , $groundImage );break; 

        case 3 : imagepng ( $ground_im , $groundImage );break; 

        default:die( $errorMsg ); 

    } 



     //头诖 

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