<?php
$list = file_get_contents("03/input.txt");

$lines = explode("\n", $list);
$first_count=0;
$elaborations = elaborate($lines);
$gamma = $elaborations["greaters"];
$epsilon = $elaborations["lowers"];
$gamma_dec= bindecArray($gamma);
$epsilon_dec= bindecArray($epsilon);

$first_count = $gamma_dec*$epsilon_dec;

echo $first_count."\r\n";


$second_count=0;
$oxygen = $lines;
clean($oxygen, "greaters");
$oxygen_dec= bindecArray($oxygen);

$CO2_scrubber = $lines;
clean($CO2_scrubber, "lowers");
$CO2_scrubber_dec= bindecArray($CO2_scrubber);

$second_count=$oxygen_dec * $CO2_scrubber_dec;
echo $second_count."\r\n";


function elaborate($lines)
{
    $column_counters=[];
    foreach( $lines as $key => $line ){
        if(empty($line)) continue;
        $lenght = strlen($line);
        for ($i=0; $i < $lenght; $i++) {
            $bool = substr($line, $i,1);
            switch ($bool) {
                case "0":
                    if(empty($column_counters[$i]["0"])){
                        $column_counters[$i]["0"]=1;
                    } else {
                        $column_counters[$i]["0"]++;
                    }
                    break;
                case "1":
                    if(empty($column_counters[$i]["1"])){
                        $column_counters[$i]["1"]=1;
                    } else{
                        $column_counters[$i]["1"]++;
                    }
                    break;
            }
        }
    }
    foreach ($column_counters as $column_counter_key => $column_counter) {
        if($column_counter["0"]>$column_counter["1"]){
            $greaters[$column_counter_key]="0";
            $lowers[$column_counter_key]="1";
            continue;
        }
        $greaters[$column_counter_key]="1";
        $lowers[$column_counter_key]="0";
    }
    return [
        'greaters' => $greaters,
        'lowers' => $lowers,
        'couters' => $column_counters,
    ];
}

function bindecArray(array $binArray){
    return bindec(implode("",$binArray));
}

function clean (array &$to_clean, string $cleaner){
    $lenght = strlen($to_clean[0]);
    for ($i=0; $i < $lenght ; $i++) {
        $elaborations = elaborate($to_clean);
        foreach($to_clean as $key => $line){
            $bool = (int)substr($line, $i,1);
            if($bool==(int)$elaborations[$cleaner][$i]) continue;
            unset($to_clean[$key]);
        }
        if(count($to_clean)==1) return;
    }
}