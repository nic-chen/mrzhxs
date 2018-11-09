<?php
//
include("geoip.php");
// open the geoip database
  $gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);

  //
  $country_code = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
  if ($country_code != "CN")
	exit;


include_once("settings.php");
include_once(LIBPATH."lib.php");
$webConfig = new WebConfig;
include(APPROOT."skin/".$webConfig->webOther->GetContectByName("Skin")."/index.php");
?>
