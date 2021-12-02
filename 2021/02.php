<?php
$list = file_get_contents("02/input.txt");

$commands = explode("\n", $list);
$first_count=0;
$distance=0;
$depth=0;
foreach( $commands as $key => $command ){
    $xp = explode(" ", $command);
    $movement = (string)$xp[0];
    $unit = (int)$xp[1];
    switch ($movement) {
    case "forward":
        $distance += $unit;
        break;
    case "down":
        $depth += $unit;
        break;
    case "up":
        $depth -= $unit;
        if($depth<0) $depth=0;
        break;
    }
}
$first_count = $distance*$depth;
echo $distance."\r\n";
echo $depth."\r\n";
echo $first_count."\r\n";

$second_count=0;
$distance=0;
$depth=0;
$aim=0;
foreach( $commands as $key => $command ){
    $xp = explode(" ", $command);
    $movement = (string)$xp[0];
    $unit = (int)$xp[1];
    switch ($movement) {
    case "forward":
        $distance += $unit;
        $depth += $unit*$aim;
        break;
    case "down":
        $aim += $unit;
        break;
    case "up":
        $aim -= $unit;

        break;
    }
}
$second_count = $distance*$depth;
echo $distance."\r\n";
echo $depth."\r\n";
echo $second_count."\r\n";
