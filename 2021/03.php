<?php
$list = file_get_contents("03/input.txt");

$lines = explode("\n", $list);
$lenght=0;
$first_count=0;
$column_counters=[];
$gamma=[];
$epsilon=[];
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
            $gamma[$column_counter_key]="0";
            $epsilon[$column_counter_key]="1";
            continue;
        }
        $gamma[$column_counter_key]="1";
        $epsilon[$column_counter_key]="0";
    }
$gamma_dec= bindec(implode("",$gamma));
$epsilon_dec= bindec(implode("",$epsilon));

$first_count = $gamma_dec*$epsilon_dec;

echo $first_count."\r\n";
