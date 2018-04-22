<?php 
$string = "Some numbers: one: 1; two: 2; three: 3 end"; 
$ten = 11; 
$newstring = preg_replace_callback( 
    '/(\\d+)/', 
    function($match) use ($ten) { return (($match[0] + $ten)); }, 
    $string 
    ); 
echo $newstring; 
#prints "Some numbers: one: 11; two: 12; three: 13 end"; 
?>