<?php

$mrtime = 0; 

$output = '[ ' ; 

$list = glob("*.tid");

$reqMSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
$reqMSince = (isset($reqMSince) ? strtotime($reqMSince) : NULL);


$files = array();

foreach (glob("*.tid") as $filename) {
  
if (!isset($reqMSince) || ($reqMSince < filemtime($filename)))
{

$files[] = $filename;

} 

} 

$k = count($files); 

foreach ($files as $filename) {
  $fsize = filesize($filename);
  $contents = '';
  if ($fsize > 0) {
    $handle = fopen($filename, "r");
$contents = fread($handle, $fsize);
fclose($handle);
}



$time = filemtime($filename);

if ($time > $mrtime) {
  $mrtime = $time;
} 

$jsonC = json_decode($contents, true);
unset($jsonC['text']);
$output = $output.json_encode($jsonC);

if ($k > 1) {

$output = $output.', 

';

$k = $k - 1; 

} 




}


if (isset($reqMSince) && $reqMSince >= $mrtime) 
{
    header('HTTP/1.0 304 Not Modified');
    exit;
}

header('Cache-Control: no-cache, must-revalidate');
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $mrtime).' GMT');
echo $output.' ]';


?>