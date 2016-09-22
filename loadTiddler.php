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

/// bug with body caching; temporarily disabling 
// header('Last-Modified: '.gmdate('D, d M Y H:i:s', $time).' GMT');
echo $contents;

?>