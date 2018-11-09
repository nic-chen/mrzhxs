<?php
require_once('settings.php');

/**
Get website's niki name.
*/
function GetWebNikiName()
{
	$SQL=new SQL;
	$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentWebHost()."' ;");
	//echo "select * from t_web_conn where T_URL='".GetCurrentWebHost()."' ;";
	
	if (empty($result))
	{
		return "";
	}
	else
	{
		$row=mysqli_fetch_array($result);
		return $row["T_NIKI_NAME"];
	}
}

/**
Get if show sell price
*/
function GetIfShowSellPrice()
{
	$SQL=new SQL;
	$result = $SQL->Query("select * from t_web_conn where T_URL='".GetCurrentWebHost()."' ;");
	//echo "select * from t_web_conn where T_URL='".GetCurrentWebHost()."' ;";
	
	if (empty($result))
	{
		return "";
	}
	else
	{
		$row=mysqli_fetch_array($result);
		return $row["T_IS_SHOW_PRICE"];
	}
}

function GetCurrentWebHost()
{
	$styleNum=$_SERVER['HTTP_HOST']."";
	if	(strtolower( substr($styleNum, 0, 4) )=="www.")
	{
		$styleNum=substr($styleNum, 4);
	}

	return $styleNum;
}



/**

[0]: T_URL

[1]: T_WEB_NAME

[2]: T_CREATE_TIME

[3]: T_YOUJU_IP_ADD

[4]: T_YOUJU_DUANKOU

[5]: T_WELCOME_TEXT

[6]: T_ORDER_SIGN_NAME

[7]: T_ORDER_SIGN_PWD

*/

function GetWebConfigDetailInfo(& $detailInfo)

{

	$SQL=new SQL;

	$result = $SQL->Query("select * from t_web_conn ");

	$nPruNum = mysqli_num_rows($result);

	if ($nPruNum==0)

	{

		$web_url="";

		$web_subject="";

		return false;

	}

	else

	{

		$row=mysqli_fetch_array($result);

		$detailInfo[0]=$row["T_URL"];

		$detailInfo[1]=$row["T_WEB_NAME"];

		$detailInfo[2]=$row["T_CREATE_TIME"];

		$detailInfo[3]=$row["T_YOUJU_IP_ADD"];

		$detailInfo[4]=$row["T_YOUJU_DUANKOU"];

		$detailInfo[5]=$row["T_WELCOME_TEXT"];

		$detailInfo[6]=$row["T_ORDER_SIGN_NAME"];

		$detailInfo[7]=$row["T_ORDER_SIGN_PWD"];

	}

	return true;

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

* ɸͼ (ȱ)

*

* @param ԭͼƬַ             $img_tempname

* @param ͼ         $max_width

* @param ͼ߶         $max_height

* @param ͼַ         $dst_url

* @return unknown

*/

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
		//echo $pruClass[$i-1]." ".$pruClassHot[$i-1]." <br>";
	}
	$nClassTotal=$i;
	
	
	
	for ($m=0; $m<$nClassTotal; $m++)
	{
		for ($n=$m+1; $n<$nClassTotal; $n++)
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
	
	//for ($m=0; $m<$nClassTotal; $m++)
	{
		//echo " $pruClass[$m]-->$pruClassHot[$m]<br>";
	}
	
	
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
?>