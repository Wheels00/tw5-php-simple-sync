<?php

$filename = urlencode($_GET["tiddler"]).".tid";

$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

echo $contents;

?>