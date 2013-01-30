<?php

require 'fb_helper.php';
require ("FbPage.php");

$url_fb_pauls_surfclub='https://graph.facebook.com/pauls.surfclub';

$aContext = array(
		'http' => array(
		'proxy' => 'tcp://icache:80',
		'request_fulluri' => true,
	),	
);
$cxContext = stream_context_create($aContext);


$fbPage = new FbPage($url_fb_pauls_surfclub, $cxContext);
$fbPage->getContents();

$fbusers = $fbPage->fbUsersThatLikeAlbums;
$fbUsersImg50x50Src= $fbPage->fbUsersImg50x50SrcThatLikeAlbums;
$fbUsersImg200pxWidthSrc= $fbPage->fbUsersImg200pxWidthSrcThatLikeAlbums;

$fbPage->getfbUsersImg50x50AsFileObj();

// foreach ($fbusers as $key => $value){
//   echo $key." -- ".$value."<br />";
  
// }

// foreach ($fbUsersImg50x50Src as $key => $value){
// // 	echo $key." -- ".$value."<br />";
// 	echo "<img src=".$value ." />";
// }

foreach ($fbUsersImg200pxWidthSrc as $key => $value){
	// 	echo $key." -- ".$value."<br />";
	echo "<img src=".$value ."  height='200' width='200' />";
}


?>