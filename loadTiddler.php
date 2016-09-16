<?php

$filename = urlencode($_GET["tiddler"]).".tid";

$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$time = filemtime($filename);
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $time).' GMT');
echo $contents;

?>