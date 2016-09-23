<?php

$reqMSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
$reqMSince = (isset($reqMSince) ? strtotime($reqMSince) : NULL);

$filename = urlencode($_GET["tiddler"]).".tid";
$time = filemtime($filename);

if (isset($reqMSince) && $reqMSince >= $time) {
   header('HTTP/1.0 304 Not Modified');
   exit;
 }
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);


header('Cache-Control: no-cache, must-revalidate'); // no-cache allows caching but requires checking with the server for updates
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $time).' GMT'); 
echo $contents;

?>