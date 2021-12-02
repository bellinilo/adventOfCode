<?php
$list = file_get_contents("01/input.txt");
$array = explode("\n", $list);
$first_count=0;
foreach( $array as $key => $value ){
    if($key<1 ) continue;
    if ($value > $array[$key-1]) $first_count++;
}
echo $first_count."\r\n";

$second_count=0;
foreach( $array as $key => $value ){
    if($key<2 || $key==count($array)-1) continue;
    if ((int)$value+(int)$array[$key-2]+(int)$array[$key-1] < (int)$value+(int)$array[$key-1]+(int)$array[$key+1]) $second_count++;
}
echo $second_count;
