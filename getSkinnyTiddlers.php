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
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
echo $output.' ]';


?>