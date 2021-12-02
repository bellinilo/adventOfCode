<?php
$list = file_get_contents("02/input.txt");

$lines = explode("\n", $list);
$first_count=0;
foreach( $lines as $key => $line ){
    if(empty($line)) continue;
    $numbers = preg_split('/\s+/', $line);
    $greater=0;
    $diff=0;
    $lower=10000000000;
    foreach ($numbers as $key => $number) {
        if(empty($number))continue;
        $number=(int)$number;
        if($number > $greater) $greater = $number;
        if($number < $lower) $lower = $number;
    }
    $diff = $greater - $lower;
    $first_count += $diff;

}
echo $first_count."\r\n";

function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

$second_count=0;
foreach( $lines as $key => $line ){
    if(empty($line)) continue;
    $mod=0;
    $numbers = preg_split('/\s+/', $line);
    usort($numbers, "cmp");
    $lenght = count($numbers);
    foreach ($numbers as $key => $number) {
        if(empty($number))continue;
        $number=(int)$number;
        for ($i=$key+1; $i < $lenght; $i++) {
            if($numbers[$i]%$number==0){
                $mod=$numbers[$i]/$number;
                continue 2;
            }
        }
    }
    $second_count += $mod;

}
echo $second_count."\r\n";
