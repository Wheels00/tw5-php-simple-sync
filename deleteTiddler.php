<?php

$filename = urlencode($_GET["tiddler"]).".tid";

unlink($filename); 

?>