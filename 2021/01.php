<?php
$list = "199,200,208,210,200,207,240,269,260,263";

$array = explode(",", $list);
$first_count=0;
foreach( $array as $key => $value ){
    if($key<1 ) continue;
    if ($value > $array[$key-1]) $first_count++;
}
echo $first_count."\r\n";

$second_count=0;
foreach( $array as $key => $value ){
    if($key<2 || $key==count($array)-1) continue;
    if ($value+$array[$key-2]+$array[$key-1] < $value+$array[$key-1]+$array[$key+1]) $second_count++;
}
echo $second_count;
