<?php

$reqMSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
$reqMSince = (isset($reqMSince) ? strtotime($reqMSince) : NULL);

$filename = urlencode($_GET["tiddler"]).".tid";
$time = filemtime($filename);

/// bug with body caching; temporarily disabling 

// if (isset($reqMSince) && $reqMSince >= $time) {
//   header('HTTP/1.0 304 Not Modified');
//   exit;
// }
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

/// bug with body caching; temporarily disabling // ensuring no caching
// header('Last-Modified: '.gmdate('D, d M Y H:i:s', $time).' GMT');
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');


echo $contents;

?>