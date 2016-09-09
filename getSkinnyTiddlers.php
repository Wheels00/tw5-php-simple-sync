<?php

$mrtime = 0; 

$output = '[ ' ; 

$list = glob("*.tid");

$k = count($list); 

foreach (glob("*.tid") as $filename) {
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

header('Last-Modified: '.gmdate('D, d M Y H:i:s', $mrtime).' GMT');
echo $output.' ]';


?>