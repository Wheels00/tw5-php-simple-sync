<?php

$output = '[ ' ; 

$list = glob("*.tid");

$k = count($list); 

foreach (glob("*.tid") as $filename) {
    $handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);



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

echo $output.' ]';


?>