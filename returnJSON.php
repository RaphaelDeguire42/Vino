
<?php

$str = "54,32 $";
$str = floatval(str_replace(",", ".", $str));
var_dump($str);


?>