<?php

$value1 = "abcde";
$value2 = '/^de/';
preg_match($value2,substr($value1,3),$matches, PREG_OFFSET_CAPTURE);
print_r ($matches);
/*
$subject = "abcdef";
$pattern = '/^def/';
preg_match($pattern, substr($subject,3), $matches, PREG_OFFSET_CAPTURE);
print_r($matches);
*/
?>
