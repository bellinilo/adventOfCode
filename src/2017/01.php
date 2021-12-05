<?php
$list = file_get_contents("01/input.txt");

$first_count=0;
$lenght = strlen($list);
for ($i=0; $i < $lenght; $i++) {
    if($i < $lenght/2){
        if(substr($list, $i,1)==substr($list, $i+$lenght/2,1)) $first_count+=substr($list, $i,1);
    }
    else {
        if(substr($list, $i,1)==substr($list, $i+$lenght/2-$lenght,1)) $first_count+=substr($list, $i,1);

    }
    // echo $first_count."\n\r";
}
echo $first_count."\n\r";

// $second_count=0;
// foreach( $array as $key => $value ){
//     if($key<2 || $key==count($array)-1) continue;
//     if ((int)$value+(int)$array[$key-2]+(int)$array[$key-1] < (int)$value+(int)$array[$key-1]+(int)$array[$key+1]) $second_count++;
// }
// echo $second_count;
