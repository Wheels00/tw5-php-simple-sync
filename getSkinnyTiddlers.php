<?php

$mrtime = 0; 

$output = '[ ' ; 

$list = glob("*.tid");



$files = array();

foreach (glob("*.tid") as $filename) {

if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && 
    strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) < filemtime($filename))
{

$files[] = $filename;

} 

} 

$k = count($files); 

foreach ($files as $filename) {
    $handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);



$time = filemtime($filename);

if ($time > $mrtime) {
  $mrtime = $time;
} 



$pattern = '/(,*\s)^\s+"text":.*$/m';

$contents = preg_replace($pattern, '$1', $contents);

$pattern = '/("),(\s*\})/m';

$contents = preg_replace($pattern, '$1$2', $contents);

$output = $output.$contents;

if ($k > 1) {

$output = $output.', 

';

$k = $k - 1; 

} 




}


if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && 
    strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $mrtime)
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